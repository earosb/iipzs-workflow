<?php

namespace App\Http\Controllers;

use App\Invite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite()
    {
        return view('user.invite');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request)
    {
        // process the form submission and send the invite by email
        // validate the incoming request data
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //update or create a new invite record
        $invite = Invite::updateOrCreate(
            [
                'email' => $request->input('email')
            ],
            [
                'name' => $request->input('name'),
                'token' => $token
            ]
        );


        $invite->sendInvitationNotification();

        flash(__('user.invite_sent', ['name' => $invite->name, 'email' => $invite->email]));

        return redirect()->route('user.index');
    }

    public function accept($token)
    {
        // here we'll look up the user by the token sent provided in the URL
        // Look up the invite
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        return view('user.create', compact('invite'));
    }

    public function register(Request $request, $token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $invite->name,
            'email' => $invite->email,
            'password' => bcrypt($request->input('password'))
        ]);

        // delete the invite so it can't be used again
        $invite->delete();

        $credentials = ['email' => $user->email, 'password' => $request->input('password')];

        Auth::attempt($credentials);

        return redirect()->route('home');
    }
}
