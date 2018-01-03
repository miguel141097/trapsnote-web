<html>

  <head>

    <title> Iniciar Sesion </title>

    <!-- {Manera de agregar recursos en larabel con laravel collective} -->
    <!--{   {!!Html::style('css/estilosFormularios.css')!!}   }-->

    <!-- {Sin embargo Heroku maneja estos direcciones sin estos comandos de laravel collective} -->
    <link rel="stylesheet" href="css/estilosFormularios.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

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
          {!! Form::text('email',null,['placeholder' => 'Email']) !!}
          <!-- {placeholder: Campo donde se escribe} -->
        </div>

    		<div class="indicadorInput">
    			{!! Form::password('password',['placeholder' => 'Password']) !!}
    		</div>

    		{!! Form::submit('Iniciar Sesion', ['class' => 'button']) !!}
        <button type="button" class ='button' onclick= "window.location='{{ url('SignUp') }}'">Crear cuenta</button>

		{!! Form::close() !!}


    </div>


  </body>


</html>
