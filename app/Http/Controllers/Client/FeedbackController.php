<?php

namespace App\Http\Controllers\Client;

use App\Project;
use App\Feedback;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('clients.feedback.create', compact('project'));
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
            'rating' => 'required|numeric|between:1,5',
            'message' => 'sometimes|nullable|min:3|max:500',
        ]);

        $proposal = $project->winningProposal;

        try {
            $feedback = Feedback::create([
                'uuid' => Str::uuid(),
                'rating' => request()->rating,
                'message' => request()->message,
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $proposal->user_id,
                'project_id' => $project->id,
                'created_at' => Carbon::now(),
            ]);
        } catch (QueryException $exception) {
            return redirect()->back()->withInput()->withErrors(['error' => 'A feedback was already submitted.']);
        }

        // update the project status to complete
        $project->status = config('settings.project.completed');
        $project->save();

        return redirect()->route('client-projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
