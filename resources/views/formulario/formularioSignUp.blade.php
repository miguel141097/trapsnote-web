<html>

  <head>

    <title> Crear Sesion </title>

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

    	{!! Form::open( ['action' => 'FormularioController@manejarEventoCrearSesion', 'method' => 'POST', 'class' => 'datosDeRegistro'] ) !!}

            <?php
                //Se inicializa para NO repetir los errores al recargar la página
                $_SESSION['error'] = "";
                $_SESSION['exito'] = "";
                $_SESSION['falla'] = false;
                //bandera que indica que no hay sesion activa
                $_SESSION['Middleware']=false;
            ?>

            <!-- {Indica que el registro se llevó a caba desde la aplicación web} -->
            <input type="hidden" name="formaRegistro" value="web">

            <div class="indicadorInput">
                {!! Form::text('username',null,['placeholder' => 'Username', 'class' => 'form-control']) !!}
                <!-- {placeholder: Campo donde se escribe} -->
            </div>

    		<div class="indicadorInput">
    			{!! Form::text('name',null,['placeholder' => 'Name', 'class' => 'form-control']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::text('last_name',null,['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::text('email',null,['placeholder' => 'Email', 'class' => 'form-control']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::password('password',['placeholder' => 'Password', 'class' => 'form-control']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::password('password_repeat',['placeholder' => 'Repeat Password', 'id' => 'ultimoInput', 'class' => 'form-control']) !!}
    		</div>

    		<div>
                <label>Fecha de Nacimiento</label>
    		</div>

            <div class = "form-group">
                {!! Form::selectRange('day', 1, 31) !!}
                {!! Form::selectMonth('month') !!}
                {!! Form::selectRange('year', 1960, date('o') ) !!}
            </div>

        		{!! Form::submit('Registrar', ['class' => 'button']) !!}
            <button type="button" class ='button' onclick="window.location='../Login'">Ya tienes una cuenta?</button>
          </div>


		{!! Form::close() !!}


    </div>


  </body>


</html>
