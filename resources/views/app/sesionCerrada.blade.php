<head>
	<title>Trapsnote </title>
	<!-- Hay que usar "asset()" porque puede fallar agregando los estilos -->
	<link rel="stylesheet" href="{{asset('menu/fonts.css')}}">
	<link rel="stylesheet" href="{{asset('css/estilosSwitch.css')}}">
	<!-- Implementar bootstrap en el formulario -->
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">

	<!-- la siguiente etiqueta se utiliza para que se adapte en pantallas mas pequeñas -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body >

<div class="col-xs-12">
	<div class="center-block">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<h2> Gracias por visitarnos </h2>

            <button type="button" class ='btn btn-primary' onclick="window.location='{{ url("Login") }}'">iniciar Sesion</button>
    </div>

  </div>
</div>
</body>
