<?php

    require_once ("entidades/Archivo.php");
    require_once ("entidades/Usuario.php");
    require_once ("entidades/Comentario.php");
    
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
        $arr[] = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;

        foreach($arr as $item) 
        {
            if( $item === NULL ) {
                echo "ERROR, debe ingresar todos los atributos obligatorios para borrar un usuario.";
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
        if( $usuario["Objeto"]->GetPerfil() != "admin" ) {
            return "ERROR, el perfil del Usuario Logueado debe ser admin para poder eliminar.";
        }
        
        $comentario = Comentario::BuscarPorId($_POST['email']);

        $retorno = Comentario::Eliminar( $comentario["Objeto"]->GetEmail() );
        if( $retorno["Exito"]===FALSE )
            return $retorno["Mensaje"];
        return ( Usuario::Eliminar( $usuario["Objeto"]->GetEmail() ) )["Mensaje"];
    }
    
?>

