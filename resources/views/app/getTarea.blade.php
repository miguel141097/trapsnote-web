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
				$completado = $tarea['completado'];

				$completado = $tarea['completado'];
			?>

			<table class="table" id='getTareas'>

				<thead class="thead-inverse">

					<th>Categoria: {!! $tarea['categoria'] !!}
						<button class="btn btn-success titulo" style="float: right" onclick="window.location='Tarea/Editar?id=<?php echo $id ?>'">edit</button>
					</th>

				</thead>


				<tr class="nombreTarea">
					<td>{!! $tarea['nombre'] !!}</td>
				</tr>

				<tr>

					<?php  

						$hora = $tarea['fechaLimite'];

						//Si la tarea tiene fecha limite se procede a colocarla como valor por defecto
						if($hora != null){
							$year = substr($hora, 0, 4);
							$month = substr($hora, 5, 2);
							$day = substr($hora, 8, 2);

							$hour = substr($hora, 11, 2);
							$minute = substr($hora, 14, 2);

							/*Se acomoda la fecha con respecto a la hora del pais donde se usa la APP*/
							$fecha = $year."-".$month."-".$day."T".$hour.":".$minute.":00";
							$fechaParaMostrar = $fecha." ".$_SESSION['horaMostrar'];

							$fechaParaMostrar = date('Y-m-d H:i', strtotime($fechaParaMostrar));

							$year = substr($fechaParaMostrar, 0, 4);
							$month = substr($fechaParaMostrar, 5, 2);
							$day = substr($fechaParaMostrar, 8, 2);

							$hour = substr($fechaParaMostrar, 11, 2);
							$minute = substr($fechaParaMostrar, 14, 2);

							$fechaLimite = $day."/".$month."/".$year."/".$hour.":".$minute;

							$fechaEnIngles = $year."-".$month."-".$day." ".$hour.":".$minute;

							@session_start();
							date_default_timezone_set($_SESSION['ZonaHoraria']);
							

							$expiro = false;
							//Se compara la fecha para saber si la tarea éxpiro
						    if( strtotime($fechaEnIngles) <= strtotime(date('Y-m-d H:i:s')) ){
						    	$expiro = true;
						    }

						}

					?>

					@if ($completado == false)

						@if ($hora != null)

							@if ($expiro == true)
								<td class="tareaExpirada">Expiro ({!! $fechaLimite !!}) </td>
							@endif

							@if ($expiro == false)
								<td class="tareaNoCompletada">NO Completado ({!! $fechaLimite !!}) </td>
							@endif

						@endif

						@if ($hora == null)
							<td class="tareaNoCompletada">NO Completado</td>
						@endif

					@endif

					@if ($completado != false)

						@if ($hora != null)

							<td class="tareaCompletada">Completado ({!! $fechaLimite !!}) </td>

						@endif

						@if ($hora == null)
							<td class="tareaCompletada">Completado </td>
						@endif

					@endif

				</tr>

			</table>

		@endforeach

	@endif



@endsection
