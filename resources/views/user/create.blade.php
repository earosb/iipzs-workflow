@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Usuarios
                @endslot

                <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="col-md-4 control-label">{{ __('labels.name') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                   autofocus>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <label for="email" class="col-md-4 control-label">{{ __('labels.email') }}</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                   autofocus>
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
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