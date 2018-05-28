<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
        @auth
            <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Observaciones <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('issue.index', ['status' => 'open']) }}">Abiertas</a></li>
                            <li><a href="{{ route('issue.index', ['created_by' => Auth::user()->id]) }}">Creadas por
                                    mí</a></li>
                            <li><a href="{{ route('issue.index', ['assigned_to' => Auth::user()->id]) }}">Mis
                                    observaciones</a></li>
                            <li><a href="{{ route('issue.index') }}">Todas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('issue.create') }}">Nueva observación</a>
                    </li>
                </ul>
        @endauth

        <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Entrar</a></li>
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                @endguest
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Mantenedores <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.index') }}">Usuarios</a></li>
                            <li><a href="{{ route('type.index') }}">Tipos</a></li>
                            <li><a href="{{ route('resource.index') }}">Recursos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('profile') }}">Perfil</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>