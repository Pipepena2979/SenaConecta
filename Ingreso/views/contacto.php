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
    <?php if(isset($_SESSION['mensajeContacto'])): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="alert alert-<?=$_SESSION['tipo_alert_contacto']?> alert-dismoissible fade show" role="alert">
                        <?=$_SESSION['mensajeContacto']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                </div>
                <?php
                    unset($_SESSION['tipo_alert_contacto']);
                    unset($_SESSION['mensajeContacto']);
                ?>
            </div>
        </div>
    <?php endif ?> 
<?php if(empty($contacto)) {?>
<div class="container-fluid"> 
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
        </div> 
        <div class="card-body">
            <div class="row">
                <div class="form-group  col-md-12 text-center">
                    <h2>Todavia no hay solicitudes de contacto</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos de los fromularios de contacto
                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                    data-bs-toggle="popover" data-bs-trigger="hover" 
                    data-bs-content="En esta tabla puedes ver las solicitudes de contacto">
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
                            <th>Nombres</th>
                            <th>Correo electrónico</th>
                            <th>Asunto</th>
                            <th>Mensaje</th>
                            <th>Fecha de enviado</th>
                            <th>Eliminar</th>
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
                        foreach($contacto AS $c){?>
                        <tr id="tablasty">
                            <td><?=$i;?></td>
                            <td><?=$c['nombres']?></td>
                            <td><?=$c['email']?></td>
                            <td><?=$c['asunto']?></td>
                            <td><?=$c['mensaje']?></td>
                            <td><?=$c['fechaRegistro']?></td>
                            <td style="text-align:center;vertical-align: middle;">   
                                <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarComentario" onclick="recibir_id(<?= $c['id'] ?>,'<?=$c['nombres']?>','<?=$c['fechaRegistro']?>');">
                                    <i class="fa fa-trash"></i>
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
</div>
<?php } ?>
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
<script>
    function recibir_id(id,nombres,fechaRegistro) {
        console.log(id)
        let modal = document.getElementById("eliminarComentario");
        let enlaceEjemplo = modal.querySelector("#botonconfirmareliminarComentario");
        let href = '../controllers/cRegUsuarios.php?eliminarComentario=' + id;
        enlaceEjemplo.setAttribute('href', href);
        let texto= document.getElementById("textoEliminarComentario");
        texto.innerText="¿Esta seguro de eliminar el comentario de " + nombres + " con fecha de envio " + fechaRegistro +"?";
    }
</script>
<!-- Modal eliminar comentario-->
<div class="modal fade" id="eliminarComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar comentario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="textoEliminarComentario" class="modal-body" style="text-align: center;"></div>
                <div class="modal-footer">
                                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <a  id="botonconfirmareliminarComentario" class="btn btn-success btn-block" href="../controllers/cRegUsuarios.php">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Fin Modal eliminar comentario-->
<!-- Footer -->
<?php include_once('layout/footer.php');?>