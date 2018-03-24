@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $issue->title }}</div>

                    <div class="panel-body">
                        <h4>{{ $issue->createdBy->name }}
                            <small>{{ $issue->created_at->format('d-m-Y h:m') }}</small>
                        </h4>

                        <p>{{ $issue->description }}</p>

                        <ul class="list-group">
                            @foreach($issue->attachments as $attachment)
                                <li class="list-group-item">
                                    @if($attachment->mime_type == 'image/jpeg')
                                        <i class="glyphicon glyphicon-picture"></i>
                                    @elseif($attachment->mime_type == 'application/pdf')
                                        <i class="glyphicon glyphicon-file"></i>
                                    @elseif($attachment->mime_type == 'application/pdf')
                                        <i class="glyphicon glyphicon-facetime-video"></i>
                                    @else
                                        <i class="glyphicon glyphicon-file"></i>
                                    @endif
                                    <a href="/{{ $attachment->path }}" target="_blank"> {{ $attachment->name }}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                @foreach($issue->comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>{{ $comment->createdBy->name }}
                                <small>{{ $comment->created_at->format('d-m-Y h:m') }}</small>
                            </h4>

                            <p>{{ $comment->description }}</p>

                            <ul class="list-group">
                                @foreach($comment->attachments as $attachment)
                                    <li class="list-group-item">
                                        @if($attachment->mime_type == 'image/jpeg')
                                            <i class="glyphicon glyphicon-picture"></i>
                                        @elseif($attachment->mime_type == 'application/pdf')
                                            <i class="glyphicon glyphicon-file"></i>
                                        @elseif($attachment->mime_type == 'application/pdf')
                                            <i class="glyphicon glyphicon-facetime-video"></i>
                                        @else
                                            <i class="glyphicon glyphicon-file"></i>
                                        @endif
                                        <a href="/{{ $attachment->path }}" target="_blank"> {{ $attachment->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

                <div class="panel panel-default" id="comment-form">
                    <div class="panel-body">

                        <form method="POST" action="{{ route('comment.store', $issue->id) }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="sr-only">{{ __('labels.description') }}</label>
                                <textarea name="description" class="form-control" placeholder="Dejar un comentario"
                                          autofocus>{{ old('description') }}</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>

                            {{--TODO Implementar subida de archivos por ajax--}}
                            {{--<div class="form-group">--}}
                            {{--<obs-attach user="{{ Auth()->user() }}"></obs-attach>--}}
                            {{--</div>--}}

                            <div class="form-group {{ $errors->has('attachment') ? 'has-error' : ''}}">
                                <input name="attachment" id="attachment" type="file" class="form-control">
                                {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">{{ __('buttons.comment') }}</button>

                                {{--<div class="btn-group">--}}
                                {{--<button class="btn btn-primary">{{ __('buttons.comment') }}</button>--}}
                                {{--<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"--}}
                                {{--aria-haspopup="true" aria-expanded="false">--}}
                                {{--<span class="caret"></span>--}}
                                {{--<span class="sr-only">Toggle Dropdown</span>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu">--}}
                                {{--<li><a href="#">Cerrar</a></li>--}}
                                {{--<li><a href="#">Anular</a></li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#">Eliminar</a></li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}

                                <button class="btn btn-link" type="reset">
                                    {{ __('buttons.cancel') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios suscritos</div>

                    <div class="panel-body">
                        <ul class="list-group">
                            @forelse($issue->subscribers as $subscriber)
                                <li class="list-group-item">{{ $subscriber->name }}</li>
                            @empty
                                <li class="list-group-item">No hay usuarios suscritos</li>
                            @endforelse
                        </ul>
                        <form method="POST" action="{{ route('toggle-subscription', $issue->id) }}">
                            {{ csrf_field() }}
                            @if($issue->subscribers->contains(Auth::id()))
                                <button type="submit"
                                        class="btn btn-default btn-block">{{ __('buttons.cancel_subscription') }}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary btn-block">{{ __('buttons.subscribe') }}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection