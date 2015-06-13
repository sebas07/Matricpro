<body>
<div id="header">
    <nav id="meuA" class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav">
                <li><a href="<?=base_url()?>welcome"><strong>Principal</strong></a></li>
                <li><a href="<?=base_url()?>carrera"><strong>Carreras</strong></a></li>
                <li><a href="<?=base_url()?>curso"><strong>Cursos</strong></a></li>
                <li><a href="<?=base_url()?>profesor"><strong>Profesores</strong></a></li>
                <li><a href="<?=base_url()?>estudiante/"><strong>Estudiantes</strong></a></li>
                <li><a href="<?=base_url()?>administrador/"><strong>Administradores</strong></a></li>
                <li><a href="<?=base_url()?>especialidad/"><strong>Especialidades</strong></a></li>
            </ul>
        </div>
    </nav>
</div>

<div id="contenido">

<?php if(isset($cursoPadre)) echo $cursoPadre?>