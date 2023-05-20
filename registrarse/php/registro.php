<?php

require_once "CAD.php";

if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contrasena']))
{
    #echo $_POST['nombre']."-".$_POST['correo']."-".$_POST['contrasena'];
    #Enviar a la BD
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $cad = new CAD();
    if($cad->verificaEmail($correo))
    {
        if($cad->agregaUsuario($nombre, $contrasena, $correo))
        {
            header("Location: ../../index.html");
        }
        else
        {
            header("Location: error.php");
        }
    }
    else
    {
        echo "El correo ya ha sido registrado";
    }
    
    
}

unset($_POST['nombre']);
unset($_POST['correo']);
unset($_POST['contrasena']);

?>
