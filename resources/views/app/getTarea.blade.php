@extends('layouts.principal')

@section('contenido')

	<?php   
    	@session_start();
    ?>

	<!-- Alertas -->
	@include('alert.request')

	<?php

		$_SESSION['error'] = "";
      	$_SESSION['exito'] = "";
      	$_SESSION['falla'] = false;

    	$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
		$listaDeTareas = $recurso->getTarea();
    ?>

	<!-- Alertas -->
	@include('alert.request')

	<?php
      //Se inicializa para NO repetir los errores al recargar la página  
      $_SESSION['error'] = "";
      $_SESSION['exito'] = "";
    ?>

	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<h3>Mis Tareas <a href="Tarea/Nueva"> <button class="btn btn-success">Nuevo</button> </a></h3>
				
		</div>

	</div>



	@if( $listaDeTareas != null )

		@foreach ($listaDeTareas as $tarea)

			<?php  
				$id = $tarea['_id'];
			?>

			<table class="table">

				<thead class="thead-inverse">

					<th onclick="window.location='Tarea/Editar?id=<?php echo $id ?>'">Categoria: {!! $tarea['categoria'] !!}</th>

				</thead>

			
				<tr class="nombreTarea">

					<td onclick="window.location='Tarea/Editar?id=<?php echo $id ?>'">Nombre: {!! $tarea['nombre'] !!}</td>

				</tr>

			</table>

		@endforeach

	@endif



@endsection











