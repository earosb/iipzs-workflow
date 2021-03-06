@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                <div class="col-sm-10 col-sm-offset-1">

                    <form method="POST" action="{{ route('issue.store') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type">Tipo</label>
                                <div class="btn-group btn-group-justified" data-toggle="buttons">
                                    @foreach($types as $type)
                                        <label class="btn btn-default">
                                            <input autocomplete="off" name="type" value="{{ $type->id }}" type="radio">
                                            {{ $type->name }}
                                        </label>
                                    @endforeach
                                </div>
                                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                    autofocus>
                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description">Descripción</label>
                                <textarea name="description" id="description" class="form-control"
                                        rows="5">{{ old('description') }}</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : ''}}">
                                <label for="assigned_to">Acción inmediata</label>
                                <app-select name="assigned_to" :multiple="false" :options="{{ json_encode($users->toArray()) }}"></app-select>
                                {!! $errors->first('assigned_to', '<p class="help-block">:message</p>') !!}
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group {{ $errors->has('resources') ? 'has-error' : ''}}">
                                <label for="title">Recursos <small class="text-muted">(opcional)</small></label>
                                <app-select name="resources" :multiple="true" :options="{{ json_encode($resources->toArray()) }}"></app-select>
                                {!! $errors->first('resources', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('notify_to') ? 'has-error' : ''}}">
                                <label for="notify_to">Notificar a <small class="text-muted">(opcional)</small></label>
                                <app-select name="notify_to" :multiple="true" :options="{{ json_encode($users->toArray()) }}"></app-select>
                                {!! $errors->first('notify_to', '<p class="help-block">:message</p>') !!}
                            </div>

                            <obs-attach :attach="{{ json_encode(old('attachments')) }}"></obs-attach>

                        </div>

                        </div>

                        <input type="submit" class="btn btn-primary" value="Guardar">

                    </form>

                </div>

            @endcomponent
        </div>
    </div>
@endsection