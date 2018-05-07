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

        $arr[] = isset($_POST['emailLogueado']) ? $_POST['emailLogueado'] : NULL;
        $arr[] = isset($_POST['claveLogueado']) ? $_POST['claveLogueado'] : NULL;

        foreach($arr as $item) 
        {
            if( $item === NULL ) {
                echo "ERROR, debe ingresar todos los atributos obligatorios para modificar un usuario.";
                return FALSE;
            }
        }

        // Elimino del array los datos del usuario Logueado:
        array_pop($arr); 
        array_pop($arr);

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

        $usuarioLogueado = Usuario::BuscarPorId($_POST['emailLogueado']);
        if( $usuarioLogueado["Exito"]===FALSE )
            return "Usuario Logueado: ".$usuarioLogueado["Mensaje"];
        if( $usuarioLogueado["Objeto"]->GetClave() != $_POST['claveLogueado'] )
            return "La clave del Usuario Logueado no coincide.\n";
        if( $usuarioLogueado["Objeto"]->GetPerfil() == "user" &&  $_POST['email'] != $_POST['emailLogueado'] ) {
            return "ERROR, el perfil del Usuario Logueado debe ser admin para modificar otro usuario.";
        }

        $usuario = Usuario::NewUsuario($arr);
        return (Usuario::Modificar($usuario))["Mensaje"];
    }
    
?>

