@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Tipos
                @endslot

                <form class="form-horizontal" method="POST" action="{{ route('type.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="col-md-4 control-label">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                   autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                        <label for="content" class="col-md-4 control-label">Notificar por defecto</label>
                        <div class="col-md-6">
                            @foreach ($users->chunk(2) as $chunk)
                                <div class="col-md-6">
                                    @foreach ($chunk as $user)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="users[]" name="users[]" value="{{ $user->id }}">{{ $user->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 pull-right">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </div>

                </form>

            @endcomponent
        </div>
    </div>
@endsection