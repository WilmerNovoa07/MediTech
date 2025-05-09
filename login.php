<?php
require 'assets/db/config.php';

// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
  $errMsg = '';

  // Obtener datos del formulario
  $usuario = trim($_POST['usuario']);
  $clave = trim($_POST['clave']);

  // Validación básica
  if (empty($usuario)) {
    $errMsg = 'Digite su usuario';
  }
  if (empty($clave)) {
    $errMsg = 'Digite su contraseña';
  }

  if (empty($errMsg)) {
    try {
      // Consulta para verificar el usuario y obtener sus datos
      $stmt = $connect->prepare(
            'SELECT id, nombre, usuario, email, clave, cargo FROM usuarios WHERE usuario = :usuario 
            UNION 
            SELECT codpaci, CONCAT(nombrep, " ", apellidop) as nombre, usuario, "" as email, clave, cargo FROM customers WHERE usuario = :usuario
            UNION
            SELECT coddoc, CONCAT(nomdoc, " ", apedoc) as nombre, usuario, correo as email, clave, cargo FROM doctor WHERE usuario = :usuario'
        );

      $stmt->execute([':usuario' => $usuario]);
      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($data === false) {
        $errMsg = "Usuario $usuario no encontrado.";
      } else {
        // Verificar la contraseña
        if (md5($clave) === $data['clave']) {
          // Almacenar datos del usuario en la sesión
          $_SESSION['id'] = $data['id'];
          $_SESSION['nombre'] = $data['nombre'];
          $_SESSION['usuario'] = $data['usuario'];
          $_SESSION['email'] = $data['email'];
          $_SESSION['clave'] = $data['clave'];
          $_SESSION['cargo'] = $data['cargo'];

          // Guardar el nombre del usuario en la tabla de sesión
          $nombreUsuario = $_SESSION['nombre'];
          $connect->query("REPLACE INTO session_data (id, user_name) VALUES (1, '{$nombreUsuario}')");

          // Redirección basada en el cargo
          if ($_SESSION['cargo'] == 1) {
            header('Location: view/admin/admin.php');
          } elseif ($_SESSION['cargo'] == 2) {
            header('Location: view/user/user.php');
          } elseif ($_SESSION['cargo'] == 3) {
          header('Location: view/doctor/doctorview.php'); // Cambiado a la vista de doctor
          }

          exit;
        } else {
          $errMsg = 'Contraseña incorrecta.';
        }
      }
    } catch (PDOException $e) {
      $errMsg = 'Error en el sistema: ' . $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <title>MediTech</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css " href="assets/css/style.css">
  <link rel="stylesheet" type="text/css " href="assets/css/css/all.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert.css">
  <link rel="icon" href="assets/img/logo.png" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body>
<img class="wave" src="../Meditech/assets/img/wave2.png" alt="" style="position: absolute; top: 0; left: 0; width: 62%; height: auto; z-index: -1; opacity: 0.9; object-fit: cover">

  <div class="contenedor">
    <div class="img">
      <img src="" alt="">
    </div>
    <div class="contenido-login">

      <form autocomplete="off" method="POST" role="form">

        <img src="assets/img/logo.png" alt="">
        <h2>Bienvenido</h2>
        <?php
        if (isset($errMsg)) {
          echo '<div style="color:#FF0000;text-align:center;font-size:20px;">' . $errMsg . '</div>';
        }
        ?>
        <div class="input-div nit">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">

            <input type="text" name="usuario" value="<?php if (isset($_POST['usuario']))
              echo $_POST['usuario'] ?>" autocomplete="off" placeholder="USUARIO">
            </div>
          </div>
          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">

              <input type="password" required="true" name="clave" value="<?php if (isset($_POST['clave']))
              echo MD5($_POST['clave']) ?>" placeholder="CONTRASEÑA">
            </div>
          </div>
          <div class="row" id="load" hidden="hidden">
            <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
              <img src="assets/img/load.gif" width="100%" alt="">
            </div>
            <div class="col-xs-12 center text-accent">
              <span>Validando información...</span>
            </div>
          </div>


          <button class="btn" name='login'> Iniciar sesión
          </button>

        </form>
        <div id="msg_error" class="alert alert-danger" role="alert" style="display: none"></div>

      </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <!-- Js personalizado -->


  </body>

  </html>