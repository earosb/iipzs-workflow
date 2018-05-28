@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-1">

                    <form method="POST" action="{{ route('issue.update', $issue->id) }}"
                          enctype="multipart/form-data">
                        <input name="_method" value="PATCH" type="hidden">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                            <label for="type">Tipo</label>
                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                @foreach($types as $type)
                                    <label class="btn btn-default @if($issue->type->id === $type->id) active @endif">
                                        <input name="type" value="{{ $type->id }}" id="type" type="radio"
                                               @if($issue->type->id === $type->id) checked="checked" @endif>
                                        {{ $type->name }}
                                    </label>
                                @endforeach
                            </div>
                            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ $issue->title }}"
                                   autofocus>
                            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('resources') ? 'has-error' : ''}}">
                            <label for="title">Recursos <span class="text-muted">(opcional)</span></label>
                            <app-select name="resources" :multiple="true"
                                        :selected="{{ json_encode($selectedResources->toArray()) }}"
                                        :options="{{ json_encode($resources->toArray()) }}"></app-select>
                            {!! $errors->first('resources', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="5">{{ $issue->description }}</textarea>
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : ''}}">
                            <label for="assigned_to">Acción inmediata</label>
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                <option selected>Seleccione usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                            @if($issue->assignedTo->id === $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('assigned_to', '<p class="help-block">:message</p>') !!}
                        </div>

                        <input type="submit" class="btn btn-primary" value="Actualizar">

                    </form>

                </div>

            @endcomponent
        </div>
    </div>
@endsection