<?php
include 'conn/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}
$numero_aleatorio = rand(1, 1000);

if (isset($_POST['imagenIa'])) {
  if ($user_id == '') {
    header('location: logint/Logint.php');
  } else {
    $namek = $_POST['namek'];
    $suvirLetra_name = $_FILES['suvirLetra']['name']; // Nombre del archivo
    if ($namek != "" && $suvirLetra_name != "") {

      $namek = filter_var($namek, FILTER_SANITIZE_STRING);
      $suvirLetra_size = $_FILES['suvirLetra']['size']; // Tamaño del archivo
      $suvirLetra_tmp_name = $_FILES['suvirLetra']['tmp_name']; // Ruta temporal del archivo
      $image_folder_01 = 'uploaded_img/' . $numero_aleatorio . $suvirLetra_name; // Carpeta de destino del archivo

      $insert_products = $conn->prepare("INSERT INTO `timage`(imgen_ia,name) VALUES(?,?)");
      $insert_products->execute([$numero_aleatorio . $suvirLetra_name, $namek]);

      if ($insert_products) {
        if ($suvirLetra_size > 20000000) {
          $message[] = '¡Archivo muy pesado!';
        } else {
          move_uploaded_file($suvirLetra_tmp_name, $image_folder_01);

          if ($namek) {
            # code...

?>
            <div class="containere" id="myModal">
              <!-- Div para centrar -->
              <div class="contente">
                <!-- Contenido -->
                <p>EL NOMBRE DEL PROPIETARIO ES : <?= $namek ?> </p>
                <!-- Botón para cerrar -->
                <span class="close-btne" onclick="closeModal()">X</span>
              </div>
            </div>

            <script>
              // Función para abrir el div
              function openModal() {
                document.getElementById("myModal").style.display = "block";
              }

              // Función para cerrar el div
              function closeModal() {
                document.getElementById("myModal").style.display = "none";
              }
            </script>
<?php
          }
          $message[] = '¡Nuevo programa agregado!';
        }
      }
    } else {
      header('location: index.php#routine');
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--=============== FAVICON ===============-->
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" />

  <!--=============== REMIXICONS ===============-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="assets/css/styles.css" />

  <title>IA WRITE</title>
</head>
<!-- background-image: linear-gradient(to right, #7657f1, #c892d6); -->

<body>
  <!--==================== HEADER ====================-->
  <header class="header" id="header">
    <nav class="nav container">
      <a href="#" class="nav__logo">Write IA</a>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="#home" class="nav__link active-link">Home</a>
          </li>
          <li class="nav__item">
            <a href="#routine" class="nav__link">Tutorial</a>
          </li>

          <li class="nav__item">
            <a href="#join" class="nav__link">Comencémos</a>
          </li>

          <li class="nav__item">
            <a href="logint/Logint.php" class="nav__link" style="text-decoration: line-through; color: rgb(13 157 180)" Target="_blank">Iniciar sesión</a>
          </li>
        </ul>

        <!-- Close button -->
        <div class="nav__close" id="nav-close">
          <i class="ri-close-line"></i>
        </div>
      </div>

      <div class="nav__buttons">
        <!-- Theme change button -->
        <i class="ri-moon-line change-theme" id="theme-button"></i>

        <!-- Toggle button -->
        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-apps-2-line"></i>
        </div>
      </div>
    </nav>
  </header>

  <!--==================== MAIN ====================-->
  <main class="main">
    <!--==================== HOME ====================-->
    <section class="home section" id="home">
      <div class="home__container container grid">
        <div class="home__data">
          <h1 class="home__title">
            Reconoce tu
            <div class="home__title-box">
              letra
              <div>Write IA</div>
            </div>

            <img src="assets/img/star-img.svg" alt="home image" />
          </h1>

          <p class="home__description">
            ¡Bienvenido a nuestra página de Reconocimiento de Letra con
            Inteligencia Artificial!

            <img src="assets/img/circle-img.svg" alt="home image" />
          </p>

          <a href="#join" class="button">
            Comencémos gratis ;] <i class="ri-arrow-right-line"></i>
          </a>

          <div class="home__box">
            <div>
              <h3>300+</h3>
              <span>Write IA Trabajos</span>
            </div>
            <div>
              <h3>40+</h3>
              <span>Participantes</span>
            </div>
          </div>
        </div>

        <img src="assets/img/home-yoga.png" alt="home image" class="home__img" />
      </div>
    </section>

    <!--==================== LIST ====================-->
    <section class="list section">
      <div class="list__container container grid">
        <div class="list__content">
          <h1 class="list__number">#01</h1>

          <div class="list__blob">
            <img src="assets/img/list-yoga.png" alt="list image" />
          </div>
        </div>

        <div class="list__data">
          <p class="list__description">
            Algoritmos de IA Avanzados: Nuestro sistema utiliza algoritmos de
            aprendizaje automático y redes neuronales para reconocer y
            comprender una amplia variedad de estilos de escritura y fuentes
            de letras.

            <img src="assets/img/star-2-img.svg" alt="list image" />
          </p>

          <a href="#routine" class="button list__button">
            Siguiente paso<i class="ri-arrow-right-line"></i>

            <img src="assets/img/ellipse-img.svg" alt="button image" />
          </a>
        </div>
      </div>
    </section>

    <!--==================== HEALTH ====================-->
    <section class="health section" id="health">
      <div class="health__container container grid">
        <div class="health__data">
          <h2 class="section__title">Por que somos los mejores!</h2>

          <p class="health__description">
            Diseñada pensando en la facilidad de uso, nuestra página ofrece
            una interfaz intuitiva que permite a los usuarios cargar imágenes
            de escritura a mano, directamente en la plataforma para que sean
            analizadas instantáneamente.
          </p>

          <a href="#join" class="button">
            Let’s go ! ≧◠ᴥ◠≦<i class="ri-arrow-right-line"></i>
          </a>
        </div>

        <div class="health__image">
          <img src="assets/img/health-fitness.png" alt="health image" class="health__img" />

          <div class="health__rate">
            <!-- <div class="health__icon">
                <i class="ri-heart-3-fill"></i>
              </div> -->

            <!-- <div class="health__group">
                <span class="health__title"> Heart Rate </span>

                <span class="health__number"> 168 bpm </span>
              </div> -->
          </div>

          <div class="health__course">
            <div class="health__group">
              <span class="health__number"> 500+ </span>

              <span class="health__title"> Trabajos de exito </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--==================== ROUTINE ====================-->
    <section class="routine section" id="routine">
      <div class="routine__container container grid">
        <div class="routine__data">
          <h2 class="section__title">Tutorial, Es simple y facil de usar</h2>

          <p class="routine__description">
            Sigue las instrucciones para una mejor eficiencia.
          </p>

          <a href="#join" class="button">
            Let’s go ! ≧◠ᴥ◠≦ <i class="ri-arrow-right-line"></i>
          </a>
        </div>

        <div class="routine__images">
          <img src="assets/img/routine-yoga-1.png" alt="routine image" class="routine__img-1" />
          <img src="assets/img/routine-yoga-2.png" alt="routine image" class="routine__img-2" />

          <div class="routine__box-1">
            <i class="ri-play-circle-fill routine__icon"></i>
            <span class="routine__title">Video English</span>
          </div>

          <div class="routine__box-2">
            <i class="ri-play-circle-fill routine__icon"></i>
            <span class="routine__title">Video spañol</span>
          </div>
        </div>
      </div>
    </section>

    <!--==================== FOLLOW ====================-->
    <section class="follow section" id="follow">
      <div class="follow__container container grid">
        <div class="follow__content-1">
          <div class="follow__data">
            <h2 class="section__title follow__title">
              Todo tipo de documentos
              <div>#Write IA</div>
            </h2>
            <a href="#join" class="button follow__button">
              Sigenos <i class="ri-arrow-right-line"></i>
            </a>
          </div>

          <img src="assets/img/akg262657_00000000_c3ff0520_230703123417_800x977.jpg" alt="follow image" class="follow__img-1" />
          <img src="assets/img/carta-formal-e-informal-e1560388960954.jpg" alt="follow image" class="follow__img-2" />
        </div>

        <div class="follow__content-2">
          <img src="assets/img/29664068-la-escritura-del-vintage-caligrafía-antigua-grunge-de-fondo-de-papel.jpg" alt="follow image" class="follow__img-3" />
          <img src="assets/img/download.jpeg" alt="follow image" class="follow__img-4" />
        </div>
      </div>
    </section>
    <style>
      .name {
        border: none;
        outline: none;
        color: white;
        cursor: pointer;
        /* Cambia el cursor a una flecha */

        /* Esto elimina el contorno cuando el input está enfocado */
      }
    </style>
    <!--==================== JOIN ====================-->
    <section class="join section" id="join">
      <div class="join__container container grid">
        <div class="join__content">
          <div>
            <h2 class="join__title">wire detection with IA</h2>

            <p class="join__description">
              Carga de Imágenes: Simplemente carga una imagen que contenga
              texto escrito a mano en nuestra plataforma y deja que nuestra IA
              haga el resto.
            </p>
          </div>

          <form action="" method="post" class="join__form" enctype="multipart/form-data">
            <input type="text" name="namek" class="name">
            <input style="padding: 15px" type="file" class="join__input" name="suvirLetra" accept="image/jpg, image/jpeg, image/png, image/webp" />
            <input type="submit" class="button join__button" name="imagenIa">
            <i class="ri-arrow-right-line"></i>
            </input>
          </form>
        </div>
      </div>
    </section>
  </main>
  <!--==================== FOOTER ====================-->
  <footer class="footer">
    <div class="footer__container container grid">
      <div class="footer__content grid">
        <div>
          <a href="#" class="footer__logo">Write IA</a>

          <!-- <p class="footer__description">
              Take care of your health and <br />
              your mind with the best <br />
              Write IA classes.
            </p> -->
        </div>

        <div class="footer__data grid">
          <!-- <div>
              <h3 class="footer__title">Direccion</h3>

              <p class="footer__info">
                12345 M/01 Sol <br />
                Avenue, Lima, Peru
              </p>
            </div> -->

          <div>
            <h3 class="footer__title">Contactos</h3>

            <p class="footer__info">
              +51 962 248 104 <br />
              stifler@exoor.com
            </p>
          </div>

          <!-- <div>
              <h3 class="footer__title">Office</h3>

              <p class="footer__info">
                Marzo - Viernes  <br />
                9AM - 10PM
              </p>
            </div> -->
        </div>
      </div>

      <div class="footer__group">
        <ul class="footer__social">
          <li>
            <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
              <i class="ri-facebook-circle-line"></i>
            </a>
          </li>

          <li>
            <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
              <i class="ri-instagram-line"></i>
            </a>
          </li>

          <li>
            <a href="https://twitter.com/" target="_blank" class="footer__social-link">
              <i class="ri-twitter-line"></i>
            </a>
          </li>

          <li>
            <a href="https://www.youtube.com/" target="_blank" class="footer__social-link">
              <i class="ri-youtube-line"></i>
            </a>
          </li>
        </ul>

        <span class="footer__copy">
          &#169; Copyright EXXOR . TODOS LOS DERECHOS RESERBADOS.
        </span>
      </div>
    </div>
  </footer>

  <!--========== SCROLL UP ==========-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-line"></i>
  </a>

  <!--=============== SCROLLREVEAL ===============-->
  <script src="assets/js/scrollreveal.min.js"></script>

  <!--=============== MAIN JS ===============-->
  <script src="assets/js/main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>