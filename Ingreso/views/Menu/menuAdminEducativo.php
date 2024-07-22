<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Asignaciones Totales en el Sistema</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Número Documento</th>
                                    <th class="text-center">Nombre Instructor</th>
                                    <th class="text-center">Nivel</th>
                                    <th class="text-center">Nombre Titulación</th>
                                    <th class="text-center">Tipo Competencia</th>
                                    <th class="text-center">Competencia</th>
                                    <th class="text-center">Rubro</th>
                                    <th class="text-center">Ambiente</th>
                                    <th class="text-center">Fecha Inicio</th>
                                    <th class="text-center">Fecha Fin</th>
                                    <th class="text-center">Fecha Asignación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($asignacionesTotales = $consulta->asignacionesTotales()) {
                                    foreach ($asignacionesTotales as $asignacion) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['id']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['nDocInstructor']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['nombreInstructor']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['nom_nivel']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['denominacion_prog']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['tipo']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['nom_competencia']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['nombreRubro']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['nombreAmbiente']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['fecha_inicio']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['fecha_fin']) . "</td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($asignacion['fechaAsignacion']) . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12 d-flex justify-content-center">
    <a href="../controllers/exportsProgramacionesTotales.php" class="btn btn-success btn-custom"><i class="bi bi-box-arrow-in-down"></i> Descargar Reporte Programaciones Totales <strong>SenaConecta</strong></a>
        </div>
    </div>
</div>
