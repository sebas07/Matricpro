<h1>Matricpro</h1>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h2>Datos del usuario</h2>
        <hr />
        <?php if(isset($profesor)): ?>
        <?= form_open(base_url().'profesor/editarDatos') ?>
            <?php
                foreach($profesor->result() as $profe):
                    $nombre = array('name' => 'nombre', 'value' => $profe->nombre, 'placeholder' => 'Escriba su nombre', 'class' => 'form-control');
                    $apellido1 = array('name' => 'apellido1', 'value' => $profe->apellido1, 'placeholder' => 'Escriba su primer apellido', 'class' => 'form-control');
                    $apellido2 = array('name' => 'apellido2', 'value' => $profe->apellido2, 'placeholder' => 'Escriba su segundo apellido', 'class' => 'form-control');
                    $cedula = array('name' => 'cedula', 'value' => $profe->cedula, 'placeholder' => 'Escriba su número de cédula', 'class' => 'form-control');
                endforeach;
            ?>
            <?= form_label('Nombre: ', 'nombre'); ?>
            <?= form_input($nombre) ?>
            <?= form_label('Primer apellido: ', 'apellido1'); ?>
            <?= form_input($apellido1) ?>
            <?= form_label('Segundo apellido: ', 'apellido2'); ?>
            <?= form_input($apellido2) ?>
            <?= form_label('Cedula: ', 'cedula'); ?>
            <?= form_input($cedula) ?>
            <br />
            <?= form_submit('btnAceptar', 'Guardar cambios', 'class="form-control btn btn-primary" onclick="return mensaje()"') ?>
        <?= form_close() ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function mensaje() {
        return confirm('¿Realmente desea guardar los cambios?');
    }
</script>
<!--        --><?php //foreach($profesor->result() as $profe): ?>
<!--            --><?php //echo $profe->nombre; ?>
<!--        --><?php //endforeach; ?>