<?php

require '../vendor/PHPExcel/Classes/PHPExcel.php';

// Iniciar la sesión
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verificar si 'asignacionesInstructor' está definida y no está vacía
if (!isset($_SESSION['asignacionesInstructor']) || empty($_SESSION['asignacionesInstructor'])) {
    echo "No hay asignaciones para exportar.";
    exit();
}

// Crear una nueva hoja de cálculo
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();

// Establecer el título de la hoja
$sheet->setTitle('Asignaciones');

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
$sheet->getStyle('A1:K1')->applyFromArray($headerStyle);
$sheet->getStyle('A1:K1')->applyFromArray($borderStyle);

// Agregar los encabezados de las columnas
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nivel');
$sheet->setCellValue('C1', 'Nombre Titulación');
$sheet->setCellValue('D1', 'Tipo de Competencia');
$sheet->setCellValue('E1', 'Competencia');
$sheet->setCellValue('F1', 'Jornada');
$sheet->setCellValue('G1', 'Zonas');
$sheet->setCellValue('H1', 'Municipio');
$sheet->setCellValue('I1', 'Fecha de inicio');
$sheet->setCellValue('J1', 'Fecha de finalización');
$sheet->setCellValue('K1', 'Fecha de asignación');

// Agregar los datos de las asignaciones
$asignaciones = $_SESSION['asignacionesInstructor'];
$row = 2; // Empezar en la segunda fila porque la primera es para los encabezados
foreach ($asignaciones as $asignacion) {
    $sheet->setCellValue('A' . $row, $row - 1);
    $sheet->setCellValue('B' . $row, $asignacion['nom_nivel']);
    $sheet->setCellValue('C' . $row, $asignacion['denominacion_prog']);
    $sheet->setCellValue('D' . $row, $asignacion['tipo']);
    $sheet->setCellValue('E' . $row, $asignacion['nom_competencia']);
    $sheet->setCellValue('F' . $row, $asignacion['nombreJornada']);
    $sheet->setCellValue('G' . $row, $asignacion['Nom_regiones'] == 'Otra' ? 'Virtual' : $asignacion['Nom_regiones']);
    $sheet->setCellValue('H' . $row, $asignacion['Nom_municipio'] == 'Otro' ? 'Virtual' : $asignacion['Nom_municipio']);
    $sheet->setCellValue('I' . $row, $asignacion['fecha_inicio']);
    $sheet->setCellValue('J' . $row, $asignacion['fecha_fin']);
    $sheet->setCellValue('K' . $row, $asignacion['fechaAsignacion']);
    $sheet->getStyle('A' . $row . ':K' . $row)->applyFromArray($borderStyle);
    $row++;
}

// Ajustar el ancho de las columnas automáticamente
foreach (range('A', 'K') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Verificar si la clase ZipArchive está disponible
if (!class_exists('ZipArchive')) {
    echo "La clase ZipArchive no está disponible. Asegúrate de que la extensión zip está habilitada en tu configuración de PHP.";
    exit();
}

// Crear el escritor y guardar el archivo en el servidor temporalmente
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$filename = 'Asignaciones_' . $_SESSION['nombres'] . '_' . $_SESSION['apellidos'] . '.xlsx';
$writer->save($filename);

// Enviar el archivo al navegador para su descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
readfile($filename);

// Eliminar el archivo del servidor después de enviarlo
unlink($filename);
exit();

?>
