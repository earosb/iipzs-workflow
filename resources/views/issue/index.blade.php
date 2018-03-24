@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                        <th>Fecha <span class="glyphicon glyphicon-triangle-bottom"></span></th>
                        <th><span class="glyphicon glyphicon-comment"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($issues as $issue)
                        <tr>
                            <td>
                                <a href="{{ route('issue.show', $issue->id) }}">#{{ $issue->id }} {{ $issue->title }}</a>
                            </td>
                            <td>
                                <app-label
                                        color="{{ $issue->status->class }}">{{ __("status.{$issue->status->name}") }}</app-label>
                            </td>
                            <td>{{ $issue->createdBy->name }}</td>
                            <td>{{ $issue->created_at->diffForHumans() }}</td>
                            <td><span class="badge">{{ $issue->comments_count }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td>No hay nada aquí</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $issues->links() }}
                </div>
            @endcomponent
        </div>
    </div>
@endsection