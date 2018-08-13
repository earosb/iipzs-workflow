@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Observaciones
                @endslot

                @include('flash::message')

                <form class="form-inline" method="GET" action="{{ route('issue.index') }}">
                    <div class="form-group">
                        <label class="sr-only" for="status">Estado</label>
                        <select class="form-control" id="status" name="status">
                            <option disabled selected>Estado</option>
                            @foreach($states as $status)
                                <option value="{{ $status->name }}">
                                    {{ __("status.{$status->name}") }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="created_by">Creado por</label>
                        <select class="form-control" id="created_by" name="created_by">
                            <option disabled selected>Creado por</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="assigned_to">Asignada a</label>
                        <select class="form-control" id="assigned_to" name="assigned_to">
                            <option disabled selected>Asignada a</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Filtrar</button>
                </form>

                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                        <th>Acción inmediata</th>
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
                            <td>{{ $issue->assignedTo->name }}</td>
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