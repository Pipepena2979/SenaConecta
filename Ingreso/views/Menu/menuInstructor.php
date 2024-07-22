<?php
     if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Asignaciones encargadas a <?=$_SESSION['nombres']?> <?=$_SESSION['apellidos']?> por mes</h6>     
              </div>
              <div class="card-body">
                <div class="chart-area d-flex justify-content-center align-items-center">
                    <?php if($asignaciones_ins){?>
                        <canvas id="asignacion_instructor">
                        </canvas>
                        <?php }else{ ?>
                        <h3>No hay Asignaciones</h3>
                        <?php } ?>
                    </div>
              </div>
            </div>
        </div>
    </div>
</div> 


<!-- Asignaciones que le hayan hecho al Instructor -->