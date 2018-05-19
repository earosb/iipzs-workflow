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
                               class="list-group-item">Detalles de cuenta</a>
                            <a href="{{ route('profile.password') }}" type="button"
                               class="list-group-item active">Cambiar contraseña</a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <form method="POST" action="{{ route('profile.update-password') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="old_password">Contraseña actual</label>
                                <input type="password" class="form-control" name="old_password" id="old_password">
                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="new_password">Nueva contraseña</label>
                                <input type="password" class="form-control" name="new_password" id="new_password">
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Repetir nueva contraseña</label>
                                <input type="password" class="form-control" name="new_password_confirmation"
                                       id="new_password_confirmation">
                                @if ($errors->has('new_password_confirmation'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Establecer nueva contraseña</button>
                        </form>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
@endsection