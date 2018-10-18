<?php

namespace App\Http\Controllers\Api\v1;

use App\Comment;
use App\Issue;
use App\Status;
use App\User;
use App\Http\Requests\StoreComment;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Facades\Auth;

class CommentController
{
    /**
     * @param Issue $issue
     * @param StoreComment $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreComment $request, Issue $issue)
    {
        $comment = Comment::create([
            'created_by'  => Auth::user()->id,
            'issue_id'    => $issue->id,
            'description' => $request->input('description')
        ]);

        if ($request->input('action') === 'resolve') {
            $issue->update(['status_id' => Status::whereName('resolved')->first()->id]);
        } elseif ($request->input('action') === 'close') {
            $issue->update(['status_id' => Status::whereName('closed')->first()->id]);
        }

        if ($request->has('attachments')) {
            foreach ($request->attachments as $attachment) {
                $comment->attachments()->create([
                    'name'      => $attachment->getClientOriginalName(),
                    'mime_type' => $attachment->getClientMimeType(),
                    'path'      => $attachment->store('attachments', 'public')
                ]);
            }
        }

        if ($request->has('assigned_to')) {
            $newAssignedTo = User::find($request->input('assigned_to'));
            if ($issue->assigned_to !== $newAssignedTo->id) {
                Comment::create([
                    'created_by'  => Auth::user()->id,
                    'issue_id'    => $issue->id,
                    'description' => "Cambió usuario responsable ({$issue->assignedTo->name} > {$newAssignedTo->name})"
                ]);
                $issue->update(['assigned_to' => $request->input('assigned_to')]);
            }
        }

        if (!$issue->subscribers->contains(Auth::user()->id)) {
            $issue->subscribers()->attach(Auth::user()->id);
        }

        return CommentResource::collection($issue->comments);
    }
}
