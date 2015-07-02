<h2>Expediente Académico</h2>
<div class="table-responsive">
    <?php $this->load->helper('form') ?>
    <table class="table table-striped">
        <tr>
            <th>Sigla</th>
            <th>Nombre del curso</th>
            <th>Grupo</th>
            <th>Semestre</th>
            <th>Año</th>
            <th>Estado</th>
            <th>Nota</th>
        </tr>
        <?php
        if(isset($cursos)){
        foreach ($cursos->result() as $curso) { ?>
            <tr>
                <td><?= $curso->sigla ?></td>
                <td><?= $curso->nombre ?></td>
                <td><?= $curso->grupo; ?></td>
                <td><?= $curso->semestre; ?></td>
                <td><?= $curso->año; ?></td>
                <?php if($curso->NotaFinal >= 70){
                    $curso->estado = "Aprobado";
                } elseif($curso->NotaFinal == null){
                    $curso->estado = "Matriculado";
                    $curso->NotaFinal = 'MA';
                } else {
                    $curso->estado = "Reprobado";
                }
                ?>
                <td><?= $curso->estado; ?></td>
                <td><?= $curso->NotaFinal ?></td>
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