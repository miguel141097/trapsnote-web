@extends('layouts.principal')

@section('contenido')

	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Tarea</h3>	
		
			<!-- Alertas -->
			@include('alert.request')

			<!-- Formulario -->
			{!! Form::open( ['action' => 'FrontController@manejarEventoCrearTarea', 'method' => 'POST'] ) !!}

				<?php
					//Iniciar una nueva sesión o reanudar la existente
	         		session_start();
         		?>

				<!-- Encargada de mandar la url al controlador al hacer el post -->
	        	<input type="hidden" name="url" value="{{ $_SESSION['url'] }}">

		    	<div class="form-group">
		    		{!! Form::text('descripcion',null,['placeholder' => 'Descripcion ...', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
		    		{!! Form::text('categoria',null,['placeholder' => 'Categoria', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
		    		{!! Form::text('horaCompletado',null,['placeholder' => 'horaCompletado', 'class' => 'form-control']) !!}
		    	</div>

		    	{!! Form::selectRange('completado', 0, 1) !!}

		    	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
		    	{!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}

			{!! Form::close() !!}

		</div>

	</div>

@endsection