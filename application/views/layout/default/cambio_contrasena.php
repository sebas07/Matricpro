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
        <?php if(isset($profesor)): ?>
            <?= form_open(base_url().'profesor/cambiar_contrasena', $formulario) ?>
                <?= form_label('Contraseña actual: ', 'actual'); ?>
                <?= form_password($actual) ?>
                <?= form_label('Contraseña nueva: ', 'contrasena'); ?>
                <?= form_password($contrasena) ?>
                <?= form_label('Confirmar contraseña: ', 'contrasena2'); ?>
                <?= form_password($contrasena2) ?>
                <br />
                <?= form_submit('btnAceptar', 'Guardar cambios', 'class="form-control btn btn-primary" onclick="return mensajeP()"') ?>
            <?= form_close() ?>
        <?php elseif(isset($administrador)): ?>
            <?= form_open(base_url().'administrador/cambiarContrasenna', $formulario) ?>
                <?= form_label('Contraseña actual: ', 'actual'); ?>
                <?= form_password($actual) ?>
                <?= form_label('Contraseña nueva: ', 'contrasena'); ?>
                <?= form_password($contrasena) ?>
                <?= form_label('Confirmar contraseña: ', 'contrasena2'); ?>
                <?= form_password($contrasena2) ?>
                <br />
                <?= form_submit('btnAceptar', 'Guardar cambios', 'class="form-control btn btn-primary" onclick="return mensajeA()"') ?>
            <?= form_close() ?>
        <?php elseif(isset($estudiante)): ?>
            <?= form_open(base_url().'estudiante/cambiarContrasenna', $formulario) ?>
                <?= form_label('Contraseña actual: ', 'actual'); ?>
                <?= form_password($actual) ?>
                <?= form_label('Contraseña nueva: ', 'contrasena'); ?>
                <?= form_password($contrasena) ?>
                <?= form_label('Confirmar contraseña: ', 'contrasena2'); ?>
                <?= form_password($contrasena2) ?>
                <br />
                <?= form_submit('btnAceptar', 'Guardar cambios', 'class="form-control btn btn-primary" onclick="return mensajeE()"') ?>
            <?= form_close() ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function mensajeP() {
        var c = '<?php if(isset($profesor)) { echo $profesor->contrasena; } ?>';
        var a = document.forms["cambio"]["actual"].value;
        var x = document.forms["cambio"]["contrasena"].value;
        var y = document.forms["cambio"]["contrasena2"].value;
        if (a == null || a == "") {
            alert("El campo de contraseña actual debe ser completado");
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        if (x == null || x == "") {
            alert("El campo de contraseña nueva debe ser completado");
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
            alert('La contraseña es inválida');
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        return confirm('¿Realmente desea guardar los cambios realizados?');
    }
    function mensajeA() {
        var c = '<?php if(isset($administrador)) {echo $administrador->contrasena; } ?>';
        var a = document.forms["cambio"]["actual"].value;
        var x = document.forms["cambio"]["contrasena"].value;
        var y = document.forms["cambio"]["contrasena2"].value;
        if (a == null || a == "") {
            alert("El campo de contraseña actual debe ser completado");
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        if (x == null || x == "") {
            alert("El campo de contraseña nueva debe ser completado");
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
            alert('La contraseña es inválida');
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        return confirm('¿Realmente desea guardar los cambios realizados?');
    }
    function mensajeE() {
        var c = '<?php if(isset($estudiante)) {echo $estudiante->contrasena; } ?>';
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
            alert('La contraseña es inválida');
            document.forms["cambio"]["actual"].focus();
            return false;
        }
        return confirm('¿Realmente desea guardar los cambios realizados?');
    }
</script>