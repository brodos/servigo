<?php

namespace App\Http\Controllers\User;

use App\Media;
use App\Project;
use App\Proposal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ProposalsController extends Controller
{
    public function index()
    {
    	$proposals = auth()->user()->proposals()
                        ->with('project','project.owner.profile.city','project.owner.profile.county')
                        ->orderBy('withdrawn_at', 'asc')
                        ->orderBy('confirmed_at', 'desc')
                        ->orderBy('accepted_at', 'desc')
                        ->orderBy('submitted_at', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(config('settings.pagination.proposalsPerPage'), ['*'], 'p');

    	return view('account.proposals.index', compact('proposals'));
    }

    public function create(Project $project)
    {
    	$this->authorize('create_proposal', $project);

    	return view('account.proposals.create', compact('project'));
    }

    public function store(Project $project)
    {
    	$this->authorize('create_proposal', $project);

    	$this->validate(request(), [
    		'duration' => 'required|numeric',
            'duration_type' => 'required|numeric|in:' . implode(',', array_keys(config('settings.duration_type'))),
    		'price' => 'required|numeric',
    		'available_from' => 'required|date_format:d/m/Y',
    		'description' => 'required|min:50|max:10000',
    	]);

    	$available_from = Carbon::createFromFormat('d/m/Y', request()->available_from);

    	$proposal = $project->proposals()->create([
    		'user_id' => auth()->id(),
    		'uuid' => Str::uuid(),
    		'description' => request()->description,
    		'price' => request()->price,
    		'duration' => request()->duration,
    		'duration_type' => request()->duration_type,
    		'available_from' => $available_from,
    		'submitted_at' => now()
    	]);

    	// check for images
        if (request()->has('images')) {
            $media = Media::whereIn('uuid', request()->images)->pluck('id')->toArray();

            $proposal->media()->sync($media);
        }

    	return redirect()->route('user-proposal.show', $proposal)->with('flash-message', 'Oferta a fost trimisă cu success!');
    }

    public function show(Proposal $proposal)
    {
    	$this->authorize('view_proposal', $proposal);

    	$proposal->load('media');

    	return view('account.proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
    	$this->authorize('update_proposal', $proposal);

    	return view('account.proposals.edit', compact('proposal'));
    }

    public function update(Proposal $proposal)
    {
    	$this->authorize('update_proposal', $proposal);

    	$this->validate(request(), [
    		'duration' => 'required|numeric',
            'duration_type' => 'required|numeric|in:' . implode(',', array_keys(config('settings.duration_type'))),
    		'price' => 'required|numeric',
    		'available_from' => 'required|date_format:d/m/Y',
    		'description' => 'required|min:50|max:10000',
    	]);

    	$available_from = Carbon::createFromFormat('d/m/Y', request()->available_from);

    	$proposal->update([
    		'description' => request()->description,
    		'price' => request()->price,
    		'duration' => request()->duration,
    		'duration_type' => request()->duration_type,
    		'available_from' => $available_from,
    	]);

    	// check for images
        if (request()->has('images')) {
            $media = Media::whereIn('uuid', request()->images)->pluck('id')->toArray();

            $proposal->media()->sync($media);
        }

    	return redirect()->route('user-proposal.show', $proposal)->with('flash-message', 'Oferta a fost modificată cu success!');
    }
}
