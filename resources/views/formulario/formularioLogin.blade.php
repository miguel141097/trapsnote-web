<html>

  <head>

    <title> Iniciar Sesion </title>

    <!-- {Manera de agregar recursos en larabel con laravel collective} -->
    <!--{   {!!Html::style('css/estilosFormularios.css')!!}   }-->

    <!-- {Sin embargo Heroku maneja estos direcciones sin estos comandos de laravel collective} -->
    <link rel="stylesheet" href="css/estilosFormularios.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

    <!-- la siguiente etiqueta se utiliza para que se adapte en pantallas mas pequeñas -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  </head>

  <body>

    <?php
      @session_start();
    ?>

  	<!-- {Incluye las alertas} -->
  	@include('alert.request')

    <div class="box1">

    	<img src="assets/logoRetocado.jpg" class="logotipo">

    	{!! Form::open( ['action' => 'FormularioController@manejarEventoLogin', 'method' => 'POST', 'class' => 'datosDeRegistro'] ) !!}

        <?php

          //Se inicializa para NO repetir los errores al recargar la página
          $_SESSION['error'] = "";
          $_SESSION['exito'] = "";
          $_SESSION['falla'] = false;

        ?>

        <div class="indicadorInput">
          {!! Form::text('email',null,['placeholder' => 'Email', 'class' => 'form-control']) !!}
          <!-- {placeholder: Campo donde se escribe} -->
        </div>

    		<div class="indicadorInput">
    			{!! Form::password('password',['placeholder' => 'Password', 'class' => 'form-control']) !!}
    		</div>

        <div class="form-group">
          <label>Zona Horaria:</label>
          {!! Form::select('ZonaHoraria', ['America/Caracas' => 'Caracas', 'America/Bogota' => 'Bogota', 'America/Sao_Paulo' => 'Sao Paulo', 'America/Argentina/Buenos_Aires' => 'Buenos Aires', 'America/Santiago' => 'Santiago de Chile', 'America/Mexico_City' => 'Ciudad de Mexico', 'Asia/Tokyo' => 'Tokio', 'Europe/Madrid' => 'Madrid'], null, array('class' => 'form-control')) !!}
        </div>

        <div class = "form-group">
      		{!! Form::submit('Iniciar Sesion', ['class' => 'button']) !!}
          <button type="button" class ='button' onclick= "window.location='../SignUp'">Crear cuenta</button>
        </div>

		{!! Form::close() !!}


    </div>


  </body>


</html>
