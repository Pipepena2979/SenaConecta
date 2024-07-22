<?php

use PDF as GlobalPDF;

require('./fpdf.php');

include '../../models/mconsultaspdf.php';

$pdf = new Consultaspdf();
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Si no está iniciada, la iniciamos
    session_start();
}
if(isset($_GET['pr'])){

    $id = $_GET['pr'];
    
    $codrequerido = $pdf->perfilrequerido($id);
}

class PDF extends FPDF


{
   // Cabecera de página
   function Header()
   {
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('./senanara.png', 265, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->Image('./logo_siga.png', 15, 10, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      //creamos una celda o fila
      $this->Cell(100,15, utf8_decode('Centro Desarrollo Agoindustrial Empresarial SENA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(20); // Salto de línea
      $this->SetTextColor(103); //color


      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("PROCESO DE DIRECCIÓN DE FORMACIÓN PROFESIONAL INTEGRAL "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(2);
      $this->Cell(255, 10, utf8_decode('Perfil del requerido'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Version: 3'), 1, 0, 'C', 1);
      $this->Ln();
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
$i = $i + 1;


/* TABLA */

// foreach($codrequerido AS $p){
$pdf->Cell(2);
$pdf->Cell(275, 10, utf8_decode('Perfil del requerido'), 1, 0, 'C', 0);
$pdf->Ln();
$pdf->Cell(2);
$pdf->Write(10, utf8_decode('Opción 1: Título profesional universitario en cualquier núcleo básico de conocimiento. Nivel de lengua
certificado* de mínimo B2 de acuerdo con el MCER en cada una de las 4 habilidades de dominio de lengua
(Comprensión oral, Comprensión escrita, Producción oral, Producción escrita). Veinticuatro (24) meses de
experiencia en la instrucción/docencia de la lengua extranjera a impartir.
Opción 2: Título tecnólogo en cualquier
núcleo básico de conocimiento. Nivel de lengua certificado* de mínimo B2 de acuerdo con el MCER en cada una
de las 4 habilidades de dominio de lengua (Comprensión oral, Comprensión escrita, Producción oral, Producción
escrita). Treinta (30) meses de experiencia en la instrucción/docencia de la lengua extranjera a impartir. Los
instructores para programas de formación complementaria virtual, incluyendo bilingüismo, deberán acreditar
capacitación relacionada con tutoría virtual, no inferior a 40 horas, además de cumplir los requisitos del perfil'), 0, 1 , 'C' , 0);




$pdf->Output('Prueba2.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
