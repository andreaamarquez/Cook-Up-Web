<?php

require_once "CAD.php";
session_start();

$flag = 0;

if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contrasena']))
{
    if($_POST['nombre'] != '' && $_POST['correo'] !='' && $_POST['contrasena'] != '')
    {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $cad = new CAD();
        if($cad->verificaEmail($correo))
        {
            if($cad->agregaUsuario($nombre, $contrasena, $correo))
            {
                $usuario = $cad->traeUsuario($correo);
                $idUsuario = $cad->traeUsuarioId($correo);
                $rol = $usuario['idRol'];
                $id = $idUsuario['idUsuario'];
                $_SESSION['idRol'] = $rol;
                $_SESSION['idUsuario'] = $id;
                header("Location: ../index.php");
            }
        }
        else
        {
            $flag = 1;
        }
    }
    else
    {
        $flag = 2;
    }
        
}

unset($_POST['nombre']);
unset($_POST['correo']);
unset($_POST['contrasena']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="icon" type="image/png" href="../img/icono.png">
    <link rel="stylesheet" href="../registrarse/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form action="../php/registro.php" method="POST">
        <h1 class="title">Registrarse</h1>
        <?php
            if($flag == 1)
                echo '<div class="mensaje" style="margin-bottom: 20px; border-radius: 20px; background-color: pink; color: red;">El correo ya ha sido registrado</div>';
            else if($flag == 2)
                echo '<div class="mensaje" style="margin-bottom: 20px; border-radius: 20px; background-color: pink; color: red;">Campos vacíos</div>';
        ?>
        <label>
            <i class="fa-solid fa-user"></i>
            <input placeholder="username" type="text" name="nombre">
        </label>
        <label>
            <i class="fa-solid fa-envelope"></i>
            <input placeholder="email" type="email" name="correo">
        </label>
        <label>
            <i class="fa-solid fa-lock"></i>
            <input placeholder="password" type="password" name="contrasena">
        </label>
        <a href="login.php" class="link">¿Ya tienes una cuenta?</a>

        <input type="submit" value="Registrate" style="color: #fff;
            border: none;
            background:  rgb(246, 0, 127);
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 20px;">
        <div class="backToHome"><a href="../index.php">Volver al inicio</a></div>
    </form>
    
    <script src="main.js"></script>
</body>
</html>