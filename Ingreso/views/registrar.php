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
    if ( $_SESSION['rol'] == 3) {
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
include("../controllers/cRegUsuarios.php");
include('layout/header.php');
include_once("../controllers/lib_fecha_texto.php"); 

?>


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

<br>

<?php if(isset($_SESSION['cargaMasiva'])){?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Carga masiva de usuarios 
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este formulario puedes realizar una carga masiva de usuarios para el aplicativo">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </h6>
                </div>               
                <div class="card-body">
                    <form action="../controllers/cCargaMasiva.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-12">                                         
                                <label for="cargaMasiva">
                                    <b>Carga masiva</b>
                                    <b>Ciudad o municipio de residencia</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                        data-bs-toggle="popover" data-bs-trigger="hover" 
                                        data-bs-content="En este campo debes seleccionar el archivo de carga masiva">
                                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="file" class="form-control" id="cargaMasiva" name="cargaMasiva" value="" accept=".xlsx"  required>  
                                <input type=hidden value="upload" name='action'>                                      
                            </div>
                            <div class="form-group col-md-6">
                                <a href="../controllers/cCargaMasiva.php?cancelx=1" class="btn btn-danger btn-block">Cancelar</a>
                            </div>
                            <div class="form-group col-md-6">
                                <button class="btn btn-success btn-block">Cargar</button>
                            </div>
                            <div class="form-group col-md-12">
                            <!-- href="../controllers/cCargaMasiva.php?plantilla=1" -->
                                <a onclick="carga()" class="btn btn-info btn-block">Descargar plantilla</a>
                            </div>
                            <?php if(isset($_SESSION['mensajeCarga'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alert_carga']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensajeCarga']?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                                <?php
                                    unset($_SESSION['tipo_alert_carga']);
                                    unset($_SESSION['mensajeCarga']);
                                ?>
                            <?php endif ?>
                        </div> <!--Cierre del row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function carga() {
            // alert('hola');
            swal({
              title: "¿Desea hacer una carga masiva?",
              text: "Para realizar una carga masiva, porfavor leer la hoja 1 donde se encuentran las indicaciones para el correcto uso.\n En la hoja 2 iran los datos de los usuarios a registrar.",
              icon: "info",
              buttons: true,
              dangerMode: false,
              buttons: ["Cancelar", "Descargar plantilla"],
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("La plantilla de carga masiva se descargo correctamente", {
                  icon: "success",
                  button:{
                    text: 'Aceptar',
                  },
                });
                location.href="../controllers/cCargaMasiva.php?plantilla=1";
              } 
            })
        }

    </script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

<?php }elseif(isset($_SESSION['usuarios'])){?>

<?php $user = $_SESSION['usuarios']; ?>
<?php $municipios = $_SESSION['editarMunicipio']; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Editar información del usuario <?=$user[0]['nombres']?> <?=$user[0]['apellidos']?>
                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                            data-bs-toggle="popover" data-bs-trigger="hover" 
                            data-bs-content="En este formulario puedes editar la información del usuario <?=$user[0]['nombres']?> <?=$user[0]['apellidos']?>">
                                <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>
                    </h6>
                </div>               
                <div class="card-body">
                    <form action="../controllers/cRegUsuarios.php" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="enombre" name="enombre" value="<?=$user[0]['nombres']?>" required>                                        
                            </div>

                            <div class="form-group col-md-6">                                         
                                <label for="eapellidos">
                                    <b>Apellidos</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar los apellidos del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="text" class="form-control" id="eapellidos" name="eapellidos" value="<?=$user[0]['apellidos']?>" required>                                        
                            </div>
                            <div class="form-group col-md-4">  
                                <label for="etDoc">
                                    <b>Tipo de documento</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar el tipo de documento del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <select name="etDoc" id="etDoc" class="form-control" required>
                                    <option value="" selected disabled>Selecciona una opcion</option>
                                    <?php
                                        foreach($tDocs as $td){?>
                                            <option value="<?= $td ['id']?>" <?=$td['id']==$user[0]['T_doc']? 'selected':''; ?> required><?=$td ['Nombre']; ?></option>
                                    <?php } ?>           
                                </select>
                            </div>
        
                            <div class="form-group col-md-4">                                         
                                <label for="enDoc">
                                    <b>Numero de documento</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes visualizar el numero de documento del usuario, No se puede editar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="number" min="0" class="form-control" value="<?=$user[0]['num_doc']?>" readonly required>
                                
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="eGenero">
                                    <b>Género</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar el género del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                    <select id="eGenero" name="eGenero" class="form-control" >
                                        <option value="" selected disabled>Selecciona una opcion</option>
                                        <?php
                                            foreach($genero AS $r){?>
                                                <option value="<?=$r['id']?>" <?=$r['id']==$user[0]['genero']? 'selected':''; ?> required><?=$r['nombreGenero']?></option>
                                        <?php } ?>
                                    </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="efechaNacimiento">
                                    <b>Fecha de nacimiento</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar la fecha de nacimiento del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="date" class="form-control" id="efechaNacimiento" value="<?=$user[0]['fechaNacimiento']?>" name="efechaNacimiento" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="eCorreo">
                                    <b>Correo electrónico</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar el correo electrónico del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="email" min="0" class="form-control" id="eCorreo" value="<?=$user[0]['Correo']?>" name="eCorreo" placeholder="Ingrese su correo electronico" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="eTelefono">
                                    <b>Número de telefono</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar el número de telefono del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="number" min=0 maxlength="10" oninput="maxlengthNumber(this);" class="form-control" id="eTelefono" value="<?=$user[0]['Telefono']?>" name="eTelefono" placeholder="Ingrese número telefonico" required>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="eRol">
                                    <b>Rol</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar el rol del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                    <select id="eRol" name="eRol" class="form-control" >
                                        <option value="" selected disabled>Selecciona una opcion</option>
                                        <?php
                                            foreach($roles AS $r){?>
                                                <option value="<?=$r['id']?>" <?=$r['id']==$user[0]['rol']? 'selected':''; ?> required><?=$r['Nombre']?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="efechaFinContrato">
                                    <b>Fecha de finalización de contrato</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar la Fecha de finalización de contrato del usuario registrado">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <input type="date" class="form-control" id="efechaFinContrato" value="<?=$user[0]['fechaFinContrato']?>" name="efechaFinContrato" required>
                            </div>

                            <div class="form-group  col-md-12" id="displaySupervisor" style="display: 
                                <?php if($user[0]['rol'] != 1 && $user[0]['rol'] != 4){
                                        echo "block";
                                    }else{
                                        echo "none";
                                    } ?>;">
                                    <label for="rol">
                                        <b>Supervisor de contrato</b>
                                        <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                        data-bs-toggle="popover" data-bs-trigger="hover" 
                                        data-bs-content="En este campo debes seleccionar el usuario supervisor de contrato del usuario a registrar">
                                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                        </a>
                                    </label>
                                        <select id="supervisor" name="supervisor" class="form-control" >
                                            <option value="" disabled selected>Selecciona una opcion</option>
                                            <?php if(isset($_SESSION['usuariosSupervisores'] )){?>

                                                <?php 
                                                $h = 0;
                                                date_default_timezone_set("America/Bogota");
                                                $fecha = date("Y-m-d");
                                                foreach($_SESSION['usuariosSupervisores'] AS $i){
                                                    if($i['fechaFinContrato'] >= $fecha){
                                                        $h=1;
                                                    }
                                                }
                                                if($h > 0){ ?>
                                                    <?php foreach($_SESSION['usuariosSupervisores'] AS $i){?>
                                                        <?php if($i['fechaFinContrato'] >= $fecha){?>
                                                            <option value="<?=$i['num_doc']?>" <?=$i['num_doc']==$user[0]['supervisor']? 'selected':''; ?> required><?=$i['nombres']?> <?=$i['apellidos']?></option>
                                                        <?php }?>
                                                    <?php }?>
                                                <?php }else{ ?>
                                                    <option value="" disabled selected>No hay usuarios disponibles para ser supervisores de contrato</option>
                                                <?php } ?>
                                            <?php }?>
                                        </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="perfil">
                                    <b>Perfil Profesional</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                        data-bs-toggle="popover" data-bs-trigger="hover" 
                                        data-bs-content="En este campo debes ingresar el perfil profesional del usuario a registrar">
                                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label><button type="button" class="btn btn-success" id="agregar" onclick="resultados()" style="margin-left: 10px;">+</button>
                                <button type="button" class="btn btn-danger" id="eliminar" onclick="eliminarUltimoDiv()">-</button>
                            </div>
                            <div  id="resultados" class="form-group col-md-12">
                                <?php foreach($_SESSION['editarPerfilUsuario'] AS $i){?>

                                <div class="input-group mb-1" id="miDiv">
                                    <input type="text" class="form-control" name = "perfiles[]" placeholder="Agregar perfil profesional" value="<?=$i['Titulo']?>" autocomplete="off" required>
                                    <div class="input-group-append" id="iconoBorrar">
                                        <span class="input-group-text">
                                        <i class="bi bi-trash" id="eliminarDiv" onclick="eliminarDiv(this.parentNode.parentNode.parentNode)"></i> <!-- Reemplaza "fa-search" con el icono que desees -->
                                        </span>
                                    </div>
                                </div>

                                <?php }?>
                            
                            </div> 
                            <div class="form-group  col-md-12">
                                <label for="departamento">
                                    <b>Departamento de residencia</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar el departamento de residencia del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                    <select id="departamento" name="departamento" class="form-control" required>
                                        <option value="" selected disabled>Selecciona una opcion</option>
                                            <?php
                                                foreach($departamentos as $d){?>
                                                    <option value="<?= $d ['iddpar']?>"  <?=$d['iddpar']==$user[0]['departamento']? 'selected':''; ?> required><?=$d ['nomdepar']?></option>
                                            <?php } ?> 
                                    </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Ciudad">
                                    <b>Ciudad o municipio de residencia</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar la ciudad o municipio de residencia del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <select id="Ciudad" name="Ciudad" class="form-control" required>
                                    <?php
                                        foreach($municipios as $d){?>
                                            <option value="<?= $d ['id']?>" <?=$d['id']==$user[0]['municipio']? 'selected':''; ?> required><?=$d ['Nom_municipio']?></option>
                                    <?php } ?>         
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <a href="../controllers/cRegUsuarios.php?cancelx=1" class="btn btn-danger btn-block">Cancelar</a>
                            </div>
                            <div class="form-group col-md-6">
                                <button class="btn btn-success btn-block">Editar</button>
                            </div>
                            <?php if(isset($_SESSION['mensajeEditar'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alert_editar']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensajeEditar']?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                                <?php
                                    unset($_SESSION['tipo_alert_editar']);
                                    unset($_SESSION['mensajeEditar']);
                                ?>
                            <?php endif ?>
                        </div> <!--Cierre del row-->
                    </form>
                    <script>
                        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                          return new bootstrap.Popover(popoverTriggerEl)
                        })
                    </script>
                    <script>
                        let img = document.getElementById('fotoperfil');
                        let input = document.getElementById('foto');
                        input.onchange = (e) => {
                            if(input.files[0])
                                img.src = URL.createObjectURL(input.files[0]);
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
</div>

<?php }elseif(isset($_SESSION['errorRegistrar'])){ ?>
    <div class="container-fluid">
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar usuarios 
                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="Este formulario es para el registro de nuevos usuarios">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <form action="../controllers/cRegUsuarios.php" method="POST">
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <label for="nombres">
                                <b>Nombres</b> 
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar los nombres del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="nombres" 
                                value="<?=$_SESSION['errorRegistrarNombres']?>" 
                                name="nombres" 
                                placeholder="Ingrese sus nombres" 
                                autocomplete="off"
                                required
                            >
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="apellidos">
                                <b>Apellidos</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar los apellidos del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="apellidos" 
                                value="<?=$_SESSION['errorRegistrarApellidos']?>" 
                                name="apellidos" 
                                placeholder="Ingrese sus apellidos" 
                                autocomplete="off"
                                required>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="tDoc">
                                <b>Tipo de documento</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el tipo de documento del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="tDoc" name="tDoc" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opcion</option>
                                    <?php
                                        foreach($tDocs as $td){?>
                                            <option value="<?= $td ['id']?>" <?=$td['id']==$_SESSION['errorRegistrartDoc']? 'selected':''; ?> required><?=$td ['Nombre']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="nDoc">
                                <b>Número de documento</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar el número de documento del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="number" min=0 maxlength="10" oninput="maxlengthNumber(this);" class="form-control" id="nDoc" value="<?=$_SESSION['errorRegistrarnDoc']?>" name="nDoc" placeholder="Ingrese su número de documento" required>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="genero">
                                <b>Género</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar el tipo de género del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="genero" name="genero" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opcion</option>
                                    <?php
                                        foreach($genero as $td){?>
                                            <option value="<?= $td ['id']?>" <?=$td['id']==$_SESSION['errorRegistrarGenero']? 'selected':''; ?> required><?=$td ['nombreGenero']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fechaNacimiento">
                                <b>Fecha de nacimiento</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar la fecha de nacimiento del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="date" class="form-control" id="fechaNacimiento" value="<?=$_SESSION['errorRegistrarFechaNacimiento']?>" name="fechaNacimiento" required>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="correo">
                                <b>Correo electrónico</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes ingresar el correo electrónico del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="email" min="0" class="form-control" id="correo" value="<?=$_SESSION['errorRegistrarCorreo']?>" name="correo" autocomplete="off" placeholder="Ingrese su correo electronico" required>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="nTelefono">
                                <b>Número de telefono</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar el número de telefono del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="number" min=0 maxlength="10" oninput="maxlengthNumber(this);" class="form-control" id="nTelefono" value="<?=$_SESSION['errorRegistrarNumero']?>" name="nTelefono" placeholder="Ingrese número telefonico" required>
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="rol">
                                <b>Rol</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el rol del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="rol" name="rol" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opcion</option>
                                    <?php
                                        foreach($roles AS $r){?>
                                            <option value="<?=$r['id']?>" <?=$r['id']==$_SESSION['errorRegistrarRol']? 'selected':''; ?> required><?=$r['Nombre']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fechaContrato">
                                <b>Fecha de finalización de contrato</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar la fecha de finalización del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="date" class="form-control" id="fechaContrato" value="<?=$_SESSION['errorRegistrarFechaContrato']?>" name="fechaContrato" required>
                        </div>
                        <div class="form-group  col-md-12" id="displaySupervisor" style="display: 
                        <?php if($_SESSION['errorRegistrarRol'] != 1 && $_SESSION['errorRegistrarRol'] != 4){
                            echo "block";
                        }else{
                            echo "none";
                        } ?>;">
                            <label for="rol">
                                <b>Supervisor de contrato</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el usuario supervisor de contrato del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="supervisor" name="supervisor" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opcion</option>
                                    <?php
                                        foreach($_SESSION['errorRegistrarSupervisorAjax'] AS $r){?>
                                            <option value="<?=$r['num_doc']?>" <?=$r['num_doc']==$_SESSION['errorRegistrarSupervisor']? 'selected':''; ?> required><?=$r['nombres']?> <?=$r['apellidos']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="perfil">
                                <b>Perfil Profesional</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar el perfil profesional del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label><button type="button" class="btn btn-success" id="agregar" onclick="resultados()" style="margin-left: 10px;">+</button>
                            <button type="button" class="btn btn-danger" id="eliminar" onclick="eliminarUltimoDiv()">-</button>
                        </div>
                        <div  id="resultados" class="form-group col-md-12">
                            <?php foreach($_SESSION['errorRegistrarPerfiles'] AS $i){?>

                                <div class="input-group mb-1" id="miDiv">
                                    <input type="text" class="form-control" name = "perfiles[]" placeholder="Agregar perfil profesional" value="<?=$i?>" autocomplete="off" required>
                                    <div class="input-group-append" id="iconoBorrar">
                                        <span class="input-group-text">
                                        <i class="bi bi-trash" id="eliminarDiv" onclick="eliminarDiv(this.parentNode.parentNode.parentNode)"></i> <!-- Reemplaza "fa-search" con el icono que desees -->
                                        </span>
                                    </div>
                                </div>

                            <?php }?>
                            
                        </div> 
                        <div class="form-group  col-md-6">
                            <label for="departamento">
                                <b>Departamento de residencia</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el departamento de residencia del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="departamento" name="departamento" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                        <?php
                                            foreach($departamentos as $d){?>
                                                <option value="<?= $d ['iddpar']?>" <?=$d['iddpar']==$_SESSION['errorRegistrarDepartamento']? 'selected':''; ?> required><?=$d ['nomdepar']?></option>
                                        <?php } ?> 
                            </select>
                        </div>
                        <div class="col-xl-6 form-group">
                            <label for="Ciudad">
                                <b>Ciudad o municipio de residencia</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar la ciudad o municipio de residencia del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <select id="Ciudad" name="Ciudad" class="form-control" required>
                                <?php foreach($_SESSION['errorRegistrarMunicipioA'] AS $m){?>
                                    <option value="<?=$m['id']?>" <?=$m['id']==$_SESSION['errorRegistrarMunicipio']? 'selected':''; ?> required><?=$m['Nom_municipio']?></option>
                                <?php } ?>       
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-success btn-block">Registrar</button>
                        </div>  
                        <div class="form-group col-md-12">
                            <a class="btn btn-info btn-block" href="../controllers/cCargaMasiva.php?carga=1">Carga masiva</a>
                        </div>
                        <?php if(isset($_SESSION['mensaje'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alert']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensaje']?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                            <?php
                                unset($_SESSION['tipo_alert']);
                                unset($_SESSION['mensaje']);
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
    <script>
    // Funcion para limitar la cantidad de numeros a escribir
        function maxlengthNumber(obj){
            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }
    </script>

<?php }else{?>
    <div class="container-fluid">
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar usuarios 
                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="Este formulario es para el registro de nuevos usuarios">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <form action="../controllers/cRegUsuarios.php" method="POST">
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <label for="nombres">
                                <b>Nombres</b> 
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar los nombres del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="nombres" 
                                value="" 
                                name="nombres" 
                                placeholder="Ingrese sus nombres" 
                                autocomplete="off"
                                required
                            >
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="apellidos">
                                <b>Apellidos</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar los apellidos del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="apellidos" 
                                value="" 
                                name="apellidos" 
                                placeholder="Ingrese sus apellidos" 
                                autocomplete="off"
                                required>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="tDoc">
                                <b>Tipo de documento</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar el tipo de documento del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="tDoc" name="tDoc" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <?php
                                        foreach($tDocs as $td){?>
                                            <option value="<?= $td ['id']?>" required><?=$td ['Nombre']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="nDoc">
                                <b>Número de documento</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar el número de documento del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="number" 
                                min=0 
                                maxlength="10" 
                                oninput="maxlengthNumber(this);" 
                                class="form-control" 
                                id="nDoc" 
                                value="" 
                                name="nDoc" 
                                placeholder="Ingrese su número de documento" 
                                autocomplete="off"
                                required
                            >
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="genero">
                                <b>Género</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar el tipo de género del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="genero" name="genero" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <?php
                                        foreach($genero as $td){?>
                                            <option value="<?= $td ['id']?>" required><?=$td ['nombreGenero']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fechaNacimiento">
                                <b>Fecha de nacimiento</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes seleccionar la fecha de nacimiento del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="date" 
                                class="form-control" 
                                id="fechaNacimiento" 
                                value="" 
                                name="fechaNacimiento" 
                                required
                            >
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="correo">
                                <b>Correo electrónico</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes ingresar el correo electrónico del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input 
                                type="email" 
                                min="0" 
                                class="form-control" 
                                id="correo" 
                                value="" 
                                name="correo" 
                                placeholder="Ingrese su correo electrónico" 
                                autocomplete="off" 
                                required
                            >
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="nTelefono">
                                <b>Número de telefono</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo debes ingresar el número de telefono del usuario a registrar">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="number" min=0 maxlength="10" oninput="maxlengthNumber(this);" class="form-control" id="nTelefono" value="" name="nTelefono" placeholder="Ingrese número telefonico" required>
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="rol">
                                <b>Rol</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el rol del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="rol" name="rol" class="form-control" >
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <?php
                                        foreach($roles AS $r){?>
                                            <option value="<?=$r['id']?>" required><?=$r['Nombre']?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fechaContrato">
                                <b>Fecha de finalización de contrato</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar la fecha de finalización del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <input type="date" class="form-control" id="fechaContrato" name="fechaContrato" required>
                        </div>
                        <div class="form-group  col-md-12" id="displaySupervisor" style="display: none;">
                            <label for="rol">
                                <b>Supervisor de contrato</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el usuario supervisor de contrato del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="supervisor" name="supervisor" class="form-control" >
                                    
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="perfil">
                                <b>Perfil Profesional</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes ingresar el perfil profesional del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label> <button type="button" class="btn btn-success" id="agregar" onclick="resultados()" style="margin-left: 10px;">+</button>
                            <button type="button" class="btn btn-danger" id="eliminar" onclick="eliminarUltimoDiv()" style="margin-left: 10px;">-</button>
                            
                        </div>
                        <div id="resultados" class="form-group col-md-12">
                            <div class="input-group mb-1" id="miDiv">
                                <input type="text" class="form-control" name = "perfiles[]" placeholder="Agregar perfil profesional" autocomplete="off" required>
                                <div class="input-group-append" id='iconoBorrar'>
                                    <span class="input-group-text">
                                    <i class="bi bi-trash" id="eliminarDiv" onclick="eliminarDiv(document.querySelector('#miDiv'))"></i> <!-- Reemplaza "fa-search" con el icono que desees -->
                                    </span>
                                </div>
                            </div>
                        </div> 

                        <style>
                                #eliminar{
                                    display: none;
                                }
                                #iconoBorrar{
                                    display: none;
                                }
                        </style>

                        <div class="form-group  col-md-12">
                            <label for="departamento">
                                <b>Departamento de residencia</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar el departamento de residencia del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                                <select id="departamento" name="departamento" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                        <?php
                                            foreach($departamentos as $d){?>
                                                <option value="<?= $d ['iddpar']?>" required><?=$d ['nomdepar']?></option>
                                        <?php } ?> 
                            </select>
                        </div>
                        <div class="form-group col-md-12" id="displayDepartamento" style="display: none;">
                            <label for="Ciudad">
                                <b>Ciudad o municipio de residencia</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                data-bs-toggle="popover" data-bs-trigger="hover" 
                                data-bs-content="En este campo debes seleccionar la ciudad o municipio de residencia del usuario a registrar">
                                    <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                </a>
                            </label>
                            <select id="Ciudad" name="Ciudad" class="form-control" required>
                                            
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-success btn-block">Registrar</button>
                        </div>  
                        <div class="form-group col-md-12">
                            <a class="btn btn-info btn-block" href="../controllers/cCargaMasiva.php?carga=1">Carga masiva</a>
                        </div>
                        <?php if(isset($_SESSION['mensaje'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alert']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensaje']?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                            <?php
                                unset($_SESSION['tipo_alert']);
                                unset($_SESSION['mensaje']);
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
    <script>
        // Funcion para limitar la cantidad de numeros a escribir
        function maxlengthNumber(obj){
            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }
    </script>

<?php } ?>

<br>
   <div class="container-fluid">
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Usuarios registrados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de documento</th>
                                <th>Numero de documento</th>
                                <th>Genero</th>
                                <th>Rol</th>
                                <th>Numero de telefono</th>
                                <th>Correo electrónico</th>
                                <th>Fecha de nacimiento</th>
                                <th>Departamento de residencia</th>
                                <th>Ciudad de residencia</th>
                                <th>Finalizacion de contrato</th>
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
                            foreach($usuarios As $u){?>
                                <tr id="tablasty" style="background-color: 
                                    <?php if($u['fechaFinContrato'] < $fecha){
                                        echo '#C0C0C0';
                                    }else{
                                        echo '';
                                    }
                                    ?> ;">
                                    <td style="vertical-align: middle;"><?=$i?></td>
                                    <td style="vertical-align: middle;"><?=$u['nombres']?></td>
                                    <td style="vertical-align: middle;"><?=$u['apellidos']?></td>
                                    <td style="vertical-align: middle;"><?=$u['nombretd']?></td>
                                    <td style="vertical-align: middle;"><?=$u['num_doc']?></td>
                                    <td style="vertical-align: middle;"><?=$u['nombreGenero']?></td>
                                    <td style="vertical-align: middle;"><?=$u['nombrerol']?></td>
                                    <td style="vertical-align: middle;"><?=$u['Telefono']?></td>
                                    <td style="vertical-align: middle;"><?=$u['Correo']?></td>
                                    <td style="vertical-align: middle;"><?=fechaATexto2($u['fechaNacimiento'])?></td>
                                    <td style="vertical-align: middle;"><?=$u['nomdepar']?></td>
                                    <td style="vertical-align: middle;"><?=$u['Nom_municipio']?></td>
                                    <td style="vertical-align: middle;color:
                                        <?php 
                                            if($u['fechaFinContrato'] < $fecha){
                                                echo 'red';
                                            }else{
                                                echo '';
                                            }
                                        ?>"><?=fechaATexto2($u['fechaFinContrato'])?>
                                    </td>
                                    <td style="text-align:center;vertical-align: middle;">
                                        <a class="nav-link" id="iconos" href="../controllers/cRegUsuarios.php?editUser=<?=$u['id']?>&n=<?=$u['num_doc']?>" title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td style="text-align:center;vertical-align: middle;">   
                                        <a class="nav-link" id="iconos" href="#" data-toggle="modal" data-target="#eliminarModal" onclick="recibir_id(<?= $u['id'] ?>,'<?=$u['nombres']?>','<?=$u['apellidos']?>',<?=$u['num_doc']?>);">
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
    <script>
        function recibir_id(id,nombres,apellidos,num_doc) {
            let modal = document.getElementById("eliminarModal");
            let enlaceEjemplo = modal.querySelector("#botonconfirmareliminarusuario");
            let href = '../controllers/cRegUsuarios.php?eliminar=' + id;
            enlaceEjemplo.setAttribute('href', href);
            let texto= document.getElementById("textoEliminarUsuario");
            texto.innerText="¿Esta seguro de eliminar el usuario " + nombres + " " + apellidos + " con numero de documento " + num_doc +"?";
        }

        function resultados(){

            let divPrincipal = document.createElement("div");
            divPrincipal.className = "input-group mb-1";

            let input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.placeholder = "Agregar perfil profesional";
            input.name = "perfiles[]";
            input.required = true;
            input.autocomplete= true;

            let divAppend = document.createElement("div");
            divAppend.className = "input-group-append";

            divAppend.id = "iconoBorrar";

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

            document.getElementById("resultados").appendChild(divPrincipal);

            let eliminar = document.getElementById("eliminar");
            eliminar.style.display="inline";

            //document.getElementById("iconoBorrar").style.display="inline";

            let mostrar = document.querySelectorAll("#iconoBorrar");
            for(i=0;i < mostrar.length; i++){
                mostrar[i].style.display="inline";
            }
        }

        function eliminarDiv(div) {
            let resultados = document.getElementById("resultados");
            let divs = resultados.getElementsByClassName("input-group");
            if (divs.length > 1) {
                resultados.removeChild(div);
                
                // alert(resultados.childNodes.length)
                if(divs.length == 1){
                    let eliminar = document.getElementById("eliminar");
                    eliminar.style.display="none";
                    document.getElementById("iconoBorrar").style.display="none";
                }
            }
            
        }

        function eliminarUltimoDiv() {
            let resultados = document.getElementById("resultados");
            let divs = resultados.getElementsByClassName("input-group");

            

            if (divs.length > 1) {
                resultados.removeChild(divs[divs.length - 1]);
                if (divs.length == 1){
                    let eliminar =document.getElementById("eliminar");
                    eliminar.style.display="none";
                    document.getElementById("iconoBorrar").style.display="none";
                }
                
                
            }
        }
    </script>

<!-- Modal eliminar usuario-->
    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="textoEliminarUsuario" class="modal-body" style="text-align: center;"></div>
                <div class="modal-footer">
                                
                </div>
                <div class="container">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <a  id="botonconfirmareliminarusuario" class="btn btn-success btn-block" href="../controllers/cRegUsuarios.php">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Fin Modal eliminar usuario-->

<?php include_once('layout/footer.php');?>

<script src="../controllers/cMunicipios.js"></script>