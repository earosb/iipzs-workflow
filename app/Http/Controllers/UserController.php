<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all(['id', 'name', 'email']);

        return view('user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * @param StoreUser $request
     * @return $this|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreUser $request)
    {
        User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt(str_random(8)),
        ]);
        return redirect()->route('user.index');
    }

    /**
     *
     */
    public function edit(User $user)
    {
        $roles = Role::all(['id', 'name']);

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     *
     */
    public function update(User $user, Request $request)
    {
        $user->syncRoles($request->rol);

        return redirect()->route('user.index');
    }
}
