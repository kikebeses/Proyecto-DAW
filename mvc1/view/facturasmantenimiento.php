<?php require("layout/header.php"); ?>
<h1>facturas</h1>
<br />
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>
<form action="<?php echo 'index.php?c=facturas&m=' .
    ($opcion == 'EDITAR' ? 'modificar&id=' . $factura->id : 'insertar'); ?>" method="POST">
    <label for="cliente_id" class="form-label">cliente_id</label>
    <select class="form-control" name="cliente_id" id="cliente_id" required>
    <?php

    if ($opcion == 'NUEVA') :

    ?>
    <option value="" disabled select>Seleccionar cliente></option>

    <?php
    endif;
    foreach ($clientes->filas as $cliente) :
     ?>
        <option value="<?php echo $cliente->id; ?>" 
        <?php
        if ($opcion == 'EDITAR') 
            echo ($cliente->id == $factura->$cliente_id ? 'selected' : '');?>
        >
            <?php echo $cliente->nombre; ?>    
        </option>
    
     <?php
     endforeach;
     ?>
    </select>
    <br />
    <label for="numero" class="form-label">numero</label>
    <input type="text" class="form-control" name="numero" id="numero"
        value="<?php echo ($opcion == 'EDITAR' ? $factura->numero : ''); ?>" required />
    <br />

    <label for="fecha" class="form-label">fecha</label>
    <input type="date" class="form-control" name="fecha" id ="fecha"
        value="<?php echo ($opcion == 'EDITAR' ? $factura->fecha : ''); ?>" required />

    <br />        
    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=facturas'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>
<?php require("layout/footer.php"); ?>