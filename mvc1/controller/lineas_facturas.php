<?php
// Asegura que la sesión esté iniciada.
if (session_status() === PHP_SESSION_NONE)
    session_start();

// Importamos el nuevo modelo de líneas de factura.
require_once("model/lineas_facturas.php");
// Es posible que necesites el modelo de Clientes/Productos para las vistas de mantenimiento.
// require_once("model/ClientesModelo.php"); 
// require_once("model/ProductosModelo.php");

class LineasFacturasControlador
{
    /**
     * Muestra el listado de líneas de factura (o quizás las líneas de una factura específica).
     */
    static function index()
    {

 $factura = new FacturasModelo();
 $factura->id = $_GET["id"];
        $factura->Seleccionar();

        $lineas_facturas = new LineasFacturasModelo();
        $lineas_facturas->factura_id = $_GET["id"];
        $lineas_facturas->Seleccionar(); // Obtiene todas las líneas o las de un ID si se usa.

        // Cambia la vista al listado de líneas (que estará anidado en la factura principal).
        require_once("view/lineas_facturas.php"); 
    }

    /**
     * Muestra la vista para añadir una nueva línea a una factura.
     */
    static function Nuevo()
    {
        $factura = new FacturasModelo();
        $factura->Seleccionar();
        
        $opcion = 'NUEVO'; 
        require_once("view/lineas_facturas_mantenimiento.php");
    }

    static function Insertar()
    {
        // 1. Instanciar el nuevo modelo.
        $linea = new LineasFacturasModelo();
        
  
        $linea->factura_id = $_POST["factura_id"];
        $linea->referencia = $_POST["referencia"];
        $linea->descripcion = $_POST["descripcion"];
        $linea->cantidad = $_POST["cantidad"];
        $linea->precio = $_POST["precio"];
        $linea->iva = $_POST["iva"]; 
        
        if ($linea->Insertar() == 1)
            // Redirigir al listado de líneas (o de vuelta a la factura principal).
            header("location:" . URLSITE . '?c=lineasfacturas&a=ver&id=' . $linea->factura_id);
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $linea = new LineasFacturasModelo();
        
        // El ID de la línea se obtiene por GET.
        $linea->id = $_GET['id'];
        $opcion = 'EDITAR'; 

        if ($linea->Seleccionar())
            // Vista de mantenimiento de línea.
            require_once("view/lineas_facturas_mantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $linea = new LineasFacturasModelo();
        
    
        $linea->id = $_GET['id'];
        $linea->factura_id = $_POST["factura_id"]; 
        $linea->referencia = $_POST["referencia"];
        $linea->descripcion = $_POST["descripcion"];
        $linea->cantidad = $_POST["cantidad"];
        $linea->precio = $_POST["precio"];
        $linea->iva = $_POST["iva"];
        
       
        if (($linea->Modificar() == 1) || ($linea->GetError() == ''))
            // Redirigir de vuelta a la factura principal.
            header("location:" . URLSITE . '?c=lineasfacturas&a=ver&id=' . $linea->factura_id);
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Borrar()
    {
        $linea = new LineasFacturasModelo();
        $linea->id = $_GET['id'];
        
        $linea->Seleccionar(); 
        $factura_id_a_redirigir = $linea->factura_id; 

        if ($linea->Borrar() == 1)
            // Redirigir de vuelta a la factura principal.
            header("location:" . URLSITE . '?c=lineasfacturas&a=ver&id=' . $factura_id_a_redirigir);
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
?>