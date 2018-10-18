@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Usuarios
                @endslot

                @include('flash::message')

                <div class="pull-right">
                    <a href="{{ route('invite') }}" class="btn btn-default">{{ __('buttons.create') }}</a>
                </div>

                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th class="hidden-xs">Correo electrónico</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td class="hidden-xs">
                                {{ $user->email }}
                            </td>
                            <td>
                                @if($user->roles->count() > 0)
                                    {{ __('roles.'.$user->roles->first()->name) }}
                                @else
                                    Usuario sin rol asignado
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-default">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection