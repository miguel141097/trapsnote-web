<html>

  <head>

    <title> Crear Sesion </title>

    <!-- {Manera de agregar recursos en larabel con laravel collective} -->
    {!!Html::style('css/estilosFormularios.css')!!}

  </head>

  <body>

    <div class="box1">

    	<img src="{{ asset('assets/logoRetocado.jpg') }}" class="logotipo">

    	{!! Form::open( ['action' => 'FormularioController@manejarEventoCrearSesion', 'method' => 'POST', 'class' => 'datosDeRegistro'] ) !!}

    		<div class="indicadorInput">
    			{!! Form::text('name',null,['placeholder' => 'Name'], 'required') !!}
    			<!-- {placeholder: Campo donde se escribe} -->
          		<!-- {required: Campo Obligatorio} -->
    		</div>

    		<div class="indicadorInput">
    			{!! Form::text('last_name',null,['placeholder' => 'Last Name'], 'required') !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::text('email',null,['placeholder' => 'Email'], 'required') !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::password('password',['placeholder' => 'Password'], 'required') !!}
    		</div>

    		<div class="indicadorInput">
    			{!! Form::password('password_repeat',['placeholder' => 'Repeat Password', 'id' => 'ultimoInput'], 'required') !!}
    		</div>

    		{!! Form::submit('Registrar', ['class' => 'button']) !!}
    
		{!! Form::close() !!}


    </div>


  </body>


</html>
