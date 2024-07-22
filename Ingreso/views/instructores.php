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

<?php if($instructores == "" ){?>
    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="form-group  col-md-12 text-center">
                        <h2>Todavia no tienes instructores registrados</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{?>

    <?php if($instructores2 == "" && $_SESSION['rol'] == 2){?>
        <div class="container-fluid"> 
            <div class="card shadow mb-4">  
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mensaje</h6>
                </div> 
                <div class="card-body">
                    <div class="row">
                        <div class="form-group  col-md-12 text-center">
                            <h2>Todavia no tienes instructores registrados a tu nombre</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }elseif(!empty($instructores2) && $_SESSION['rol'] == 2){?>

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de los instructores 
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
                                    <th>Tipo de documento</th>
                                    <th>Numero de documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo electrónico</th>
                                    <th>Telefono</th>
                                    <th>Perfil</th>
                                    <th>Calendario</th>
                                    <th>Asignar</th>
                                </tr>
                            </thead>
                            <style>
                                #tablasty:hover{
                                    color: black;
                                }
                            </style>
                            <tbody>
                                <?php 
                                $i =1;
                                    foreach($instructores2 As $ins){?>
                                        <tr id="tablasty">
                                            <td><?=$i?></td>
                                            <td><?=$ins['Nombre']?> <p style="font-size: 0px;"><?=$ins['perfilIns']?></p></td>
                                            <td><?=$ins['num_doc']?></td>
                                            <td><?=$ins['nombres']?></td>
                                            <td><?=$ins['apellidos']?></td>
                                            <td><?=$ins['Correo']?></td>
                                            <td><?=$ins['Telefono']?></td>
                                            <td style="text-align:center;">
                                                <a  class="nav-link iconos" id="modalMensaje" href="#" data-toggle="modal" data-target="#perfilModal" 
                                                    onclick="perfil(<?=$ins['num_doc']?>,'<?=$ins['foto']?>','<?=$ins['nombres']?>',
                                                    '<?=$ins['apellidos']?>','<?=$ins['nombreRol']?>','<?=$ins['Correo']?>',
                                                    '<?=$ins['Telefono']?>','<?=$ins['nomdepar']?>','<?=$ins['Nom_municipio']?>',
                                                    '<?=fechaATexto2($ins['fechaFinContrato'])?>','<?=$ins['perfilIns']?>', <?=$ins['genero']?>);" title="Perfil">
                                                    <i class="fa fa-user" ></i>
                                                </a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a class="nav-link" id="iconos" href="../controllers/cCalendario.php?usu=<?=$ins['num_doc']?>" title="Calendario">
                                                    <i class="fa fa-calendar"></i>
                                                </a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a class="nav-link" id="iconos" href="../controllers/regprogramacion.php?asig=<?=$ins['num_doc']?>" title="Asignar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $i ++; } ?>                
                            </tbody>
                        </table>    
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

        <script>
            function perfil(num_doc,foto,nombre,apellidos,nombreRol,Correo,Telefono,nomdepar,Nom_municipio,fechaFinContrato,perfilIns,genero) {

                let modal = document.getElementById("perfilModal");

                <?php if(isset($_SESSION['error'])){?>
                

                    document.getElementById('divrow').style.display='none';
                    document.getElementById('formularioMensaje').style.display='';
                
                    document.getElementById('mensajeBtn').style.display='none';
                
                    document.getElementById('mensajeBtnMostar').style.display='';
                
                <?php }else{?>
                
                    document.getElementById('divrow').style.display='';
                    document.getElementById('formularioMensaje').style.display='none';
                
                    document.getElementById('mensajeBtn').style.display='';
                
                    document.getElementById('mensajeBtnMostar').style.display='none';
                
                <?php }?>
                
                if( genero == 2 && foto == 'undraw_profile.png'){
                    let fotoPerfil = document.getElementById("imgPerfilTitulo");
                    let href = '../img/Perfil/' + foto;
                    fotoPerfil.setAttribute('src', href);
                }else if((genero == 1 || genero == 3) && foto == 'undraw_profile.png'){
                    let fotoPerfil = document.getElementById("imgPerfilTitulo");
                    let href = '../img/Perfil/undraw_profile_Mujer.png';
                    fotoPerfil.setAttribute('src', href);
                }else{
                    let fotoPerfil = document.getElementById("imgPerfilTitulo");
                    let href = '../img/Perfil/' + foto;
                    fotoPerfil.setAttribute('src', href);
                }


                let enlaceEjemplo = modal.querySelector("#hrefPerfil");
                let href = '../controllers/cCalendario.php?usu=' + num_doc;
                enlaceEjemplo.setAttribute('href', href);

                let titulo= document.getElementById("titulomodal");
                titulo.innerText="Perfil de " + nombre + " " + apellidos ;

                var nom = nombre.split(' ');
                var ape = apellidos.split(' ');
                console.log(nom[0] + " " + ape[0]);

                let tituloTitulo= document.getElementById("tituloPerfilTitulo");
                tituloTitulo.innerText=nom[0] + " " + ape[0];

                let ubicacionTitulo= document.getElementById("ubicacionPerfilTitulo");
                ubicacionTitulo.innerText=Nom_municipio + " / " + nomdepar;

                let rolTitulo= document.getElementById("rolPerfilTitulo");
                rolTitulo.innerText=nombreRol;



                let nombreCompleto= document.getElementById("nombrePerfil");
                nombreCompleto.innerText=nombre + " " + apellidos;

                let correo= document.getElementById("correoPerfil");
                correo.innerText=Correo;

                let telefono= document.getElementById("telefonoPerfil");
                telefono.innerText=Telefono;

                let ubicacion= document.getElementById("ubicacionPerfil");
                ubicacion.innerText=Nom_municipio + " / " + nomdepar;

                let feCoPe= document.getElementById("fechaContratoPerfil");
                feCoPe.innerText=fechaFinContrato;

                var porciones = perfilIns.split('-');
      

                let html = '<p class="mb-4"><span class="text-primary font-italic me-1">Perfil profesional</span></p>';
                for(i=0;i < porciones.length; i++){
                  html += "<p class='text-muted mb-0'  id='perfilProfesional'>"+ porciones[i] + "</p>";
                  html += "<div class='progress rounded' style='height: 3px;'><div class='progress-bar' role='progressbar' style='width: 0%' aria-valuenow='80' aria-valuemin='0' aria-valuemin='0' aria-valuemax='100'></div></div><br>";
                }
            
                let PePro= document.getElementById("listaperfil");
                PePro.innerHTML=html;
            
                let doc = document.getElementById('receptor');
                doc.value= num_doc;
      
            }

        </script>


    <?php }else{?>

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de los instructores 
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
                                    <th>Tipo de documento</th>
                                    <th>Numero de documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo electrónico</th>
                                    <th>Telefono</th>
                                    <th>Perfil</th>
                                    <th>Calendario</th>
                                    <th>Asignar</th>
                                </tr>
                            </thead>
                            <style>
                                #tablasty:hover{
                                    color: black;
                                }
                            </style>
                            <tbody>
                                <?php 
                                $i =1;
                                    foreach($instructores As $ins){?>
                                        <tr id="tablasty">
                                            <td><?=$i?></td>
                                            <td><?=$ins['Nombre']?> <p style="font-size: 0px;"><?=$ins['perfilIns']?></p></td>
                                            <td><?=$ins['num_doc']?></td>
                                            <td><?=$ins['nombres']?></td>
                                            <td><?=$ins['apellidos']?></td>
                                            <td><?=$ins['Correo']?></td>
                                            <td><?=$ins['Telefono']?></td>
                                            <td style="text-align:center;">
                                                <a  class="nav-link iconos" id="modalMensaje" href="#" data-toggle="modal" data-target="#perfilModal" 
                                                    onclick="perfil(<?=$ins['num_doc']?>,'<?=$ins['foto']?>','<?=$ins['nombres']?>',
                                                    '<?=$ins['apellidos']?>','<?=$ins['nombreRol']?>','<?=$ins['Correo']?>',
                                                    '<?=$ins['Telefono']?>','<?=$ins['nomdepar']?>','<?=$ins['Nom_municipio']?>',
                                                    '<?=fechaATexto2($ins['fechaFinContrato'])?>','<?=$ins['perfilIns']?>', <?=$ins['genero']?>);" title="Perfil">
                                                    <i class="fa fa-user" ></i>
                                                </a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a class="nav-link" id="iconos" href="../controllers/cCalendario.php?usu=<?=$ins['num_doc']?>" title="Calendario">
                                                    <i class="fa fa-calendar"></i>
                                                </a>
                                            </td>
                                            <td style="text-align:center;">
                                                <a class="nav-link" id="iconos" href="../controllers/regprogramacion.php?asig=<?=$ins['num_doc']?>" title="Asignar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $i ++; } ?>                
                            </tbody>
                        </table>    
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

        <script>
            function perfil(num_doc,foto,nombre,apellidos,nombreRol,Correo,Telefono,nomdepar,Nom_municipio,fechaFinContrato,perfilIns,genero) {

                let modal = document.getElementById("perfilModal");

                <?php if(isset($_SESSION['error'])){?>
                

                    document.getElementById('divrow').style.display='none';
                    document.getElementById('formularioMensaje').style.display='';
                
                    document.getElementById('mensajeBtn').style.display='none';
                
                    document.getElementById('mensajeBtnMostar').style.display='';
                
                <?php }else{?>
                
                    document.getElementById('divrow').style.display='';
                    document.getElementById('formularioMensaje').style.display='none';
                
                    document.getElementById('mensajeBtn').style.display='';
                
                    document.getElementById('mensajeBtnMostar').style.display='none';
                
                <?php }?>
                
                if( genero == 2 && foto == 'undraw_profile.png'){
                    let fotoPerfil = document.getElementById("imgPerfilTitulo");
                    let href = '../img/Perfil/' + foto;
                    fotoPerfil.setAttribute('src', href);
                }else if((genero == 1 || genero == 3) && foto == 'undraw_profile.png'){
                    let fotoPerfil = document.getElementById("imgPerfilTitulo");
                    let href = '../img/Perfil/undraw_profile_Mujer.png';
                    fotoPerfil.setAttribute('src', href);
                }else{
                    let fotoPerfil = document.getElementById("imgPerfilTitulo");
                    let href = '../img/Perfil/' + foto;
                    fotoPerfil.setAttribute('src', href);
                }


                let enlaceEjemplo = modal.querySelector("#hrefPerfil");
                let href = '../controllers/cCalendario.php?usu=' + num_doc;
                enlaceEjemplo.setAttribute('href', href);

                let titulo= document.getElementById("titulomodal");
                titulo.innerText="Perfil de " + nombre + " " + apellidos ;

                var nom = nombre.split(' ');
                var ape = apellidos.split(' ');
                console.log(nom[0] + " " + ape[0]);

                let tituloTitulo= document.getElementById("tituloPerfilTitulo");
                tituloTitulo.innerText=nom[0] + " " + ape[0];

                let ubicacionTitulo= document.getElementById("ubicacionPerfilTitulo");
                ubicacionTitulo.innerText=Nom_municipio + " / " + nomdepar;

                let rolTitulo= document.getElementById("rolPerfilTitulo");
                rolTitulo.innerText=nombreRol;



                let nombreCompleto= document.getElementById("nombrePerfil");
                nombreCompleto.innerText=nombre + " " + apellidos;

                let correo= document.getElementById("correoPerfil");
                correo.innerText=Correo;

                let telefono= document.getElementById("telefonoPerfil");
                telefono.innerText=Telefono;

                let ubicacion= document.getElementById("ubicacionPerfil");
                ubicacion.innerText=Nom_municipio + " / " + nomdepar;

                let feCoPe= document.getElementById("fechaContratoPerfil");
                feCoPe.innerText=fechaFinContrato;

                var porciones = perfilIns.split('-');
      

                let html = '<p class="mb-4"><span class="text-primary font-italic me-1">Perfil profesional</span></p>';
                for(i=0;i < porciones.length; i++){
                  html += "<p class='text-muted mb-0'  id='perfilProfesional'>"+ porciones[i] + "</p>";
                  html += "<div class='progress rounded' style='height: 3px;'><div class='progress-bar' role='progressbar' style='width: 0%' aria-valuenow='80' aria-valuemin='0' aria-valuemin='0' aria-valuemax='100'></div></div><br>";
                }
            
                let PePro= document.getElementById("listaperfil");
                PePro.innerHTML=html;
            
                let doc = document.getElementById('receptor');
                doc.value= num_doc;
      
            }

        </script>
<?php } ?>
   
</div>


<?php }?>

<!-- Perfil modal -->
<div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="titulomodal">Hola</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-12 mx-auto justify-content-center">
                        <div class="card mb-4 mx-auto">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 text-center">
                                    <img src="../img/Perfil/undraw_profile.svg" id="imgPerfilTitulo" alt=""
                                      class="rounded-circle img-fluid" style="width: 180px;height:180px;">
                                    </div>
                                    <div class="col-lg-6 text-center">
                                    <h5 class="my-3" id="tituloPerfilTitulo">Diego Robayo</h5>
                                    <p class="text-muted mb-1" id="rolPerfilTitulo">Ingeniero de Sistemas</p>
                                    <p class="text-muted mb-4" id="ubicacionPerfilTitulo">Villeta-Cundinamarca</p>
                                    <a href="#" type="button" id="hrefPerfil" class="btn btn-primary">Asignar</a>
                                    <button type="button" class="btn btn-outline-primary ms-1" id="mensajeBtn" onclick="ocultarbtn()">Mensaje</button>
                                    <button type="button" class="btn btn-outline-primary ms-1" style="display: none;" id="mensajeBtnMostar" onclick="mostarbtn()">Atras</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if(isset($_SESSION['modalMensaje']) AND isset($_SESSION['tipo_alert_Mensaje']) AND isset($_SESSION['mensajeMensaje'])): ?>
                        <div class="form-group col-md-12">
                            <div class="alert alert-<?=$_SESSION['tipo_alert_Mensaje']?> alert-dismoissible fade show" role="alert">
                                <?=$_SESSION['mensajeMensaje']?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                        </div>
                    <?php
                        unset($_SESSION['tipo_alert_Mensaje']);
                        unset($_SESSION['mensajeMensaje']);
                    ?>
                    <?php endif ?> 
                </div>
                <div class="row" id="divrow">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <p class="mb-0"><b>Nombre:</b></p>
                                      </div>
                                      <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="nombrePerfil">Diego Robayo</p>
                                      </div>
                                    </div>
                                <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <p class="mb-0"><b>Correo electrónico:</b></p>
                                      </div>
                                      <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="correoPerfil">diegofer.robayo2005@gmail.com</p>
                                      </div>
                                    </div>
                                <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <p class="mb-0"><b>Celular:</b></p>
                                      </div>
                                      <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="telefonoPerfil">3214615499</p>
                                      </div>
                                    </div>
                                <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <p class="mb-0"><b>Dirección:</b></p>
                                      </div>
                                      <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="ubicacionPerfil">Villeta / Cundinamarca</p>
                                      </div>
                                    </div>
                                <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <p class="mb-0"><b>Fin Contrato:</b></p>
                                      </div>
                                      <div class="col-sm-9">
                                        <p class="" id="fechaContratoPerfil">30/Noviembre/2023</p>
                                      </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body" id="listaperfil">
                                

                                <!-- <p class="mb-1" style="font-size: .77rem;" id="perfilProfesional">Web Design</p> -->
      
                            </div>
                        </div>
                    </div>

                </div> 
                
                <div class="row" id="formularioMensaje" style="display: none;">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="../controllers/cMensaje.php" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <p class="mb-1"><span class="text-primary font-italic me-1">Enviar mensaje</span></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tituloMensaje">
                                                <b>Titulo de mensaje</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes ingresar el título del mensaje a enviar">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                maxlength="50" 
                                                id="tituloMensaje" 
                                                name="tituloMensaje" 
                                                placeholder="Ingresa el título del mensaje" 
                                                autocomplete="off"
                                                required
                                            >    
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tipoMensaje">
                                                <b>Tipo de mensaje</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes seleccionar el tipo de mensaje a enviar">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                            </label>
                                            <select name="tipoMensaje" id="tipoMensaje" class="form-control" required>
                                                <option value="" disabled selected>Seleccione una opcion</option>
                                                <?php
                                                    foreach($tipomensaje as $p){?>
                                                        <option value="<?= $p ['id']?>"><?=$p ['importancia']; ?></option>
                                                <?php } ?> 
                                            </select>   
                                        </div>  
                                        <div class="form-group col-md-12">
                                            <label for="mensaje">
                                                <b>Mensaje</b>
                                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                                    data-bs-content="En este campo puedes ingresar el mensaje a enviar">
                                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                                </a>
                                            </label>
                                           
                                            <textarea 
                                            name="mensaje" 
                                            id="mensaje" 
                                            cols="50" 
                                            rows="5" 
                                            class="form-control" 
                                            placeholder="Ingresa tu mensaje..."
                                            required
                                            ></textarea>
                                            <input type="hidden" value="" id="receptor" name="receptor" required>   
                                        </div>  
                                        <div class="form-group col-md-12">
                                            <center><button class="btn btn-success" style="cursor: pointer;">Enviar mensaje</button></center>    
                                        </div>                    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<script>
    function ocultarbtn (){
        let divrow = document.getElementById('divrow');
        divrow.style.display='none';

        let btnOcultar =  document.getElementById('mensajeBtn');
        btnOcultar.style.display='none';

        let btnMostrar =  document.getElementById('mensajeBtnMostar');
        btnMostrar.style.display='';

        btnMostrar.className = "btn btn-outline-danger ms-1";
       
        let mostrarFormulario = document.getElementById('formularioMensaje');
        mostrarFormulario.style.display='';
    }
    function mostarbtn (){
        let divrow = document.getElementById('divrow');
        divrow.style.display='';

        let btnOcultar =  document.getElementById('mensajeBtn');
        btnOcultar.style.display='';

        let btnMostrar =  document.getElementById('mensajeBtnMostar');
        btnMostrar.style.display='none';

        btnMostrar.className = "btn btn-outline-primary ms-1";

        let mostrarFormulario = document.getElementById('formularioMensaje');
        mostrarFormulario.style.display='none';
       
    }
</script>
<!-- Fin modal calendario -->

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