<?php

require '../vendor/PHPExcel/Classes/PHPExcel.php';
require '../models/mconsultas.php';

// Iniciar la sesión si no está activa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Obtener las asignaciones
$consulta = new Consultas();
$asignaciones = $consulta->asignacionesTotales();

// Verificar si existen asignaciones disponibles en la sesión
if (!isset($asignaciones) || empty($asignaciones)) {
    echo "No hay asignaciones para exportar.";
    exit();
}

// Crear una nueva instancia de PHPExcel
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();

// Establecer el título de la hoja
$sheet->setTitle('Asignaciones Totales');

// Definir estilos para los encabezados
$headerStyle = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FFFFFF'),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '4CAF50')
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

// Definir estilos para los bordes
$borderStyle = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    )
);

// Aplicar estilos a los encabezados de las columnas
$sheet->getStyle('A1:L1')->applyFromArray($headerStyle);
$sheet->getStyle('A1:L1')->applyFromArray($borderStyle);

// Definir los encabezados de las columnas
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Número Documento');
$sheet->setCellValue('C1', 'Nombre Instructor');
$sheet->setCellValue('D1', 'Nivel');
$sheet->setCellValue('E1', 'Nombre Titulación');
$sheet->setCellValue('F1', 'Tipo Competencia');
$sheet->setCellValue('G1', 'Competencia');
$sheet->setCellValue('H1', 'Rubro');
$sheet->setCellValue('I1', 'Ambiente');
$sheet->setCellValue('J1', 'Fecha Inicio');
$sheet->setCellValue('K1', 'Fecha Fin');
$sheet->setCellValue('L1', 'Fecha Asignación');

// Agregar los datos de las asignaciones
$row = 2; // Empezar en la segunda fila porque la primera es para los encabezados
foreach ($asignaciones as $asignacion) {
    $sheet->setCellValue('A' . $row, $asignacion['id']);
    $sheet->setCellValue('B' . $row, $asignacion['nDocInstructor']);
    $sheet->setCellValue('C' . $row, $asignacion['nombreInstructor']);
    $sheet->setCellValue('D' . $row, $asignacion['nom_nivel']);
    $sheet->setCellValue('E' . $row, $asignacion['denominacion_prog']);
    $sheet->setCellValue('F' . $row, $asignacion['tipo']);
    $sheet->setCellValue('G' . $row, $asignacion['nom_competencia']);
    $sheet->setCellValue('H' . $row, $asignacion['nombreRubro']);
    $sheet->setCellValue('I' . $row, $asignacion['nombreAmbiente']);
    $sheet->setCellValue('J' . $row, $asignacion['fecha_inicio']);
    $sheet->setCellValue('K' . $row, $asignacion['fecha_fin']);
    $sheet->setCellValue('L' . $row, $asignacion['fechaAsignacion']);
    $sheet->getStyle('A' . $row . ':L' . $row)->applyFromArray($borderStyle);
    $row++;
}

// Ajustar el ancho de las columnas automáticamente
foreach (range('A', 'L') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Configurar encabezados para la descarga del archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Asignaciones_Totales_SenaConecta.xlsx"');
header('Cache-Control: max-age=0');

// Crear el escritor para Excel y enviar el archivo al cliente
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

// Finalizar la ejecución del script
exit();
?>
