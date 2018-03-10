<?php

namespace App\Http\Controllers;

use App\Type;
use App\User;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $types = Type::paginate(15);

        return view('type.index', compact('types'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::all(['id', 'name']);

        return view('type.create', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $type = Type::create([
            'name' => $request->get('name')
        ]);

        $type->notifyByDefault()->attach($request->input('users'));

        return redirect()->route('type.index');
    }

    /**
     * @param Type $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Type $type)
    {
        $users = User::all(['id', 'name']);

        return view('type.edit', compact('type', 'users'));
    }

    /**
     * @param Type $type
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Type $type, Request $request)
    {
        $type->name = $request->name;
        $type->save();

        $type->notifyByDefault()->sync($request->input('users'));

        return redirect()->route('type.index');
    }

    /**
     * @param Type $type
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Type $type)
    {
        $type->notifyByDefault()->detach();
        $type->delete();

        return redirect()->route('type.index');
    }
}
