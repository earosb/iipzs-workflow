<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordChanged;
use App\Rules\PasswordMatchRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();

        return view('profile.show', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword()
    {
        return view('profile.edit-password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password'              => ['required', new PasswordMatchRule],
            'new_password'              => 'required|confirmed|string|min:6|different:old_password',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        $user->update([
            'password' => bcrypt($request->input('new_password')),
        ]);

        $user->notify(new PasswordChanged());

        flash('Contraseña cambiada correctamente');

        return redirect()->route('profile');
    }
}
