<head>
	<!-- la siguiente etiqueta se utiliza para que se adapte en pantallas mas pequeñas -->
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
@extends('layouts.principal')

@section('contenido')

	<?php
    	@session_start();
    ?>

	<!-- Alertas -->
	@include('alert.request')

	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<h3 class = "titulo" >Cerrar Sesion</h3>
          <div class="form-group">
            {!! Form::open( ['action' => 'FrontController@manejarEventoLogout', 'method' => 'DELETE'] ) !!}
              {{ Form::submit('Cerrar sesion', ['class' => 'btn btn-danger'] ) }}
            {!! Form::close() !!}
          </div>
    </div>

  </div>

@endsection
