<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\ObservationReceivedNewComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        return dd($request->all());
        $this->validate($request, [
            'comment'          => 'required',
            'observation'      => 'required|exists:observations,id',
            'immediate_action' => 'exists:users,id',
        ]);

        $comment = Comment::create([
            'user_id'             => Auth::user()->id,
            'immediate_action_id' => $request->has('immediate_action') ? $request->input('immediate_action') : null,
            'observation_id'      => $request->input('observation'),
            'content'             => $request->input('comment')
        ]);

        if ($request->has('attachments')) {
            foreach ($request->attachments as $attachment) {
                $attach = json_decode($attachment, true);
                $comment->attachments()->create($attach);
            }
        }

//        if ($request->has('immediate_action'))
//            event(new ImmediateActionEvent::class)

        event(new ObservationReceivedNewComment($comment));

        return redirect()->route('observation.show', $request->input('observation'));
    }
}
