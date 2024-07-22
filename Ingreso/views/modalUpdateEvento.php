<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar programación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php if($_SESSION['rol'] == 1 OR $_SESSION['rol'] == 4){?>
        <?php if($contadorIns2 > 0){?>
            <form name="formEventoUpdate" id="formEventoUpdate" action="UpdateEvento.php" class="form-horizontal" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <input type="hidden" class="form-control" name="idEvento" id="idEvento" required>          
                    <label for="enDoc" class="col-sm-12 control-label">Instructor a cargo</label>
                    <select class="form-control" name="enDoc" id="enDoc" >
                      <option value="" selected disabled>Selecciona una opción</option>
                      <?php foreach($resulIns2 AS $r){?>
                        <option value="<?=$r['num_doc']?>"><?=$r['nombres']?> <?=$r['apellidos']?></option> 
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="enivel" class="col-sm-12 control-label">Nivel academico</label>
                    <select class="form-control" name="enivel" id="enivel">
                      <option value=""  selected disabled>Selecciona una opción</option>
                      <?php foreach($resulNivel AS $r){?>
                        <option value="<?=$r['id']?>"><?=$r['nom_nivel']?></option> 
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="enrubro" class="col-sm-12 control-label">Rubro</label>
                    <select class="form-control" name="enrubro" id="enrubro">
                      <option value=""  selected disabled>Selecciona una opción</option>
                      <?php foreach($resulrubro AS $r){?>
                        <option value="<?=$r['id']?>"><?=$r['nombreRubro']?></option> 
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="enTitulacion" class="col-sm-12 control-label">Nombre de la titulacion</label>
                    <select class="form-control" name="enTitulacion" id="enTitulacion" >
                      <option value="" selected disabled>Selecciona una opción</option>
                      <?php foreach($resulEstructura AS $r){?>
                        <option value="<?=$r['codigo_prog']?>"><?=$r['denominacion_prog']?></option> 
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="etCompetencia" class="col-sm-12 control-label">Tipo competencia</label>
                    <select class="form-control" name="etCompetencia" id="etCompetencia" >
                      <option value="" selected disabled>Selecciona una opcion</option>
                      <?php foreach($resulTipoCompetencia AS $r){?>
                        <option value="<?=$r['id']?>"><?=$r['tipo']?></option> 
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="eCompetencia" class="col-sm-12 control-label">Competencia</label>
                    <select class="form-control" name="eCompetencia" id="eCompetencia" >
                      <option value="" selected disabled>Selecciona una opcion</option>
                      <?php foreach($resulCompetencia AS $r){?>
                        <option value="<?=$r['cod_competencia']?>"><?=$r['nom_competencia']?></option> 
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                  <label for="nivel" class="col-sm-12 control-label">Ambiente de Aprendizaje</label>
                    <select class="form-control" name="eambiente" id="eambiente">
                      <option value=""  selected disabled>Selecciona una opción</option>
                      <?php foreach($resuambiente AS $r){?>
                      <option value="<?=$r['id']?>"><?=$r['ambiente']?></option> 
                      <?php }?>
                    </select>
                  </div>         
                  <div class="form-group col-md-4">
                    <label for="efecha_asignacion" class="col-sm-12 control-label">Fecha de asignación</label>
                    <input type="date" class="form-control" name="efecha_asignacion" id="efecha_asignacion" value="" required> 
                  </div>
                  <div class="form-group col-md-4">
                    <label for="ehora_Inicio" class="col-sm-12 control-label">Hora de inicio de la asignación</label>
                    <input type="time" class="form-control" name="ehora_Inicio" id="ehora_Inicio" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="ehora_Fin" class="col-sm-12 control-label">Hora de fin de la asignación</label>
                    <input type="time" class="form-control" name="ehora_Fin" id="ehora_Fin" required>
                  </div>
                        <!-- fin --> 
                  <div class="form-group col-md-12"><hr></div>    
                  <div class="form-group col-md-6">
                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Salir</button>
                  </div>
                  <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-success btn-block">Guardar Evento</button>
                  </div>
                </div>
              </div>
            </form>
        <?php }else{?>

            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-12">
                  <center><h5><?=$_SESSION['nombres']?>, no hay instrutores disponibles para poder realizar la modifición de la programación</h5></center><hr>
                </div>

                <div class="form-group col-md-12">
                  <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Salir</button>
                </div>
              </div>
            </div>

        <?php }?>

      <?php }else{?>
        <?php if($contadorIns > 0){?>
          <form name="formEventoUpdate" id="formEventoUpdate" action="UpdateEvento.php" class="form-horizontal" method="POST">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <input type="hidden" class="form-control" name="idEvento" id="idEvento" required>          
                  <label for="enDoc" class="col-sm-12 control-label">Instructor a cargo</label>
                  <select class="form-control" name="enDoc" id="enDoc" >
                    <option value="" selected disabled>Selecciona una opción</option>
                    <?php foreach($resulIns AS $r){?>
                      <option value="<?=$r['num_doc']?>"><?=$r['nombres']?> <?=$r['apellidos']?></option> 
                    <?php }?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="enrubro" class="col-sm-12 control-label">Tipo de Rubro</label>
                    <select class="form-control" name="enrubro" id="enrubro">
                      <option value=""  selected disabled>Selecciona una opción</option>
                      <?php foreach($resulrubro AS $r){?>
                        <option value="<?=$r['id']?>"><?=$r['nombreRubro']?></option> 
                      <?php }?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="enivel" class="col-sm-12 control-label">Nivel academico</label>
                  <select class="form-control" name="enivel" id="enivel">
                    <option value=""  selected disabled>Selecciona una opción</option>
                    <?php foreach($resulNivel AS $r){?>
                      <option value="<?=$r['id']?>"><?=$r['nom_nivel']?></option> 
                    <?php }?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="enTitulacion" class="col-sm-12 control-label">Nombre de la titulacion</label>
                  <select class="form-control" name="enTitulacion" id="enTitulacion" >
                    <option value="" selected disabled>Selecciona una opción</option>
                    <?php foreach($resulEstructura AS $r){?>
                      <option value="<?=$r['codigo_prog']?>"><?=$r['denominacion_prog']?></option> 
                    <?php }?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="etCompetencia" class="col-sm-12 control-label">Tipo competencia</label>
                  <select class="form-control" name="etCompetencia" id="etCompetencia" >
                    <option value="" selected disabled>Selecciona una opcion</option>
                    <?php foreach($resulTipoCompetencia AS $r){?>
                      <option value="<?=$r['id']?>"><?=$r['tipo']?></option> 
                    <?php }?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="eCompetencia" class="col-sm-12 control-label">Competencia</label>
                  <select class="form-control" name="eCompetencia" id="eCompetencia" >
                    <option value="" selected disabled>Selecciona una opcion</option>
                    <?php foreach($resulCompetencia AS $r){?>
                      <option value="<?=$r['cod_competencia']?>"><?=$r['nom_competencia']?></option> 
                    <?php }?>
                  </select>
                </div>
                <div class="form-group col-md-12">
                <label for="nivel" class="col-sm-12 control-label">Ambiente de Aprendizaje</label>
                <select class="form-control" name="eambiente" id="eambiente">
                  <option value=""  selected disabled>Selecciona una opción</option>
                  <?php foreach($resuambiente AS $r){?>
                    <option value="<?=$r['id']?>"><?=$r['ambiente']?></option> 
                  <?php }?>
                </select>
                </div>     
                <div class="form-group col-md-4">
                  <label for="efecha_asignacion" class="col-sm-12 control-label">Fecha de asignación</label>
                  <input type="date" class="form-control" name="efecha_asignacion" id="efecha_asignacion" value="" required> 
                </div>
                <div class="form-group col-md-4">
                  <label for="ehora_Inicio" class="col-sm-12 control-label">Hora de inicio de la asignación</label>
                  <input type="time" class="form-control" name="ehora_Inicio" id="ehora_Inicio" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="ehora_Fin" class="col-sm-12 control-label">Hora de fin de la asignación</label>
                  <input type="time" class="form-control" name="ehora_Fin" id="ehora_Fin" required>
                </div>
                      <!-- fin -->

                <div class="form-group col-md-12"><hr></div>    
                <div class="form-group col-md-6">
                  <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Salir</button>
                </div>
                <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-success btn-block">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </form>
        <?php }else{?>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-12">
                  <center><h5><?=$_SESSION['nombres']?>, no tiene instrutores a su cargo para poder realizar la modifición de la programación</h5></center><hr>
                </div>

                <div class="form-group col-md-12">
                  <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Salir</button>
                </div>
              </div>
            </div>
        <?php }?>
      <?php }?>

    </div>
  </div>
</div>