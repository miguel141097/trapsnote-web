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
          		<input type="email" placeholder="Email adress" name="email" value="<?php if(isset($_POST['email'])) echo ($_POST['email']); ?>" maxlength="<?php  echo maxLengthNames; ?>" required>
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

          $url = 'https://dry-forest-40048.herokuapp.com/login';
          $ch = curl_init( $url );
          // Este es el setup para enviar los datos del json a la base de datos
          $payload = json_encode($datos);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
          $result = curl_exec($ch);
          curl_close($ch);
          // Aqui se imprime la respuesta del servidor
          $result = json_decode($result, true);
          echo $result['email'];
          echo "<pre>$result</pre>";
          echo $datos['email'];
          echo $datos['password'];


      }

    ?>

  </body>

</html>
