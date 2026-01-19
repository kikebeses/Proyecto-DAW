<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/articulos.php");
class ArticulosControlador
{
    static function index()
    {
        $articulos = new ArticulosModelo();
        $articulos->Seleccionar();

        require_once("view/articulos.php");
    }
    static function Nuevo()
    {

        $articulos = new ArticulosModelo();
        $articulos->Seleccionar();
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/articulosmantenimiento.php");
    }
    static function Insertar()
    {
        $articulos = new ArticulosModelo();
        $articulos->referencia = $_POST["referencia"];
        $articulos->descripcion = $_POST["descripcion"];
        $articulos->precio = $_POST["precio"];
        $articulos->iva = $_POST["iva"];
        if ($articulos->Insertar() == 1)
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulos->GetError();
            header("location:" . URLSITE . "/view/error.php");
        }
    }
    static function Editar()
    {
        $articulos = new ArticulosModelo();
        $articulos->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un factura.
        if ($articulos->seleccionar())
            require_once("view/articulosmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulos->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Modificar()
    {
        $articulos = new ArticulosModelo();
        $articulos->id = $_GET['id'];
        $articulos->referencia = $_POST['referencia'];
        $articulos->descripcion = $_POST['descripcion'];
        $articulos->precio = $_POST['precio'];
        $articulos->iva = $_POST['iva'];
       
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($articulos->Modificar() == 1) || ($articulos->GetError() == ''))
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulos->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Borrar()
    {
        $articulos = new ArticulosModelo();
        $articulos->id = $_GET['id'];
        if ($articulos->Borrar() == 1)
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulos->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
?>