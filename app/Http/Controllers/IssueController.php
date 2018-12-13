<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssue;
use App\Http\Requests\UpdateIssue;
use App\Issue;
use App\Resource;
use App\Search\Issue\IssueSearch;
use App\Status;
use App\Type;
use App\User;
use Auth;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $states = Status::all(['id', 'name']);

        $users = User::all(['id', 'name']);

        $issues = IssueSearch::apply($request)->appends($request->except(['page']));

        return view('issue.index', compact('states', 'users', 'issues'));
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Issue $issue)
    {
        $issue->load(['createdBy', 'comments.createdBy', 'comments.issue', 'resources']);

        $users = User::all('name AS label', 'id AS value')->whereNotIn('id', Auth()->id());

        return view('issue.show', compact('issue', 'users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = Type::all(['id', 'name']);
        $users = User::all(['id', 'name'])
            ->map(function ($user) {
                return ['label' => $user->name, 'value' => $user->id];
            });
        $resources = Resource::all(['id', 'name'])
            ->map(function ($resource) {
                return ['label' => $resource->name, 'value' => $resource->id];
            });

        return view('issue.create', compact('types', 'users', 'resources'));
    }

    /**
     * @param StoreIssue $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreIssue $request)
    {
        return $request->all();
        /** @var Type $type */
        $type = Type::findOrFail($request->input('type'));

        /** @var Issue $issue */
        $issue = Issue::create([
            'created_by'  => Auth::user()->id,
            'assigned_to' => $request->input('assigned_to'),
            'type_id'     => $type->id,
            'status_id'   => Status::whereName('open')->first()->id,
            'title'       => $request->input('title'),
            'description' => $request->input('description')
        ]);

        if ($request->has('resources')) {
            $resources = explode(',', $request->input('resources'));
            $issue->resources()->attach($resources);
        }

        if ($request->has('notify_to')) {
            $subscribers = explode(',', $request->input('notify_to'));
            $issue->subscribers()->attach($subscribers);
        }

        if ($request->has('attachments')) {
            foreach ($request->attachments as $attachment) {
                $issue->attachments()->create([
                    'name'      => $attachment->getClientOriginalName(),
                    'mime_type' => $attachment->getClientMimeType(),
                    'path'      => $attachment->store('attachments', 'public')
                ]);
            }
        }

        // $issue->subscribers()->attach($type->notifyByDefault->pluck('id'));

        return redirect()->route('issue.show', $issue->id);
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Issue $issue)
    {
        $issue->load(['createdBy', 'comments.createdBy', 'comments.issue', 'resources']);

        $types = Type::all(['id', 'name']);
        $users = User::all(['id', 'name']);
        $resources = Resource::all(['id', 'name'])
            ->map(function ($resource) {
                return ['label' => $resource->name, 'value' => $resource->id];
            });

        $selectedResources = $issue->resources->map(function ($resource) {
            return ['label' => $resource->name, 'value' => $resource->id];
        });

        return view('issue.edit', compact('issue', 'users', 'types', 'resources', 'selectedResources'));
    }

    /**
     * @param Issue $issue
     * @param UpdateIssue $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Issue $issue, UpdateIssue $request)
    {
        $issue->update(
            $request->except(['_method', '_token'])
        );

        if ($request->has('resources')) {
            $resources = explode(',', $request->input('resources'));
            $issue->resources()->sync($resources);
        }

        flash(__('issue.updated'));

        return redirect()->route('issue.show', $issue->id);
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Issue $issue)
    {
        try {
            $issue->delete();
            flash(__('issue.deleted'));
        } catch (\Exception $e) {
            logger('\App\Http\Controllers\IssueController::destroy', [
                'user'    => Auth::user()->id,
                'issue'   => $issue->id,
                'message' => $e->getMessage(),
            ]);
            flash(__('issue.deleted_error', ['message' => $e->getMessage()]));
        }

        return redirect()->route('issue.index');
    }
}
