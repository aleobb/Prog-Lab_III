<?php

    require_once ("entidades/Archivo.php");
    require_once ("entidades/Usuario.php");
    require_once ("entidades/Comentario.php");
    
    $arr = array();
    if( Validar() )
        echo Procesar();

    function Validar()
    {
        if ( $_SERVER["REQUEST_METHOD"] !== "GET" ) {
            echo "ERROR, no ha hecho un request tipo GET.";
            return FALSE;
        }

        global $arr;
        $arr["email"] = isset($_GET['email']) ? $_GET['email'] : NULL;
        $arr["titulo"] = isset($_GET['titulo']) ? $_GET['titulo'] : NULL;

        if( isset($_GET['email']) && !filter_var($_GET['email'],FILTER_VALIDATE_EMAIL) ) {
            echo "ERROR, debe ingresar un email valido.";
            return FALSE;
        }
        
        return TRUE;
    }

    function Procesar()
    {
        global $arr;
        return Comentario::GetComentariosFiltrados($arr);
    }
    
?>

