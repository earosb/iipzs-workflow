@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                <form class="form-horizontal" method="POST" action="{{ route('issue.update', $issue->id) }}"
                      enctype="multipart/form-data">
                    <input name="_method" value="PATCH" type="hidden">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                        <label for="type" class="col-md-4 control-label">Tipo</label>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                @foreach($types as $type)
                                    <label class="btn btn-default @if($issue->type->id === $type->id) active @endif">
                                        <input name="type" value="{{ $type->id }}" id="type" type="radio"
                                               @if($issue->type->id === $type->id) checked="checked" @endif>
                                        {{ $type->name }}
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        <label for="title" class="col-md-4 control-label">Título</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $issue->title }}"
                                   autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-6">
                            <textarea name="description" id="description" class="form-control" cols="30"
                                      rows="10">{{ $issue->description }}</textarea>
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : ''}}">
                        <label for="assigned_to" class="col-md-4 control-label">Acción inmediata</label>
                        <div class="col-md-6">
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                <option selected>Seleccione usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                            @if($issue->assignedTo->id === $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('assigned_to'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('assigned_to') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 pull-right">
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>
                    </div>

                </form>

            @endcomponent
        </div>
    </div>
@endsection