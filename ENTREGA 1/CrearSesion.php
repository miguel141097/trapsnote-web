<html>

  <head>

    <title> Crear Sesion </title>
    <link rel="stylesheet" href="css/estilosFormularios.css">

    <?php
      /*Incluye la libreria de constantes para que puedan usarse en este archivo*/
      include 'constantes/constantes.php';
      include 'objetos/Calendario.php';
      include 'objetos/Validaciones.php';
    ?>

  </head>

  <body>

    <div class="box1">

      <img src="assets/logoRetocado.jpg" class="logotipo">

      <form class="datosDeRegistro" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" METHOD="POST">

        <label class="indicadorInput"> Maximo <?php  echo maxLengthNames; ?> Caracteres
          <input type="text" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])) echo ($_POST['name']); ?>" maxlength="<?php  echo maxLengthNames; ?>" required>
          <!-- {placeholder: Campo donde se escribe} -->
          <!-- {required: Campo Obligatorio} -->
        </label>

        <label class="indicadorInput"> Maximo  <?php  echo maxLengthNames; ?> Caracteres
          <input type="text" placeholder="Last Name" name="last_name" value="<?php if(isset($_POST['last_name'])) echo ($_POST['last_name']); ?>" maxlength=" <?php  echo maxLengthNames; ?>" required>
        </label>

        <label class="indicadorInputVacio"> Espacio
          <input type="email" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) echo ($_POST['email']); ?>" required>
        </label>

        <label class="indicadorInput"> Maximo  <?php  echo maxLengthPassword; ?> Caracteres
          <input type="password" placeholder="Password" name="password" maxlength="<?php  echo maxLengthPassword; ?>" required>
        </label>

        <label class="indicadorInput"> Maximo <?php  echo maxLengthPassword; ?> Caracteres
          <input id="ultimoInput" type="password" placeholder="Repeat Password" name="psw_repeat" maxlength="<?php  echo maxLengthPassword; ?>" required>
        </label>

        <div> Fecha de Nacimiento <br/><br/>
          <?php  $h = new Calendario();
            $h->generarDay();
            $h->generarMonth();
            $h->generarYear();
          ?>
        </div>


        <?php  

          if($_POST){

            /*Se encarga se hacer TODAS las validaciones de este apartado*/
              include 'objetos/CapturaCrear.php';
              $capture = new CapturaCrear();

              $datos = $capture->CapturaValidarFormulario();

              //Lo Guardamos en una Variable JSON
              $JSON = json_encode($datos);


              /*   ENVIO    */
              echo $JSON;
              $url = 'https://quiet-basin-87095.herokuapp.com';
              $ch = curl_init( $url );
              // Este es el setup para enviar los datos del json a la base de datos
              $payload = json_encode(array('usuario' => $datos));
              curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              // El exec se encarga de enviar la solicitud al rervidor y guarda la respuesta en $result
              //$result = curl_exec($ch);
              curl_close($ch);
              // Aqui se imprime la respuesta del servidor
              //echo "<pre>$result</pre>";

              if($datos != "Error"){
                echo "<script language='javascript'>window.location='salidas/action_crear_sesion.php'</script>";
              } 

          }

        ?>

        <button type="submit" id="signupbtn">Continuar</button>

      </form>

    </div>

  </body>


</html>
