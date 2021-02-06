{{--
    Tengo una plantilla base para las paginas que pueden ver todas las personas, y tengo otra plantilla para las paginas que solo pueden ver los usuarios que estan autenticados (que seria esta app.blade.php).
 --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- 
        Con esto permito que se pueda editar el titulo en otras secciones.
    --}}
    <title>@yield('title', 'Ludodidactas!')</title>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @section('styles')
        {{-- 
            Pongo mis estilos dentro de una sección para que puedan ser pisados
            en otras secciones, o puedan agregarseles otros estilos con @parent
        --}}
        <link href="/css/app.css" rel="stylesheet">
        
        <style type="text/css">
            .posts .post {
              font-family: sans-serif;
              font-size:14px;
            }

            /*
             * Estilos para las secciones especificas de los usuarios
             */
            body .user_content {
                margin-top:30px;
            }
        </style>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    @show
</head>

<body>
    <div id="app">
        {{-- 
            Saco todo el codigo que viene por defecto de la barra de navegación
            a navbar.blade.php y le agrego los items que yo tenía de antes (Mis posts, Perfil... Cualquiera de las vistas que me genera make:auth soy
            totalmente libre de editarlas, solamente tener en cuenta de respetar los action, y los elementos de los formularios, y que los mismos sean
            acordes a los campos seteados en RegisterController.
        --}}
        @include('layouts.components.navbar')

        <div class="container">
            @if(session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message')}}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
