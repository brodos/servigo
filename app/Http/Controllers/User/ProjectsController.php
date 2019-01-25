<?php

namespace App\Http\Controllers\User;

use App\Media;
use App\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
	/**
     * Display a listing of the users projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = auth()->user()->projects()
                        ->withCount('proposals')
                        ->with('proposals','owner.profile.city', 'owner.profile.county')
                        ->orderBy('completed_at', 'asc')
                        ->orderBy('published_at', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(config('settings.pagination.perPage'), ['*'], 'p');

        return view('account.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('update_project', $project);

        return view('account.projects.show', compact('project'));
    }

    /**
     * Show the form for creating a new project.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	return view('account.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:50|max:10000',
            'start_date' => 'nullable|date_format:d/m/Y',
            'end_date' => 'nullable|date_format:d/m/Y',
            'asap' => 'required_without_all:start_date,end_date'
        ]);

        $project = new Project;

        $project->uuid = Str::uuid();
        $project->user_id = auth()->id();

        if (request()->asap) {
            $project->start_date = $project->end_date = null;
            $project->asap = 1;
        } else {
            $project->start_date = Carbon::createFromFormat('d/m/Y', request()->start_date);
            if (empty(request()->end_date)) {
                $project->end_date = $project->start_date;
            } else {
                $project->end_date = Carbon::createFromFormat('d/m/Y', request()->end_date);
            }
        }

        $project->fill([
            'title' => request()->title,
            'slug' => str_slug(request()->title . ' ' . str_random(8)),
            'description' => request()->description,
        ]);

        $project->save();

        // $hashids = new Hashids(config('settings.hashids.key'), config('settings.hashids.pad'));
        // $project->slug = str_slug($project->title) . '-' . $hashids->encode($project->id);
        // $project->save();

        // check for images
        if (request()->has('images')) {
            $media = Media::whereIn('uuid', request()->images)->pluck('id')->toArray();

            $project->media()->sync($media);
        }

        return redirect()->route('user-project.show', $project)->with('flash-message', 'Anuntul a fost creat cu succes!');

    }

    public function edit(Project $project)
    {
        $this->authorize('update_project', $project);

        // return $project->media;

        return view('account.projects.edit', compact('project'));        
    }

    public function update(Project $project)
    {

        $this->authorize('update_project', $project);

        $this->validate(request(), [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:50|max:10000',
            'start_date' => 'nullable|required_without:asap|date_format:d/m/Y',
            'end_date' => 'nullable|date_format:d/m/Y',
            'asap' => 'required_without_all:start_date,end_date'
        ]);

        if (request()->asap) {
            $project->start_date = $project->end_date = null;
            $project->asap = 1;
        } else {
            $project->start_date = Carbon::createFromFormat('d/m/Y', request()->start_date);

            if (request()->end_date == '') {
                $project->end_date = $project->start_date;
            } else {
                $project->end_date = Carbon::createFromFormat('d/m/Y', request()->end_date);
            }

            $project->asap = 0;
        }

        $project->fill([
            'title' => request()->title,
            'slug' => str_slug(request()->title . ' ' . str_random(8)),
            'description' => request()->description,
        ]);

        $project->save();

        // check for images
        if (request()->has('images')) {
            $media = Media::whereIn('uuid', request()->images)->pluck('id')->toArray();

            $project->media()->sync($media);
        }

        return redirect()->route('user-project.show', $project)->with('flash-message', 'Anuntul a fost modificat cu success!');

    }
}
