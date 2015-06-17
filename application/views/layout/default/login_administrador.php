<br />
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Ingreso de administradores</h1>
        <hr />
        <?= form_open('verifyLogin/administrador') ?>
        <?php
        $cedula = array('name' => 'cedula', 'placeholder' => 'Escriba su numero de cedula', 'class' => 'form-control');
        $contrasenna = array('name' => 'contrasenna', 'placeholder' => 'Contrasenna', 'class' => 'form-control');
        ?>
        <?= form_label('Cedula: ', 'cedula') ?>
        <?= form_input($cedula) ?>
        <br /><br />
        <?= form_label('Contrasenna: ', 'contrasenna'); ?>
        <?= form_password($contrasenna) ?>
        <br />
        <br />
        <?= form_submit('btnIngresar', 'Ingresar', 'class="form-control btn btn-primary"'); ?>
        <?= form_close() ?>
        <br />
        <?php echo validation_errors('<p class="error">'); ?>
    </div>
    <div class="col-md-4">
        <h4>Ingresar como:</h4>
        <a href="<?= base_url(); ?>logueo/profesores">Profesor </a>
        |
        <a href="<?= base_url(); ?>logueo"> Estudiante</a>
    </div>
</div>
<br />