<?php

    require_once ("entidades/Usuario.php");
    require_once ("entidades/Archivo.php");

    $arr = array();
    if( Validar() )
        echo Procesar();

    function Validar()
    {
        if ( $_SERVER["REQUEST_METHOD"] !== "POST" ) {
            echo "ERROR, no ha hecho un request tipo POST.";
            return FALSE;
        }

        global $arr;
        $arr[] = isset($_POST['email']) ? $_POST['email'] : NULL;
        $arr[] = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
        $arr[] = isset($_POST['perfil']) ? $_POST['perfil'] : NULL;
        $arr[] = isset($_POST['edad']) ? $_POST['edad'] : NULL;
        $arr[] = isset($_POST['clave']) ? $_POST['clave'] : NULL;

        foreach($arr as $item) 
        {
            if( $item === NULL ) {
                echo "ERROR, debe ingresar todos los atributos obligatorios para modificar un usuario.";
                return FALSE;
            }
        }

        if ( $_POST["perfil"] != "admin" && $_POST["perfil"] != "user" ) {
            echo "ERROR, el perfil debe ser admin o user.";
            return FALSE;
        }

        if ( $_POST["edad"] < 1 || $_POST["edad"] > 120 ) {
            echo "ERROR, debe ingresar una edad valida.";
            return FALSE;
        }

        if( !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ) {
            echo "ERROR, debe ingresar un email valido.";
            return FALSE;
        }

        return TRUE;
    }

    function Procesar()
    {
        global $arr;
        $usuario = Usuario::NewUsuario($arr);
        return (Usuario::Modificar($usuario))["Mensaje"];
    }
    
?>

