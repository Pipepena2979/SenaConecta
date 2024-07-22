<div class="container-fluid">
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Coordinadores misionales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$coordinadorMisional[0]['contar']?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Coordinadores</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$coordinador[0]['contar']?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            instructores</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$instructores[0]['contar']?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Fecha actual</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=fechaATexto2(date("Y-m-d"))?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>                                 
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">NÚmero general de asignaciónes a instructores por mes</h6>     
                  </div>
                  <div class="card-body">
                      <div class="chart-area d-flex justify-content-center align-items-center">
                        <?php if($asignaciones){?>
                          <canvas id="asignaciones">
                          </canvas>
                        <?php }else{ ?>
                          <h3>No hay asignaciones registradas</h3>
                        <?php } ?>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Total de inicios de sesión de usuarios por mes</h6>   
                    </div>
                    <div class="card-body">
                       <div class="chart-area d-flex justify-content-center align-items-center">
                       <?php if($registros){?>
                           <canvas id="inicios">
                           </canvas>
                         <?php }else{ ?>
                           <h3>No hay inicios de sesión registrados</h3>
                         <?php } ?>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Diagrama de cantidad de usuarios por rol</h6>   
                  </div>
                  <div class="card-body">
                      <div class="chart-pie pt-4 pb-2">
                          <canvas id="rol"></canvas>
                      </div>
                      <div class="mt-4 text-center small">
                          <span class="mr-2">
                              <i class="fas fa-circle text-primary"></i> Coordinador Misional
                          </span>
                          <span class="mr-2">
                              <i class="fas fa-circle text-success"></i> Coordinador
                          </span>
                          <span class="mr-2">
                              <i class="fas fa-circle text-info"></i> Instructor
                          </span>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Diagrama de usuarios Registrados por genero</h6>   
                  </div>
                  <div class="card-body">
                      <div class="chart-pie pt-4 pb-2">
                          <canvas id="genero"></canvas>
                      </div>
                      <div class="mt-4 text-center small">
                          <span class="mr-2">
                              <i class="fas fa-circle" style="color: #FFFF00;"></i> Femenino
                          </span>
                          <span class="mr-2">
                              <i class="fas fa-circle" style="color: #828282;"></i> Masculino
                          </span>
                          <span class="mr-2">
                              <i class="fas fa-circle" style="color: #0833a2;"></i> Otros
                          </span>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-12">
              <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <h6 class="m-0 font-weight-bold text-primary">Total de inicios de sesión por mes</h6>   
                  </div>
                  <div class="card-body">
                     <div class="chart-area d-flex justify-content-center align-items-center">
                     <?php if($registros){?>
                         <canvas id="sesion">
                         </canvas>
                       <?php }else{ ?>
                         <h3>No hay inicios de sesión registrados</h3>
                       <?php } ?>
                     </div>
                  </div>
              </div>
          </div>
        </div>
</div> 
