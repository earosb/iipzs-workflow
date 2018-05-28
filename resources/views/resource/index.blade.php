@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Recursos
                @endslot

                <div class="pull-right">
                    <a href="{{ route('resource.create') }}" class="btn btn-default">{{ __('buttons.create') }}</a>
                </div>

                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>
                                {{ $resource->name }}
                            </td>
                            <td>
                                {{ $resource->description }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('resource.edit', $resource->id) }}"
                                   class="btn btn-sm btn-default"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                <form method="POST" action="{{ route('resource.destroy', $resource->id) }}"
                                      style="display:inline">
                                    {{ csrf_field() }}
                                    <input name="_method" value="DELETE" type="hidden">
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"
                                              title="Eliminar"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $resources->links() }}
                </div>
            @endcomponent
        </div>
    </div>
@endsection