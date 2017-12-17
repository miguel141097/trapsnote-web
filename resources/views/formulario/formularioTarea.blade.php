<html>

  <head>

    <title>Crear Tarea </title>

    <!-- {Manera de agregar recursos en larabel con laravel collective} -->
    <!--{   {!!Html::style('css/estilosFormularios.css')!!}   }-->

    <!-- {Sin embargo Heroku maneja estos direcciones sin estos comandos de laravel collective} -->
    <link rel="stylesheet" href="css/estilosFormularios.css">
    <link rel="stylesheet" href="css/bootstrap.css">

  </head>

  <body>
  	<!-- {Incluye las alertas} -->
  	@include('alert.request')

    <div class="box1">

    	<img src="assets/logoRetocado.jpg" class="logotipo">

          	{!! Form::open( ['action' => 'FormularioController@manejarCrearTarea', 'method' => 'POST', 'class' => 'datosDeRegistro'] ) !!}

            <div class="indicadorInput">
              {!! Form::text('descripcion',null,['placeholder' => 'Descripcion']) !!}
              <!-- {placeholder: Campo donde se escribe} -->
                  <!-- {required: Campo Obligatorio} -->
            </div>

            <div class="indicadorInput">
              {!! Form::text('categoria',null,['placeholder' => 'Categoria']) !!}
              <!-- {placeholder: Campo donde se escribe} -->
                  <!-- {required: Campo Obligatorio} -->
            </div>
          		<div class="indicadorInput">
          			{!! Form::text('username',null, ['placeholder' => 'username']) !!}
          		</div>

              <div>
                {!! Form::selectRange('completado', 0, 1) !!}

              </div>

              <div class="indicadorInput">
                {!! Form::text('horaCompletado',null,['placeholder' => 'horaCompletado']) !!}
              </div>
          		{!! Form::submit('Crear Tarea', ['class' => 'button']) !!}
              <button type="button" class ='button' onclick="window.location='{{ url("Login") }}'">Atras</button>

      		{!! Form::close() !!}


          </div>



    </div>


  </body>


</html>
