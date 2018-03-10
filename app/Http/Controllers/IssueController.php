<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssue;
use App\Issue;
use App\Status;
use App\Type;
use App\User;
use Auth;

class IssueController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $issues = Issue::withCount('comments')->orderBy('updated_at', 'desc')->paginate(20);

        flash('Observaciones cargadas', 'info');

        return view('issue.index', compact('issues'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $issue = Issue::find($id)->load(['user', 'comments']);

        $users = User::all('name AS label', 'id AS value')->whereNotIn('id', Auth()->id());

        return view('issue.show', compact('issue', 'users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = Type::all(['id', 'name']);

        return view('issue.create', compact('types'));
    }

    /**
     * @param StoreIssue $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreIssue $request)
    {
        $issue = Issue::create([
            'user_id'   => Auth::user()->id,
            'type_id'   => $request->input('type'),
            'status_id' => Status::whereName('new')->first()->id,
            'title'     => $request->input('title'),
            'content'   => $request->input('content')
        ]);

        if ($request->has('attachment')) {
            $issue->attachments()->create([
                'name'      => $request->attachment->getClientOriginalName(),
                'mime_type' => $request->attachment->getClientMimeType(),
                'path'      => $request->attachment->store('attachments', 'public')
            ]);
        }

        return redirect()->route('issue.index');
    }
}
