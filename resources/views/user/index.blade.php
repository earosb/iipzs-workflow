@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('layouts.panel')
                @slot('title')
                    Usuarios
                @endslot

                @include('flash::message')

                <div class="pull-right">
                    <a href="{{ route('invite') }}" class="btn btn-default">{{ __('buttons.create') }}</a>
                </div>

                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('password.request') }}" class="btn btn-sm btn-default"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                {{--<form method="POST" action="{{ route('user.destroy', $user->id) }}"--}}
                                      {{--style="display:inline">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<input name="_method" value="DELETE" type="hidden">--}}
                                    {{--<button class="btn btn-sm btn-danger" type="submit">--}}
                                        {{--<span class="glyphicon glyphicon-trash" aria-hidden="true"--}}
                                              {{--title="Eliminar"></span>--}}
                                    {{--</button>--}}
                                {{--</form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endcomponent
        </div>
    </div>
@endsection