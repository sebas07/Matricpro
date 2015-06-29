<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h2>Datos del usuario</h2>
        <hr />
        <?php if(isset($profesor)): ?>
            <?= form_open(base_url().'profesor/editarDatos') ?>
                <?php
                    foreach($profesor as $profe):
                        $nombre = array('name' => 'nombre', 'value' => $profesor->nombre, 'placeholder' => 'Escriba su nombre', 'class' => 'form-control', 'disabled' => 'disabled');
                        $apellido1 = array('name' => 'apellido1', 'value' => $profesor->apellido1, 'placeholder' => 'Escriba su primer apellido', 'class' => 'form-control', 'disabled' => 'disabled');
                        $apellido2 = array('name' => 'apellido2', 'value' => $profesor->apellido2, 'placeholder' => 'Escriba su segundo apellido', 'class' => 'form-control', 'disabled' => 'disabled');
                        $cedula = array('name' => 'cedula', 'value' => $profesor->cedula, 'placeholder' => 'Escriba su número de cédula', 'class' => 'form-control', 'disabled' => 'disabled');
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
                <a class="btn btn-warning" href="<?= base_url(); ?>profesor/cambio_contrasena">Cambiar contraseña</a>
            <?= form_close() ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function mensaje() {
        return confirm('¿Realmente desea guardar los cambios?');
    }
</script>