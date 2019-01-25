<?php

namespace App\Http\Controllers\Client;

use App\Media;
use App\Project;
use App\Proposal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::owned()
                        ->with('proposals','feedback')
                        ->orderBy('published_at', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('clients.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:50|max:10000',
        ]);

        $project = Project::create([
            'user_id' => auth()->user()->id,
            'name' => request('name'),
            'description' => request('description'),
            'uuid' => Str::uuid(),
        ]);



        if (request()->has('images')) {
            $media = Media::whereIn('uuid', request()->images)->pluck('id')->toArray();

            $project->media()->sync($media);
        }

        return redirect()->route('client-projects.show', $project->id)->with('flash-message', 'Anuntul a fost creat cu succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        $project = Project::owned()
                        ->with('owner','proposals.owner','messages')
                        ->withCount('proposals', 'unreadProposals', 'messages', 'unreadMessages')
                        ->where('id', $project->id)->firstOrFail();
                        
        return view('clients.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('clients.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $this->validate(request(), [
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:50|max:5000',
        ]);

        $project->update([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        return redirect()->route('client-projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect()->route('client-projects.index');
    }
}