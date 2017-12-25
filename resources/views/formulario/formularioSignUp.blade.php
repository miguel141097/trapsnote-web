<html>

  <head>

    <title> Crear Sesion </title>

    <!-- {Manera de agregar recursos en larabel con laravel collective} -->
    <!--{   {!!Html::style('css/estilosFormularios.css')!!}   }-->

    <!-- {Sin embargo Heroku maneja estos direcciones sin estos comandos de laravel collective} -->
    <link rel="stylesheet" href="css/estilosFormularios.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

  </head>

  <body>

  	<!-- {Incluye las alertas} -->
  	@include('alert.request')

    <div class="box1">

    	<img src="assets/logoRetocado.jpg" class="logotipo">

    	{!! Form::open( ['action' => 'FormularioController@manejarEventoCrearSesion', 'method' => 'POST', 'class' => 'datosDeRegistro'] ) !!}

            <div class="indicadorInput">
                {!! Form::text('username',null,['placeholder' => 'Username']) !!}
                <!-- {placeholder: Campo donde se escribe} -->
                    <!-- {required: Campo Obligatorio} -->
            </div>

    		<div class="indicadorInput">
    			{!! Form::text('name',null,['placeholder' => 'Name']) !!}
    			<!-- {placeholder: Campo donde se escribe} -->
          		<!-- {required: Campo Obligatorio} -->
    		</div>

    		<div class="indicadorInput">
    			{!! Form::text('last_name',null,['placeholder' => 'Last Name']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::text('email',null,['placeholder' => 'Email']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::password('password',['placeholder' => 'Password']) !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::password('password_repeat',['placeholder' => 'Repeat Password', 'id' => 'ultimoInput']) !!}
    		</div>

    		<div>
    			{!! Form::selectRange('day', 1, 31) !!}
    			{!! Form::selectMonth('month') !!}
    			{!! Form::selectRange('year', 1960, date('o') ) !!}
    		</div>

        		{!! Form::submit('Registrar', ['class' => 'button']) !!}
            <button type="button" class ='button' onclick="window.location='{{ url("Login") }}'">Ya tienes una cuenta?</button>

		{!! Form::close() !!}


    </div>


  </body>


</html>
