<h2>Lista de cursos que puede matricular</h2>
<div clas="table-responsive">
    <?php $this->load->helper('form') ?>
    <form method="post" action="matricular"/>
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
                <td value><?= $curso->sigla ?></td>
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
                    <input class="btn btn-success" id="matricula" type="submit" value="Matricular">
                </td>
            </tr>
            <?php } ?>
        </table>
    </form>
</div>
<br/>
<?php }
else {
    echo "<p>error en la app</p>";
}
?>
</body>
</html>