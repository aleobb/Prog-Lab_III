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
        $arr[] = isset($_POST['clave']) ? $_POST['clave'] : NULL;

        foreach($arr as $item) 
        {
            if( $item === NULL ) {
                echo "ERROR, debe ingresar todos los atributos obligatorios para crear un nuevo usuario.";
                return FALSE;
            }
        }

        if( !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ) {
            echo "ERROR, debe ingresar un email valido.";
            return FALSE;
        }

        return TRUE;
    }

    function Procesar()
    {
        $usuario = Usuario::BuscarPorId($_POST['email']);
        if( $usuario["Exito"]===FALSE )
            return $usuario["Mensaje"];
        if( $usuario["Objeto"]->GetClave() != $_POST['clave'] )
            return "La clave no coincide";
        return "Bienvenido";
    }
    
?>

