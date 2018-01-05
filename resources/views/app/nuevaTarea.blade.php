@extends('layouts.principal')

@section('contenido')

	<?php
      @session_start();
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
			<h3>Nueva Tarea <a href="../Tarea" class="retorno"><span class="icon-arrow-left retorno"></span></a> </h3>

			<!-- Formulario -->
			{!! Form::open( ['action' => 'FrontController@manejarEventoCrearTarea', 'method' => 'POST'] ) !!}

         		<div class="form-group">
		    		{!! Form::text('nombre',null,['placeholder' => 'Nombre', 'class' => 'form-control']) !!}
		    	</div>

		    	<div class="form-group">
		    		{!! Form::textarea('descripcion',null,['placeholder' => 'Descripcion ...', 'class' => 'form-control']) !!}
		    	</div>

					<div class="form-group">
					   {!! Form::select('categoria', ["Estudios", "Trabajo", "Hogar", "Actividad", "Ejercicio", "Plan", "Informacion"], null,  array('class' => 'form-control')) !!}
					</div>
<!--

					<div class="form-group">
		    		{!! Form::text('categoria',null,['placeholder' => 'Categoria', 'class' => 'form-control']) !!}
		    	</div>
-->


				<div class="form-group">
		    		<label> ¿Desea Colocar Una Fecha Limite? </label>

		    		<label>SI <input type="radio" name="fecha" onclick="deploy(this)" value="SI"> </label>
		    		<label>NO <input type="radio" name="fecha" onclick="deploy(this)" value="NO" checked="checked"> </label>
		    	</div>
<!--
					<table class="table">

						<thead class="thead-inverse">
							<tr>
								<th> Categorias</th>
							</th>
						</thead>
						<tbody>
							@foreach ($_SESSION['categorias'] as $categoria)
							 <tr>
								 <td>
									 {{$categoria}}
								 </td>
							 </tr>
							@endforeach
						</tbody>

					</table>
-->

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
	    			{!! Form::selectRange('year', date('o'), 2030 ) !!}
    			</div>


		    	{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

		    	<button type="reset" class="btn btn-danger" onclick="deploy(this)" value="NO">Cancelar</button>

			{!! Form::close() !!}

		</div>

	</div>

@endsection
