@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Actualizar recurso
                @endslot
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <form method="POST" action="{{ route('resource.update', $resource->id) }}">
                            {{ csrf_field() }}
                            <input name="_method" value="PATCH" type="hidden">

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $resource->name }}"
                                       autofocus>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description">Descripción <span class="text-muted">(opcional)</span></label>
                                <textarea name="description" id="description" class="form-control"
                                          rows="4">{{ $resource->description }}</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
@endsection