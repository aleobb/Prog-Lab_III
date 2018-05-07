<?php

    require_once ("entidades/Usuario.php");
    require_once ("entidades/Archivo.php");

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
        $arr[] = isset($_GET['email']) ? $_GET['email'] : NULL;
        $arr[] = isset($_GET['nombre']) ? $_GET['nombre'] : NULL;
        $arr[] = isset($_GET['perfil']) ? $_GET['perfil'] : NULL;
        $arr[] = isset($_GET['edad']) ? $_GET['edad'] : NULL;
        $arr[] = isset($_GET['clave']) ? $_GET['clave'] : NULL;

        foreach($arr as $item) 
        {
            if( $item === NULL ) {
                echo "ERROR, debe ingresar todos los atributos obligatorios para crear un nuevo usuario.";
                return FALSE;
            }
        }

        if ( $_GET["perfil"] != "admin" && $_GET["perfil"] != "user" ) {
            echo "ERROR, el perfil debe ser admin o user.";
            return FALSE;
        }

        if ( $_GET["edad"] < 1 || $_GET["edad"] > 120 ) {
            echo "ERROR, debe ingresar una edad valida.";
            return FALSE;
        }

        if( !filter_var($_GET['email'],FILTER_VALIDATE_EMAIL) ) {
            echo "ERROR, debe ingresar un email valido.";
            return FALSE;
        }

        return TRUE;
    }

    function Procesar()
    {
        global $arr;
        $usuario = Usuario::NewUsuario($arr);
        return (Usuario::Agregar($usuario))["Mensaje"];
    }
    
?>

