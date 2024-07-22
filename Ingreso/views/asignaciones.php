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
    if ($_SESSION['rol'] != 3) {
        session_destroy();
        echo "<script>alert('Error, usted no tiene permiso');location.href='../../index.php'</script>";
        exit();
    }

?>

<?php include('layout/header.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
include("../controllers/regprogramacion.php"); //Almacena, controla y muestra  ?>

    <!-- Page Wrapper -->
<div id="wrapper">
        <!-- Sidebar -->
        <?php include'layout/sidebar.php'  ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include ('layout/navitem.php')?>
 
 
<br>

<?php if(empty($_SESSION['asignacionesInstructor'])){?>

<div class="container-fluid"> 
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
        </div> 
        <div class="card-body">
            <div class="row">
                <div class="form-group  col-md-12 text-center">
                    <h2>Todavia no tienes asignaciones</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }else{?>

<div class="container-fluid">
    <div class="col-xl-12 col-lg-7">
        <div class="row">
            <div class="col-xl-2 col-lg-7 py-3">
                <a href="./calendarioIns.php" class="btn btn-info btn-block"><i class="bi bi-calendar-week" style="margin-right: 10px;"></i> Calendario</a>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Asignaciones programadas a <?= $_SESSION['nombres']?> <?= $_SESSION['apellidos']?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nivel</th>
                            <th>Nombre Titulacion</th>
                            <th>Tipo de Competencia</th>
                            <th>Competencia</th>
                            <th>Jornada</th>
                            <th>Zonas</th>
                            <th>Municipio</th>
                            <th>Fecha de inicio </th>
                            <th>Fecha de finalizacion</th>
                            <th>Fecha de asignación</th>
                            
                        </tr>
                    </thead> 
                        <style>
                            #tablasty:hover{
                                color: black;
                            }
                        </style>          
                    <tbody>
                        <?php
                        $i=1;
                        $asignacion = $_SESSION['asignacionesInstructor'];  
                            date_default_timezone_set("America/Bogota");
                            $fecha = date("Y-m-d h:i:s");     
                            foreach($asignacion As $asi){?>
                            <tr id="tablasty" style="background-color: <?php if($asi['fecha_fin'] < $fecha){
                                    echo '#C0C0C0';
                                }else{
                                    echo '';
                                }?>;">
                                <td><?=$i?></td>
                                <td><?=$asi['nom_nivel']?></td>
                                <td><?=$asi['denominacion_prog']?></td>
                                <td style="color:
                                    <?php 
                                    if($asi['fecha_fin'] < $fecha){
                                        echo '';
                                    }else{
                                        switch ($asi['tipocompetencia']) {
                                            case 1:
                                                echo '#8BC34A';
                                                break;
                                            case 2:
                                                echo '#2196F3';
                                                break;
                                            case 3:
                                                echo '#FF5722';
                                                break;
                                          }
                                    }            
                                    ?>
                                ">
                                    <?=$asi['tipo']?></td>
                                <td><?=$asi['nom_competencia']?></td>
                                <td><?=$asi['nombreJornada']?></td>
                                <td><?php if($asi['Nom_regiones'] == 'Otra'){
                                    echo 'Virtual';
                                }else{
                                    echo $asi['Nom_regiones'];
                                }?></td>
                                <td><?php if($asi['Nom_municipio'] == 'Otro'){
                                    echo 'Virtual';
                                }else{
                                    echo $asi['Nom_municipio'];
                                }
                                ?></td>
                                <td><?=$asi['fecha_inicio']?></td>
                                <td><?=$asi['fecha_fin']?></td>
                                <td><?=$asi['fechaAsignacion']?></td> 
                            </tr>
                            <?php $i++; } ?>
                    </tbody>
                </table>   
            </div>
        </div>
    </div>
    <div class="form-group col-md-12 d-flex justify-content-center">
    <a href="../controllers/exportsProgramaciones.php" class="btn btn-success btn-custom"><i class="bi bi-box-arrow-in-down"></i> Descargar Reporte Programaciones <?= $_SESSION['nombres']?> <?= $_SESSION['apellidos']?></a>
    </div>
</div>
</div>   
<?php }?>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Modal eliminar programacion-->
<div class="modal fade" id="eliminarModalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar programacion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="textoc" class="modal-body" style="text-align: center;"></div>
            <div class="modal-footer">
                
            </div>
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="form-group col-md-6">
                        <a  id="botonconfirmarc" class="btn btn-success btn-block" href="../controllers/exit.php">Cerrar Sessión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal eliminar programacion-->

<?php include'layout/footer.php'  ?>


<script src="../controllers/cRegion.js"></script>