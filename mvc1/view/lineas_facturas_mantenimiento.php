<?php require("layout/header.php"); ?>
<h1>facturas</h1>
<br />
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>
<form action="<?php echo 'index.php?c=lineasfacturas&m=' .
    ($opcion == 'EDITAR' ? 'modificar&id=' . $lineas_facturas->id : 'insertar'); ?>" method="POST">
    <label for="cliente_id" class="form-label">cliente_id</label>
    <select class="form-control" name="cliente_id" id="cliente_id" required>
    <?php

    if ($opcion == 'NUEVA') :

    ?>
    <option value="" disabled select>Seleccionar cliente></option>

    <?php
    endif;
 foreach ($lineas_facturas->filas as $fila) : ?>
    <option value="<?php echo $fila->id; ?>" 
        <?php
        if ($opcion == 'EDITAR') 
            echo ($fila->id == $factura->cliente_id ? 'selected' : '');
        ?>
    >
        <?php echo $fila->nombre; ?>    
    </option>
<?php endforeach; ?>

    </select>
    <label for="referencia" class="form-label">Referencia</label>
<input type="text" class="form-control" name="referencia" id="referencia"
    value="<?php echo ($opcion == 'EDITAR' ? $lineas_facturas->referencia : ''); ?>" required />

<br />

<label for="descripcion" class="form-label">Descripción</label>
<input type="text" class="form-control" name="descripcion" id ="descripcion"
    value="<?php echo ($opcion == 'EDITAR' ? $lineas_facturas->descripcion : ''); ?>" required />

<br />

<label for="cantidad" class="form-label">Cantidad</label>
<input type="number" class="form-control" name="cantidad" id ="cantidad" step="0.001"
    value="<?php echo ($opcion == 'EDITAR' ? $lineas_facturas->cantidad : ''); ?>" required />

<br />

<label for="precio" class="form-label">Precio</label>
<input type="number" class="form-control" name="precio" id ="precio" step="0.01"
    value="<?php echo ($opcion == 'EDITAR' ? $lineas_facturas->precio : ''); ?>" required />

<br />

<label for="iva" class="form-label">IVA</label>
<input type="number" class="form-control" name="iva" id ="iva" step="0.01"
    value="<?php echo ($opcion == 'EDITAR' ? $lineas_facturas->iva : ''); ?>" required />

<br />
    <br />        
    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=lineasfacturas'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>
<?php require("layout/footer.php"); ?>