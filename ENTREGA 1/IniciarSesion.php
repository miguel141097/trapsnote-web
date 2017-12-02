<html>

  <head>
      <title>Iniciar Sesion</title>
      <link rel="stylesheet" href="css/estilosFormularios.css">

     <?php
        include 'constantes/constantes.php';
      ?>

  </head>

  <body>

  	<div class="box1">

  		<img src="assets/logoRetocado.jpg" class="logotipo">

  		 <form class="datosDeRegistro" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" METHOD="POST">

	  		 <label class="indicadorInput"> Maximo <?php  echo maxLengthNames; ?> Caracteres
          		<input type="text" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])) echo ($_POST['name']); ?>" maxlength="<?php  echo maxLengthNames; ?>" required>
              <!-- el atributo value se utiliza para que haya un valor por defecto, en este caso se utiliza para mantener un valor
              en el formulario mientras se valida dicho valor -->
        	 </label>

        	 <label class="indicadorInput"> Maximo <?php  echo maxLengthPassword; ?> Caracteres
          		<input type="password" placeholder="Password" name="password" maxlength="<?php  echo maxLengthPassword; ?>" required>
        	 </label>

	         <button type="submit" id="loginbtn">Iniciar Sesion</button>

	     </form>

  	</div>

    <div id="box2"> ¿No tienes cuenta?

    	<button type="button" onclick="location = 'CrearSesion.php'">Registrate</button>

    </div>

    <?php  

      if($_POST){

          /*Se encarga se hacer TODAS las validaciones de este apartado*/
          include 'objetos/CapturaIniciar.php';
          $capture = new CapturaIniciar();

          $datos = $capture->CapturaValidarFormulario();

          //Lo Guardamos en una Variable JSON
          $JSON = json_encode($datos);

          if($datos != "Error"){
            echo "<script language='javascript'>window.location='salidas/action_iniciar_sesion.php'</script>";
          } 

      }

    ?>

  </body>

</html>
