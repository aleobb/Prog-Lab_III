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
        $arr[] = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
        $arr[] = isset($_POST['comentario']) ? $_POST['comentario'] : NULL;
        $arr[] = "Sin Imagen";

        foreach($arr as $item) 
        {
            if( $item === NULL ) {
                echo "ERROR, debe ingresar todos los atributos obligatorios para crear un nuevo comentario.";
                return FALSE;
            }
        }

        if( !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ) {
            echo "ERROR, debe ingresar un email valido.";
            return FALSE;
        }

        $usuario = Usuario::BuscarPorId($_POST['email']);
        if( $usuario["Exito"]===FALSE ){
            echo $usuario["Mensaje"];
            return FALSE;
        }
        
        return TRUE;
    }

    function Procesar()
    {
        global $arr;
        $comentario = Comentario::NewComentario($arr);
        return (Comentario::Agregar($comentario))["Mensaje"];
    }
    
?>

