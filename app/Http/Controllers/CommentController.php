<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreComment;
use App\Issue;
use App\Status;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * @param StoreComment $request
     * @param Issue $issue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreComment $request, Issue $issue)
    {
        if ($issue->comments->count() === 0)
            $issue->update(['status_id' => Status::whereName('open')->first()->id]);

        $comment = Comment::create([
            'created_by'  => Auth::user()->id,
            'issue_id'    => $issue->id,
            'description' => $request->input('description')
        ]);

        if ($request->input('action') === 'resolve') {
            $issue->update(['status_id' => Status::whereName('resolved')->first()->id]);
        } else if ($request->input('action') === 'close') {
            $issue->update(['status_id' => Status::whereName('closed')->first()->id]);
        }

//        if ($request->has('attachments')) {
//            foreach ($request->attachments as $attachment) {
//                $attach = json_decode($attachment, true);
//                $comment->attachments()->create($attach);
//            }
//        }

        if ($request->has('attachment')) {
            $comment->attachments()->create([
                'name'      => $request->attachment->getClientOriginalName(),
                'mime_type' => $request->attachment->getClientMimeType(),
                'path'      => $request->attachment->store('attachments', 'public')
            ]);
        }

        if (!$issue->subscribers->contains(Auth::user()->id))
            $issue->subscribers()->attach(Auth::user()->id);

        return redirect()->route('issue.show', $issue->id);
    }
}
