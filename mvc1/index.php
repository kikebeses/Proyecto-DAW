<?php 
if (session_status() === PHP_SESSION_NONE)  
    session_start(); 
 
require_once("config.php"); 
require_once("controller/app.php"); 
require_once("controller/clientes.php"); 
require_once("controller/facturas.php");
require_once("controller/lineas_facturas.php");
require_once("controller/articulos.php");
 
$controlador = ''; 
if(isset($_GET['c'])) : 
    $controlador = $_GET['c']; 
 
    $metodo = ''; 
    if(isset($_GET['m']))
        $metodo = $_GET['m']; 
 
    switch($controlador) : 
        case 'clientes' : 
            if (method_exists('ClientesControlador', $metodo)) : 
                ClientesControlador::{$metodo}(); 
            else:
                ClientesControlador::index(); 
               endif; 
 
            break; 

               case 'facturas':
                if (method_exists(object_or_class:'FacturasControlador', method:$metodo)) :
                    FacturasControlador::{$metodo}();
                    else:
                        FacturasControlador::index();
                        endif;
                        break;

                case 'lineasfacturas':
                if (method_exists(object_or_class:'LineasFacturasControlador', method:$metodo)) :
                    LineasFacturasControlador::{$metodo}();
                    else:
                        LineasFacturasControlador::index();
                        endif;
                        break;
                        
                 case 'articulos':
                if (method_exists(object_or_class:'ArticulosControlador', method:$metodo)) :
                    ArticulosControlador::{$metodo}();
                    else:
                        ArticulosControlador::index();
                        endif;
                         break;
                        

        default: 
            AppControlador::index(); 
    endswitch;        
else : 
    AppControlador::index(); 
endif; 
?> 