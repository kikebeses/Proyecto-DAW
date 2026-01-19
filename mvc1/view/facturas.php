<?php require("layout/header.php"); ?>
<h1>facturas</h1>
<br />
<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>.
            <th>Id Cliente</th>
            <th>Número</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($factura->filas):
            foreach ($factura->filas as $fila):
                ?>
                <tr>
                    <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
                    <td><?php echo $fila->id; ?></td>
                    <td><?php echo $fila->cliente_id; ?></td>
                    <td><?php echo $fila->numero; ?></td>
                    <td><?php echo $fila->fecha; ?></td>
                    <td style="text-align: right; width: 50%;">
                        <a href="index.php?c=lineasfacturas&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-primary">Lineas_facturas</button>
                        </a>
                        <a href="index.php?c=facturas&m=editar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-success">Editar</button></a>
                        <a href="index.php?c=facturas&m=borrar&id=<?php echo $fila->id; ?>">
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
                <a href="index.php?c=facturas&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>

                <a href="index.php?c=facturas&m=exportar">
                    <button type="button" class="btn btn-success">Exportar</button>

                    </a>
                    <a href="index.php?c=facturas&m=imprimir" target="_blank">
                    <button type="button" class="btn btn-primary">Imprimir</button>
            </td>
        </tr>
    </tfoot>
</table>
<?php require("layout/footer.php"); ?>