<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Ludodidactas!
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('help') }}" title="Info sobre el proyecto" >
                        Ayuda!
                    </a>
                </li>

                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Ingresar</a></li>
                    <li><a href="{{ url('/register') }}">Registrarse</a></li>
                @else
                        {{-- Agrego a la barra de navegación los items que tenia en mi proyecto inciialmente --}}
                        <li>
                            <a href="{{ route('panel::posts.index') }}">Mis posts</a>
                        </li>
                        <li>
                            <a href="{{ route('panel::profile.edit') }}">Mi perfil </a>
                        </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        {{-- 

                            ATENTO CON ESTO 

                            La ruta de logout es por post, por lo que es necesario tener un formulario para el envio. Aca la artimaña que se usa para tener un link es tener un formulario oculto y al hacer click en el link "Logout" se envia el formulario

                        --}}
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                    {{-- 
                    Muestra la imagen del perfil en caso de que la tenga.

                    Una buena práctica sería tener la imagen redimensionada en un tamaño mas chico para mostrarla en la navbar, y mostrar el path de esa imagen en lugar de mostar la imagen original que es mucho mas pesada
                    --}}
                    <li style="line-height:50px" class="hidden-xs">
                        @if(Auth::user()->avatar)
                            <img class="img-responsive img-circle img-thumbnail" src="storage/{{Auth::user()->avatar}}" style="max-height:50px;">
                        @else
                            <img class="img-responsive img-circle img-thumbnail" src="img/default-avatar.png" title="No tenés cargada ninguna foto todavía!" style="max-height:45px;">
                        @endif
                    </li>
                @endif

                
            </ul>
        </div>
    </div>
</nav>