<h4>Seleccione la carrera</h4>
<?php $this->load->helper('form') ?>
<form method="post" action="listaCursos"/>
    <select class="carrera" name="idCarrera">
        <?php foreach($carreras->result() as $carrera){ ?>
            <option value="<?= $carrera->idCarrera ?>"><?= $carrera->nombre ?></option>
        <?php } ?>
    </select>
    <input id="obtenerCarrera" type="submit" value="Continuar">
</form>
