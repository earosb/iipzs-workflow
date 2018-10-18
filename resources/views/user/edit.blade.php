@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Editar usuario
                @endslot

                <form class="form-horizontal" method="POST" action="{{ route('user.update', $user) }}">
                    <input name="_method" value="PATCH" type="hidden">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label class="col-md-4 control-label">{{ __('labels.name') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <label class="col-md-4 control-label">{{ __('labels.email') }}</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('roles') ? 'has-error' : ''}}">
                        <label class="col-md-4 control-label">{{ __('labels.roles') }}</label>
                        <div class="col-md-6">
                            @foreach ($roles as $rol)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="rol" value="{{$rol->id}}"> {{$rol->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </div>

                </form>

            @endcomponent
        </div>
    </div>
@endsection