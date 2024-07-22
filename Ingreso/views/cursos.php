<?php

    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    if (!isset($_SESSION['T_doc'],$_SESSION['num_doc'],$_SESSION['rol'],$_SESSION['Correo'],$_SESSION['nombres'],$_SESSION['apellidos'],$_SESSION['fechaNacimiento'],$_SESSION['Telefono'],$_SESSION['contrasena'],$_SESSION['foto'])) {
        session_destroy();
        echo "<script>alert('Por favor inicie session');location.href='../../index.php'</script>";
        exit();
    }
    if ($_SESSION['rol'] == 3) {
        session_destroy();
        echo "<script>alert('Error, usted no tiene permiso');location.href='../../index.php'</script>";
        exit();
    }

?>

<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
include("../controllers/mosinstructores.php");
include('layout/header.php');
include_once("../controllers/lib_fecha_texto.php"); 

?>


<div id="wrapper">
    <?php include_once('layout/sidebar.php');  ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include'layout/navitem.php'  ?>


                  
<br>
<?php if(empty($cursos)) {?>
<div class="container-fluid"> 
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
        </div> 
        <div class="card-body">
            <div class="row">
                <div class="form-group  col-md-12 text-center">
                    <h2>Todavia no hay cursos registrados</h2>
                    <center><p><a href="./tablaperfilcu.php" style="text-decoration: none;">Registralos</a></p></center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos de los cursos
                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                    data-bs-toggle="popover" data-bs-trigger="hover" 
                    data-bs-content="En esta tabla puedes ver los intructores registrados, visualizar sus perfiles y el calendario asignado a cada uno, tmabien puedes realizar un asignación directa">
                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Nivel academico</th>
                            <th>Codigo</th>
                            <th>Version</th>
                            <th>Jornada</th>
                            <th>Descripción</th>
                            <th>Calendario</th>
                        </tr>
                    </thead>
                    <style>
                        #tablasty:hover{
                            color: black;
                        }
                    </style>
                    <tbody>
                    <?php 
                    
                        $i = 1;
                        foreach($cursos AS $c){?>
                        <tr id="tablasty">
                            <td><?=$i;?></td>
                            <td><?=$c['denominacion_prog']?></td>
                            <td><?=$c['nom_nivel']?></td>
                            <td><?=$c['codigo_prog']?></td>
                            <td><?=$c['version']?></td>
                            <td><?=$c['nombreJornada']?></td>
                            <td><?=$c['descripcion']?></td>
                            <td style="text-align:center;">
                                <a class="nav-link" id="iconos" href="../controllers/cCalendario.php?curso=<?=$c['codigo_prog']?>" title="Calendario">
                                    <i class="fa fa-calendar"></i>
                                </a>
                            </td>
                        </tr>
                    <?php $i++; } ?>              
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
<?php } ?>

            </div>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<?php  if(isset($_SESSION['modalMensaje'])){ ?>

<script>
  setTimeout(()=>{document.getElementById('modalMensaje').click()},300)
</script>

<?php unset($_SESSION['modalMensaje']); } ?>


<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<!-- Footer -->
<?php include_once('layout/footer.php');?>