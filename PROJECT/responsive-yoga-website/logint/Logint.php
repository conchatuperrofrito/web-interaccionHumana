<?php

include '../conn/connect.php';
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

if (isset($_POST['ingresar'])) {

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $select_user = $conn->prepare("SELECT * FROM `tusers` WHERE email = ? AND pass = ?");
  $select_user->execute([$email, $pass]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if ($select_user->rowCount() > 0) {
    $_SESSION['user_id'] = $row['name'];
    header('location:../index.php');
  } else {
    $message[] = '¡Nombre de usuario o contraseña incorrecta!';
  }
}
if (isset($_POST['registrar'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);


  $select_user = $conn->prepare("SELECT * FROM `tusers` WHERE email = ?");
  $select_user->execute([$email,]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if ($select_user->rowCount() > 0) {
    $message[] = '¡el Email ya existe!';
  } else {

    $insert_user = $conn->prepare("INSERT INTO `tusers`(name, email, pass) VALUES(?,?,?)");
    $insert_user->execute([$name, $email, $pass]);
    $message[] = 'registrado exitosamente, inicie sesión ahora por favor!';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
  <script src="script.js"></script>

  <div class="body">
    <div class="veen">
      <div class="login-btn splits">

        <p class="pointer"><img src="../assets/img/logos/download.png" style="width: 30px; color: #2d6fdc; cursor:pointer" alt=""> ingresar con Google</p>
        <p class="pointer"><img src="../assets/img/logos/fb.png" style="width: 30px; color: #2d6fdc;cursor:pointer" alt=""> ingresar con Facebook</p>
        <br>
        <p>Ya tienes una cuenta?</p>
        <button class="active">Ingresar</button>
      </div>
      <div class="rgstr-btn splits">
        <p class="pointer"><img src="../assets/img/logos/download.png" style=" width: 30px; cursor:pointer" alt=""> ingresar con Google</p>
        <p class="pointer"><img src="../assets/img/logos/fb.png" style="width: 30px; cursor:pointer" alt=""> ingresar con Facebook</p>
        <br>
        <p>No tienes una cuenta?</p>
        <button>Registrar</button>
      </div>
      <div class="wrapper">
        <form id="login" tabindex="500" method="post">
          <h3>Ingresar</h3>
          <div class="mail">
            <input type="mail" name="email" />
            <label>Ingrese tu correo</label>
          </div>
          <div class="passwd">
            <input type="password" name="pass" />
            <label>Contraseña</label>
          </div>
          <div class="submit">
            <button class="dark" name="ingresar">Ingresar</button>
          </div>
        </form>
        <form id="register" tabindex="502" method="post">
          <h3>Registrar</h3>
          <div class="name">
            <input type="text" name="name" />
            <label>Nombre completo</label>
          </div>
          <div class="mail">
            <input type="mail" name="email" />
            <label>Correo</label>
          </div>
          <!-- <div class="uid">
            <input type="text" name="" />
            <label>Nombre de usuario</label>
          </div> -->
          <div class="passwd">
            <input type="password" name="pass" />
            <label>Contraseña</label>
          </div>
          <div class="submit">
            <button class="dark" name="registrar">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <style type="text/css">
    .site-link {
      padding: 5px 15px;
      position: fixed;
      z-index: 99999;
      background: #fff;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.14), 0 4px 8px rgba(0, 0, 0, 0.28);
      right: 30px;
      bottom: 30px;
      border-radius: 10px;
    }

    .pointer {
      cursor: pointer;
    }

    .site-link img {
      width: 30px;
      height: 30px;
    }
  </style>
</body>

</html>