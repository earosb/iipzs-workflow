@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Tipos
                @endslot

                <div class="pull-right">
                    <a href="{{ route('type.create') }}" class="btn btn-default">{{ __('buttons.create') }}</a>
                </div>

                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>
                                {{ $type->name }}
                            </td>
                            <td>
                                {{ $type->notifyByDefault->implode('name', ', ') }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('type.edit', $type->id) }}" class="btn btn-sm btn-default"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                <form method="POST" action="{{ route('type.destroy', $type->id) }}"
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
                    {{ $types->links() }}
                </div>
            @endcomponent
        </div>
    </div>
@endsection