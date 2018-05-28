@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Recursos
                @endslot
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <form method="POST" action="{{ route('resource.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       autofocus>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description">Descripción <span class="text-muted">(opcional)</span></label>
                                <textarea name="description" id="description" class="form-control"
                                          rows="4">{{ old('description') }}</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
@endsection