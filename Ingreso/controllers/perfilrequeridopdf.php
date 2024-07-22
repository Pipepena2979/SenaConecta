

<?php
include '../models/mconsultaspdf.php';
date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");

$fecha = date("d") . " de " . $mes[date("m")-1] . " de " . date("Y");
$fecha1 = date("Ymd");
$fecha2 = date("d/m/Y");

$anchohoja = 550;

$pdf = new Consultaspdf();
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
if(isset($_GET['pr'])){

    $id = $_GET['pr'];
    
    $codrequerido = $pdf->perfilrequerido($id);
}


$html = "<body>
<div style='text-align: center;'>
    <table border='1' style='margin: auto;width: ". $anchohoja .";border-collapse: collapse;'>
        <tr>
            <th colspan='4' ><img src='http://". $_SERVER['HTTP_HOST'].";../img/Sena.png' height='80px' width='120px' alt=''><img src='http://". $_SERVER['HTTP_HOST'].";../img/Sena.png' height='80px'  width='150px' alt=''></th>
        </tr>
        <tr>
            <td colspan='3' rowspan='3' style='text-align: center;'> PROCESO DE DIRECCIÓN DE FORMACIÓN PROFESIONAL INTEGRAL</td>
            <td style='text-align: center;width: 9%;'><b>VERSION: 3</b></td>
        </tr>
    </table>
    <table border='1' style='margin: auto;width: ". $anchohoja .";border-collapse: collapse;'>
        <tr>
            <td style='text-align: center;width: ". $anchohoja .";height:50px ;'>Perfil del requerido</td>
        </tr>
        <tr> ";
                foreach($codrequerido AS $p){
                    $html .= "<tr>";
                        $html .= "<td>" .$p['perfil'] ."</td>";
                    $html .= "</tr>";
                };"
        </tr>
    </table>
</div>
</body>";


// echo "<script type='text/javascript'>window.print();</script>";


// $html = ob_get_clean();

ini_set('memory_limit', '4096M');
require_once('../vendor/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("archivo.pdf", array("Attachement" => false));


?>
