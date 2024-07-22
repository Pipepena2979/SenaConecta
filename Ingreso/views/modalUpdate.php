<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Datos de la programación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-12">         
                <label for="enDoc" class="col-sm-12 control-label">Instructor a cargo</label>
                <input type="text" class="form-control" value="<?=$_SESSION['nombres']?> <?=$_SESSION['apellidos']?>" required disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="enivel" class="col-sm-12 control-label">Nivel academico</label>
                <input type="text" class="form-control" id="nivA" required disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="enTitulacion" class="col-sm-12 control-label">Nombre de la titulacion</label>
                <input type="text" class="form-control" id="nomT" required disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="etCompetencia" class="col-sm-12 control-label">Tipo competencia</label>
                <input type="text" class="form-control" id="tipC" required disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="eCompetencia" class="col-sm-12 control-label">Competencia</label>
                <input type="text" class="form-control" id="com" required disabled>
              </div>
              <div class="form-group col-md-12">
                <label for="amb" class="col-sm-12 control-label">Ambiente</label>
                <input type="text" class="form-control" id="amb" required disabled>
              </div>
              <div class="form-group col-md-4">
                <label for="efecha_asignacion" class="col-sm-12 control-label">Fecha de asignación</label>
                <input type="date" class="form-control" name="efecha_asignacion" id="efecha_asignacion" value="" required disabled> 
              </div>
              <div class="form-group col-md-4">
                <label for="ehora_Inicio" class="col-sm-12 control-label">Hora de inicio de la asignación</label>
                <input type="time" class="form-control" name="ehora_Inicio" id="ehora_Inicio" required disabled>
              </div>
              <div class="form-group col-md-4">
                <label for="ehora_Fin" class="col-sm-12 control-label">Hora de fin de la asignación</label>
                <input type="time" class="form-control" name="ehora_Fin" id="ehora_Fin" required disabled>
              </div>
                    <!-- fin -->

              <div class="form-group col-md-12"><hr></div>    
              <div class="form-group col-md-12">
                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Salir</button>
              </div>
              
            </div>
          </div>
    
    </div>
  </div>
</div>