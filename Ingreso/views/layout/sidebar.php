<?php



    if (session_status() !== PHP_SESSION_ACTIVE) {

        // Si no está iniciada, la iniciamos

        session_start();

    }



    $rol = array(

        1  => "Coordinador Misional",

        2  => "Coordinador",

        3  => "Instructor",

        4  => "Administrador",

        5 =>  "Administración Educativa",

    );



?>

 

 



<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">



    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="menu.php">

        <div class="sidebar-brand-icon">

            <img class="footer-logo" src="https://lostramites.com.co/wp-content/uploads/logo-de-Sena-sin-fondo-Blanco-300x300.png" alt="Logo Sena" width="50px">

        </div>

        <div class="sidebar-brand-text mx-3"><?php echo $rol[$_SESSION['rol']]?></div>

    </a>

    <!-- cierrer de sesion por inactividad -->

     <!-- <div class="alert alert-danger position-realtive d-line-flex p-2" style="display: none;" role="alert">

        <div id="number" class="text-danger"></div>

    </div>  -->

    <script type="text/javascript">

        n = 300

        let id = window.setInterval(function(){

            document.onmousemove = function(){

                n = 300

            };

            n--;

            

            if (n <= -1) {

                swal({

                    title: "Advertencia!",

                    text: "Su sesion se cerrara por inactividad!",

                    icon: "warning",

                    buttons: false,

                });

                // setTimeout(() => {

                // location.href="../controllers/exit.php"

                // },4000)

                document.onmousemove = function(){

                    location.href="../controllers/exit.php"

                };

            }

        },1200); 

    </script>

    <!-- fin de Cierre automatico de sesion -->



    <hr class="sidebar-divider">



    <div class="sidebar-heading">

    </div>           

           

    <li class="nav-item">

        <a class="nav-link" href="menu.php">

            <i class="fas fa-home"></i>

            <span>Inicio</span></a>

    </li>



    <?php if(isset( $_SESSION['rol']) &&  $_SESSION['rol']==4 OR ($_SESSION['rol']==1 or $_SESSION['rol']==2)){?> 

        <li class="nav-item">

            <a class="nav-link" href="registrar.php">

                <i class="bi bi-receipt-cutoff"></i>

                <span>Registrar usuarios</span></a>

        </li>

    <?php }?>



    <?php if(isset( $_SESSION['rol']) && $_SESSION['rol'] ==4 OR ($_SESSION['rol']==1 or $_SESSION['rol']==2)){?>

        <li class="nav-item">

            <a class="nav-link" href="tablaperfilcu.php">

                <i class="bi bi-journal-text"></i>

                <span>Perfil Curricular</span></a>

        </li>

        <?php if(isset( $_SESSION['rol']) &&  $_SESSION['rol']==4 OR ($_SESSION['rol']==1 or $_SESSION['rol']==2)){?> 

        <li class="nav-item">

            <a class="nav-link" href="Ambiente.php">

                <i class="bi bi-receipt-cutoff"></i>

                <span>Registar Ambiente</span></a>

        </li>

        <?php }?>

        <li class="nav-item">

            <a class="nav-link" href="programacion.php">

                <i class="fas fa-fw fa-address-book"></i>

                <span>Programación</span></a>

        </li>

        <li class="nav-item">

            <a class="nav-link" href="instructores.php">

                <i class="bi bi-person-badge"></i>

                <span>Instructores</span></a>

        </li>

        <li class="nav-item">

            <a class="nav-link" href="cursos.php">

                <i class="fas fa-fw fa-users"></i>

                <span>Cursos</span></a>

        </li>

    <?php } ?>

 

    <?php if(isset( $_SESSION['rol']) && $_SESSION['rol']==3){?>



        <li class="nav-item ">

            <a class="nav-link" href="../controllers/cRegAsignaciones.php?asignacionIns=1">

                <i class="fas fa-fw fa-user"></i>

            <span>Asignaciones</span></a>

        </li>



    <?php } ?>





    <li class="nav-item ">

        <a class="nav-link" href="coordinadores.php">

            <i class="bi bi-people-fill"></i>

            <span>Coordinadores</span></a>

    </li>



    <?php if(isset( $_SESSION['rol']) && $_SESSION['rol']==4 ){?> 

        <li class="nav-item">

            <a class="nav-link" href="contacto.php">

                <i class="bi bi-person-rolodex"></i>

                <span>Solicitudes de contacto</span></a>

        </li>

    <?php }?>

            



    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ayuda" aria-expanded="true" aria-controls="collapsePages">

            <i class="bi bi-calendar-event"></i>

                <span><strong>Ayuda y soporte</strong></span>

        </a>

        <div id="ayuda" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">Opciones:</h6>

                <a class="collapse-item" href="../../Ingreso/controllers/cManual.php?M=1">Manual de uso</a>

                <!-- <a class="collapse-item" href="../../video/video principal.mp4">Video de soporte</a>  -->

            </div>

        </div>

    </li>

            

    <hr class="sidebar-divider d-none d-md-block">



    <div class="text-center d-none d-md-inline">

        <button class="rounded-circle border-0" id="sidebarToggle"></button>

    </div>



</ul>

