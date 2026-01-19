<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("model/clientes.php");
require_once("crypt.php");
require_once("pdfs/clientes.php");

class ClientesControlador
{
    static function index()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();

        require_once("view/clientes.php");
    }
    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/clientesmantenimiento.php");
    }
    static function Insertar()
    {
        $cliente = new ClientesModelo();
        $cliente->nombre = $_POST['nombre'];
        $cliente->email = $_POST['email'];
        $cliente->apellidos = $_POST['apellidos'];

        if($cliente->contrasenya = $_POST["contrasenya"]){
            $encriptada = Crypt::Encriptar('contrasenya');


        }
        $cliente->contrasenya = $encriptada;
        $cliente->direccion = $_POST['direccion'];
        $cliente->cp = $_POST['cp'];
        $cliente->poblacion = $_POST['poblacion'];
        $cliente->provincia = $_POST['provincia'];
        $cliente->fecha_nacimiento = $_POST['fecha_nacimiento'];
        if ($cliente->Insertar() == 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "/view/error.php");
        }
    }
    static function Editar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente.
        if ($cliente->seleccionar())
            require_once("view/clientesmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Modificar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $cliente->nombre = $_POST['nombre'];
        $cliente->email = $_POST['email'];
        $cliente->apellidos = $_POST['apellidos'];
        if($cliente->contrasenya = $_POST["contrasenya"]){
            $encriptada = Crypt::Encriptar('contrasenya');
        }
        $cliente->contrasenya = $encriptada;
        $cliente->direccion = $_POST['direccion'];
        $cliente->cp = $_POST['cp'];
        $cliente->poblacion = $_POST['poblacion'];
        $cliente->provincia = $_POST['provincia'];
        $cliente->fecha_nacimiento = $_POST['fecha_nacimiento'];
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == ''))
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Borrar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        if ($cliente->Borrar() == 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

static function Exportar()
{
    $cliente = new ClientesModelo();
    $cliente->Seleccionar();

    // Convertir las filas a un array de objetos/arrays sencillos
    $datos = [];

    foreach ($cliente->filas as $fila) {
        $datos[] = [
            "id"        => $fila->id,
            "nombre"    => $fila->nombre,
            "email"     => $fila->email,
            "apellidos" => $fila->apellidos
        ];
    }

    // Convertir a JSON con formato
    $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Guardar en archivo
    $rutaFichero = "clientes.json";
    file_put_contents($rutaFichero, $json);

    // Cabeceras para descarga
    header("Content-Type: application/json");
    header("Content-Length: " . filesize($rutaFichero));
    header("Content-Disposition: attachment; filename=clientes.json");

    readfile($rutaFichero);
}

/*
   static function Exportar()
    {
        $cliente = new ClientesModelo();

        $cliente->Seleccionar();


        try {
            $fichero = fopen("clientes.csv","w");

        foreach ($cliente->filas as $fila) {

            //Esta cadena se cambia segun el formato del archivo
            $cadena = "$fila->id#$fila->nombre#$fila->email#$fila->apellidos\n";



            fputs($fichero, $cadena);
        }
    }

    finally{
        fclose($fichero);
    }

    $rutaFichero = 'clientes.csv';
    $fichero = basename($rutaFichero);


    header("Content-Type: application/octet-stream");
    header("Content-Lenght: ".filesize($rutaFichero));
    header("Content-Disposition: attachment; filename=$fichero");

    readfile($rutaFichero);
    }
    // http://localhost/mvc/?c=clientes&m=imprimir

*/

    static function Imprimir()
    {
        // Creamos el modelo de clientes.
        $clientes = new ClientesModelo();
 
        // Seleccionamos todos los clientes.
        $clientes->Seleccionar();
 
        // Creamos el PDF de clientes.
        $pdf = new ClientesPDF();
 
        // Añadimos un página.
        $pdf->AddPage("L");
 
        // Indicamos el tamaño de letra.
        $pdf->SetFont('Arial','',12);
 
        // Establecemos el tamaño de cada celda.
        $pdf->SetWidths(array(30,30,30,30,30,30,30,30,30));
 
        // Pasamos la filas obtenidas.
        $pdf->filas = $clientes->filas;
       
        // Imprimirmos
        $pdf->Imprimir();
       
        // Mostramos
        $pdf->Output();
    }
}
?>