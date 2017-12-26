@extends('layouts.principal')

@section('contenido')

	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Tareas</h3>

			<!-- Alertas -->
			@include('alert.request')

				<?php
					//Iniciar una nueva sesión o reanudar la existente
	         		session_start();
							$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
							$urltarea=$_SESSION['url'];
							$recurso->postgetTarea($urltarea);
						?>
						{!! Form::open( ['action' => 'FrontController@crearTarea'] ) !!}
						{!! Form::submit('Crear Tarea', ['class' => 'btn btn-primary']) !!}
				{!! Form::close() !!}

		</div>

	</div>

@endsection
