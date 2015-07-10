<br />
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Ingreso de profesores</h1>
        <hr />
        <?= form_open('verifyLogin/profesor') ?>
        <?php
        $cedula = array('name' => 'cedula', 'placeholder' => 'Escriba su número de cédula', 'class' => 'form-control');
        $contrasenna = array('name' => 'contrasenna', 'placeholder' => 'Escriba su contraseña', 'class' => 'form-control');
        ?>
        <?= form_label('Número de cédula: ', 'cedula') ?>
        <?= form_input($cedula) ?>
        <br /><br />
        <?= form_label('Contraseña: ', 'contrasenna'); ?>
        <?= form_password($contrasenna) ?>
        <br />
        <br />
        <?= form_submit('btnIngresar', 'Ingresar', 'class="form-control btn btn-primary"'); ?>
        <?= form_close() ?>
        <br />
<!--        --><?php //echo validation_errors('<p class="error">'); ?>
    </div>
    <div class="col-md-4">
        <h4>Ingresar como:</h4>
        <a href="<?= base_url(); ?>logueo">Estudiante </a>
        |
        <a href="<?= base_url(); ?>logueo/administradores"> Administrador</a>
    </div>
</div>
<br />