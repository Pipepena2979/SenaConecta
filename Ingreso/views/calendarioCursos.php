<?php 
  if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
  }
  $curso = $_SESSION['calendarioCurso'][0]['codigo_prog'];

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

  date_default_timezone_set("America/Bogota");
  $fecha = date("Y-m-d");
  if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 4){
    $SqlEventos   = ("SELECT e.*, ec.denominacion_prog, co.nom_competencia , rub.id AS rubid , am.ambiente
      FROM asignacion_instructor AS e
      INNER JOIN estructura_curricular AS ec ON e.nom_titulacion=ec.codigo_prog 
      INNER JOIN competencia AS co ON e.competencia=co.cod_competencia
      INNER JOIN person AS p ON e.nDocInstructor=p.num_doc
      INNER JOIN tiporubro AS rub ON rub.id=e.rubro
      INNER JOIN ambientes AS am On am.id= e.id_ambiente
      WHERE e.nom_titulacion = $curso ");
    $resulEventos = mysqli_query($con, $SqlEventos);
    // var_dump($SqlEventos);
    // die();
  }else{
    $SqlEventos   = ("SELECT e.*, ec.denominacion_prog, co.nom_competencia, rub.id AS rubid , am.ambiente
      FROM asignacion_instructor AS e
      INNER JOIN estructura_curricular AS ec ON e.nom_titulacion=ec.codigo_prog 
      INNER JOIN competencia AS co ON e.competencia=co.cod_competencia
      INNER JOIN person AS p ON e.nDocInstructor=p.num_doc
      INNER JOIN tiporubro AS rub ON rub.id=e.rubro
      INNER JOIN ambientes AS am On am.id= e.id_ambiente
      WHERE e.nom_titulacion = $curso AND p.supervisor=" . $_SESSION['num_doc']);
    $resulEventos = mysqli_query($con, $SqlEventos);
    // var_dump($SqlEventos);
    // die();
  }

  

  // $SqlIns   = ("SELECT * FROM person WHERE rol=3 AND estado=1");
  // $resulIns = mysqli_query($con, $SqlIns);

  $SqlNivel   = ("SELECT * FROM nivel");
  $resulNivel = mysqli_query($con, $SqlNivel);

  $SqlEstructura   = ("SELECT * FROM estructura_curricular");
  $resulEstructura = mysqli_query($con, $SqlEstructura);

  $SqlTipoCompetencia  = ("SELECT * FROM tipo_competencia");
  $resulTipoCompetencia = mysqli_query($con, $SqlTipoCompetencia);

  $SqlCompetencia  = ("SELECT * FROM competencia");
  $resulCompetencia = mysqli_query($con, $SqlCompetencia);

  $SqlIns   = ("SELECT * FROM person WHERE (rol=3 AND supervisor= " . $_SESSION['num_doc'] . ") AND (fechaFinContrato >= $fecha AND estado=1)");
  $resulIns = mysqli_query($con, $SqlIns);

  $contadorIns = $resulIns->num_rows ;

  $SqlIns2   = ("SELECT * FROM person WHERE rol=3 AND (fechaFinContrato >= $fecha AND estado=1)");
  $resulIns2 = mysqli_query($con, $SqlIns2);

  $contadorIns2 = $resulIns2->num_rows ;

  $Sqlrubro  = ("SELECT * FROM tiporubro");
  $resulrubro = mysqli_query($con, $Sqlrubro);

  $Sqlambiente  = ("SELECT * FROM ambientes");
  $resuambiente = mysqli_query($con, $Sqlambiente);
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
                  <?php include('msjs.php');?>
                </div>
                <div class="col-xl-12 col-lg-7">
                  <div class="row">
                    <div class="col-xl-2 col-lg-7 py-3">
                        <a href="./cursos.php" class="btn btn-info btn-block"><i class="bi bi-arrow-bar-left" style="margin-right: 10px;"></i> Volver</a>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Calendario de programaciones hechas por <?=$_SESSION['nombres']?> <?=$_SESSION['apellidos']?> a la titulación <?=$_SESSION['calendarioCurso'][0]['nom_nivel']?> en <?=$_SESSION['calendarioCurso'][0]['denominacion_prog']?></h6>
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
  include('modalNuevoEventoCurso.php');
  include('modalUpdateEventoCurso.php');
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
    editable: true,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

//Nuevo Evento
  select: function(start, end){
      $("#exampleModal").modal();
      $("input[name=fecha_asignacion]").val(start.format('YYYY-MM-DD'));
      $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
       
      var valorFechaFin = end.format("DD-MM-YYYY");
      var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
      $('#fecha_fin').val(start.format('YYYY-MM-DD'));  

    },
      
    events: [
      <?php
       while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
          {
          _id: '<?php echo $dataEvento['id']; ?>',
          nDoc: '<?php echo $dataEvento['nDocInstructor']; ?>',
          nivel: '<?php echo $dataEvento['nivel']; ?>',
          rubro: '<?php echo $dataEvento['rubid']; ?>',
          codTitulacion: '<?php echo $dataEvento['nom_titulacion']; ?>',
          nombreCurso: '<?php echo $dataEvento['denominacion_prog']; ?>',
          tipoCompetencia: '<?php echo $dataEvento['tipocompetencia']; ?>',
          competencia: '<?php echo $dataEvento['competencia']; ?>',
          ambiente: '<?php echo $dataEvento['id_ambiente']; ?>',
          nomambiente:'<?php echo $dataEvento['ambiente']; ?>',
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

    element
      .find(".fc-time")
      .html(fechaFormateada + " - " + fechaFormateada2)
    element
      .find(".fc-title")
      .html(event.nombreCurso)
    element
      .find(".fc-content")
      .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
    
    //Eliminar evento
    element.find(".closeon").on("click", function() {

  var pregunta = confirm("Deseas Borrar este Evento?");   
  if (pregunta) {

    $("#calendar").fullCalendar("removeEvents", event._id);

     $.ajax({
            type: "POST",
            url: 'deleteEvento.php',
            data: {id:event._id},
            success: function(datos)
            {
              $(".alert-danger").show();

              setTimeout(function () {
                $(".alert-danger").slideUp(500);
              }, 3000); 

            }
        });
      }
    });
  },


//Moviendo Evento Drag - Drop
eventDrop: function (event, delta, revertFunc) {
  var idEvento = event._id;
  var nDocIns = event.nDoc;
  var codT = event.codTitulacion;
  var start = (event.start.format('DD-MM-YYYY HH:mm:ss'));
  var end = (event.end.format("DD-MM-YYYY HH:mm:ss"));

    $.ajax({
        url: 'drag_drop_evento.php',
        data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento + '&nDocIns=' + nDocIns + '&codT=' + codT,
        type: "POST",
        success: 
        
        function (response) {
         // $("#respuesta").html(response);
          console.log(response)
          if(response > 0){
            revertFunc();
            alert('no puede asignarse en en este horario')
          }
          
      
        }
    });
},

//Modificar Evento del Calendario 
eventClick:function(event){
    var idEvento = event._id;
    var prueba = event.competencia;
    // console.log(prueba);
    $('input[name=idEvento').val(idEvento);
    $('#enDoc').val(event.nDoc);
    $('#enivel').val(event.nivel);
    $('#enrubro').val(event.rubro);
    $('#enTitulacion').val(event.codTitulacion);
    $('#etCompetencia').val(event.tipoCompetencia);
    $('#eCompetencia').val(event.competencia);
    $('#eambiente').val(event.ambiente);

    $('#efecha_asignacion').val(event.start.format('YYYY-MM-DD'));

    $('input[name=ehora_Inicio').val(event.start.format('HH:mm:ss'));
    $('input[name=ehora_Fin').val(event.end.format('HH:mm:ss'));

    $("#modalUpdateEvento").modal();
  },


  });


//Oculta mensajes de Notificacion
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 3000); 


});

</script>
<script src="../controllers/cTitulacion.js"></script>
<script src="../controllers/cCompetencia.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

</body>
</html>