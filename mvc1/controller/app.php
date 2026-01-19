<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/clientes.php");
require_once("model/facturas.php");
require_once("model/lineas_facturas.php");
class AppControlador
{
    static function index()
    {
        require_once("view/app.php");
    }
}    