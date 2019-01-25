<?php

namespace App\Http\Controllers\Contractor;

use App\User;
use App\Project;
use App\Feedback;
use App\Proposal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class FeedbackController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('contractors.feedback.create', ['project' => $project]);
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
                'to_user_id' => $project->user_id,
                'project_id' => $project->id,
                'created_at' => Carbon::now(),
            ]);
        } catch (QueryException $exception) {
            return redirect()->back()->withInput()->withErrors(['error' => 'A feedback was already submitted.']);
        }

        // update the project status to complete
        $proposal->status = config('settings.proposal.completed');
        $proposal->save();

        return redirect()->route('contractor-completed-projects.show', $project->id);
    }

    /**
     * Show the form for submitting a feedback reply
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function reply(Project $project)
    {
        return view('contractor-feedback-reply.show');
    }

    /**
     * Store a reply for the given feedback
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function storeReply(Feedback $feedback)
    {
        // check if the auth user is allowed to submit a reply
        $this->validate(request(), [
            'reply' => 'required|min:3',
        ]);

        $feedback_reply = Feedback::update([
            'reply' => request()->reply,
            'replied_at' => Carbon::now(),
        ]);

        redirect()->route('contractor-completed-projects.show', $project->id);
    }
}
