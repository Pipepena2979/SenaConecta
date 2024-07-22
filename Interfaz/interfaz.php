<?php

  if (session_status() !== PHP_SESSION_ACTIVE) {

    // Si no está iniciada, la iniciamos

    session_start();

  }

  session_destroy();

?>

<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">



  <title>C D A E Villeta</title>

  <meta content="" name="description">

  <meta content="" name="keywords">



  <!-- Favicons -->

  <link href="./Img/Sena.png" rel="icon">

  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">



  <!-- Google Fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">



  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">



  <link href="assets/css/main.css" rel="stylesheet">

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <style>

        .cont-recap{
          width: 100%;
          display: flex;
          justify-content: center;
        }
        @media (max-width:473px) {
            .botones-iniciar{
              display: flex !important;
              flex-direction: row-reverse !important;
              flex-wrap: nowrap !important;
            }
        }
        @media (max-width:415px) {
            .title-size{
                font-size: 22px !important;
            }
            .texto-size{
              font-size: 18px !important;
            }
        }
        @media (max-width:393px) {
            .title-size{
                font-size: 22px !important;
            }
            .texto-size{
              font-size: 15px !important;
            }
        }
        @media (max-width:328px) {
            .title-size{
                font-size: 20px !important;
            }
            .texto-size{
              font-size: 14px !important;
            }
            .ingresar-size{
              font-size: 13px  !important;
            }
        }
        @media (max-width:307px) {
            .title-size{
                font-size: 19px !important;
            }
            .texto-size{
              font-size: 13px !important;
            }
        }
        @media (max-width:277px) {
            .title-size{
                font-size: 17px !important;
            }
            .texto-size{
              font-size: 12px !important;
            }
            .ingresar-size{
              font-size: 9px  !important;
            }
        }
    </style>


</head>



<body>



  <!-- ======= Header ======= -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      
      <a href="#" class="logo d-flex align-items-center">

        <!-- Uncomment the line below if you also wish to use an image logo -->

        <!-- <img src="assets/img/logo.png" alt=""> -->

        <h1>Sena<span>Conecta</span></h1>

      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#header" class="active">Inicio</a></li>
          <li><a href="#constructions">Nosotros</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
      </nav><!-- .navbar -->
    </div>

  </header><!-- End Header -->



  <!-- ======= Hero Section ======= -->

  <section id="hero" class="hero">



    <div class="info d-flex align-items-center">

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-6 text-center">

            <h2 data-aos="fade-down" class="title-size">Bienvenido <span>Sena<a style="color: #39A900;">Conecta</a></span></h2>

            <p data-aos="fade-up " class="texto-size">La programación de instructores en el Servicio Nacional de Aprendizaje (SENA) es una tarea fundamental para garantizar la calidad de la formación que se ofrece a los aprendices. Para facilitar este proceso y asegurar una asignación eficiente y efectiva de instructores, se ha desarrollado un software diseñado específicamente para las necesidades del SENA</p>

            <a data-aos="fade-up" data-aos-delay="200" data-bs-toggle="modal" href="#Login" id="ModalLogin" class="btn-get-started ingresar-size">Ingresar</a>

          </div>

        </div>

      </div>

    </div>



    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">



      <div class="carousel-item active" style="background-image: url(assets/img/hero-carousel/sena9.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena3.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena7.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena2.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena4.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena5.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena6.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena1.jpeg)"></div>
      <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/sena8.jpeg)"></div>

      

      <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">

        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>

      </a>



      <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">

        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>

      </a>



    </div>



  </section><!-- End Hero Section -->



  <main id="main">



    <!-- ======= Constructions Section ======= -->

    <section id="constructions" class="constructions section-bg">

      <div class="container" data-aos="fade-up">



        <div class="section-header">

          <h2>Nosotros</h2>

          <p>El Servicio Nacional de Aprendizaje (SENA) es una entidad autónoma del gobierno colombiano, adscrita al Ministerio del Trabajo, que tiene como objetivo principal brindar formación y capacitación a personas de todas las edades con el fin de mejorar sus competencias y habilidades para el mundo laboral</p>

        </div>



        <div class="row gy-4">



          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="card-item">

              <div class="row">

                <div class="col-xl-5">

                  <div class="card-bg" style="background-image: url(assets/img/sena8.jpg);"></div>

                </div>

                <div class="col-xl-7 d-flex align-items-center">

                  <div class="card-body">

                    <h4 class="card-title">¿Que somos?</h4>

                    <p>Una entidad autónoma del Gobierno colombiano que promueve la formación técnica y tecnológica, desarrollo de habilidades laborales en el país. Su objetivo es contribuir al crecimiento económico y al mejoramiento de la calidad de vida de los colombianos a través de la educación y la capacitación</p>

                  </div>

                </div>

              </div>

            </div>

          </div><!-- End Card Item -->



          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

            <div class="card-item">

              <div class="row">

                <div class="col-xl-5">

                  <div class="card-bg" style="background-image: url(assets/img/nosotros2.jpeg);"></div>

                </div>

                <div class="col-xl-7 d-flex align-items-center">

                  <div class="card-body">

                    <h4 class="card-title">Vision</h4>

                    <p>Ser referente en la formación técnica y tecnológica en Colombia, promoviendo el desarrollo económico y social del país mediante la educación y la capacitación de alta calidad. Además, podría incluir objetivos relacionados con la innovación educativa, la inclusión de grupos vulnerables.</p>

                  </div>

                </div>

              </div>

            </div>

          </div><!-- End Card Item -->



          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">

            <div class="card-item">

              <div class="row">

                <div class="col-xl-5">

                  <div class="card-bg" style="background-image: url(assets/img/nosotros1.jpeg);"></div>

                </div>

                <div class="col-xl-7 d-flex align-items-center">

                  <div class="card-body">

                    <h4 class="card-title">Mision</h4>

                    <p>Ofrecer y ejecutar la formación profesional integral, para la incorporación y el desarrollo de las personas en actividades productivas que contribuyan al desarrollo social, económico y tecnológico de Colombia</p>

                  </div>

                </div>

              </div>

            </div>

          </div><!-- End Card Item -->



          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">

            <div class="card-item">

              <div class="row">

                <div class="col-xl-5">

                  <div class="card-bg" style="background-image: url(assets/img/sena8.jpg);"></div>

                </div>

                <div class="col-xl-7 d-flex align-items-center">

                  <div class="card-body">

                    <h4 class="card-title">Slogan</h4>

                    <p>Conéctate con tu futuro, conéctate con SENA Conecta</p>

                  </div>

                </div>

              </div>

            </div>

          </div><!-- End Card Item -->



        </div>



      </div>

    </section><!-- End Constructions Section -->

        <!-- ======= Contact Section ======= -->

        <section id="contact" class="contact">

          <div class="container" data-aos="fade-up" data-aos-delay="100">

    

            <div class="row gy-4">

              <div class="col-lg-6">

                <div class="info-item  d-flex flex-column justify-content-center align-items-center">

                  <i class="bi bi-map"></i>

                  <h3>Nuestra dirección</h3>

                  <p>Cl. 2 #13 - 3, Villeta, Cundinamarca</p>

                </div>

              </div><!-- End Info Item -->

    

              <div class="col-lg-3 col-md-6">

                <div class="info-item d-flex flex-column justify-content-center align-items-center">

                  <i class="bi bi-envelope"></i>

                  <h3>Envíanos un correo electrónico</h3>

                  <p>sena@gmail.com</p>

                </div>

              </div><!-- End Info Item -->

    

              <div class="col-lg-3 col-md-6">

                <div class="info-item  d-flex flex-column justify-content-center align-items-center">

                  <i class="bi bi-telephone"></i>

                  <h3>Llámanos</h3>

                  <p>+57 314 257 4657</p>

                </div>

              </div><!-- End Info Item -->

    

            </div>

    

            <div class="row gy-4 mt-1">

    

              <div class="col-lg-6 ">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3974.592001286635!2d-74.48093638467456!3d5.007220840316306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e409a382b430215%3A0xc52e02a6d349782a!2sSENA%2C%20CDAE%20Villeta!5e0!3m2!1ses!2sco!4v1680589499807!5m2!1ses!2sco" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>

              </div><!-- End Google Maps -->

    

              <div class="col-lg-6">

                <form action="./Controllers/Contacto.php" method="post" class="php-email-form"> <!--class="php-email-form" -->

                  <div class="row gy-4">

                    <div class="col-lg-6 form-group">

                      <input 

                        type="text" 

                        name="nombre" 

                        class="form-control" 

                        id="nombre" 

                        placeholder="Ingresa tu nombre" 

                        autocomplete="off"

                        required>

                    </div>

                    <div class="col-lg-6 form-group">

                      <input 

                        type="email" 

                        class="form-control" 

                        name="email" 

                        id="email" 

                        placeholder="Ingresa tu correo electrónico" 

                        autocomplete="off"

                        multiple 

                        required>

                    </div>

                  </div>

                  <div class="form-group">

                    <input 

                      type="text" 

                      class="form-control" 

                      name="subject" 

                      id="subject" 

                      placeholder="Ingresa tu asunto de maximo 25 caracteres" 

                      maxlength="25"

                      autocomplete="off" 

                      required>

                  </div>

                  <div class="form-group">

                    <textarea class="form-control" name="message" rows="5" placeholder="Ingresa tu mensaje" required></textarea>

                  </div>

                  <div class="text-center"><button type="submit">Enviar mensaje</button></div>

                </form>

              </div><!-- End Contact Form -->

    

            </div>

    

          </div>

        </section><!-- End Contact Section -->







  </main><!-- End #main -->



  <!-- ======= Footer ======= -->

  <footer id="footer" class="footer">



    <div class="footer-content position-relative text-center">

      <div class="container">

        <div class="row">



          <div class="col-lg-6 col-md-6">

            <div class="footer-info">

              <h3>Sena<a style="color: #39A900;">Conecta</a></h3>

              <p>

              Cl. 2 #13 - 3<br>

              Villeta, Cundinamarca<br><br>

                <strong>Telefono:</strong> +57 314 297 5647<br>

                <strong>Correo electrónico:</strong> sena@gmail..com<br>

              </p>

              <div class="social-links d-flex mt-1" style="justify-content: center;">

                <a href="https://www.facebook.com/SenaCDAEVilletaOficial?mibextid=avESrC" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>        

                <a href="https://instagram.com/senavilleta?igshid=MzRlODBiNWFlZA==" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>

                <a href="https://www.youtube.com/@SENAComunica" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-youtube"></i></a>

                <a href="https://cdaevilleta.blogspot.com/" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-house-door-fill"></i></a>

              </div>

            </div>

          </div><!-- End footer info column-->



          <div class="col-lg-6 col-md-3 footer-links text-center">

            <h4>Enlaces útiles</h4>

            <ul>

              <li><a href="#header">Inicio</a></li>

              <li><a href="#main">Nosotros</a></li>

              <li><a href="#contact">Contacto</a></li>

              <li><a href="../Ingreso/controllers/cManual.php?N=1">Manual de uso</a></li>

            </ul>

          </div><!-- End footer links column-->

        </div>

      </div>

    </div>



    <div class="footer-legal text-center position-relative">

      <div class="container">

        <div class="copyright">

          &copy; <?=date("Y")?> Copyright <strong><span>Sena<a style="color: #39A900;">Conecta</a></span></strong>. Todos los derechos reservados

        </div>

        <div class="credits">

         

          Diseñado por <a>ADSO</a>

        </div>

        <a data-bs-toggle="modal"  data-bs-target="#staticBackdrop" id="modalContacto"></a>

      </div>

    </div>



  </footer>

  <!-- End Footer -->





<?php  if(isset($_SESSION['tipo_alert_Login']) && isset($_SESSION['mensajeLogin']) && isset($_SESSION['modal'])){ ?>



  <script>

    setTimeout(()=>{document.getElementById('ModalLogin').click()},700)
    

  </script>

  

<?php unset($_SESSION['modal']); }?>






<div class="modal modalentorno" id="Login" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">

        <h3 class="modal-title" style="font-family: Amatic SC ;">Iniciar sesión</h3>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: red;"></button>

      </div>

      

      <div class="modal-body">

      

        <form action="./Controllers/Cuser.php" method="POST"> 

          <div class="input-group mb-3">

            <label for="documento">Usuario</label>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>

            <input type="number" min=1 id="documento" name="documento" class="form-control modalinput" placeholder="Escribe tu usuario" aria-label="Escribe tu usuario" aria-describedby="basic-addon1" required>

          </div>

          <div class="input-group mb-3">

            <label for="contra">Contraseña</label>

          </div>

          <div class="input-group mb-3">

            <span class="input-group-text" id="basic-addon1" onclick="mostrarContrasena()"><i id="icon" class="bi bi-eye-slash-fill"></i></span>

            <input type="password" id="contra" name="contra" class="form-control modalinput" placeholder="Escribe tu contraseña" aria-label="Escribe tu usuario" aria-describedby="basic-addon1" required>

          </div>



          <div class="modal-footer botones ">

          </div>

          

          <?php if(isset($_SESSION['mensajeLogin'])): ?>

            <div class="alert alert-<?=$_SESSION['tipo_alert_Login']?> alert-dismissible fade show" role="alert">

              <?=$_SESSION['mensajeLogin']?>

              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>

            <?php

                unset($_SESSION['tipo_alert_Login']);

                unset($_SESSION['mensajeLogin']);

            ?>

          <?php endif ?>  

          

          <!-- <div class="input-group mb-3">



            <div class="cont-recap">
              <div class="g-recaptcha" data-sitekey="6LcoZQgpAAAAAABBH-hqTdgdYKX0kcfz7Oq9QV6c" required></div>
            </div>



          </div> -->



          <!-- <div class="modal-footer botones">

          </div>



          

            <center><a style="color: blue;cursor: pointer;">Olvide la contraseña</a></center> -->

          

            <div class="modal-footer botones botones-iniciar">

            <a class="btn btn-danger btn-block boton" data-bs-dismiss="modal">Cerrar</a>

            <button class="btn btn-success btn-block boton">Iniciar Sesion</button>

          </div>

 




<?php  if(isset($_SESSION['modalContacto']) && isset($_SESSION['mensajeContacto']) && isset($_SESSION['boton'])){ ?>



  <script>

    // alert('hola');

    setTimeout(()=>{document.getElementById('modalContacto').click()},700)

  </script>



<?php unset($_SESSION['modalContacto']); } ?>



<!-- Modal estatica -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="staticBackdropLabel">Querido usuario</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <?=$_SESSION['mensajeContacto'];?>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-<?=$_SESSION['boton']?> btn-block" data-bs-dismiss="modal">Aceptar</button>

      </div>

    </div>

  </div>

</div>





  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



  <div id="preloader"></div>



  <!-- Vendor JS Files -->

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="assets/vendor/aos/aos.js"></script>

  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <script src="assets/vendor/php-email-form/validate.js"></script>



  <!-- Template Main JS File -->

  <script src="assets/js/main.js"></script>



</body>



</html>