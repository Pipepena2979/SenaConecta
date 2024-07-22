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

    include("../controllers/cAmbiente.php");
    include('layout/header.php');

?>

<!-- Page Wrapper -->
        <div id="wrapper">

        <?php include('layout/sidebar.php' ) ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('layout/navitem.php')  ?>
                <!-- End of Topbar -->

<br>                        

<?php if(isset($_SESSION['CargaMasivaAmbiente'])){?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Carga masiva ambientes
                        <a href="#" title="Atencion" 
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="En este formulario puedes realizar una carga masiva de usuarios para el aplicativo">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <form action="../controllers/cAmbiente.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">                                         
                                <label for="enombre">
                                    <b>Nombres</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar los nombres del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="text" class="form-control" id="enombre" name="enombre" value="" required>
                            </div>
                        </div>
                    </form>                                       
                </div>
            </div>
        </div>
    </div>
</div>

<?php } elseif(isset($_SESSION['consultaAmbiente'])){ ?>
    <?php $editAmbiente = $_SESSION['consultaAmbiente']; ?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Editar ambiente <?=$editAmbiente[0]['ambiente']?>
                        <a href="#" title="Atencion" 
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="En este formulario puedes realizar una carga masiva de usuarios para el aplicativo">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <form action="../controllers/cAmbiente.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-12">                                         
                                <label for="enombre">
                                    <b>Nombre ambiente</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar los nombres del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="text" class="form-control" id="eAmbiente" name="eAmbiente" value="<?=$editAmbiente[0]['ambiente']?>" autocomplete="off" required >
                            </div>
                            <div class="form-group col-md-6">
                                <button class="btn btn-success btn-block">Editar</button>
                            </div>
                            <div class="form-group col-md-6">
                                <a class="btn btn-danger btn-block" href="../controllers/cAmbiente.php?cancelEdit=1">Cancelar</a>
                            </div>
                        </div>
                    </form>                                       
                </div>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Registrar ambientes
                        <a href="#" title="Atencion" 
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="En este formulario puedes realizar una carga masiva de usuarios para el aplicativo">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <form action="../controllers/cAmbiente.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-12">                                         
                                <label for="enombre">
                                    <b>Nombre ambiente</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar los nombres del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="text" class="form-control" id="ambiente" name="ambiente" value="" autocomplete="off" placeholder="Ingrese el nombre del ambiente" required >
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success btn-block">Registrar</button>
                            </div>
                        </div>
                    </form>                                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php 
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
?>

<div class="container-fluid">
    <?php if(isset($_SESSION['mensaje_ambiente'])): ?>
        <div class="form-group col-md-12">
            <div class="alert alert-<?=$_SESSION['tipo_alert_ambiente']?> alert-dismoissible fade show" role="alert">
                <?=$_SESSION['mensaje_ambiente']?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        </div>
            <?php
                unset($_SESSION['tipo_alert_ambiente']);
                unset($_SESSION['mensaje_ambiente']);
            ?>
    <?php endif ?>
</div>

<?php if (!$tAmbiente){ ?>
    <div class="container-fluid">
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Atención</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group  col-md-12 text-center">
                        <h2>No hay ambientes resgistrados</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }else {?>
<div class="container-fluid">
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ambientes registrados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Ambiente</th>
                                <th>Editar</th>
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
                            date_default_timezone_set("America/Bogota");
                            $fecha = date("Y-m-d"); 
                            foreach($tAmbiente As $a){?>
                                <tr id="tablasty">
                                    <td style="vertical-align: middle;"><?=$i?></td>
                                    <td style="vertical-align: middle;"><?=$a['ambiente']?></td>
                                    <td style="text-align:center;vertical-align: middle;">
                                        <a class="nav-link" id="iconos" href="../controllers/cAmbiente.php?eAmbiente=<?=$a['id']?>&nAmbiente=<?=$a['ambiente']?>" title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td style="text-align:center;vertical-align: middle;">   
                                        <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarModal" onclick="recibir_id(<?= $a['id'] ?>,'<?=$a['ambiente']?>');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>                               
                            <?php $i++;} ?>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>

<?php }?>




<script>
     function recibir_id(id,ambiente) {
        let modal = document.getElementById("eliminarModal");
        let enlaceEjemplo = modal.querySelector("#botonconfirmareliminarAmbiente");
        let href = '../controllers/cAmbiente.php?eliminarAmbiente=' + id;
        enlaceEjemplo.setAttribute('href', href);
        let texto= document.getElementById("textoEliminarAmbiente");
        texto.innerText="¿Esta seguro de eliminar el ambiente " + ambiente + " ?";
    }
</script>

<!-- eliminar modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Ambiente</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="textoEliminarAmbiente" class="modal-body" style="text-align: center;"></div>
                <div class="modal-footer">
                                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <a  id="botonconfirmareliminarAmbiente" class="btn btn-success btn-block" href="../controllers/cAmbiente.php">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<?php include('layout/footer.php')?>
<script src="../controllers/cRegion.js"></script>
<script src="../controllers/cCompetencia.js"></script>
