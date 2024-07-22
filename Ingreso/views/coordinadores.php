<?php

  if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
  }
  if (!isset($_SESSION['T_doc'],$_SESSION['num_doc'],$_SESSION['rol'],$_SESSION['Correo'],$_SESSION['nombres'],$_SESSION['apellidos'],$_SESSION['Telefono'],$_SESSION['contrasena'],$_SESSION['foto'])) {
    session_destroy();
    echo "<script>alert('Por favor inicie session');location.href='../../index.php'</script>";
    exit();
  }

?>

<?php include'layout/header.php'  ?>
<?php include("../controllers/mosinstructores.php"); ?>
<?php include_once("../controllers/lib_fecha_texto.php"); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include'layout/sidebar.php'  ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include'layout/navitem.php'  ?>
                
                <!-- End of Topbar -->

<link href="../css/main2.css" rel="stylesheet">  

<section id="recent-blog-posts" class="recent-blog-posts">
<?php if($coordinadoresT == ""){ ?>
    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="form-group  col-md-12 text-center">
                        <h2>Todavia no tienes coordinadores registrados</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
  <?php 
    date_default_timezone_set("America/Bogota");
    $fechaActual = date("Y-m-d");     
  ?>
  <div class="container" data-aos="fade-up"">
    <div class="section-header" style="padding-bottom: 10px;">
      <h2>Coordinadores</h2>
    </div>
    <div class="row gy-5">       
    <?php foreach($coordinadoresT As $c){?> 
      
    <?php $fecha = $c['fechaFinContrato'];?>
      <?php if($fecha >= $fechaActual){ ?>

        <div class="col-xl-4 col-md-6 margenCardPrueba" data-aos="fade-up" data-aos-delay="100">
          <div class="post-item position-relative h-100">
            <div class="post-img position-relative overflow-hidden">
              <img src="../img/Perfil/<?php 

                if($c['genero'] == 2 && $c['foto'] == 'undraw_profile.png'){
                    echo $c['foto'];
                }elseif(($c['genero'] == 1 || $c['genero'] == 3) && $c['foto'] == 'undraw_profile.png'){
                    echo 'undraw_profile_Mujer.png';
                }else{
                    echo $c['foto'];
                }

              ?>" class="img-fluid" alt="" style="height: 400px;width:100%;">
              <span class="post-date"><i class="fa fa-birthday-cake" aria-hidden="true" style="margin-right: 7px;"></i> <?=fechaATexto($c['fechaNacimiento'])?></span>
            </div>
            <div class="post-content d-flex flex-column">
              <!-- <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3> -->
              <div class="meta d-flex align-items-center">
                <div class="d-flex align-items-center">
                  <i class="bi bi-person"></i>
                  <span class="ps-2"> &nbsp;&nbsp;<?=$c['nombres']?> <?=$c['apellidos']?> 
                    <a href="#" title="Correo electrónico"  
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="<?=$c['Correo']?>">
                            <i class="fa fa-envelope" aria-hidden="true" id="IconosAyuda"></i>
                    </a>
                    <a href="#" title="Número telefonico"  
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="<?=$c['Telefono']?>">
                            <i class="fa fa-phone" aria-hidden="true" id="IconosAyuda"></i>
                    </a>
                  </span>
                </div>
              </div>
              <div class="meta d-flex align-items-center">      
                <div class="d-flex align-items-center">
                  <i class="bi bi-folder2"></i> <span class="ps-2"> &nbsp;&nbsp;<?=$c['Nombre']?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php } ?>
    <?php } ?>

    </div>
  </div>
<?php }?>
</section>
<!-- End Recent Blog Posts Section -->





</div>

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
       
<?php include'layout/footer.php'?>