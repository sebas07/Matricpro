<body>
<div id="header">
    <div id="nombreAplicacion">
        <h3><?=APP_NAME?></h3>
    </div>

    <nav id="menu">
        <ul id="top_menu">

            <a href="<?=base_url()?>welcome/cerrarSesion"><li>Salir</li></a>
            <a href="<?=base_url()?>usuario"><li>Administar</li></a>
            <a href="<?=base_url()?>especialidad"><li>Especialidades</li></a>
            <a href="<?=base_url()?>curso"><li>Cursos</li></a>
            <a href="<?=base_url()?>profesor"><li>Profesor</li></a>
            <a href="<?=base_url()?>estudiante"><li>Estudiante</li></a>
            <a href="<?=base_url()?>welcome"><li>Inicio</li></a>

        </ul>

    </nav>


</div>
<div id="usuario">
    <div id="usuariotexto">
        <p>
            <?=$usuario?>
        </p>
    </div>

</div>
<div id="contenido">