<?php

require_once "CAD.php";
session_start();

$flag = 0;

if(isset($_POST['correo']) && isset($_POST['contrasena']))
{
    if($_POST['correo'] !='' && $_POST['contrasena'] != '')
    {
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $cad = new CAD();
        if($cad->verificaUsuario($correo, $contrasena))
        {
            #$_SESSION['correo'] = $correo;
            #Rol
            #$_SESSION['Rol'] = 0;
            //Dar acceso al usuario
            header("Location: ../index.html");
        }
        else{
            #echo "Usuario no encontrado";
            #echo '<script src="../iniciarSesion/mensaje.js"></script>';
            #header("../iniciarSesion/mensaje.js");
            $flag = 1;
        }
            
    }
    else
     $flag = 2;
    #echo "Campos vacios";   
}


unset($_POST['correo']);
unset($_POST['contrasena']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="icon" type="image/png" href="../img/icono.png">
    <link rel="stylesheet" href="../iniciarSesion/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form action="login.php" method="post">
        <h1 class="title">Iniciar sesión</h1>
        <!--Mensaje de php-->
        <?php
            if($flag == 1)
                echo '<div class="mensaje" style="margin-bottom: 20px; border-radius: 20px; background-color: pink; color: red;">Correo o contraseña incorrectos</div>';
            else if($flag == 2)
                echo '<div class="mensaje" style="margin-bottom: 20px; border-radius: 20px; background-color: pink; color: red;">Campos vacíos</div>';
        ?>
        <label>
            <i class="fa-solid fa-user"></i>
            <input placeholder="email" type="text" name="correo">
        </label>
        <label>
            <i class="fa-solid fa-lock"></i>
            <input placeholder="password" type="password" name="contrasena">
        </label>
        <a href="registro.php" class="link">¿No tienes una cuenta? Registrate</a>

        <input type="submit" value="Ingresar" style="color: #fff;
            border: none;
            background:  rgb(246, 0, 127) !important;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 20px;">
        <div class="backToHome"><a href="../index.html">Volver al inicio</a></div>
    </form>
</body>
</html>