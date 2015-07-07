<h2>Lista de cursos matriculados</h2>
<div class="table-responsive">
    <?php $this->load->helper('form') ?>
    <table class="table table-striped">
        <tr>
            <th>Sigla</th>
            <th>Nombre del curso</th>
            <th>Grupo</th>
            <th>Profesor</th>
            <th>Semestre</th>
            <th>Año</th>
            <th>Opciones</th>
        </tr>
        <?php
        if(isset($cursoshijo)){
        foreach ($cursoshijo->result() as $cursohijo) { ?>
            <tr>
                <?php foreach($cursos->result() as $curso) {
                    if($cursohijo->idCurso == $curso->idCurso) {
                        ?>
                        <td><?= $curso->sigla ?></td>
                        <td><?= $curso->nombre ?></td>
                    <?php
                    }
                } ?>
                <td><?= $cursohijo->grupo; ?></td>
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

                    <a class="btn btn-danger" onclick="return confirm('¿Esta seguro que desea retirar el curso?')"
                       href="<?= base_url(); ?>matricula/retirar/<?= $cursohijo->idEstudiantePorCurso;?>">Retirar</a>

            </td>
            </tr>
        <?php } ?>
    </table>
</div>
<br/>
<?php }
else {
    echo "<p>error en la app</p>";
}
?>
</body>
</html>