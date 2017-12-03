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
