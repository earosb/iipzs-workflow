<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Issue as IssueResource;
use App\Search\Issue\IssueSearch;
use Illuminate\Http\Request;
use App\Issue;

class IssueController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if (auth()->user()->can('view all issues')) {
            $issues = IssueSearch::apply($request)->appends($request->except(['page']));
        } else {
            $issues = IssueSearch::apply($request)->appends(
                array_merge($request->except(['page']), ['created_by' => auth()->user()->id])
            );
        }

        return IssueResource::collection($issues);
    }

    /**
     *
     */
    public function show(Issue $issue)
    {
        $issue->load('comments');

        return new IssueResource($issue);
    }
}
