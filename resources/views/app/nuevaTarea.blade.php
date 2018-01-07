@extends('layouts.principal')

@section('contenido')

	<?php
      @session_start();

      $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
      $listaCategorias = $recurso->getCategorias();

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

			<h3 class = "titulo">Nueva Tarea <a href="../Tarea" class="retorno"><span class="icon-arrow-left retorno"></span></a> </h3>

			@if($listaCategorias != false)

				<!-- Formulario -->
				{!! Form::open( ['action' => 'FrontController@manejarEventoCrearTarea', 'method' => 'POST'] ) !!}

	         		<div class="form-group">
			    		{!! Form::text('nombre',null,['placeholder' => 'Nombre', 'class' => 'form-control']) !!}
			    	</div>

			    	<div class="form-group">
			    		{!! Form::textarea('descripcion',null,['placeholder' => 'Descripcion ...', 'class' => 'form-control']) !!}
			    	</div>

					<div class="form-group">
					   {!! Form::select('categoria',$listaCategorias, null, array('class' => 'form-control')) !!}
					</div>

					<div class="form-group">
			    		<label> ¿Desea Colocar Una Fecha Limite? </label>

			    		<label>SI <input type="radio" name="fecha" onclick="deploy(this)" value="SI"> </label>
			    		<label>NO <input type="radio" name="fecha" onclick="deploy(this)" value="NO" checked="checked"> </label>
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


			    	<div class = "form-group" id = "fechaDesplegable" style="display:none">
		    			{!! Form::selectRange('day', 1, 31) !!}
		    			{!! Form::selectMonth('month') !!}
		    			{!! Form::selectYear('year', date('o'), date('o') + 10) !!}

		    			<?php

		    				/*Se utiliza para que el formato de hora sea 00:00 y no 0:0*/

		    				$horas = array();

	        				for ($i = 0; $i < 24; $i ++) {
	        					if($i < 10)
	        						$i = '0'.$i;
				    			array_push($horas, $i);
							}

							$minutos = array();

	        				for ($i = 0; $i < 60; $i ++) {
	        					if($i < 10)
	        						$i = '0'.$i;
				    			array_push($minutos, $i);
							}

		    			?>

		    			<div class = "form-group hora">

			    			<label>HORA</label>
			    			{!! Form::select('hour',$horas) !!}
			    			<label class = "puntos">:</label>
			    			{!! Form::select('minute',$minutos) !!}

		    			</div>

	    			</div>


	    			<div class = "form-group" >

				    	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
				    	<button type="reset" class="btn btn-warning" onclick="deploy(this)" value="NO">Cancelar</button>

			    	</div>


				{!! Form::close() !!}

			@endif

		</div>

	</div>

@endsection
