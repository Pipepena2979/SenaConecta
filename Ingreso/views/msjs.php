

<?php
if(isset($_REQUEST['eRep'])){ ?>
<div class="form-group col-md-12">
    <div class="alert alert-danger alert-dismoissible fade show" role="alert">
      Alerta, una fecha esta repetida!, asegurese que los dias de la programación no esten repetidos.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
</div>
<?php } ?>

<?php
if(isset($_REQUEST['eHora'])){ ?>
<div class="form-group col-md-12">
    <div class="alert alert-danger alert-dismoissible fade show" role="alert">
      Alerta!, asegurese que la hora de inicio sea mayor a la hora de fin.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
</div>
<?php } ?>

<?php
if(isset($_REQUEST['eD'])){ ?>
<div class="form-group col-md-12">
    <div class="alert alert-danger alert-dismoissible fade show" role="alert">
      Alerta!, este Instructor ya esta asigando en este horario ( <?=$_REQUEST['eD']?> ).
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
</div>
<?php } ?>
<?php
if(isset($_REQUEST['eE'])){ ?>
<div class="form-group col-md-12">
    <div class="alert alert-danger alert-dismoissible fade show" role="alert">
      Alerta!, esta titulación ya fue asiganda en este horario ( <?=$_REQUEST['eE']?> ).
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
</div>
<?php } ?>
<?php
if(isset($_REQUEST['e'])){ ?>
<div class="form-group col-md-12">
    <div class="alert alert-success alert-dismoissible fade show" role="alert">
      Felicitaciones!, El evento fue registrado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
</div>
<?php } ?>

<?php
if(isset($_REQUEST['ea'])){ ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <strong>Felicitaciones!</strong> El evento fue actualizado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

<div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="display: none;">
  <strong>Felicitaciones!</strong> El evento fue borrado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

