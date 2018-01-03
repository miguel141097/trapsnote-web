<!DOCTYPE html>
<html>

  <head>

    <title>Trapsnote</title>

    <!-- Hay que usar "asset()" porque puede fallar agregando los estilos -->
    <link rel="stylesheet" href="{{asset('menu/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('menu/estilosMenu.css')}}">

    <!-- Se incorpora esta oja de estilos en las vistas derivadas de esta -->
    <link rel="stylesheet" href="{{asset('css/estilosTareas.css')}}">

    <!-- Implementar bootstrap en el formulario -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">

    <!-- la siguiente etiqueta se utiliza para que se adapte en pantallas mas pequeñas -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Es sumamente importante colocar esta libreria ANTES para que la librería propia, para que el movimiento del menu funcione-->
    <script src="{{asset('menu/jquery-latest.js')}}"></script>
    <script src="{{asset('menu/menu.js')}}"></script>

  </head>


  <body>

    <header>

      <div class="menuDesplegable">
        <a href="#" class="btn-menu"><span class="icon-menu"> Menu</span></a>
      </div>

      <!-- Menu desplegable -->
      <nav>

        <ul>

          <li>
            <img src="{{asset('assets/logoRetocado.jpg')}}" class="logoSideBar">
            <p class="identificador">{{ $_SESSION['username'] }}</p>
          </li>


          <!-- la etiqueta SPAN incorpora cada uno de los iconos que acompañan a las opciones -->
          <li><a href="../Tarea"><span class="icon-books"></span>Tareas</a></li>

          <li><a href="EditProfile"><span class="icon-cogs"></span>Configuracion</a></li>

          <li><a href="#"><span class="icon-switch"></span>Cerrar Sesion</a></li>

        </ul>

      </nav>

    </header>

    <!-- En esta sección va el contenido dinámico -->
    <div class="contenido">
      @yield('contenido')
    </div>

  </body>

</html>
