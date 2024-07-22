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

<?php

include("../controllers/cRegUsuarios.php");
include'layout/header.php'  ?>

<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}

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
<?php if(isset($_SESSION['mensaje'])): ?>
        <div class="container-fluid">
            <div class="row">
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
            </div>
        </div>
<?php endif ?> 

<?php if(isset($_SESSION['perfil'])){?>
    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar contraseña <?=$_SESSION['nombres']?></h6>
            </div>    
            <div class="card-body">
                <form  action="../controllers/cRegPerfil.php" method="POST">
                    <div class="row">
                        <div class="form-group  col-md-12">
                            <label for="eContra1"><b>Ingresa tu contraseña actual </b><a onclick="mostrar1()"><i id="icon1" class="bi bi-eye-slash-fill"></i></a></label>
                            <input type="password" class="form-control" id="eContra1" name="eContra1" required> 
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="eContra2"><b>Vulve a ingresar tu contraseña actual </b><a onclick="mostrar2()"><i id="icon2" class="bi bi-eye-slash-fill"></i></a></label>
                            <input type="password" class="form-control" id="eContra2" name="eContra2" required> 
                        </div>
                        <div class="form-group  col-md-6">
                            <a href="../controllers/cRegPerfil.php?cancel=1" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="form-group  col-md-6">
                            <button class="btn btn-success btn-block">Siguiente</button>
                        </div>
                        <?php if(isset($_SESSION['mensajeperfil'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alertperfil']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensajeperfil']?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                            <?php
                                unset($_SESSION['tipo_alertperfil']);
                                unset($_SESSION['mensajeperfil']);
                            ?>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function mostrar1(){
            let tipo = document.getElementById("icon1");
            let contra = document.getElementById("eContra1");
            if(tipo.className == "bi bi-eye-slash-fill"){
                tipo.className = "bi bi-eye-fill";
                if(contra.type == "password"){
                  contra.type = "text";
                }
            }else{
                tipo.className = "bi bi-eye-slash-fill";
                contra.type = "password";
            }
        }
        function mostrar2(){
            let tipo = document.getElementById("icon2");
            let contra = document.getElementById("eContra2");
            if(tipo.className == "bi bi-eye-slash-fill"){
                tipo.className = "bi bi-eye-fill";
                if(contra.type == "password"){
                  contra.type = "text";
                }
            }else{
                tipo.className = "bi bi-eye-slash-fill";
                contra.type = "password";
            }
        }
    </script>
<?php }elseif(isset($_SESSION['rContra'])){?>

    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ingresa tu nueva contraseña <?=$_SESSION['nombres']?></h6>
            </div>    
            <div class="card-body">
                <form  action="../controllers/cRegPerfil.php" method="POST">
                    <div class="row">
                        <div class="form-group  col-md-12">
                            <label for="eContra1"><b>Ingresa tu nueva contraseña </b><a onclick="mostrar3()"><i id="icon3" class="bi bi-eye-slash-fill"></i></a></label>
                            <input type="password" class="form-control" id="eContra3" name="eContra3" required> 
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="eContra2"><b>Vulve a ingresar tu nueva contraseña </b><a onclick="mostrar4()"><i id="icon4" class="bi bi-eye-slash-fill"></i></a></label>
                            <input type="password" class="form-control" id="eContra4" name="eContra4" required> 
                        </div>
                        <div class="form-group  col-md-6">
                            <a href="../controllers/cRegPerfil.php?cancel2=1" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="form-group  col-md-6">
                            <button class="btn btn-success btn-block">Actualizar contraseña</button>
                        </div>
                        <?php if(isset($_SESSION['mensajerContra'])): ?>
                            <div class="form-group col-md-12">
                                <div class="alert alert-<?=$_SESSION['tipo_alertrContra']?> alert-dismoissible fade show" role="alert">
                                    <?=$_SESSION['mensajerContra']?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                            <?php
                                unset($_SESSION['tipo_alertrContra']);
                                unset($_SESSION['mensajerContra']);
                            ?>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function mostrar3(){
            let tipo = document.getElementById("icon3");
            let contra = document.getElementById("eContra3");
            if(tipo.className == "bi bi-eye-slash-fill"){
                tipo.className = "bi bi-eye-fill";
                if(contra.type == "password"){
                  contra.type = "text";
                }
            }else{
                tipo.className = "bi bi-eye-slash-fill";
                contra.type = "password";
            }
        }
        function mostrar4(){
            let tipo = document.getElementById("icon4");
            let contra = document.getElementById("eContra4");
            if(tipo.className == "bi bi-eye-slash-fill"){
                tipo.className = "bi bi-eye-fill";
                if(contra.type == "password"){
                  contra.type = "text";
                }
            }else{
                tipo.className = "bi bi-eye-slash-fill";
                contra.type = "password";
            }
        }
    </script>

<?php }else{?>
    <style>
        .fotoperfil{
            width: 220px;
            height: 250px;
            border-radius: 40%;
            cursor: pointer;
        }
    </style>
    <div class="container-fluid"> 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Foto de perfil de <?=$_SESSION['nombres']?> <?=$_SESSION['apellidos']?></h6>
            </div>    
            <div class="card-body">
                    <div class="text-center">
                        <img class="img-circle fotoperfil" src="../img/Perfil/<?php 
                        
                        if($_SESSION['genero'] == 2 && $_SESSION['foto'] == 'undraw_profile.png'){
                            echo $_SESSION['foto'];
                        }elseif(($_SESSION['genero'] == 1 || $_SESSION['genero'] == 3) && $_SESSION['foto'] == 'undraw_profile.png'){
                            echo 'undraw_profile_Mujer.png';
                        }else{
                            echo $_SESSION['foto'];
                        }

                        ?>" title="Foto de perfil" id="fotoperfil">
                        <hr>
                    </div>
                <p style="font-weight: bold;">Extension permitida del archivo a subir es: <b style="color: red ;">jpg</b></p>    
                <hr>
                <form  action="../controllers/cRegPerfil.php" method="POST" enctype="multipart/form-data"> 
                    <div class="row">
                        <div class="form-group col-md-12">                                          
                            <label for="foto"><b>Foto de Perfil</b></label>
                            <input type="file" class="form-control" id="foto" accept=".jpg" name="foto">                                  
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-success btn-block">Editar foto de perfil</button>
                        </div>
                        
                    </div>
                </form>
                <script>
                    let img = document.getElementById('fotoperfil');
                    let input = document.getElementById('foto');

                    input.onchange = (e) => {
                        if(input.files[0])
                            img.src = URL.createObjectURL(input.files[0]);
                    }
                </script>
            </div>
        </div>
    </div>



    <div class="container-fluid"> 
        <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos personales de <?=$_SESSION['nombres']?> <?=$_SESSION['apellidos']?> 
                    
                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                        data-bs-toggle="popover" data-bs-trigger="hover" 
                        data-bs-content="En este formulario puedes editar tus datos personales">
                            <i class="fa fa-question-circle" id="IconosAyuda"></i>
                        </a>

                </h6>
            </div>    
            <div class="card-body"> 
                <form  action="../controllers/cRegPerfil.php" method="POST"> 
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <label for="eNombres">
                                <b>Nombres</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tus nombres">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="text" class="form-control" id="eNombres" name="eNombres" placeholder="Ingrese sus nombres" value="<?= $_SESSION['nombres']?>" required> 
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="eApellidos">
                                <b>Apellidos</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tus apellidos">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="text" class="form-control" id="eApellidos" name="eApellidos" placeholder="Ingrese sus apellidos" value="<?= $_SESSION['apellidos']?>" required> 
                        </div>
                        <div class="form-group  col-md-4">
                                <label for="eGenero">
                                    <b>Género</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tu tipo de género">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                    <select id="eGenero" name="eGenero" class="form-control" >
                                        <option value="" selected disabled>Selecciona una opcion</option>
                                        <?php
                                            foreach($genero AS $r){?>
                                                <option value="<?=$r['id']?>" <?=$r['id']==$_SESSION['genero']? 'selected':''; ?> required><?=$r['nombreGenero']?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        <div class="form-group  col-md-4">
                            <label for="eCorreo">
                                <b>Correo electrónico</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tu correo electrónico">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="email" class="form-control" id="eCorreo" name="eCorreo" placeholder="Ingrese su correo electrónico" value="<?= $_SESSION['Correo']?>" required> 
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="eTel">
                                <b>Número teléfonico</b>
                                <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tu número teléfonico">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                            </label>
                            <input type="number" min=0 maxlength="10" placeholder="Ingrese su número teléfonico" oninput="maxlengthNumber(this);" class="form-control" id="eTel" name="eTel" value="<?= $_SESSION['Telefono']?>" required> 
                        </div>
                        <div class="form-group  col-md-6">
                                <label for="departamento">
                                    <b>Departamento de residencia</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tu departamento de residencia">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                    <select id="depar" name="eDepartamento" class="form-control" required>
                                        <option value="" selected disabled>Selecciona una opción</option>
                                            <?php
                                                foreach($departamentos as $d){?>
                                                    <option value="<?= $d ['iddpar']?>"  <?=$d['iddpar']==$_SESSION['departamentoUsu']? 'selected':''; ?> required><?=$d ['nomdepar']?></option>
                                            <?php } ?> 
                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Ciudad">
                                    <b>Ciudad o municipio de residencia</b>
                                    <a href="#" title="Atención <?=$_SESSION['nombres']?>"  
                                    data-bs-toggle="popover" data-bs-trigger="hover" 
                                    data-bs-content="En este campo puedes editar tu ciudad o municipio de residencia">
                                        <i class="fa fa-question-circle" id="IconosAyuda"></i>
                                    </a>
                                </label>
                                <select id="Ciudad" name="eCiudad" class="form-control" required>
                                    <?php
                                        foreach($_SESSION['arrayMunicipios'] as $d){?>
                                            <option value="<?= $d ['id']?>" <?=$d['id']==$_SESSION['municipioUsu']? 'selected':''; ?> required><?=$d ['Nom_municipio']?></option>
                                    <?php } ?>         
                                </select>
                            </div>
                        <div class="form-group  col-md-12">
                            <button class="btn btn-success btn-block">Actualizar información</button>
                        </div>
                    </div>
                </form>
                <center><a href="../controllers/cRegPerfil.php?contra=1">Actualizar contraseña</a></center>
            </div>
        </div>
    </div>

    <script>
        // Funcion para limitar la cantidad de numeros a escribir
        function maxlengthNumber(obj){
            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
            }
        }
    </script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
<?php }?>   

</div>

      
<?php include_once('layout/footer.php');?>

<script src="../controllers/cPerfil.js"></script>     
           