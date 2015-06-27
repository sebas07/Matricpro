<h2>Lista de cursos que puede matricular</h2>
<div clas="table-responsive">
    <table class="table table-striped">
        <tr>
            <th>Sigla</th>
            <th>Nombre del curso</th>
            <th>Grupo</th>
            <th>Cupo disponible</th>
            <th>Profesor</th>
            <th>Semestre</th>
            <th>Año</th>
            <th>Opciones</th>
        </tr>
        <?php
        if($cursoshijo){
        foreach ($cursoshijo->result() as $cursohijo) { ?>
        <tr>
            <?php foreach($cursos->result() as $curso) {
            if ($cursohijo->idCurso == $curso->idCurso) {
            ?>
            <td><?= $curso->sigla ?></td>
            <td><?= $curso->nombre ?></td>
            <?php
            }
            } ?>
            <td><?= $cursohijo->grupo; ?></td>
            <td><?= $cursohijo->capacidad; ?></td>
            <?php foreach($profesores->result() as $profesor) {
                if ($cursohijo->idProfesor == $profesor->idProfesor) {
                    ?>
                    <td><?= $profesor->nombre .' '. $profesor->apellido1 .' '. $profesor->apellido2 ?></td>
                <?php
                }
            } ?>
            <td><?= $cursohijo->estado; ?></td>
            <td><?= $cursohijo->año; ?></td>
            <td>
                <a type="btn" class="btn btn-success" href="">Matricular</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<br/>
<h2>Lista de cursos matriculados</h2>
<?php }
else {
    echo "<p>error en la app</p>";
}
?>
</body>
</html>