<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreComment;
use App\Issue;
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
        $comment = Comment::create([
            'created_by'  => Auth::user()->id,
            'issue_id'    => $issue->id,
            'description' => $request->input('description')
        ]);

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
