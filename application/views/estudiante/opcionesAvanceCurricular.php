<h4>Seleccione la carrera para ver el expediente académico</h4>
<?php $this->load->helper('form') ?>
<form method="get" action="mostrarAvance"/>
<select class="carrera" name="idCarrera">
    <?php foreach($carreras->result() as $carrera){ ?>
        <option value="<?= $carrera->idCarrera ?>"><?= $carrera->nombre ?></option>
    <?php } ?>
</select>
<input class="btn btn-info" type="submit" value="Continuar">
</form>
