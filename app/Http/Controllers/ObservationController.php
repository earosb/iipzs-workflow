<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObservation;
use App\Observation;
use App\Status;
use App\Type;
use App\User;
use Auth;

class ObservationController extends Controller
{
    public function index()
    {
        $observations = Observation::withCount('comments')->orderBy('created_at')->paginate(20);

        flash('Observaciones cargadas', 'info');

        return view('observation.index', compact('observations'));
    }

    public function show($id)
    {
        $observation = Observation::find($id)->load(['user', 'comments']);

        $users = User::all('name AS label', 'id AS value')->whereNotIn('id', Auth()->id());

        return view('observation.show', compact('observation', 'users'));
    }

    public function create()
    {
        $types = Type::all(['id', 'name']);

        return view('observation.create', compact('types'));
    }

    public function store(StoreObservation $request)
    {
        $observation = Observation::create([
            'user_id'   => Auth::user()->id,
            'type_id'   => $request->input('type'),
            'status_id' => Status::whereName('new')->first()->id,
            'title'     => $request->input('title'),
            'content'   => $request->input('content')
        ]);

        if ($request->has('attachment')) {
            $observation->attachments()->create([
                'name'      => $request->attachment->getClientOriginalName(),
                'mime_type' => $request->attachment->getClientMimeType(),
                'path'      => $request->attachment->store('attachments', 'public')
            ]);
        }

        return redirect()->route('observation.index');
    }
}
