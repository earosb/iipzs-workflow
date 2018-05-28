<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::paginate(15);
        
        return view('resource.index', compact('resources'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resource.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        
        Resource::create($request->except('_token'));
        
        flash('El recurso fue creado');
        
        return redirect()->route('resource.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('resource.edit', compact('resource'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        
        $resource->update($request->except(['_method', '_token']));
        
        flash('El recurso fue actualizado');
        
        return redirect()->route('resource.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Resource $resource)
    {
        
        try {
            $resource->delete();
            flash('Recurso eliminado correctamente');
        } catch (\Exception $e) {
            logger('\App\Http\Controllers\ResourceController::destroy', [
                'user'    => Auth::user()->id,
                'issue'   => $resource->id,
                'message' => $e->getMessage(),
            ]);
            flash('Ocurrió un error al intentar eliminar el recurso: ' . $e->getMessage());
        }
        
        return redirect()->route('resource.index');
    }
}
