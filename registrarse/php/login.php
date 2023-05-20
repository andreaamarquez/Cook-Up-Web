<?php

require_once "CAD.php";
session_start();

if(isset($_POST['correo']) && isset($_POST['contrasena']))
{
    /*$correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $cad = new CAD();
    if($cad->verificaUsuario($correo, $contrasena))
    {
        #$_SESSION['correo'] = $correo;
        #Rol
        #$_SESSION['Rol'] = 0;
        //Dar acceso al usuario
        header("Location: ../index.html");
    }*/
    header("Location: ../index.html");
    /*else
        echo "Error";*/
}
else{
    echo "Error";
}

unset($_POST['correo']);
unset($_POST['contrasena']);
?>
