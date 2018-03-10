@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $issue->title }}</div>

                    <div class="panel-body">
                        <h4>{{ $issue->user->name }}</h4>
                        <h5>{{ $issue->created_at->format('d-m-Y h:m') }}</h5>

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
                            <h4>{{ $comment->user->name }}</h4>
                            <h5>{{ $comment->created_at->format('d-m-Y h:m') }}</h5>

                            <p>{{ $comment->content }}</p>

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

                            <p>Acción inmediata: {{ $comment->immediateAction->name }}</p>
                        </div>
                    </div>
                @endforeach

                <div class="panel panel-default" id="comment-form">
                    <div class="panel-body">

                        <form method="POST" action="{{ route('comment.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="observation" value="{{ $issue->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment" class="sr-only">{{ __('labels.comment') }}</label>
                                <textarea name="comment" class="form-control" placeholder="Dejar un comentario"
                                          autofocus>{{ old('comment') }}</textarea>

                            </div>

                            <div class="form-group">
                                <obs-attach user="{{ Auth()->user() }}"></obs-attach>
                            </div>

                            <div class="form-group{{ $errors->has('immediate_action') ? ' has-error' : '' }}">
                                <label for="immediate_action">{{ __('labels.immediate_action') }}</label>
                                <select name="immediate_action" id="immediate_action" class="form-control">
                                    <option disabled selected>Seleccione usuario</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <subscribers-input users="{{ $users }}"></subscribers-input>

                            <div class="form-group">
                                <div class="btn-group">
                                    <button class="btn btn-primary">{{ __('buttons.comment') }}</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Resolver</a></li>
                                        <li><a href="#">Anular</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>

                                {{--<button class="btn btn-primary">--}}
                                {{--{{ __('buttons.comment') }}--}}
                                {{--</button>--}}

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
                        {{--TODO Implementar suscripción y cancelar suscripción--}}
                        {{--@if($issue->subscribers->contains(Auth::id()))--}}
                            {{--<button class="btn btn-default btn-block">{{ __('buttons.cancel_subscription') }}</button>--}}
                        {{--@else--}}
                            {{--<button class="btn btn-primary btn-block">{{ __('buttons.subscribe') }}</button>--}}
                        {{--@endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection