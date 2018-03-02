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
                        <th class="text-center"><span class="glyphicon glyphicon-comment"></span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($observations as $observation)
                        <tr>
                            <td>
                                <a href="{{ route('observation.show', $observation->id) }}">#{{ $observation->id }} {{ $observation->title }}</a>
                            </td>
                            <td>
                                <app-label
                                        color="{{ $observation->status->class }}">{{ $observation->status->name }}</app-label>
                            </td>
                            <td>{{ $observation->user->name }}</td>
                            <td>{{ $observation->created_at->diffForHumans() }}</td>
                            <td><span class="badge">{{ $observation->comments_count }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td>No hay nada aquí</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $observations->links() }}
                </div>
            @endcomponent
        </div>
    </div>
@endsection