@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-1">

                    <form method="POST" action="{{ route('issue.store') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

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

                        <div class="form-group {{ $errors->has('resources') ? 'has-error' : ''}}">
                            <label for="title">Recursos <span class="text-muted">(opcional)</span></label>
                            <app-select name="resources" :multiple="true" :options="{{ json_encode($resources->toArray()) }}"></app-select>
                            {!! $errors->first('resources', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="5">{{ old('description') }}</textarea>
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('attachment') ? 'has-error' : ''}}">
                            <label for="attachment">Adjuntar archivo <span class="text-muted">(opcional)</span></label>
                            <input name="attachment" id="attachment" type="file" class="form-control">
                            {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : ''}}">
                            <label for="assigned_to">Acción inmediata</label>
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                <option selected>Seleccione usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('assigned_to', '<p class="help-block">:message</p>') !!}
                        </div>

                        <input type="submit" class="btn btn-primary" value="Guardar">

                    </form>

                </div>

            @endcomponent
        </div>
    </div>
@endsection