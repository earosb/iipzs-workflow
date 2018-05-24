@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('flash::message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Esta semana</div>

                        <div class="panel-body">
                            <basic-chart v-bind:height="'120px'"
                                         v-bind:type="'pie'"
                                         v-bind:data="{{  json_encode($chartData['data']) }}"
                                         v-bind:options="{{  json_encode($chartData['options']) }}"
                            ></basic-chart>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Mis asignaciones</div>

                        <div class="panel-body widget-body">
                            @if($myIssues->count() > 0)
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($myIssues as $issue)
                                        <tr>
                                            <td>
                                                <a href="{{ route('issue.show', $issue->id) }}">#{{ $issue->id }} {{ $issue->title }}</a>
                                            </td>
                                            <td>
                                                <app-label
                                                        color="{{ $issue->status->class }}">{{ __("status.{$issue->status->name}") }}</app-label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No tienes observaciones asignadas 👍</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Últimos comentarios</div>

                        <div class="panel-body widget-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @foreach($lastComments as $comment)
                                        <dl>
                                            <dt>
                                                <i class="glyphicon glyphicon-comment"></i>
                                                @if($comment->attachments->count() > 0)<i
                                                        class="glyphicon glyphicon-paperclip"></i>@endif
                                                {{ $comment->createdBy->name }}
                                                <small> comentó {{ $comment->created_at->diffForHumans() }}</small>
                                            </dt>
                                            <dd>{{ $comment->description }}
                                            </dd>
                                            <dd>
                                                En <a href="{{ route('issue.show', $comment->issue->id) }}">
                                                    {{ $comment->issue->title }}</a>
                                            </dd>
                                        </dl>
                                        @if(! $loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection