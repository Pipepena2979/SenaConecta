<?php

  if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
  }
  if (!isset($_SESSION['T_doc'],$_SESSION['num_doc'],$_SESSION['rol'],$_SESSION['Correo'],$_SESSION['nombres'],$_SESSION['apellidos'],$_SESSION['Telefono'],$_SESSION['contrasena'],$_SESSION['foto'])) {
    session_destroy();
    echo "<script>alert('Por favor inicie sessión');location.href='../../index.php';</script>";
    exit();
  }


?>

<?php 
  include_once('layout/header.php');
  include("../controllers/cRegGraficas.php");
  include("../controllers/lib_fecha_texto.php");


?>

  <div id="wrapper">
  <?php include'layout/sidebar.php'  ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
      <?php include_once('layout/navitem.php'); ?>
      <br>
      <?php if(isset($_SESSION['alertaContrato'])){ ?>

        <script>
          setTimeout(()=>{document.getElementById('modalContacto').click()},700)
        </script>

        <a data-bs-toggle="modal" data-bs-target="#alertaContrato" id="modalContacto"></a>

        <div class="modal fade" id="alertaContrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div id="textoEliminarUsuario" class="modal-body" style="text-align: center;">
                    <?php if($_SESSION['alertaContrato'] == 0){?>
                      Querido/a <?=$_SESSION['nombres']?>, el día de hoy se vence su contrato, apartir de mañana no podra ingresar al aplicativo si no se le renueva el contrato.
                    <?php }else{?>
                      Querido/a <?=$_SESSION['nombres']?>, le quedan <?=$_SESSION['alertaContrato']?> días de contrato.
                    <?php }?>
                  </div>
                  <div class="modal-footer"></div>
                  <div class="container">
                      <div class="row">
                          <div class="form-group col-md-12">
                              <button type="button" class="btn btn-info btn-block" data-bs-dismiss="modal">Aceptar</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>

      <?php unset($_SESSION['alertaContrato']); } ?>

      <?php
        switch ($_SESSION['rol']):
          case 1:
              include_once('./Menu/menuCoordinadorMisional.php');
              break;
          case 2:
              include_once('./Menu/menuCoordinador.php');
              break;
          case 3:
              include_once('./Menu/menuInstructor.php');
              break;
          case 4:
              include_once('./Menu/menuCoordinador.php');
              break;
          case 5:
              include_once('./Menu/menuAdminEducativo.php');
              break;
          
          default:
              echo "Error";
        endswitch;
      ?>
      </div>                                
      <?php include_once('./layout/footer.php');?>  
      </div>    
    </div>          
  </div>
</div>


<?php 



$meses=[
  "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"
];

$cantidad_asignaciones=[0,0,0,0,0,0,0,0,0,0,0,0];
$cantidad_registros=[0,0,0,0,0,0,0,0,0,0,0,0]; 
$cantidad_s=[0,0,0,0,0,0,0,0,0,0,0,0]; 

$cantidad_asignacionesCoordinador=[0,0,0,0,0,0,0,0,0,0,0,0];


$cantidad_asignaciones_ins=[0,0,0,0,0,0,0,0,0,0,0,0];

if($asignaciones){
  foreach($asignaciones AS $a){
    $mes = new DateTime($a["fechaAsignacion"]);
    switch($mes->format("n")){
      case 1:
          $cantidad_asignaciones[0]++;
      break;
      case 2:
          $cantidad_asignaciones[1]++;
      break;
      case 3:
          $cantidad_asignaciones[2]++;
      break;
      case 4:
          $cantidad_asignaciones[3]++;
      break;
      case 5:
          $cantidad_asignaciones[4]++;
      break;
      case 6:
          $cantidad_asignaciones[5]++;
      break;
      case 7:
          $cantidad_asignaciones[6]++;
      break;
      case 8:
          $cantidad_asignaciones[7]++;
      break;
      case 9:
          $cantidad_asignaciones[8]++;
      break;
      case 10:
          $cantidad_asignaciones[9]++;
      break;
      case 11:
          $cantidad_asignaciones[10]++;
      break;
      case 12:
          $cantidad_asignaciones[11]++;
      break;
  }
  }
?>
  <script>
  grafica_lineal("asignaciones",<?= json_encode($meses) ?>,<?= json_encode($cantidad_asignaciones) ?>);
  </script>
<?php
}


if($registros){
  foreach($registros AS $i){
    $mes = new DateTime($i["fechaRegistro"]);
    switch($mes->format("n")){
      case 1:
          $cantidad_registros[0]++;
      break;
      case 2:
         $cantidad_registros[1]++;
      break;
      case 3:
         $cantidad_registros[2]++;
      break;
      case 4:
         $cantidad_registros[3]++;
      break;
      case 5:
         $cantidad_registros[4]++;
      break;
      case 6:
         $cantidad_registros[5]++;
      break;
      case 7:
         $cantidad_registros[6]++;
      break;
      case 8:
         $cantidad_registros[7]++;
      break;
      case 9:
         $cantidad_registros[8]++;
      break;
      case 10:
         $cantidad_registros[9]++;
      break;
      case 11:
         $cantidad_registros[10]++;
      break;
      case 12:
         $cantidad_registros[11]++;
      break;
  }
  }

  ?>
  <script>
  grafica_barra("inicios",<?= json_encode($meses) ?>,<?= json_encode($cantidad_registros) ?>);
</script>
<?php
}
?>   

<?php 
if($sesion){
  foreach($sesion AS $i){
    $mes = new DateTime($i["fechaR"]);
    switch($mes->format("n")){
      case 1:
          $cantidad_s[0]++;
      break;
      case 2:
         $cantidad_s[1]++;
      break;
      case 3:
         $cantidad_s[2]++;
      break;
      case 4:
         $cantidad_s[3]++;
      break;
      case 5:
         $cantidad_s[4]++;
      break;
      case 6:
         $cantidad_s[5]++;
      break;
      case 7:
         $cantidad_s[6]++;
      break;
      case 8:
         $cantidad_s[7]++;
      break;
      case 9:
         $cantidad_s[8]++;
      break;
      case 10:
         $cantidad_s[9]++;
      break;
      case 11:
         $cantidad_s[10]++;
      break;
      case 12:
         $cantidad_s[11]++;
      break;
  }
  }

  ?>
  <script>
  grafica_barraMeses("sesion",<?= json_encode($meses) ?>,<?= json_encode($cantidad_s) ?>);
</script>
<?php
}
?> 

<!-- Grafica de roles -->
<?php 

  $cM = $coordinadorMisional[0]['contar'];
  $c = $coordinador[0]['contar'];
  $i = $instructores[0]['contar'];

?>
<script type="text/javascript">
  let cMisi = <?= $cM   ?>;
  let co = <?= $c ?>;
  let ins = <?= $i ?>;

  var ctx = document.getElementById("rol");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Coordinador Misional", "Coordinador", "Instructor"],
      datasets: [{
        data: [cMisi, co, ins],
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>
<!--Fin-->

<!-- Grafica de genero -->
<?php 

  $fem = $femenino[0]['contar'];
  $mas = $masculino[0]['contar'];
  $otros = $otros[0]['contar'];

?>
<script type="text/javascript">
  let fem = <?= $fem  ?>;
  let mas = <?= $mas ?>;
  let otros = <?= $otros ?>;

  var ctx = document.getElementById("genero");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Femenino", "Masculino", "Otros"],
      datasets: [{
        data: [fem, mas, otros],
        backgroundColor: ['#FFFF00', '#828282', '#0833a2'],
        hoverBackgroundColor: ['#EBFF82', '#aaaaaa', '#0833a9'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>
<!--Fin-->


<!-- grafica Coordinador -->

<?php
  if($asignacionesCoordinador){
    foreach($asignacionesCoordinador AS $i){
      $mes = new DateTime($i["fechaAsignacion"]);
        switch($mes->format("n")){
          case 1:
            $cantidad_asignacionesCoordinador[0]++;
          break;
          case 2:
              $cantidad_asignacionesCoordinador[1]++;
          break;
          case 3:
              $cantidad_asignacionesCoordinador[2]++;
          break;
          case 4:
              $cantidad_asignacionesCoordinador[3]++;
          break;
          case 5:
              $cantidad_asignacionesCoordinador[4]++;
          break;
          case 6:
              $cantidad_asignacionesCoordinador[5]++;
          break;
          case 7:
              $cantidad_asignacionesCoordinador[6]++;
          break;
          case 8:
              $cantidad_asignacionesCoordinador[7]++;
          break;
          case 9:
              $cantidad_asignacionesCoordinador[8]++;
          break;
          case 10:
              $cantidad_asignacionesCoordinador[9]++;
          break;
          case 11:
              $cantidad_asignacionesCoordinador[10]++;
          break;
          case 12:
              $cantidad_asignacionesCoordinador[11]++;
          break;
        }
    } ?>
  <script>
    grafica_lineal("asignacionesCoordinador",<?= json_encode($meses) ?>,<?= json_encode($cantidad_asignacionesCoordinador) ?>);
  </script>
<?php } 


// Grafica asignaciones instructor





if($asignaciones_ins){
  foreach($asignaciones_ins AS $i){
    $mes = new DateTime($i["fechaAsignacion"]);
    switch($mes->format("n")){
      case 1:
          $cantidad_asignaciones_ins[0]++;
      break;
      case 2:
         $cantidad_asignaciones_ins[1]++;
      break;
      case 3:
         $cantidad_asignaciones_ins[2]++;
      break;
      case 4:
         $cantidad_asignaciones_ins[3]++;
      break;
      case 5:
         $cantidad_asignaciones_ins[4]++;
      break;
      case 6:
         $cantidad_asignaciones_ins[5]++;
      break;
      case 7:
         $cantidad_asignaciones_ins[6]++;
      break;
      case 8:
         $cantidad_asignaciones_ins[7]++;
      break;
      case 9:
         $cantidad_asignaciones_ins[8]++;
      break;
      case 10:
         $cantidad_asignaciones_ins[9]++;
      break;
      case 11:
         $cantidad_asignaciones_ins[10]++;
      break;
      case 12:
         $cantidad_asignaciones_ins[11]++;
      break;
  }
  }

  ?>
  <script>
  grafica_lineal("asignacion_instructor",<?= json_encode($meses) ?>,<?= json_encode($cantidad_asignaciones_ins) ?>);
</script>
<?php
}
?>          




<?php 

foreach($cursos_mañana AS $c){
  $total_m[]=$c["total"];
}
foreach($cursos_tarde AS $c){
  $total_t[]=$c["total"];
}
foreach($cursos_noche AS $c){
  $total_n[]=$c["total"];
}
foreach($cursos_fin_semana AS $c){
  $total_f[]=$c["total"];
}
foreach($cursos_virtual AS $c){
  $total_v[]=$c["total"];
}

?>




<script>
// grafica total de cursos

var ctx = document.getElementById("cursos");

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Complementario Virtual", "Curso Especial", "Especialización Tecnológico", "Operario", "Profundización Técnica", "Técnico", "Tecnólogo", "Auxiliar"],
    datasets: 
    [
      {
      label: "Mañana",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data:<?= json_encode($total_m) ?> 
      },
      {
      label: "Tarde",
      backgroundColor: "#FF0080",
      hoverBackgroundColor: "#FF0080",
      borderColor: "#FF0080",
      data: <?= json_encode($total_t) ?> 
      },
      {
      label: "Noche",
      backgroundColor: "#9B9B9B",
      hoverBackgroundColor: "#9B9B9B",
      borderColor: "#9B9B9B",
      data: <?= json_encode($total_n) ?> 
      },
      {
      label: "Fin de senama",
      backgroundColor: "#FFFF00",
      hoverBackgroundColor: "#FFFF00",
      borderColor: "#FFFF00",
      data: <?= json_encode($total_f) ?> 
      },
      {
      label: "Virtual",
      backgroundColor: "#92fd70",
      hoverBackgroundColor: "#92fd70",
      borderColor: "#92fd70",
      data: <?= json_encode($total_v) ?> 
      }

    ],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true,
          drawBorder: true
        },
        ticks: {
          maxTicksLimit: 10
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 1,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '' + value;
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: true
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: true,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ' : ' + tooltipItem.yLabel;
        }
      }
    },
  }
});

</script>





