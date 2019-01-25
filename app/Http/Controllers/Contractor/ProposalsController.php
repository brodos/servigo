<?php

namespace App\Http\Controllers\Contractor;

use App\Project;
use App\Proposal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ProposalsController extends Controller
{
    public function index()
    {
    	$proposals = Proposal::owned()->get();;

    	return view('contractors.proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('contractors.proposals.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project)
    {
    	$this->validate(request(), [
    		'duration' => 'required|numeric',
            // 'duration_type' => 'required|numeric|in:' . implode(',', config('settings.duration_type')),
    		'duration_type' => 'required|numeric',
    		'price' => 'required|numeric',
    		'start_date' => 'required|date_format:Y-m-d',
    		'description' => 'required|min:50|max:5000',
    	]);

        try {
        	$proposal = Proposal::create([
        		'uuid' => Str::uuid(),
        		'user_id' => auth()->user()->id,
        		'project_id' => $project->id,
        		'price' => request()->price,
        		'description' => request()->description,
        		'duration' => request()->duration,
        		'duration_type' => request()->duration_type,
        		'start_date' => request()->start_date,
        		'status' => 1,
        	]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'You already submitted a proposal for this project']);
        }

        return redirect()->route('contractor-proposals.show', [$project->id, $proposal->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Proposal $proposal)
    {
        return view('contractors.proposals.show', ['proposal' => $proposal, 'project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project, Proposal $proposal)
    {
        $project->status = 3;
        $project->save();

        $proposal->status = 4;
        $proposal->save();

        return redirect()->route('contractor-proposals.show', [$project->id, $proposal->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
