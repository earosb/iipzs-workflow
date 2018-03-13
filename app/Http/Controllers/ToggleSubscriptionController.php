<?php

namespace App\Http\Controllers;

use App\Issue;
use Auth;

class ToggleSubscriptionController extends Controller
{

    /**
     * Alterna la suscripción de un usuario
     *
     * @param Issue $issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Issue $issue)
    {
        $issue->subscribers()->toggle(Auth::id());

        return redirect()->route('issue.show', $issue->id);
    }
}
