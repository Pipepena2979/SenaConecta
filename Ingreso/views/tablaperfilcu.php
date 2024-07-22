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

    include("../controllers/cCursos.php");
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
    <div class="container-fluid">
        <div class="row">
            <?php if(isset($_SESSION['competenciasvacias'])): ?>
            <div class="col-xl-2 col-md-6 mb-4" style="cursor: pointer;" data-toggle="modal" data-target="#modalcompetencia">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Asignar competencias</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php   endif ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4"  style="cursor: pointer;" data-toggle="modal" data-target="#modalcrearcompetencia">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Crear nueva competencia</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sticky-note fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4"  style="cursor: pointer;" onclick="location.href='<?php echo (isset($_SESSION['comReg'])) ?  '../controllers/cCursos.php?volverCom=1' : '../controllers/cCursos.php?comReg=1' ?>'">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <?php if(isset($_SESSION['comReg'])){ ?>
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <a style="text-decoration: none;" class="text-success" href="../controllers/cCursos.php?volverCom=1">Volver</a>
                                    </div>               
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        <?php }else{?>
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <a style="text-decoration: none;"  href="../controllers/cCursos.php?comReg=1" class="text-success">Competencias registradas</a>
                                    </div>                       
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4" style="cursor: pointer;" data-toggle="modal" data-target="#modalcurso">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Crear un nuevo curso</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sticky-note fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4" style="cursor: pointer;" onclick="location.href='<?php echo (isset($_SESSION['curReg'])) ?  '../controllers/cCursos.php?volver=1' : '../controllers/cCursos.php?curReg=1' ?>'">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <?php if(isset($_SESSION['curReg'])){?>
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <a style="text-decoration: none;" class="text-success" href="../controllers/cCursos.php?volver=1">Volver</a>
                                    </div>               
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <a style="text-decoration: none;" class="text-success" href="../controllers/cCursos.php?curReg=1">Cursos registrados</a>
                                    </div>    
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        <?php } ?>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($_SESSION['mensajeCurso'])): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="alert alert-<?=$_SESSION['tipo_alert_Curso']?> alert-dismoissible fade show" role="alert">
                        <?=$_SESSION['mensajeCurso']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                </div>
                <?php
                    unset($_SESSION['tipo_alert_Curso']);
                    unset($_SESSION['mensajeCurso']);
                ?>
            </div>
        </div>
    <?php endif ?> 

    <?php if(isset($_SESSION['curReg'])){?> 



            <?php if(isset($_SESSION['editarCursos'])){?>
                <?php $curso = $_SESSION['editarCursos']; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar <?=$curso[0]['nom_nivel']?> <?=$curso[0]['denominacion_prog']?>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="Este formulario puedes editar el <?=$curso[0]['nom_nivel']?> <?=$curso[0]['denominacion_prog']?>">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../controllers/cCursos.php" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="eNombreCurso">
                                            <b>Nombre del curso</b>
                                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                                data-bs-content="En este campo puedes editar el nombre del curso registrado">
                                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                            </a>
                                        </label>
                                        <input type="text" class="form-control" id="eNombreCurso" name="eNombreCurso" value="<?=$curso[0]['denominacion_prog']?>" required>  
                                    </div>
                                    <div class="form-group col-md-4">  
                                        <label for="eNivelCurso">
                                            <b>Nivel academico</b>
                                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                                data-bs-content="En este campo puedes editar el nivel academico del curso registrado">
                                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                            </a>
                                        </label>
                                        <select name="eNivelCurso" id="eNivelCurso" class="form-control" required>
                                            <option value="" disabled selected>Selecciona una opcion</option>
                                                <?php foreach($nivelcurso as $n){?>
                                                    <option value="<?= $n ['id']?>" <?=$n['id']==$curso[0]['nivel']? 'selected':''; ?> required ><?=$n ['nom_nivel']; ?></option>
                                                <?php } ?>            
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label for="eVersionCurso">
                                            <b>Versión</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes editar la version del curso registrado">
                                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                        </label>
                                        <input type="number" min=1 class="form-control" id="eVersionCurso" value="<?=$curso[0]['version']?>" name="eVersionCurso" placeholder="Ingrese número telefonico" required>
                                    </div>
                                    <div class="form-group  col-md-12">
                                        <label for="eDescripcionCurso">
                                            <b>Descripcion del curso Max(499 caracteres):</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes ingresar la descripción del curso a crear">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                        </label>
                                        <textarea placeholder="Ingrese la descripción del curso" id="eDescripcionCurso" name="eDescripcionCurso" class="form-control" rows="4" cols="50" maxlength="499" required><?=$curso[0]['descripcion']?></textarea>   
                                    </div>
                                    <div class="form-group col-md-6">
                                        <a href="../controllers/cCursos.php?cancelCurso=1" class="btn btn-danger btn-block">Cancelar</a>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success btn-block">Editar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php }else{?>

                <?php if($cursos){?>

                    <div class="container-fluid">
                        <div class="card shadow mb-4"> 
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Datos de los cursos registrados</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-center" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Nivel academico</th>
                                                <th>Codigo</th>
                                                <th>Version</th>
                                                <th>Jornada</th>
                                                <th>Descripción</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach($cursos AS $c){?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$c['denominacion_prog']?></td>
                                                <td><?=$c['nom_nivel']?></td>
                                                <td><?=$c['codigo_prog']?></td>
                                                <td><?=$c['version']?></td>
                                                <td><?=$c['nombreJornada']?></td>
                                                <td><?=$c['descripcion']?></td>
                                                <td style="text-align:center;">
                                                    <a class="nav-link" id="iconos" href="../controllers/cCursos.php?editCursos=<?=$c['codigo_prog']?>" title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td style="text-align:center;">   
                                                    <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarCursoModal" onclick="eliminarCurso(<?= $c['codigo_prog'] ?>,'<?=$c['nom_nivel']?>','<?=$c['denominacion_prog']?>');">
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

                    <script>
                        function eliminarCurso(codigo_prog,nom_nivel,denominacion_prog) {
                            console.log(denominacion_prog);
                            let modal = document.getElementById("eliminarCursoModal");
                            let enlaceEjemplo = modal.querySelector("#botonConfirmarEliminarCurso");
                            let href = '../controllers/cCursos.php?eliminarCursos=' + codigo_prog;
                            enlaceEjemplo.setAttribute('href', href);
                            let texto= document.getElementById("textoEliminarCurso");
                            texto.innerText="¿Esta seguro de eliminar el " + nom_nivel + " " + denominacion_prog + " con codigo " + codigo_prog + "?";
                        }
                    </script>

                    <!-- Modal eliminar curso-->
                    <div class="modal fade" id="eliminarCursoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar curso</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div id="textoEliminarCurso" class="modal-body" style="text-align: center;"></div>
                                <div class="modal-footer">

                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <a  id="botonConfirmarEliminarCurso" class="btn btn-success btn-block" href="../controllers/cRegUsuarios.php">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal eliminar curso-->

                <?php }else{?>

                    <div class="container-fluid">
                        <div class="card shadow mb-4"> 
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label><b>No tienes ningun curso registrado, porfavor registrelos</b></label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <a class="btn btn-success btn-block" style="cursor: pointer;" data-toggle="modal" data-target="#modalcurso" >Registrar cursos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>


            <?php }?>

        <?php } elseif(isset($_SESSION['comReg'])){ ?>
            <?php  if($competencias){ ?>

                <?php if(isset($_SESSION['editarCompetencia'])){?>
                    
                <?php $curso = $_SESSION['editarCompetencia']; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar la competencia <?=$curso[0]['tipo']?> <?=$curso[0]['nom_competencia']?> con codigo <?=$curso[0]['cod_competencia']?>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="Este formulario puedes editar la competencia <?=$curso[0]['tipo']?> <?=$curso[0]['nom_competencia']?>">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../controllers/cCursos.php" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="eNombreCompetencia">
                                            <b>Nombre de la competencia</b>
                                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                                data-bs-content="En este campo puedes editar el nombre de la competencia registrada">
                                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                            </a>
                                        </label>
                                        <input type="text" class="form-control" id="eNombreCompetencia" name="eNombreCompetencia" value="<?=$curso[0]['nom_competencia']?>" required>  
                                    </div>
                                    <div class="form-group col-md-6">  
                                        <label for="eTipoCompetencia">
                                            <b>Tipo de competencia</b>
                                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                                data-bs-content="En este campo puedes editar el tipo de competencia registrada">
                                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                            </a>
                                        </label>
                                        <select name="eTipoCompetencia" id="eTipoCompetencia" class="form-control" required>
                                            <option value="" disabled selected>Selecciona una opcion</option>
                                                <?php foreach($tipocompetenciacursos as $p){?>
                                                    <option value="<?= $p ['id']?>" <?=$p['id']==$curso[0]['tipoCompetencia']? 'selected':''; ?> required ><?=$p ['tipo']; ?></option>
                                                <?php } ?> 
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="eHoras">
                                            <b>Horas</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes editar las horas de duración de la competencia registrada">
                                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                        </label>
                                        <input type="number" min=1 class="form-control" id="eHoras" value="<?=$curso[0]['horas']?>" name="eHoras" placeholder="Ingrese número telefonico" required>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="eResultadosAprendizaje">
                                            <b>Resultados de aprendizaje</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes editar los resultados de aprendizaje de la competencia registrada">
                                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                        </label>
                                        <input type="number" min=1 class="form-control" id="eResultadosAprendizaje" value="<?=$curso[0]['resultadosAprendizaje']?>" name="eResultadosAprendizaje" placeholder="Ingrese número telefonico" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <a href="../controllers/cCursos.php?cancelCompetencia=1" class="btn btn-danger btn-block">Cancelar</a>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success btn-block">Editar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php }else{?>

                    <div class="container-fluid">
                        <div class="card shadow mb-4"> 
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Datos de las competencias registradas</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-center" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Tipo de competencia</th>
                                                <th>Codigo</th>
                                                <th>Horas</th>
                                                <th>Resultados de aprendizaje</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach($competencias AS $c){?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$c['nom_competencia']?></td>
                                                <td style="color:
                                                <?php 
                                                    switch ($c['tipoCompetencia']) {
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
                                                ?>">
                                                    <?=$c['tipo']?>
                                                </td>
                                                <td><?=$c['cod_competencia']?></td>
                                                <td><?=$c['horas']?></td>
                                                <td><?=$c['resultadosAprendizaje']?></td>
                                                <td style="text-align:center;">
                                                    <a class="nav-link" id="iconos" href="../controllers/cCursos.php?editCompetencias=<?=$c['cod_competencia']?>" title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td style="text-align:center;">   
                                                    <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarCompetenciaModal" onclick="eliminarCompetencia(<?= $c['cod_competencia'] ?>,'<?=$c['tipo']?>','<?=$c['nom_competencia']?>');">
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

                <?php } ?>
                

                
            <?php }else{?>

                <div class="container-fluid">
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label><b>No tienes ninguna competencia registrada, porfavor registralas</b></label>
                                </div>
                                <div class="form-group col-md-12">
                                    <a class="btn btn-success btn-block" style="cursor: pointer;" data-toggle="modal" data-target="#modalcrearcompetencia" >Registrar competencias</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }?>

                <!-- Modal eliminar curso-->
                <div class="modal fade" id="eliminarCompetenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar competencia</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div id="textoEliminarCurso" class="modal-body" style="text-align: center;"></div>
                            <div class="modal-footer">

                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <a  id="botonConfirmarEliminarCurso" class="btn btn-success btn-block" href="../controllers/cRegUsuarios.php">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal eliminar curso-->
                <script>
                    function eliminarCompetencia(cod_competencia,tipo,nom_competencia){
                        let modal = document.getElementById("eliminarCompetenciaModal");
                        let enlaceEjemplo = modal.querySelector("#botonConfirmarEliminarCurso");
                        let href = '../controllers/cCursos.php?eliminarCompetencia=' + cod_competencia;
                        enlaceEjemplo.setAttribute('href', href);
                        let texto= document.getElementById("textoEliminarCurso");
                        texto.innerText="¿Esta seguro de eliminar la competencia " + tipo + " " + nom_competencia + " con codigo " + cod_competencia + "?";
                    }
                </script>
        <?php }elseif(isset($_SESSION['select'])){?>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Buscar competencias de <?=$_SESSION['cursocodigoseleccionado'][0]['nom_nivel']?> <?=$_SESSION['cursocodigoseleccionado'][0]['denominacion_prog']?>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este formulario puedes ver las competencias asignadas a un curso">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </h6>
                        </div>               
                        <div class="card-body">
                            <form action="../controllers/cCursos.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <?php if($programas){?>
                                        <div class="form-group col-md-12">  
                                            <label for="programas">
                                                <b>Seleccione un curso</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes seleccionar un curso para ver sus competencias">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                            </label>
                                            <select name="programas" id="programas" class="form-control" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <?php
                                                    foreach($programas as $p){?>
                                                        <option value="<?= $p ['codigo_prog']?>" <?=$p['codigo_prog']==$_SESSION['select']? 'selected':''; ?> required><?=$p ['denominacion_prog']; ?></option>
                                                <?php } ?>           
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button class="btn btn-success btn-block">Buscar</button>                           
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-group col-md-12">
                                            <label for="programas">
                                                <b>No hay cursos registrados, por favor registra uno</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes registrar un nuevo curso">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                            </label>                      
                                        </div>
                                        <div class="form-group col-md-12">
                                            <a class="btn btn-info btn-block" style="cursor: pointer;" data-toggle="modal" data-target="#modalcurso">Registrar curso</a>                           
                                        </div>
                                    <?php } ?>

                                    <?php if(isset($_SESSION['mensajeCurso'])): ?>
                                    <div class="form-group col-md-12">
                                        <div class="alert alert-<?=$_SESSION['tipo_alert_curso']?> alert-dismoissible fade show" role="alert">
                                            <?=$_SESSION['mensajeCurso']?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                    </div>
                                        <?php
                                            unset($_SESSION['tipo_alert_curso']);
                                            unset($_SESSION['mensajeCurso']);
                                        ?>
                                    <?php endif ?>
                                </div> <!--Cierre del row-->
                            </form>          
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <?php }else{?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Buscar competencias por curso
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                        data-bs-toggle="popover" data-bs-trigger="hover" 
                                        data-bs-content="En este formulario puedes ver las competencias asignadas a un curso">
                                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </h6>
                            </div>               
                            <div class="card-body">
                                <form action="../controllers/cCursos.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-12">  
                                            <label for="programas">
                                                <b>Seleccione un curso</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes seleccionar un curso para ver sus competencias">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                            </label>
                                            <select name="programas" id="programas" class="form-control" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <?php
                                                    foreach($programas as $p){?>
                                                        <option value="<?= $p ['codigo_prog']?>" ><?=$p ['denominacion_prog']; ?></option>
                                                <?php } ?>           
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button class="btn btn-success btn-block">Buscar</button>                           
                                        </div>
                                        <?php if(isset($_SESSION['mensajeCurso'])): ?>
                                        <div class="form-group col-md-12">
                                            <div class="alert alert-<?=$_SESSION['tipo_alert_curso']?> alert-dismoissible fade show" role="alert">
                                                <?=$_SESSION['mensajeCurso']?>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                        </div>
                                            <?php
                                                unset($_SESSION['tipo_alert_curso']);
                                                unset($_SESSION['mensajeCurso']);
                                            ?>
                                        <?php endif ?>
                                    </div> <!--Cierre del row-->
                                </form>          
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

<?php if(isset($_SESSION['competencias'])):
    $compes = $_SESSION['competencias'];?>
    

   <div class="container-fluid">

        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos de las competencia asigandas al curso <?=$compes[0]['nom_nivel']?> <?=$compes[0]['denominacion_prog']?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Codigo Competencia</th>
                                <th>Nombre competencia</th>
                                <th>Tipo Competencia</th> 
                                <th>Duracion Maxima (Hr)</th>
                                <th>Resultados de aprendizaje</th>
                                <th>Perfil requerido</th>
                                <th>Eliminar competencia</th>       
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                $i= 1;
                                foreach($compes AS $pef){?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?=$i;?></td>
                                        <td style="vertical-align: middle;"><?=$pef['codifoCompetencia']?></td>
                                        <td style="vertical-align: middle;"><?=$pef['nom_competencia']?></td>
                                        <td style="vertical-align: middle;color:
                                            <?php  
                                                switch ($pef['Tipocompetencia']) {
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
                                            ?>">
                                            <?=$pef['tipo']?>
                                        </td>
                                        <td style="vertical-align: middle;"><?=$pef['horas']?> horas</td>
                                        <td style="vertical-align: middle;"><?=$pef['resultadosAprendizaje']?></td>                                                                     
                                        <td style="text-align:center;vertical-align: middle;">
                                            <a  href="#" data-toggle="modal" data-target="#PerfilRequerido" onclick="perfilRequerido(`<?=$pef['perfilins']?>`);">
                                                <i class="fa fa-user"></i>
                                            </a>
                                        </td>
                                        <td style="text-align:center;">   
                                            <a class="nav-link" href="#" data-toggle="modal" data-target="#eliminarcompetenciaModal" onclick="eliminarCompet(<?= $pef['id']?>, '<?=$pef['nom_competencia']?>');">
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
  
<?php endif ?>
</div> 
<script> 
    function perfilRequerido(perfilins) {

        let textoAgregar = document.getElementById('textoPerfilRequerido');
        textoAgregar.innerText= perfilins;

    }
    function eliminarCompet(id,nom_competencia) {
        alert(id + nom_competencia);
        let modal = document.getElementById("eliminarcompetenciaModal");
        let enlaceEjemplo = modal.querySelector("#botonconfirmarEliminarCompetencia");
        let href = '../controllers/cCursos.php?eliminarcompe=' + id;
        enlaceEjemplo.setAttribute('href', href);
        let texto= document.getElementById("texto");
        texto.innerText="¿Esta seguro de eliminar la compentica " + nom_competencia + " de este curso?" ;
    }
</script>

<!-- perfil requerido modal -->
    
    <div class="modal fade" id="PerfilRequerido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perfil requerido</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="textoPerfilRequerido" class="modal-body">
                    ss
                </div>
                <div class="modal-footer">
                                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center><button class="btn btn-success" type="button" data-dismiss="modal">Cerrar</button></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- fin de perfil requerido modal -->

<!-- Modal eliminar usuario-->
    <div class="modal fade" id="eliminarcompetenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar competecia</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="texto" class="modal-body" style="text-align: center;"></div>
                <div class="modal-footer">
                                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <a  id="botonconfirmarEliminarCompetencia" class="btn btn-success btn-block" href="../controllers/cCursos.php">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Fin Modal eliminar usuario-->




<!-- Modal crear compentencias -->
<div class="modal fade" id="modalcrearcompetencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva competencia</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../controllers/cCursos.php">
                    <div class="form-group col-md-12">
                        <label for="tCompetencia">
                            <b>Tipo de competencia:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el tipo de competencia de la nueva competencia a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <select name="tCompetencia" id="tCompetencia" class="form-control" required>
                            <option value="" disabled selected>Seleccione una opcion</option>
                                <?php
                                    foreach($tipocompetenciacursos as $p){?>
                                        <option value="<?= $p ['id']?>" ><?=$p ['tipo']; ?></option>
                                <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="codigocompe">
                            <b>Codigo de la competencia:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar el codigo de la nueva competencia a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input id="codigocompe" name="codigocompe"  class="form-control" placeholder="Ingrese el codigo de la competencia" type="number" required/>
                    </div>
                    <div class="form-group col-md-12">  
                        <label>
                            <b>Nombre de la competencia:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar el nombre de la nueva competencia a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <textarea  id="nombrecompe" name="nombrecompe" class="form-control" rows="4" cols="50" maxlength="100" placeholder="Ingrese la descripción de la competencia" required></textarea>         
                    </div>
                    <div class="form-group col-md-12">
                            <label for="cHoras">
                                <b>Cantidad de horas:</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar cantidad de horas de duración de la nueva competencia a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                            </label>
                            <input id="cHoras" name="cHoras" max="900" min="1" class="form-control" type="number" placeholder="Ingrese la cantidad de horas" required/>
                    </div>
                    <div class="form-group col-md-12">
                            <label for="rAprendizaje">
                                <b>Resultados de aprendizajes:</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes ingresar los resultados de aprendizaje de la nueva competencia a crear">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input id="rAprendizaje" name="rAprendizaje" max="900" min="1" class="form-control" type="number" placeholder="Ingrese los resultados de aprendizajes" required/>
                    </div>
            </div>
            <div class="modal-footer">
                
            </div>

            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="form-group col-md-6">
                        <button class="btn btn-success btn-block" >Crear competencia</button>
                    </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal crear compentencias -->

<!-- Modal asignar competencia -->
<div class="modal fade" id="modalcompetencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar competencia para <b><?=$_SESSION['cursocodigoseleccionado'][0]['nom_nivel']?> <?=$_SESSION['cursocodigoseleccionado'][0]['denominacion_prog']?></b> con el codigo <?= $_SESSION['cursocodigoseleccionado'][0]['codigo_prog']?> </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../controllers/cCursos.php">
                    <div class="form-group col-md-12">
                        <label for="tipocompe">
                            <b>Seleccione tipo de competencia:</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar el tipo de competencia">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                        </label>
                        <select name="tipocompe" id="tipocompe" class="form-control" required>
                            <option value="" disabled selected>Seleccione una opcion</option>
                            <?php
                                foreach($tipocompetenciacursos as $t){?>
                                    <option value="<?= $t ['id']?>" ><?=$t ['tipo']; ?></option>
                            <?php } ?>           
                        </select>
                    </div>
                <div class="form-group col-md-12" id="displayCompetencia" style="display: none;">
                    <label for="nivel">
                        <b>Seleccione la competencia:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar la competencia">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                    </label>
                        <select name="compeasignada" id="compeasignada" class="form-control" required>
            
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                    <label for="nivel">
                        <b>Tipo de perfil requerido:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el perfil requerido">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                    </label>
                        <select name="tipoperfilasignada" id="tipoperfilasignada" class="form-control" required>
                            <option value="" disabled selected>Seleccione una opcion</option>
                            <?php
                                foreach($perfilesinstrutores as $p){?>
                                    <option value="<?= $p ['id']?>" ><?=$p ['perfil']; ?></option>
                            <?php } ?>           
                        </select>
                    </div>  
            </div>
            <div class="modal-footer">
            </div>
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="form-group col-md-6">
                        <button class="btn btn-success btn-block">Asignar competencia</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal asignar competencia -->

<!-- Modal crear curso -->
<div class="modal fade" id="modalcurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo curso</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form  action="../controllers/cCursos.php" method="POST">
                    <div class="row">
                    <div class="form-group col-md-6">  
                        <label>
                            <b>Codigo del curso:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar el codigo del curso a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input id="codigo" name="codigo"  class="form-control" type="number" min="1" placeholder="Ingresa el codigo del curso" required/>                       
                    </div>
                    <div class="form-group col-md-6">  
                        <label>
                            <b>Version del curso:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar la version del curso a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input id="version" name="version"  min="1" class="form-control" type="number" placeholder="Ingrese la versión del curso" required/>         
                    </div>
                    <div class="form-group col-md-6">  
                        <label>
                            <b>Nombre del curso:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar el nombre del curso a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input id="nombre" name="nombre"  class="form-control" type="text" placeholder="Ingrese el nombre del curso" required/>         
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nivel">
                            <b>Seleccione el nivel academico del curso:</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico del curso a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <select name="nivel" id="nivel" class="form-control" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                                <?php
                                    foreach($nivelcurso as $n){?>
                                        <option value="<?= $n ['id']?>" ><?=$n ['nom_nivel']; ?></option>
                                <?php } ?>           
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="jornada">
                            <b>Jornada</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar la jornda del curso a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <select name="jornada" id="jornada" class="form-control" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                                <?php
                                    foreach($jornada as $n){?>
                                        <option value="<?= $n ['id']?>" ><?=$n ['Nombre']; ?></option>
                                <?php } ?>           
                        </select>
                    </div>
                    <div class="form-group col-md-12" id="displayRegionq"  style="display: none;">
                        <label for="departamento">
                            <b>Region</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este campo debes seleccionar el departamento de residencia del usuario a registrar">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="zona" name="zona" class="form-control">
                                <option value="">Selecciona una opcion</option>
                                    <?php
                                        foreach($region as $d){?>
                                            <option value="<?= $d ['id']?>" required><?=$d ['Nom_regiones']?></option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="col-xl-12 form-group" id="displayRegion" style="display: none;">
                        <label for="Ciudad">
                            <b>Ciudad o municipio de residencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este campo debes seleccionar la ciudad o municipio de residencia del usuario a registrar">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <select id="Ciudad" name="Ciudad" class="form-control">
                                        
                        </select>
                    </div>

                    <div class="form-group col-md-12">  
                        <label>
                            <b>Descripcion del curso Max(499 caracteres):</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes ingresar la descripción del curso a crear">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <textarea placeholder="Ingrese la descripción del curso" name="descripcion" class="form-control" rows="4" cols="50" maxlength="499" required></textarea>                          
                    </div>   
                    </div>  
            </div>

            <div class="modal-footer">   
            </div>

            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="form-group col-md-6">
                        <button class="btn btn-success btn-block">Crear curso</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal crear curso -->

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
   
<?php include('layout/footer.php')?>
<script src="../controllers/cRegion.js"></script>
<script src="../controllers/cCompetencia.js"></script>
