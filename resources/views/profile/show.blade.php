@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Perfil
                @endslot

                <h1>{{ $user->name }}</h1>
            @endcomponent
        </div>
    </div>
@endsection