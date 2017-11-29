<html>

  <head>

    <title> Crear Sesion </title>
    <link rel="stylesheet" href="css/estilosFormularios.css">

  </head>

  <body>

    <div class="box1">

      <img src="assets/logoRetocado.jpg" class="logotipo">

      <form class="datosDeRegistro" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" METHOD="POST">

        <label class="indicadorInput"> Maximo 3 Caracteres
          <input type="text" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])) echo ($_POST['name']); ?>" required>
          <!-- {placeholder: Campo donde se escribe} -->
          <!-- {required: Campo Obligatorio} -->
        </label>

        <label class="indicadorInput"> Maximo  25 Caracteres
          <input type="text" placeholder="Last Name" name="last_name" value="<?php if(isset($_POST['last_name'])) echo ($_POST['last_name']); ?>" required>
        </label>

        <label class="indicadorInputVacio"> Espacio
          <input type="email" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) echo ($_POST['email']); ?>" required>
        </label>

        <label class="indicadorInput"> Maximo  35 Caracteres
          <input type="password" placeholder="Password" name="password" required>
        </label>

        <label class="indicadorInput"> Maximo 34 Caracteres
          <input id="ultimoInput" type="password" placeholder="Repeat Password" name="psw_repeat" required>
        </label>

        <button type="submit" id="signupbtn">Continuar</button>

      </form>

    </div>

  </body>


</html>
