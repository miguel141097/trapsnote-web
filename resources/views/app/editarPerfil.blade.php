@extends('layouts.principal')

@section('contenido')

	<?php
		//Iniciar una nueva sesión o reanudar la existente
        @session_start();

        $name = $_SESSION['name'];
        $last_name = $_SESSION['last_name'];
    ?>

	<!-- Alertas -->
	@include('alert.request')

	<?php
	
		//Se inicializa para NO repetir los errores al recargar la página  
		$_SESSION['error'] = "";
		$_SESSION['exito'] = "";
		$_SESSION['falla'] = false;

    ?>

	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<h3>Editar Perfil</h3>

			<!-- Formulario -->
			{!! Form::open( ['action' => 'FrontController@manejarEventoEditarPerfil', 'method' => 'POST'] ) !!}

		    	<div class="form-group">
		    		{!! Form::text('name',$name,['placeholder' => 'Nuevo nombre', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
		    		{!! Form::text('last_name',$last_name,['placeholder' => 'Nuevo apellido', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
						{!! Form::password('password',['placeholder' => 'Nueva contraseña', 'class' => 'form-control']) !!}

		    	</div>

		        <div class="form-group">
		            {!! Form::password('password_repeat',['placeholder' => 'Repetir nueva contraseña', 'class' => 'form-control']) !!}
				</div>

		    	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
		    	{!! Form::reset('Cancelar', ['class' => 'btn btn-warning']) !!}

			{!! Form::close() !!}

		</div>

	</div>

@endsection
