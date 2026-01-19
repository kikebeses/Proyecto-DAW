<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/facturas.php");
class FacturasControlador
{
    static function index()
    {
        $factura = new FacturasModelo();
        $factura->Seleccionar();

        require_once("view/facturas.php");
    }
    static function Nuevo()
    {

        $clientes = new ClientesModelo();
        $clientes->Seleccionar();
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/facturasmantenimiento.php");
    }
    static function Insertar()
    {
        $factura = new FacturasModelo();
        $factura->cliente_id = $_POST["cliente_id"];
        $factura->numero = $_POST["numero"];
        $factura->fecha = $_POST["fecha"];
        if ($factura->Insertar() == 1)
            header("location:" . URLSITE . '?c=factura');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "/view/error.php");
        }
    }
    static function Editar()
    {
        $factura = new FacturasModelo();
        $factura->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un factura.
        if ($factura->seleccionar())
            require_once("view/facturasmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Modificar()
    {
        $factura = new FacturasModelo();
        $factura->id = $_GET['id'];
        $factura->cliente_id = $_POST['cliente_id'];
        $factura->numero = $_POST['numero'];
        $factura->fecha = $_POST['fecha'];
       
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($factura->Modificar() == 1) || ($factura->GetError() == ''))
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Borrar()
    {
        $factura = new FacturasModelo();
        $factura->id = $_GET['id'];
        if ($factura->Borrar() == 1)
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static public function Exportar()
    {
        $facturas = new FacturasModelo();

        $facturas->Seleccionar();
        

        try {
            $fichero = fopen("facturas.csv","w");

            foreach ($facturas->filas as $fila) {

                //Esta cadena se cambia segun el formato del archivo
                $cadena = "$fila->id#$fila->cliente_id#$fila->numero#$fila->fecha\n";

                fputs($fichero, $cadena);
            }
         }

        finally{
             fclose($fichero);
        }

        $rutaFichero = 'facturas.csv';
        $fichero = basename($rutaFichero);


        header("Content-Type: application/octet-stream");
        header("Content-Lenght: ".filesize($rutaFichero));
        header("Content-Disposition: attachment; filename=".$fichero);

        readfile($rutaFichero);
    }
}
?>