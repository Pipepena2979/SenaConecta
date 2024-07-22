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
  $registrado = $_SESSION['num_doc'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C D A E</title>
  <link rel="icon" href="../img/Sena.png">
	<link rel="stylesheet" type="text/css" href="../cssC/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../cssC/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../cssC/home.css">


  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../css/3.css">
  <!-- <link rel="stylesheet" href="../csscalen/style.css"> -->
  <link rel="stylesheet" href="../css/estilos.css">

</head>
<body id="page-top">
<?php
  include('config.php');

  $SqlEventos   = ("SELECT e.*,tc.tipo,c.nom_competencia, ec.denominacion_prog, n.nom_nivel , am.ambiente
  FROM asignacion_instructor AS e
  INNER JOIN tipo_competencia AS tc ON e.tipocompetencia=tc.id
  INNER JOIN competencia AS c ON e.competencia=c.cod_competencia
  INNER JOIN estructura_curricular AS ec ON e.nom_titulacion=ec.codigo_prog 
  INNER JOIN nivel AS n ON ec.nivel=n.id
  INNER JOIN ambientes AS am On am.id= e.id_ambiente

  WHERE e.nDocInstructor = $registrado ORDER BY e.fecha_inicio ASC");
  $resulEventos = mysqli_query($con, $SqlEventos);

?>

<div id="wrapper">
  <?php include'layout/sidebar.php'?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include'layout/navitem.php'?> 
          <br>
            <div class="container-fluid">
              <div class="row">
                
                <div class="col-xl-12 col-lg-7">
                  <div class="row">
                    <div class="col-xl-2 col-lg-7 py-3">
                        <a href="./asignaciones.php" class="btn btn-info btn-block"><i class="bi bi-arrow-bar-left" style="margin-right: 10px;"></i> Volver</a>
                    </div>
                  </div>
                </div>

                <div class="col-xl-12 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Calendario de <?=$_SESSION['nombres']?> <?=$_SESSION['apellidos']?></h6>
                        </div>               
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-md-12">
                              <div id="calendar"></div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>      
              </div>
            </div>

            <footer class="bg-white text-center text-lg-start" id="foooter">
              <!-- Copyright -->
              <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © <?=date("Y")?> Copyright  ADSO-2502959
                <a class="text-dark" target="_blank" href="https://cdaevilleta.blogspot.com/">Centro de Desarrollo Agroindustrial y Empresarial - Villeta.</a>
              </div>
              <!-- Copyright -->
            </footer>

            <style type="text/css">
              #foooter {
                position: relative;
                bottom: 0;
                width: 100%;
              }
            </style>

<?php  
  include('modalUpdate.php');
?>
<script src ="../jsC/jquery-3.0.0.min.js"></script>
<script src="../jsC/popper.min.js"></script>
<script src="../jsC/bootstrap.min.js"></script>

<script type="text/javascript" src="../jsC/moment.min.js"></script>	
<script type="text/javascript" src="../jsC/fullcalendar.min.js"></script>
<script src='../locales/es.js'></script>
<script src="../js/sb-admin-2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },

    locale: 'es',

    defaultView: "month",
    navLinks: true, 
    editable: false,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

      
    events: [
      <?php
      while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
          {
          _id: '<?php echo $dataEvento['id']; ?>',
          nDoc: '<?php echo $dataEvento['nDocInstructor']; ?>',
          nivel: '<?php echo $dataEvento['nivel']; ?>',
          codTitulacion: '<?php echo $dataEvento['nom_titulacion']; ?>',
          nombreCurso: '<?php echo $dataEvento['denominacion_prog']; ?>',
          tipoCurso: '<?php echo $dataEvento['nom_nivel']; ?>',
          tipoCom: '<?php echo $dataEvento['tipo']; ?>',
          nomCom: '<?php echo $dataEvento['nom_competencia']; ?>',
          tipoCompetencia: '<?php echo $dataEvento['tipocompetencia']; ?>',
          competencia: '<?php echo $dataEvento['competencia']; ?>',
          ambiente: '<?php echo $dataEvento['ambiente']; ?>',
          start: '<?php echo $dataEvento['fecha_inicio']; ?>',
          end:   '<?php echo $dataEvento['fecha_fin']; ?>',
          color: '<?php echo $dataEvento['color_evento']; ?>'
          },
        <?php } ?>
    ],


//Eliminar Evento
eventRender: function(event, element) {
  
  // Supongamos que tienes una variable que contiene tu fecha
  var fechaOriginal = event.start;
  var fechaOriginal2 = event.end;

  // Parsea la fecha utilizando Moment.js
  var fechaFormateada = moment(fechaOriginal, "YYYY-MM-DD HH:mm:ss").format("HH:mm A");
  var fechaFormateada2 = moment(fechaOriginal2, "YYYY-MM-DD HH:mm:ss").format("HH:mm A");


  // Muestra la fecha formateada
  console.log(fechaFormateada2);
    element
      .find(".fc-time")
      .html(fechaFormateada + " - " + fechaFormateada2)
    element
      .find(".fc-title")
      .html(event.nombreCurso)
    
    

  },


//Modificar Evento del Calendario 
eventClick:function(event){

    $('#nomT').val(event.nombreCurso);
    $('#nivA').val(event.tipoCurso);
    $('#tipC').val(event.tipoCom);
    $('#com').val(event.nomCom);
    $('#amb').val(event.ambiente);

    $('#efecha_asignacion').val(event.start.format('YYYY-MM-DD'));

    $('input[name=ehora_Inicio').val(event.start.format('HH:mm:ss'));
    $('input[name=ehora_Fin').val(event.end.format('HH:mm:ss'));

    $("#modalUpdateEvento").modal();
  },


  });


//Oculta mensajes de Notificacion
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 9000); 


});

</script>
<script src="../controllers/cTitulacion.js"></script>
<script src="../controllers/cCompetencia.js"></script>

</body>
</html>