<?php require("layout/header.php"); ?>
<h1>CLIENTES</h1>
<br />
<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Apellidos</th>
            <th>Contrasenya</th>
            <th>Direccion</th>
            <th>CP</th>
            <th>Poblacion</th>
            <th>Provincia</th>
            <th>Fecha_nacimiento</th>

            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($clientes->filas):
            foreach ($clientes->filas as $fila):
                ?>
                <tr>
                    <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
                    <td><?php echo $fila->nombre; ?></td>
                    <td><?php echo $fila->email; ?></td>
                    <td><?php echo $fila->apellidos; ?></td>
                    <td><?php echo $fila->contrasenya; ?></td>
                    <td><?php echo $fila->direccion; ?></td>
                    <td><?php echo $fila->cp; ?></td>
                    <td><?php echo $fila->poblacion; ?></td>
                    <td><?php echo $fila->provincia; ?></td>
                    <td><?php echo $fila->fecha_nacimiento; ?></td>

                    <td style="text-align: right; width: 50%;">
                        <a href="index.php?c=clientes&m=editar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-success">Editar</button></a>
                        <a href="index.php?c=clientes&m=borrar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-danger borrar" onclick="return confirm('¿Estás seguro de borrar el registro <?php
                            echo $fila->id; ?>?');">Borrar</button></a>
                    </td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <a href="index.php?c=clientes&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                    <a href="index.php?c=clientes&m=exportar">
                    <button type="button" class="btn btn-success">Exportar</button>
                    <a href="index.php?c=clientes&m=exportar">
                    <button type="button" class="btn btn-success">ExportarJSON</button>
                    </a>
                    <a href="index.php?c=clientes&m=imprimir" target="_blank">
                    <button type="button" class="btn btn-primary">Imprimir</button>

                    </a>
                </a>
            </td>
        </tr>
    </tfoot>
</table>
<?php require("layout/footer.php"); ?>