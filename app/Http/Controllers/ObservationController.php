<?php

namespace App\Http\Controllers;

use App\Observation;
use App\User;

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
}
