<!-- {En caso de algun error del usuario al ingresar un valor en el formulario, activa la advertencia} -->

@if ($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
@endif


@if ( (isset($_SESSION['error'])) and ($_SESSION['error'] != "") )
	<div class="alert alert-warning alert-dismissible" role="alert">
	    <ul>
			<li>{{ $_SESSION['error'] }}</li>
		</ul>
	</div>
@endif


@if ( (isset($_SESSION['exito'])) and ($_SESSION['exito'] != "") )
	<div class="alert alert-success alert-dismissible" role="alert">
	    <ul>
			<li>{{ $_SESSION['exito'] }}</li>
		</ul>
	</div>
@endif