<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h2>Datos del usuario</h2>
        <hr />
        <?php if(isset($profesor)): ?>
            <?= form_open(base_url().'profesor/editarDatos') ?>
                <?php
                    foreach($profesor as $profe):
                        $nombre_p = array('name' => 'nombre_p', 'value' => $profesor->nombre, 'placeholder' => 'Escriba su nombre', 'class' => 'form-control', 'disabled' => 'disabled');
                        $apellido1_p = array('name' => 'apellido1_p', 'value' => $profesor->apellido1, 'placeholder' => 'Escriba su primer apellido', 'class' => 'form-control', 'disabled' => 'disabled');
                        $apellido2_p = array('name' => 'apellido2_p', 'value' => $profesor->apellido2, 'placeholder' => 'Escriba su segundo apellido', 'class' => 'form-control', 'disabled' => 'disabled');
                        $cedula_p = array('name' => 'cedula_p', 'value' => $profesor->cedula, 'placeholder' => 'Escriba su número de cédula', 'class' => 'form-control', 'disabled' => 'disabled');
                    endforeach;
                ?>
                <?= form_label('Nombre: ', 'nombre_p'); ?>
                <?= form_input($nombre_p) ?>
                <?= form_label('Primer apellido: ', 'apellido1_p'); ?>
                <?= form_input($apellido1_p) ?>
                <?= form_label('Segundo apellido: ', 'apellido2_p'); ?>
                <?= form_input($apellido2_p) ?>
                <?= form_label('Cedula: ', 'cedula_p'); ?>
                <?= form_input($cedula_p) ?>
                <br />
                <a class="btn btn-warning" href="<?= base_url(); ?>profesor/cambio_contrasena">Cambiar contraseña</a>
            <?= form_close() ?>
        <?php elseif(isset($administrador)): ?>
            <?= form_open('#') ?>
                <?php
                    $nombre_a = array('name' => 'nombre_a', 'value' => $administrador->nombre, 'class' => 'form-control', 'disabled' => 'disabled');
                    $apellido1_a = array('name' => 'apellido1_a', 'value' => $administrador->apellido1, 'class' => 'form-control', 'disabled' => 'disabled');
                    $apellido2_a = array('name' => 'apellido2_a', 'value' => $administrador->apellido2, 'class' => 'form-control', 'disabled' => 'disabled');
                    $cedula_a = array('name' => 'cedula_a', 'value' => $administrador->cedula, 'class' => 'form-control', 'disabled' => 'disabled');
                ?>
                <?= form_label('Nombre: ', 'nombre_a'); ?>
                <?= form_input($nombre_a) ?>
                <?= form_label('Primer apellido: ', 'apellido1_a'); ?>
                <?= form_input($apellido1_a) ?>
                <?= form_label('Segundo apellido: ', 'apellido2_a'); ?>
                <?= form_input($apellido2_a) ?>
                <?= form_label('Cedula: ', 'cedula_a'); ?>
                <?= form_input($cedula_a) ?>
                <br />
                <a class="btn btn-warning" href="<?= base_url() ?>administrador/cambioContrasenna">Cambiar contraseña</a>
            <?= form_close() ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function mensaje() {
        return confirm('¿Realmente desea guardar los cambios?');
    }
</script>