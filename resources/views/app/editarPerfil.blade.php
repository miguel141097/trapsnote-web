@extends('layouts.principal')

@section('contenido')

	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Perfil</h3>

			<!-- Alertas -->
			@include('alert.request')

			<!-- Formulario -->
			{!! Form::open( ['action' => 'FrontController@manejarEventoEditarPerfil', 'method' => 'POST'] ) !!}

				<?php
					//Iniciar una nueva sesión o reanudar la existente
	         		session_start();
         		?>

				<!-- Encargada de mandar la url al controlador al hacer el post -->
	        	<input type="hidden" name="url" value="{{ $_SESSION['url'] }}">

		    	<div class="form-group">
		    		{!! Form::text('name',null,['placeholder' => 'Nuevo nombre', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
		    		{!! Form::text('last_name',null,['placeholder' => 'Nuevo apellido', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
						{!! Form::text('password',null,['placeholder' => 'Nueva contraseña', 'class' => 'form-control']) !!}
		    	</div>

          <div class="form-group">
            {!! Form::text('password_repeat',null,['placeholder' => 'Repetir nueva contraseña', 'class' => 'form-control']) !!}
		    	</div>

		    	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
		    	{!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}

			{!! Form::close() !!}

		</div>

	</div>

@endsection
