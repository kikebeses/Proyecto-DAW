<?php
require_once("bd.php");
class LineasFacturasModelo extends BD
{
    // Campos de la tabla 'lineas_factura'.
    public $id;          
    public $factura_id;
    public $referencia;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $iva;
    public $importe; // Este se calculará con la fórmula.

    
    public $filas = null;

    public function Insertar()
    {
        $this->importe = $this->cantidad * $this->precio * (1 + $this->iva / 100.0);

        // 2. Sentencia SQL. Omitimos 'id' por ser autoincremental.
        $sql = "INSERT INTO lineasfacturas (
                    factura_id, referencia, descripcion, cantidad, precio, iva, importe
                ) VALUES (
                    '$this->factura_id',
                    '$this->referencia',
                    '$this->descripcion',
                    '$this->cantidad',
                    '$this->precio',
                    '$this->iva',
                    '$this->importe'
                )";

        return $this->_ejecutar($sql);
    }

    public function Modificar()
    {
        // 1.CÁLCULO DEL IVA
        $this->importe = $this->cantidad * $this->precio * (1 + $this->iva / 100.0);

        // 2. Sentencia SQL.
        $sql = "UPDATE lineasfacturas SET" .
               " factura_id='$this->factura_id'," .
               " referencia='$this->referencia'," .
               " descripcion='$this->descripcion'," .
               " cantidad='$this->cantidad'," .
               " precio='$this->precio'," .
               " iva='$this->iva'," .
               " importe='$this->importe'" .
               " WHERE id=$this->id";

        return $this->_ejecutar($sql);
    }

    public function Borrar()
    {
        // Sentencia SQL.
        $sql = "DELETE FROM lineasfacturas WHERE id=$this->id";

        return $this->_ejecutar($sql);
    }

    public function Seleccionar()
    {
        $sql = 'SELECT * FROM lineasfacturas';

        // Si me han pasado un id, obtenemos solo el registro indicado.
        if ($this->id != 0)
            $sql .= " WHERE id=$this->id";

        $this->filas = $this->_consultar($sql);

        if ($this->filas == null)
            return false;

        if ($this->id != 0)
        {
            // Guardamos los campos de la línea de factura en las propiedades.
            $this->id           = $this->filas[0]->id;
            $this->factura_id   = $this->filas[0]->factura_id;
            $this->referencia   = $this->filas[0]->referencia;
            $this->descripcion  = $this->filas[0]->descripcion;
            $this->cantidad     = $this->filas[0]->cantidad;
            $this->precio       = $this->filas[0]->precio;
            $this->iva          = $this->filas[0]->iva;
            $this->importe      = $this->filas[0]->importe;

        }

        return true;
    }
}
?>