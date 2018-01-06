@extends('layouts.principal')

@section('contenido')


    <?php

    	@session_start();

		$enlaceActual = $_SERVER['REQUEST_URI'];
		$idTarea = substr($enlaceActual, strpos($enlaceActual , '=') + 1 );

		//Se obtiene el id de la tarea pra poder modificarlo
		$_SESSION['id'] = $idTarea;

		//Datos de la Tarea
		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
		$respuesta = $recurso->getTareaID($_SESSION['id']);

		//Si no se presentó ningún fallo se procede a extraer la información
		if($respuesta != false){

			//Datos Predeterminados
			$nombre = $respuesta['nombre'];
			$descripcion = $respuesta['descripcion'];
			$categoria = $respuesta['categoria'];

			$completado = $respuesta['completado'];
			$hora = $respuesta['fechaLimite'];

			//Si la tarea tiene fecha limite se procede a colocarla como valor por defecto
			if($hora != null){
				$year = substr($hora, 0, 4);
				$month = substr($hora, 5, 2);
				$day = substr($hora, 8, 2);
			}

		}

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

			<h3 class = "titulo"> Editar Tarea
				<a href="../Tarea" class="retorno"><span class="icon-arrow-left retorno"></span></a>

			</h3>

				<!-- Para evitar que muestre el formulario en caso de error -->
				@if ($respuesta != null)

					<div class="form-group">
						{!! Form::open( ['action' => 'FrontController@manejarEventoEliminarTarea', 'method' => 'DELETE'] ) !!}
							{{ Form::submit('Eliminar', ['class' => 'btn btn-danger'] ) }}
						{!! Form::close() !!}
					</div>


					<!-- Formulario -->
					{!! Form::open( ['action' => 'FrontController@manejarEventoEditarTarea', 'method' => 'POST'] ) !!}

						@if ($completado == false)
							<div class="form-group switch">

								<input id="interruptor" type="checkbox" name="completado" value="true" />
								<label for="interruptor">¿Tarea Completa?</label>

					    	</div>
				    	@endif

				    	@if ($completado != false)
							<div class="form-group switch switchCompletado">

								<input id="interruptor" type="checkbox" name="completado" value="true" />
								<label for="interruptor">¿Tarea Completa?</label>

					    	</div>
				    	@endif


		         		<div class="form-group">
		         			{!! Form::text('nombre',$nombre,['placeholder' => 'Nombre', 'class' => 'form-control']) !!}
				    	</div>

				    	<div class="form-group">
				    		{!! Form::textarea('descripcion',$descripcion,['placeholder' => 'Descripcion ...', 'class' => 'form-control']) !!}
				    	</div>

              <div class="form-group">
    					   {!! Form::select('categoria', ["Estudios", "Trabajo", "Hogar", "Actividad", "Ejercicio", "Plan", "Informacion"], "Estudios",  array('class' => 'form-control')) !!}
    					</div>

						<div class="form-group">
				    		<label> ¿Desea Colocar Una Fecha Limite? </label>

				    		<!-- Se coloca estos condicionales para saber si la tarea tiene fecha limite ya colocada o no -->
				    		@if($hora != null)
					    		<label>SI <input type="radio" name="fecha" onclick="deploy(this)" value="SI" checked="checked"> </label>
					    		<label>NO <input type="radio" name="fecha" onclick="deploy(this)" value="NO"> </label>
				    		@endif

				    		@if($hora == null)
					    		<label>SI <input type="radio" name="fecha" onclick="deploy(this)" value="SI"> </label>
					    		<label>NO <input type="radio" name="fecha" onclick="deploy(this)" value="NO" checked="checked"> </label>
				    		@endif

				    	</div>


				    	<!-- Funcion que sirve para desplegar la fecha limite de la tarea -->
				    	<script type="text/javascript">

					        function deploy(elemento) {

					          	if(elemento.value == "SI")
					            	document.getElementById("fechaDesplegable").style.display = "block";
					            else
					            	document.getElementById("fechaDesplegable").style.display = "none";

					        }

						</script>

						<!-- Se coloca estos condicionales para mostrar o no la fecha limite -->
						@if($hora == null)
					    	<div class = "form-group" id = "fechaDesplegable" style="display:none">
				    			{!! Form::selectRange('day', 1, 31) !!}
				    			{!! Form::selectMonth('month') !!}
				    			{!! Form::selectRange('year', date('o'), 2030 ) !!}
			    			</div>
		    			@endif

		    			@if($hora != null)
					    	<div class = "form-group" id = "fechaDesplegable" style="display:block">
				    			{!! Form::selectRange('day', 1, 31, $day) !!}
				    			{!! Form::selectMonth('month',$month) !!}
				    			{!! Form::selectRange('year', date('o'), 2030, $year) !!}
			    			</div>
		    			@endif


				    	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

				    	@if($hora == null)
				    		<button type="reset" class="btn btn-warning" onclick="deploy(this)" value="NO">Cancelar</button>
				    	@endif

				    	@if($hora != null)
				    		<button type="reset" class="btn btn-warning" onclick="deploy(this)" value="SI">Cancelar</button>
				    	@endif

					{!! Form::close() !!}

				@endif

		</div>

	</div>

@endsection
