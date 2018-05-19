@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Perfil
                @endslot

                @include('flash::message')
                <div class="row">
                    <div class="col-sm-4">
                        <div class="list-group">
                            <a href="{{ route('profile') }}" type="button"
                               class="list-group-item active">Detalles de cuenta</a>
                            <a href="{{ route('profile.password') }}" type="button"
                               class="list-group-item">Cambiar contraseña</a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <table class="table show-table">
                            <thead>
                            <tr>
                                <td class="show-table-label">Nombre</td>
                                <td class="show-table-data">{{ $user->name }}</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="show-table-label">Correo electrónico</td>
                                <td class="show-table-data">{{ $user->email }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
@endsection