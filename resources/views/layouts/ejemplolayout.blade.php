<!-- Stored in resources/views/layouts/ejemplolayout.blade.php -->

<html>
    <head>
        <title>Nombre de la app - @yield('titulo')</title>
        	    <!-- Scripts -->
				<script src="{{ asset('js/app.js') }}" defer></script>
				<!-- Styles -->
				<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @section('barralateral')
            Esto es la barra lateral inicial
        @show

        <div class="container">
            @yield('contenido')
        </div>
    </body>
</html>