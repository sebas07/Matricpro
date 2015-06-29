<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h2>Cambio de contraseña</h2>
        <hr />
        <?php
            $formulario = array('name' => 'cambio');
            $actual = array('name'=>'actual','placeholder'=>'Escriba su contraseña actual','class'=>'form-control');
            $contrasena = array('name' => 'contrasena', 'placeholder' => 'Escriba su nueva contraseña', 'class' => 'form-control');
            $contrasena2 = array('name' => 'contrasena2', 'placeholder' => 'Confirme su contraseña', 'class' => 'form-control');
        ?>
        <?= form_open(base_url().'profesor/cambiar_contrasena', $formulario) ?>
            <?= form_label('Actual: ', 'actual'); ?>
            <?= form_input($actual) ?>
            <?= form_label('Nueva: ', 'contrasena'); ?>
            <?= form_input($contrasena) ?>
            <?= form_label('Confirmar: ', 'contrasena2'); ?>
            <?= form_input($contrasena2) ?>
            <br />
            <?= form_submit('btnAceptar', 'Guardar cambios', 'class="form-control btn btn-primary" onclick="return mensaje()"') ?>
        <?= form_close() ?>
    </div>
</div>

<script>
    function mensaje() {
        var c = '<?php echo $profesor->contrasena; ?>';
        var a = document.forms["cambio"]["actual"].value;
        var x = document.forms["cambio"]["contrasena"].value;
        var y = document.forms["cambio"]["contrasena2"].value;
        if (a == null || a == "") {
            alert("El campo de contraseña actual debe ser completado");
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        if (x == null || x == "") {
            alert("El campo de la nueva contraseña debe ser completado");
            document.forms["cambio"]["contrasena"].focus();
            return false;
        }
        if (y == null || y == "") {
            alert("El campo de confirmación de contraseña debe ser completado");
            document.forms["cambio"]["contrasena2"].focus();
            return false;
        }
        if(a == c) {
            if (x != y) {
                alert('Las contraseñas no coinciden');
                document.forms["cambio"]["contrasena2"].focus();
                return false;
            }
        } else {
            alert('La contraseña es invalida');
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        return confirm('¿Realmente desea guardar los cambios?');
    }
</script>