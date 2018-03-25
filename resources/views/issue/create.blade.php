@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                <form class="form-horizontal" method="POST" action="{{ route('issue.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                        <label for="type" class="col-md-4 control-label">Tipo</label>
                        <div class="col-md-6">
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
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
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" autofocus>
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
                                      rows="10">{{ old('description') }}</textarea>
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('attachment') ? 'has-error' : ''}}">
                        <label for="attachment" class="col-md-4 control-label">Adjuntar archivo</label>
                        <div class="col-md-6">
                            <input name="attachment" id="attachment" type="file" class="form-control">
                            {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : ''}}">
                        <label for="assigned_to" class="col-md-4 control-label">Acción inmediata</label>
                        <div class="col-md-6">
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                <option selected>Seleccione usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </div>

                </form>

            @endcomponent
        </div>
    </div>
@endsection