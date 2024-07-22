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

<?php include('layout/header.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
include("../controllers/regprogramacion.php"); //Almacena, controla y muestra  
include_once("../controllers/lib_fecha_texto.php"); ?>

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
<?php

            
if(isset($_SESSION['asignar'])){
    $asig = $_SESSION['asignar'];

?>


<div class="container-fluid">
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Realizar nueva programación
                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                    data-bs-toggle="popover" data-bs-trigger="hover" 
                    data-bs-content="En este formulario puedes asignar una nueva programación a un instructor">
                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <form action="../controllers/regprogramacion.php" method="POST"> 
                <div class="row">
                    <div class="form-group  col-md-12">
                        <label for="nDoc">
                            <b>Instructores</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar un instructor para asignarle una progrmación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="nDoc" name="nDoc" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($nombresIns as $no){?>
                                        <option value="<?=$no['num_doc']?>" <?=$no['num_doc']==$asig? 'selected':''; ?> required><?=$no ['nombres']?> <?=$no ['apellidos']?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="nivel">
                            <b>Nivel</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="nivel" name="nivel" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opcion</option>
                                <?php
                                        foreach($nivel as $n){?>
                                        <option value="<?= $n ['id']?>" required><?=$n ['nom_nivel']?></option>
                                <?php } ?>            
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="rubro">
                            <b>Rubro</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="rubro" name="rubro" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($rubro as $r){?>
                                        <option value="<?= $r ['id']?>" required><?=$r ['nombreRubro']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group  col-md-12" id="displayTitulacion" style="display: none;">
                        <label for="mTitulacion">
                            <b>Nombre de la titulacion</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nombre de la titulación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="mTitulacion" name="mTitulacion" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($titulacion as $ti){?>
                                        <option value="<?= $ti ['codigo_prog']?>" required><?=$ti ['denominacion_prog']?></option>
                                <?php } ?>          
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="tCompetencia">
                            <b>Tipo Competencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el tipo de competencia">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipocompe" name="tCompetencia" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($tipocompetencia as $tp){?>
                                        <option value="<?= $tp ['id']?>" required><?=$tp ['tipo']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group  col-md-12" id="displayCompetencia" style="display: none;">
                        <label for="competencia">
                            <b>Competencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar la competencia">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="compeasignada" name="competencia" class="form-control" required>
                                
                            </select>
                    </div>
                     <div class="form-group  col-md-12">
                        <label for="tAmbiente">
                            <b>Ambiente de Aprendizaje</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el ambiente de aprendizaje">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipoAmbiente" name="tAmbiente" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($ambiente as $am){?>
                                        <option value="<?= $am ['id']?>" required><?=$am ['ambiente']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group col-md-12" style="margin-bottom:5px;">
                        <label for="fechainicio">
                            <b>Fecha a ser realizada la asignación</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar las fechas a realizar la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                            <button type="button" class="btn btn-success" id="agregar" onclick="resultPa()" style="margin-left: 10px;">+</button>
                            <button type="button" class="btn btn-danger" id="eliminar" onclick="eliminarUDivPa()" style="margin-left: 10px;">-</button>
                        </label>
                        
                    </div>
                    <div id="fechasPa" class="form-group col-md-12">
  
                        <input type="date" value= '' class="form-control" name="fechainicio[]" id="fechainicio" placeholder="Fecha de asignación" style="margin-bottom: 5px;" required> 
                
                    </div>
                    <div class="form-group col-md-6">
                      <label for="horaInicio">
                        <b>Hora de inicio</b>
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este campo puedes seleccionar la hora de inicio de la programación">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </label>
                      <input type="time" class="form-control" id="horaInicio" value="" name="horaInicio"required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="horaFin">
                        <b>Hora de fin</b>
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este campo puedes seleccionar la hora de fin de la programación">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </label>
                      <input type="time" class="form-control" id="horaFin" value="" name="horaFin"required>
                    </div>
                
                    <div class="form-group col-md-6">
                        <a href="../controllers/regprogramacion.php?cancelEdit=1" class="btn btn-danger btn-block">Cancelar</a>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success btn-block">Programar</button>
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <a href="../controllers/cReportes.php" class="btn btn-danger btn-block">Reportes</a>
                    </div> -->
                    <?php if(isset($_SESSION['mensajeProgramacion'])): ?>
                        <div class="form-group col-md-12">
                            <div class="alert alert-<?=$_SESSION['tipo_alert_programacion']?> alert-dismoissible fade show" role="alert">
                                <?=$_SESSION['mensajeProgramacion']?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <?php
                            unset($_SESSION['tipo_alert_programacion']);
                            unset($_SESSION['mensajeProgramacion']);
                        ?>
                    <?php endif ?>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
  #eliminar{
      display: none;
  }
</style>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
<script>



  function resultPa(){
    // alert('hola');
    let divPrincipal = document.createElement("div");
    divPrincipal.className = "input-group mb-1";

    let input = document.createElement("input");
    input.type = "date";
    input.className = "form-control";
    input.name = "fechainicio[]";
    input.required = true;

    let divAppend = document.createElement("div");
    divAppend.className = "input-group-append";

    let span = document.createElement("span");
    span.className = "input-group-text";
    let icono = document.createElement("i");
    icono.className = "bi bi-trash";

    icono.onclick = function() {

      eliminarDiv(divPrincipal);
    };

    span.appendChild(icono);
    divAppend.appendChild(span);
    divPrincipal.appendChild(input);
    divPrincipal.appendChild(divAppend);

    document.getElementById("fechasPa").appendChild(divPrincipal);

    let eliminar = document.getElementById("eliminar");
    eliminar.style.display="inline";

    document.getElementById("iconoBorrar").style.display="inline";
  }

  function eliminarDiv(div) {
    
    let resultados = document.getElementById("fechasPa");
    //alert(resultados.childNodes.length);
    resultados.removeChild(div);
          
    // alert(resultados.childNodes.length)
    if(resultados.childNodes.length == 3){
        let eliminar =document.getElementById("eliminar");
        eliminar.style.display="none";
    }
   
      
  }
  function eliminarUDivPa() {
      let resultados = document.getElementById("fechasPa");
      let divs = resultados.getElementsByClassName("input-group");
      // alert(divs.length);
      if (divs.length > 0) {
          resultados.removeChild(divs[divs.length - 1]);
          if (divs.length == 0){
              let eliminar =document.getElementById("eliminar");
              eliminar.style.display="none";   
          }   
      }   
  }

</script>

<?php  }elseif(isset($_SESSION['editarprogramacion'])){ ?>
<?php $easig = $_SESSION['editarprogramacion']; ?>
<?php 
    $fecha = $easig[0]['fecha_inicio'];
    $date = date_create($fecha);
    $fecha_actual = date_format($date, 'Y-m-d');

    $hora_i = $easig[0]['fecha_inicio'];
    $date_hora_i = date_create($hora_i);
    $hora_inicio = date_format($date_hora_i, 'H:i:s');

    $hora_f = $easig[0]['fecha_fin'];
    $date_hora_f = date_create($hora_f);
    $hora_fin = date_format($date_hora_f, 'H:i:s');
?>

<div class="container-fluid"> 
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Editar datos de la programación
                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                    data-bs-toggle="popover" data-bs-trigger="hover" 
                    data-bs-content="En este formulario puedes editar la información de la programación asignada">
                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                </a>
            </h6>
        </div>    
        <div class="card-body">
            <form action="../controllers/regprogramacion.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group  col-md-12">
                        <label for="eNdoc">
                            <b>Instructor a cargo</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar el instructor a cargo de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="eNdoc" name="eNdoc" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                        foreach($nombresIns as $no){?>
                                        <option value="<?=$no['num_doc']?>" <?=$no['num_doc']==$easig[0]['nDocInstructor']? 'selected':''; ?> required><?=$no ['nombres']?> <?=$no ['apellidos']?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="eNivel">
                            <b>Nivel</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar el nivel academico de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="nivel" name="eNivel" class="form-control" required>
                                <option value=""  disabled selected >Selecciona una opción</option>
                                <?php
                                        foreach($nivel as $n){?>
                                        <option value="<?=$n['id']?>" <?=$n['id']==$easig[0]['nivel']? 'selected':''; ?> required><?=$n ['nom_nivel']?></option>
                                <?php } ?>            
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="rubro">
                            <b>Rubro</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="rubro" name="rubro" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($rubro as $r){?>
                                        <option value="<?= $r ['id']?>" <?=$r['id']==$easig[0]['rubro']? 'selected': ''; ?> required><?=$r ['nombreRubro']?></option>
                                <?php } ?>            
                            </select>
                    </div>
                    <div class="form-group  col-md-12" id="displayTitulacion">
                        <label for="eNomtitulacion">
                            <b>Nombre de la titulacion</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="mTitulacion" name="eNomtitulacion" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                        foreach($titulacion as $ti){?>
                                        <option value="<?= $ti ['codigo_prog']?>" <?=$ti['codigo_prog']==$easig[0]['nom_titulacion']? 'selected':''; ?> required><?=$ti ['denominacion_prog']?></option>
                                <?php } ?>          
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="etcompetencia">
                            <b>Tipo Competencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar el tipo de competencia de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipocompe" name="etcompetencia" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                        foreach($tipocompetencia as $tp){?>
                                        <option value="<?= $tp ['id']?>" <?=$tp['id']==$easig[0]['tipocompetencia']? 'selected':''; ?> required><?=$tp ['tipo']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="ecompetencia">
                            <b>Competencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar la competencia de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="compeasignada" name="ecompetencia" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                    <?php
                                            foreach($_SESSION['editarCompetencias'] as $co){?>
                                            <option value="<?= $co ['cod_competencia']?>" <?=$co['cod_competencia']==$easig[0]['competencia']? 'selected':''; ?> required><?=$co ['nom_competencia']?></option>
                                    <?php } ?>
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="tAmbiente">
                            <b>Ambiente de Aprendizaje</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el ambiente de aprendizaje">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipoAmbiente" name="eambiente" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($ambiente as $am){?>
                                        <option value="<?= $am ['id']?>" <?=$am['id']==$easig[0]['id_ambiente']? 'selected':''; ?> required><?=$am ['ambiente']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group col-md-4">                                         
                        <label for="efechaRealizar">
                            <b>Fecha a ser realizada la asignación</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar la fecha a ser realizada la asignación de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input type="date" class="form-control" id="efechaRealizar" value="<?=$fecha_actual?>" name="efechaRealizar" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="eHoraInicio">
                            <b>Hora de inicio</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar la hora de inicio de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input type="time" class="form-control" id="eHoraInicio" value="<?=$hora_inicio?>" name="eHoraInicio" required>
                    </div> 
                    <div class="form-group col-md-4">
                        <label for="eHoraFin">
                            <b>Hora de fin</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes editar la hora de fin de la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                        <input type="time" class="form-control" id="eHoraFin" value="<?=$hora_fin?>" name="eHoraFin" required>
                    </div> 
                    <div class="form-group col-md-6">
                        <a href="../controllers/regprogramacion.php?cancelx=1" class="btn btn-danger btn-block">Cancelar</a>
                    </div>
                    <div class="form-group col-md-6">
                        <button class="btn btn-success btn-block">Editar</button>
                    </div>   
                    <?php if(isset($_SESSION['mensajeProgramacion'])): ?>
                        <div class="form-group col-md-12">
                            <div class="alert alert-<?=$_SESSION['tipo_alert_programacion']?> alert-dismoissible fade show" role="alert">
                                <?=$_SESSION['mensajeProgramacion']?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <?php
                            unset($_SESSION['tipo_alert_programacion']);
                            unset($_SESSION['mensajeProgramacion']);
                        ?>
                    <?php endif ?>                             
                    
                </div>
            </form>
            
        </div>
    </div>
</div>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<?php  }else{ ?>

<?php if(empty($nombresIns)){?>

<div class="container-fluid"> 
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
        </div> 
        <div class="card-body">
            <div class="row">
                <div class="form-group  col-md-12 text-center">
                    <h2>Para asignar programaciones, primero debe registrar instructores</h2>
                </div>
                <div class="form-group  col-md-12 text-center">
                    <a href="./registrar.php" class="btn btn-success btn-block">Registrar instructores</a>
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

<?php }elseif(isset($_SESSION['equivocado'])){?>

    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Datos de las Competencias 
                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="En este formulario puedes asignar una nueva programación a un instructor">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                    </a>
                </h6>
            </div>
            <div class="card-body">  
                <form action="../controllers/regprogramacion.php" method="POST"> 
                    <div class="row">
                        <?php if($_SESSION['rol'] == 1 OR $_SESSION['rol'] == 4){?>

                        <div class="form-group  col-md-12">
                            <label for="nDoc">
                                <b>
                                    Instructor a cargo
                                </b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar un instructor para asignarle una programación">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="nDoc" name="nDoc" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <?php
                                            foreach($nombresIns as $no){?>
                                            <option value="<?=$no['num_doc']?>" <?=$no['num_doc']==$_SESSION['equivocadonDoc']? 'selected':''; ?> required><?=$no['nombres']?> <?=$no ['apellidos']?></option>
                                    <?php } ?>
                                </select>
                        </div>

                        <?php }else{ ?>

                        <div class="form-group  col-md-12">
                            <label for="nDoc">
                                <b>
                                    Instructor a cargo
                                </b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar un instructor para asignarle una programación">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="nDoc" name="nDoc" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <?php
                                            foreach($nombresIns2 as $no){?>
                                            <option value="<?=$no['num_doc']?>" <?=$no['num_doc']==$_SESSION['equivocadonDoc']? 'selected':''; ?> required><?=$no['nombres']?> <?=$no ['apellidos']?></option>
                                    <?php } ?>
                                </select>
                        </div>

                        <?php } ?>

                        
                        <div class="form-group  col-md-12">
                            <label for="nivel">
                                <b>Nivel</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar el nivel academico">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <select id="nivel" name="nivel" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opcion</option>
                                <?php
                                        foreach($nivel as $n){?>
                                        <option value="<?= $n ['id']?>" <?=$n['id']==$_SESSION['equivocadoNivel']? 'selected':''; ?> required><?=$n ['nom_nivel']?></option>
                                <?php } ?>            
                            </select>
                        </div>
                         <div class="form-group  col-md-12">
                        <label for="rubro">
                            <b>Rubro</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="rubro" name="rubro" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($rubro as $r){?>
                                        <option value="<?= $r ['id']?>" <?=$r['id']==$easig[0]['rubro']? 'selected': ''; ?> required><?=$r ['nombreRubro']?></option>
                                <?php } ?>            
                            </select>
                    </div>
                        <div class="form-group  col-md-12" >
                            <label for="mTitulacion">
                                <b>Nombre de la titulacion</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar el nombre de la titulación">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <select id="mTitulacion" name="mTitulacion" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($titulacion as $ti){?>
                                        <option value="<?= $ti ['codigo_prog']?>" <?=$ti['codigo_prog']==$_SESSION['equivocadoTitulacion']? 'selected':''; ?> required>Codigo <?= $ti ['codigo_prog']?> - <?=$ti ['denominacion_prog']?> - Jornada <?=$ti ['nombreJornada']?></option>
                                <?php } ?>          
                            </select>
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="tCompetencia">
                                <b>Tipo Competencia</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar el tipo de competencia">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="tipocompe" name="tCompetencia" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <?php
                                            foreach($tipocompetencia as $tp){?>
                                            <option value="<?=$tp['id']?>" <?=$tp['id']==$_SESSION['equivocadoTipoCompetencia']? 'selected':''; ?> required><?=$tp['tipo']?></option>
                                    <?php } ?>           
                                </select>
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="competencia">
                                <b>Competencia</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar la competencia">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <select id="compeasignada" name="competencia" class="form-control" required>
                                <?php foreach($_SESSION['equivocadoCompetenciaAjaxx'] AS $m){?>
                                    <option value="<?=$m['cod_competencia']?>" <?=$m['cod_competencia']==$_SESSION['equivocadoCompetencia']? 'selected':''; ?> required><?=$m['nom_competencia']?></option>
                                <?php } ?>   
                            </select>
                        </div>
                        <div class="form-group  col-md-12">
                        <label for="tAmbiente">
                            <b>Ambiente de Aprendizaje</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el ambiente de aprendizaje">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipoAmbiente" name="tAmbiente" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($ambiente as $am){?>
                                        <option value="<?= $am ['id']?>" required><?=$am ['ambiente']?></option>
                                <?php } ?>           
                            </select>
                        </div>  
                        <div class="form-group col-md-12" style="margin-bottom:5px;">
                            <label for="fechainicio">
                                <b>Fecha a ser realizada la asignación</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar las fechas a realizar la programación">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                                <button type="button" class="btn btn-success" id="agregar" onclick="resultPaNe()" style="margin-left: 10px;">+</button>
                                <button type="button" class="btn btn-danger" id="eliminar" onclick="eliminarUDivPaNe()" style="margin-left: 10px;">-</button>
                            </label>
                            
                        </div>
                        <div id="fechasPaNe" class="form-group col-md-12">

                            <input type="date" value= '' class="form-control" name="fechainicio[]" id="fechainicio" placeholder="Fecha de asignación" style="margin-bottom: 5px;" required> 
                
                        </div>
                        <div class="form-group col-md-6">
                            <label for="horaInicio">
                                <b>Hora de inicio</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar la hora de inicio de la programación">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                        <input type="time" class="form-control" id="horaInicio" value="<?=$_SESSION['equivocadoHoraInicio']?>" name="horaInicio"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="horaFin">
                                <b>Hora de fin</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes seleccionar la hora de fin de la programación">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                        </label>
                            <input type="time" class="form-control" id="horaFin" value="<?=$_SESSION['equivocadoHoraFin']?>" name="horaFin"required>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success btn-block">Programar</button>
                        </div>
                        <?php if(isset($_SESSION['mensajeProgramacion'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alert_programacion']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensajeProgramacion']?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <?php
                                unset($_SESSION['tipo_alert_programacion']);
                                unset($_SESSION['mensajeProgramacion']);
                            ?>
                        <?php endif ?>  
                    </div>
                </form>
            </div>
        </div>
    </div> 

    <script>



function resultPaNe(){
  // alert('hola');
  let divPrincipal = document.createElement("div");
  divPrincipal.className = "input-group mb-1";

  let input = document.createElement("input");
  input.type = "date";
  input.className = "form-control";
  input.name = "fechainicio[]";
  input.required = true;

  let divAppend = document.createElement("div");
  divAppend.className = "input-group-append";

  let span = document.createElement("span");
  span.className = "input-group-text";
  let icono = document.createElement("i");
  icono.className = "bi bi-trash";

  icono.onclick = function() {

    eliminarDivNe(divPrincipal);
  };

  span.appendChild(icono);
  divAppend.appendChild(span);
  divPrincipal.appendChild(input);
  divPrincipal.appendChild(divAppend);

  document.getElementById("fechasPaNe").appendChild(divPrincipal);

  let eliminar = document.getElementById("eliminar");
  eliminar.style.display="inline";

  document.getElementById("iconoBorrar").style.display="inline";
}

function eliminarDivNe(div) {

    let resultados = document.getElementById("fechasPaNe");
  //alert(resultados.childNodes.length);
    resultados.removeChild(div);
        
  // alert(resultados.childNodes.length)
    if(resultados.childNodes.length == 3){
        let eliminar =document.getElementById("eliminar");
        eliminar.style.display="none";
    }
}
function eliminarUDivPaNe() {
    let resultados = document.getElementById("fechasPaNe");
    let divs = resultados.getElementsByClassName("input-group");
    // alert(divs.length);
    if (divs.length > 0) {
        resultados.removeChild(divs[divs.length - 1]);
        if (divs.length == 0){
            let eliminar =document.getElementById("eliminar");
            eliminar.style.display="none";   
        }   
    }   
}

</script>

<?php }else{ ?>

<?php if($nombresIns2 == "" && $_SESSION['rol'] ==2 ){?>

    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="form-group  col-md-12 text-center">
                        <h2>No tienes usuarios a tu nombre para poder realizarles programaciones</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }else{?>

<div class="container-fluid"> 
    <div class="card shadow mb-4">  
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Realizar nueva programación 
                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                    data-bs-toggle="popover" data-bs-trigger="hover" 
                    data-bs-content="En este formulario puedes asignar una nueva programación a un instructor">
                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                </a>
            </h6>
        </div>    
        <div class="card-body">  
            <form action="../controllers/regprogramacion.php" method="POST"> 
                <div class="row">
                    <?php if($_SESSION['rol'] == 1 OR $_SESSION['rol'] == 4){ ?>

                    <div class="form-group  col-md-12">
                        <label for="nDoc">
                            <b>
                                Instructor a cargo
                            </b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar un instructor para asignarle una progrmación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="nDoc" name="nDoc" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                        foreach($nombresIns as $no){?>
                                        <option value="<?=$no['num_doc']?>" required><?=$no['nombres']?> <?=$no ['apellidos']?></option>
                                <?php } ?>
                            </select>
                    </div>

                    <?php }else{ ?>

                    <div class="form-group  col-md-12">
                        <label for="nDoc">
                            <b>
                                Instructor a cargo
                            </b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar un instructor para asignarle una progrmación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="nDoc" name="nDoc" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <?php
                                        foreach($nombresIns2 as $no){?>
                                        <option value="<?=$no['num_doc']?>" required><?=$no['nombres']?> <?=$no ['apellidos']?></option>
                                <?php } ?>
                            </select>
                    </div>

                    <?php } ?>
                    
                    <div class="form-group  col-md-12">
                        <label for="nivel">
                            <b>Nivel</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="nivel" name="nivel" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($nivel as $n){?>
                                        <option value="<?= $n ['id']?>" required><?=$n ['nom_nivel']?></option>
                                <?php } ?>            
                            </select>
                    </div>
                     <div class="form-group  col-md-12">
                        <label for="rubro">
                            <b>Rubro</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nivel academico">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="rubro" name="rubro" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($rubro as $r){?>
                                        <option value="<?= $r ['id']?>" required><?=$r ['nombreRubro']?></option>
                                <?php } ?>            
                            </select>
                    </div>
                    <div class="form-group  col-md-12" id="displayTitulacion" style="display: none;">
                        <label for="mTitulacion">
                            <b>Titulacion</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el nombre de la titulación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="mTitulacion" name="mTitulacion" class="form-control" required>
                                        
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="tCompetencia">
                            <b>Tipo Competencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el tipo de competencia">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipocompe" name="tCompetencia" class="form-control" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php
                                        foreach($tipocompetencia as $tp){?>
                                        <option value="<?=$tp['id']?>" required><?=$tp['tipo']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group  col-md-12" id="displayCompetencia" style="display: none;">
                        <label for="competencia">
                            <b>Competencia</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar la competencia">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="compeasignada" name="competencia" class="form-control" required>
                                
                            </select>
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="tAmbiente">
                            <b>Ambiente de Aprendizaje</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar el ambiente de aprendizaje">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </label>
                            <select id="tipoAmbiente" name="tAmbiente" class="form-control" required>
                                <option value="">Selecciona una opcion</option>
                                <?php
                                        foreach($ambiente as $am){?>
                                        <option value="<?= $am ['id']?>" required><?=$am ['ambiente']?></option>
                                <?php } ?>           
                            </select>
                    </div>
                    <div class="form-group col-md-12" style="margin-bottom:5px;">
                        <label for="fechainicio">
                            <b>Fecha a ser realizada la asignación</b>
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo puedes seleccionar las fechas a realizar la programación">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                            <button type="button" class="btn btn-success" id="agregar" onclick="resultPaN()" style="margin-left: 10px;">+</button>
                            <button type="button" class="btn btn-danger" id="eliminar" onclick="eliminarUDivPaN()" style="margin-left: 10px;">-</button>
                        </label>
                        
                    </div>
                    <div id="fechasPaN" class="form-group col-md-12">
                        <input type="date" value= '' class="form-control" name="fechainicio[]" id="fechainicio" placeholder="Fecha de asignación" style="margin-bottom: 5px;" required> 
                
                    </div>
                    <div class="form-group col-md-6">
                    <label for="horaInicio">
                        <b>Hora de inicio</b>
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este campo puedes seleccionar la hora de inicio de la programación">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </label>
                        <input type="time" class="form-control" id="horaInicio" value="" name="horaInicio"required>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="horaFin">
                        <b>Hora de fin</b>
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este campo puedes seleccionar la hora de fin de la programación">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </label>
                        <input type="time" class="form-control" id="horaFin" value="" name="horaFin"required>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success btn-block">Programar</button>
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <a href="../controllers/cReporte.php" class="btn btn-danger btn-block">Reportes</a>
                    </div> -->
                    <?php if(isset($_SESSION['mensajeProgramacion'])): ?>
                        <div class="form-group col-md-12">
                            <div class="alert alert-<?=$_SESSION['tipo_alert_programacion']?> alert-dismoissible fade show" role="alert">
                                <?=$_SESSION['mensajeProgramacion']?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <?php
                            unset($_SESSION['tipo_alert_programacion']);
                            unset($_SESSION['mensajeProgramacion']);
                        ?>
                    <?php endif ?>
                </div>              
            </form>  
        </div>
    </div>
</div> 
<style>
  #eliminar{
      display: none;
  }
</style>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
<script>



  function resultPaN(){
    // alert('hola');
    let divPrincipal = document.createElement("div");
    divPrincipal.className = "input-group mb-1";

    let input = document.createElement("input");
    input.type = "date";
    input.className = "form-control";
    input.name = "fechainicio[]";
    input.required = true;

    let divAppend = document.createElement("div");
    divAppend.className = "input-group-append";

    let span = document.createElement("span");
    span.className = "input-group-text";
    let icono = document.createElement("i");
    icono.className = "bi bi-trash";

    icono.onclick = function() {

      eliminarDivN(divPrincipal);
    };

    span.appendChild(icono);
    divAppend.appendChild(span);
    divPrincipal.appendChild(input);
    divPrincipal.appendChild(divAppend);

    document.getElementById("fechasPaN").appendChild(divPrincipal);

    let eliminar = document.getElementById("eliminar");
    eliminar.style.display="inline";

    document.getElementById("iconoBorrar").style.display="inline";
  }

  function eliminarDivN(div) {
    
    let resultados = document.getElementById("fechasPaN");
    //alert(resultados.childNodes.length);
    resultados.removeChild(div);
          
    // alert(resultados.childNodes.length)
    if(resultados.childNodes.length == 3){
        let eliminar =document.getElementById("eliminar");
        eliminar.style.display="none";
    }
   
      
  }
  function eliminarUDivPaN() {
      let resultados = document.getElementById("fechasPaN");
      let divs = resultados.getElementsByClassName("input-group");
      // alert(divs.length);
      if (divs.length > 0) {
          resultados.removeChild(divs[divs.length - 1]);
          if (divs.length == 0){
              let eliminar =document.getElementById("eliminar");
              eliminar.style.display="none";   
          }   
      }   
  }

</script>

<?php } ?>

<?php } ?>

<?php } ?>


<?php if($nombresIns2 == "" && ($_SESSION['rol'] == 2)){?>

<?php }else{?>

    <?php if($_SESSION['rol'] ==1 OR $_SESSION['rol'] == 4){?>
        
    <?php if($asignacion == ""){?>

        <div class="container-fluid"> 
            <div class="card shadow mb-4">  
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
                </div> 
                <div class="card-body">
                    <div class="row">
                        <div class="form-group  col-md-12 text-center">
                            <h2>Todavia no hay programaciones realizadas</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php }else{?>

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Programaciones realizadas
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En esta tabla puedes visualizar las programaciónes programadas, editarlas o eliminarlas">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Nivel</th>
                                    <th>Rubro</th>
                                    <th>Nombre Titulacion</th>
                                    <th>Tipo de Competencia</th>
                                    <th>Competencia</th>
                                    <th>Ambiente de aprendizaje</th>
                                    <th>Jornada</th>
                                    <th>Hora de inicio</th>
                                    <th>Hora de fin</th>
                                    <th>Fecha de asignación</th>
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
                                $i=1;
                                    date_default_timezone_set("America/Bogota");
                                    $fecha = date("Y-m-d H:i:s"); 
                                    foreach($asignacion As $asi){?>
                                    <tr id="tablasty" style="background-color:
                                        <?php 
                                            if($fecha > $asi['fecha_fin']){
                                                echo 'rgba(0, 0, 0, 0.2)';
                                            }else{
                                                echo '';
                                            }   
                                        ?>
                                    ;">
                                        <td style="vertical-align: middle;"><?=$i?></td>
                                        <td style="vertical-align: middle;"><?=$asi['nom']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['apellidos']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['nom_nivel']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['nombreRubro']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['denominacion_prog']?></td>
                                        <td style="vertical-align: middle;color:
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
                                            ?>"><?=$asi['tipo']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['nom_competencia']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['ambiente']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['nombreJornada']?></td>
                                        <td style="vertical-align: middle;color:
                                            <?php
                                                if($fecha > $asi['fecha_fin']){
                                                    echo 'red';
                                                }else{
                                                    echo '';
                                                } 
                                            ?>
                                        "><?=$asi['fecha_inicio']?></td>
                                        <td style="vertical-align: middle;color:
                                            <?php
                                                if($fecha > $asi['fecha_fin']){
                                                    echo 'red';
                                                }else{
                                                    echo '';
                                                } 
                                            ?>
                                        "><?=$asi['fecha_fin']?></td>
                                        <td style="vertical-align: middle;"><?=$asi['fechaAsignacion']?></td>
                                        <td style="text-align:center;vertical-align: middle;">
                                        <a class="nav-link" id="iconos" href="../controllers/regprogramacion.php?editprog=<?=$asi['id']?>" title="Editar">
                                                <i class="fa fa-edit icono-black"></i>
                                            </a>
                                        </td>
                                            
                                        <td style="text-align:center;vertical-align: middle;">   
                                            <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarModalc" onclick="recibir_id( <?= $asi['id'] ?>,'<?=$asi['nom']?>','<?=$asi['apellidos']?>','<?=$asi['nombreJornada']?>');">
                                                <i class="fa fa-trash icono-black"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; } ?>
                                            
                            </tbody>
                        </table>   
                        <script>
                            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                            return new bootstrap.Popover(popoverTriggerEl)
                            })
                        </script>
                        <script>
                            function recibir_id(id,nom,apellidos,Nombre) {
                            let modal = document.getElementById("eliminarModalc");
                                let enlaceEjemplo = modal.querySelector("#botonconfirmarc");
                                let href = '../controllers/regprogramacion.php?eliminar_id=' + id;
                                enlaceEjemplo.setAttribute('href', href);
                                let texto= document.getElementById("textoc");
                                texto.innerText="¿Esta seguro de eliminar la programacion de " + nom + " " + apellidos + " de jornada " + Nombre +"?";
                            }
                        </script>
                        <script>
                            // Funcion para limitar la cantidad de numeros a escribir
                            function maxlengthNumber(obj){
                                if(obj.value.length > obj.maxLength){
                                    obj.value = obj.value.slice(0, obj.maxLength);
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex justify-content-center">
            <a href="../controllers/exportsProgramacionesTotales.php" class="btn btn-success btn-custom"><i class="bi bi-box-arrow-in-down"></i> Descargar Reporte Programaciones Totales <strong>SenaConecta</strong></a>
        </div>
    <?php } ?>
    <?php }else{?>

        <?php if($asignacion2 == ""){?>

            <div class="container-fluid"> 
                <div class="card shadow mb-4">  
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Mensaje
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="Este mensaje es informativo">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </h6>
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group  col-md-12 text-center">
                                <h2><a style="font-weight: bold;"><?=$_SESSION['nombres']?></a>, todavia no tienes programaciones realizadas</h2>
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
        <?php }else{?>

            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Programaciones realizadas
                            <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En esta tabla puedes visualizar las programaciónes programadas, editarlas o eliminarlas">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                            </a>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Nivel</th>
                                        <th>Rubro</th>
                                        <th>Nombre Titulacion</th>
                                        <th>Tipo de Competencia</th>
                                        <th>Competencia</th>
                                        <th>Ambiente de aprendizaje</th>
                                        <th>Jornada</th>
                                        <th>Hora de inicio</th>
                                        <th>Hora de fin</th>
                                        <th>Fecha de asignación</th>
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
                                    $i=1;
                                        date_default_timezone_set("America/Bogota");
                                        $fecha = date("Y-m-d H:i:s"); 
                                        foreach($asignacion2 As $asi){?>
                                        <tr id="tablasty" style="background-color:
                                            <?php 
                                                if($fecha > $asi['fecha_fin']){
                                                    echo 'rgba(0, 0, 0, 0.2)';
                                                }else{
                                                    echo '';
                                                }   
                                            ?>
                                        ;">
                                            <td style="vertical-align: middle;"><?=$i?></td>
                                            <td style="vertical-align: middle;"><?=$asi['nom']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['apellidos']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['nom_nivel']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['nombreRubro']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['denominacion_prog']?></td>
                                            <td style="vertical-align: middle;color:
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
                                                ?>"><?=$asi['tipo']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['nom_competencia']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['ambiente']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['nombreJornada']?></td>
                                            <td style="vertical-align: middle;color:
                                                <?php
                                                    if($fecha > $asi['fecha_fin']){
                                                        echo 'red';
                                                    }else{
                                                        echo '';
                                                    } 
                                                ?>
                                            "><?=$asi['fecha_inicio']?></td>
                                            <td style="vertical-align: middle;color:
                                                <?php
                                                    if($fecha > $asi['fecha_fin']){
                                                        echo 'red';
                                                    }else{
                                                        echo '';
                                                    } 
                                                ?>
                                            "><?=$asi['fecha_fin']?></td>
                                            <td style="vertical-align: middle;"><?=$asi['fechaAsignacion']?></td>
                                            <td style="text-align:center;vertical-align: middle;">
                                            <a class="nav-link" id="iconos" href="../controllers/regprogramacion.php?editprog=<?=$asi['id']?>" title="Editar">
                                                    <i class="fa fa-edit icono-black"></i>
                                                </a>
                                            </td>
                                                
                                            <td style="text-align:center;vertical-align: middle;">   
                                                <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarModalc" onclick="recibir_id( <?= $asi['id'] ?>,'<?=$asi['nom']?>','<?=$asi['apellidos']?>','<?=$asi['nombreJornada']?>');">
                                                    <i class="fa fa-trash icono-black"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                                
                                </tbody>
                            </table>   
                            <script>
                                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                                  return new bootstrap.Popover(popoverTriggerEl)
                                })
                            </script>
                            <script>
                                function recibir_id(id,nom,apellidos,Nombre) {
                                let modal = document.getElementById("eliminarModalc");
                                    let enlaceEjemplo = modal.querySelector("#botonconfirmarc");
                                    let href = '../controllers/regprogramacion.php?eliminar_id=' + id;
                                    enlaceEjemplo.setAttribute('href', href);
                                    let texto= document.getElementById("textoc");
                                    texto.innerText="¿Esta seguro de eliminar la programacion de " + nom + " " + apellidos + " de jornada " + Nombre +"?";
                                }
                            </script>
                            <script>
                                // Funcion para limitar la cantidad de numeros a escribir
                                function maxlengthNumber(obj){
                                    if(obj.value.length > obj.maxLength){
                                        obj.value = obj.value.slice(0, obj.maxLength);
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>

        
<?php }?>

<?php }?>
</div>
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
                        <a  id="botonconfirmarc" class="btn btn-success btn-block" href="../controllers/exit.php">Confirmar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal eliminar programacion-->

<?php include'layout/footer.php'  ?>
<script src="../controllers/cTitulacion.js"></script>
<script src="../controllers/cCompetencia.js"></script>
<script src="../controllers/cRegion.js"></script>