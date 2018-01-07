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

			<h3 class = "titulo">Mis Tareas <a href="Tarea/Nueva"> <button class="btn btn-success">Nuevo</button> </a></h3>

		</div>

	</div>



	@if( $listaDeTareas != null )

		@foreach ($listaDeTareas as $tarea)

			<?php
				$id = $tarea['_id'];
			?>

			<table class="table" id='getTareas'>

				<thead class="thead-inverse">

					<th>
						{!! $tarea['nombre'] !!}</th>

				</thead>


				<tr class="nombreTarea">

					<td >Categoria: {!! $tarea['categoria'] !!} - {!!$tarea['descripcion']!!}
						<button class="btn btn-success titulo" style="float: right" onclick="window.location='Tarea/Editar?id=<?php echo $id ?>'">edit</button>
					</td>
				</tr>

			</table>

		@endforeach

	@endif



@endsection
