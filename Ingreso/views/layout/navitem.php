<?php


    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    include('../controllers/cMensaje.php');
    

    // if(isset($_SESSION['cursoseleccionado'])){
    // $cur = $_SESSION['cursoseleccionado'];}
?>

<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">


    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
    <!-- Buzon de mensajes -->
    <?php  if($_SESSION['rol'] == 3 && $mensajes):;
            $numeromensajes = count($mensajes);
            date_default_timezone_set('America/Bogota');
        $DateAndTime = date('Y-m-d H:i:s ', time()); ?>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>

                <span class="badge badge-danger badge-counter"><?=$numeromensajes?></span>
            </a>
      
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <div class="container-fluid bg-info" style="flex-direction: column;">
                    <div class="row">
                        <div class="badge col-md-12">
                            <h6 class="dropdown-header">Mensajes Emergentes</h6>
                        </div>
                        <!-- <div class="badge col-md-4">
                            <a href="../controllers/cMensaje.php?borrar=1"><h6 class="dropdown-header text-danger">Borrar</h6></a>
                        </div> -->
                    </div>
                </div>
                    <!-- background-color: #39A900; -->

                    <?php $estado = array(
                        'leido' => 'warning',
                        'noleido' => 'success'
                    ) ?>

                    <?php $estado2 = array(
                        'leido' => 'Visto',
                        'noleido' => ''
                    ) ?>
                <?php foreach($mensajes as $m){
                    $datoenvio = $m['fechaenvio'];
                    $dato1 = strtotime($DateAndTime);
                    $dato2 = strtotime($datoenvio);
                    $datoenviodestructurado = date('Y-m-d', $dato2);
                    $interval = $dato1-$dato2;
                    $intervalmin = $interval / 60;
                    $intervalhor = $intervalmin / 60;
                    $strpos = strpos($intervalhor, '.');
                    $horastranscurridas = substr($intervalhor, 0, $strpos);
                    if($horastranscurridas <=23){
                      $horastranscurridas = "$horastranscurridas hora(s)";
                    }
                    elseif($horastranscurridas >= 24 && $horastranscurridas <= 47){
                      $horastranscurridas = 'Ayer';
                    }elseif($horastranscurridas >= 48 && $horastranscurridas <= 71){
                      $horastranscurridas = 'Hace tiempo';
                    }elseif($horastranscurridas >= 72){
                      $horastranscurridas =  fechaATexto4($datoenviodestructurado);
                    }?>
                    
                <a id='mensaje<?=$m['id']?>' class="dropdown-item d-flex align-items-center " href="#"                
                onclick="modalmensaje('<?=$m['id']?>','<?=$m['estado']?>','<?=$m['fotoemisor']?>','<?=$m['mensaje']?>','<?=$m['Titulo']?>','<?=$m['importancia']?>','<?=$m['nombreemi']?>','<?=$m['rolemi']?>','<?=$m['fechaenvio']?>');
                tipomensaje('<?=$m['importancia']?>');"
                 data-toggle="modal" data-target="#modalvermensajes">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="../img/Perfil/<?=$m['fotoemisor']?>"
                            alt="...">
                        <div id="statusmensaje" class="status-indicator bg-<?=$estado[$m['estado']] ?>"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate"><?=$m['Titulo']?></div>
                        <div class="small text-gray-500">Fecha de envio · <b><?= $horastranscurridas ?></b> <b><?=$estado2[$m['estado']]?></b></div>
                    </div>
                </a>

                <?php } ?>
               
                <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Leer más mensajes</a> -->
            </div>
        </li>

        <script>
            function modalmensaje(id,estado,fotoemisor,mensaje,Titulo,importancia,nombreemi,rolemi,fechaenvio){
                let modalmensa = document.getElementById("modalvermensajes");

                let nombreE = document.getElementById("nombreemi");
                nombreE.innerText= nombreemi;

                let rolE = document.getElementById("rolemi");
                rolE.innerText= rolemi;
                
                let titulomen = document.getElementById("titulomodal");
                titulomen.innerText= Titulo;

                let mensajeid = document.getElementById("mensajeemi");
                mensajeid.innerText= mensaje ;

                let fechaEnvio = document.getElementById("fechaE");
                fechaEnvio.innerText= fechaenvio ;


                
                let fotoid = modalmensa.querySelector("#fotoemi");
                let foto = '../img/Perfil/' + fotoemisor;
                fotoid.setAttribute('src', foto);

                // estructuramensaje
                if(estado == 'noleido'){
                let estructuramensaje = document.getElementById('mensaje'+id);
                let estadomensaje = estructuramensaje.querySelector('#statusmensaje');
                let newestatus = 'status-indicator bg-warning';
                estadomensaje.setAttribute('class', newestatus)
                }
                // ajaxmodal
                let parametros = {
                    "id" : id,
                    "estado" : estado
                }            
                $.ajax({
                    data: parametros,
                    url: '../controllers/ajaxmodal.php',
                    type: 'POST',

                    beforeSend: function()
                    { },
                    success: function(respuesta){
                        $('#pruebaajax').html(respuesta);
                    }
                });
            }

            function tipomensaje(importancia){
                let modalmensa = document.getElementById("modalvermensajes");
                // color tipomensaje
                let tipo = ""
                switch (importancia){
                    case 'Normal': 
                        tipo = "success";
                        break;
                    case 'Media': 
                        tipo = "warning";
                        break;
                    case 'Urgente': 
                        tipo = "danger";
                }
                let addclass = 'text-' + tipo + ' font-italic me-1'; 
                modalmensa.querySelector('#tipomensaje').className = addclass;               
            }
        </script>

        <!-- Modal mensajes -->
        <div class="modal fade" id="modalvermensajes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="titulomodal">Hola<h4 class="modal-title text-info" id="pruebaajax"></h4></h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- <div class="modal-body"> -->
                    
                        <div class="container py-4">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="col-lg-12 mx-auto justify-content-center">
                                        <div class="card mb-4 mx-auto">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 text-center">
                                                    <img id="fotoemi" src="../img/Perfil/" alt=""
                                                      class="rounded-circle img-fluid" style="width: 180px;height: 180px;">
                                                    </div>
                                                    <div class="col-lg-6 text-center">
                                                    <h3 class="my-3" id="nombreemi">Diego Robayo-<h5 id="rolemi"></h5></h3>
                                                    <p class="text-muted mb-1" id="rolPerfilTitulo">Ingeniero de Sistemas</p>
                                                    <p class="text-muted mb-4" id="ubicacionPerfilTitulo">Villeta-Cundinamarca</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card mb-1 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4"><span class="" id="tipomensaje">Mensaje: </span></p>
                                                <p class="mb-1"  id="mensajeemi" class="text-dark font-italic me-1">Jonatan</p>
                                            </div>
                                    
                                            <p id="fechaE" style="text-align: right;align-items: end;font-size: .77rem;margin-right: 10px;">Recibido: 8 de septiembre de 2023 a las 07:00 am</p>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div> 
                    <!-- </div> -->
                </div>
            </div>
        </div>

        <?php endif?>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(isset($_SESSION['nombres'] , $_SESSION['apellidos'], $_SESSION['foto'])): ?>
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nombres']?> <?= $_SESSION['apellidos']?></span>
                
                    <img class="img-profile rounded-circle" src="../img/Perfil/<?php 
                    
                    if($_SESSION['genero'] == 2 && $_SESSION['foto'] == 'undraw_profile.png'){
                        echo $_SESSION['foto'];
                    }elseif(($_SESSION['genero'] == 1 || $_SESSION['genero'] == 3) && $_SESSION['foto'] == 'undraw_profile.png'){
                        echo 'undraw_profile_Mujer.png';
                    }else{
                        echo $_SESSION['foto'];
                    }
                    
                    ?>">
                <?php endif ?>
            </a> 
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="perfil.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>
    </ul>

</nav>

<!-- Modal de cierre de sessión -->

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <center><b><?php echo $_SESSION['nombres']?>, ¿desea cerrar sesión?</b></center>
            </div>
            <div class="modal-footer">
                
            </div>

            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-danger btn-block" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="form-group col-md-6">
                        <a class="btn btn-success btn-block" href="../controllers/exit.php">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









