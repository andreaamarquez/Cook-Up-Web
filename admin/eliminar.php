<?php
    require_once "../php/CAD.php";
    if (isset($_GET['idReceta'])) {
        $idReceta = $_GET['idReceta'];
        $cad = new CAD();
        $flag = $cad->eliminaReceta($idReceta);
    }
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="../estilo.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <title>Eliminar receta</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icono.png">
    </head>
    <body>
        <div class = "encabezado">
           <div class = "logo">
                <img src="../img/logo.png" style="height: 70px;">
           </div>
           <div class = "login">
                <div class = "inicioSesion"><a href="../php/login.php">Iniciar sesión</a></div>
                <div class = "registro"><a href="../php/registro.php">Registrar</a></div>
           </div>
        </div>
        <div class="mainPageAdmin">
        
        <div class = "titlePageAd"><a href="menuConfig.html">Configuración<span>></span></a>Eliminar receta <span> ></span></div>
        <section class="todo">
        <?php
            $cad = new CAD();

            $datos = $cad->traeRecetas();
            if($datos)
            {
                foreach($datos as $registro)
                {
                    
                    $idReceta = $registro['idReceta'];
                    $nombreReceta = $registro['nombreReceta'];
                    $imagen = $registro['imagen'];
                    $introduccion = $registro['introduccion'];
                    
                    //echo "<td><a href='elimina.php?idUsuario=$idUsuario'>Eliminar</a></td>";
                    echo '
                        <div class="container3">
                            <img src="'.$imagen.'" alt="Imagen" class="image3">
                            <div class="content3">
                                <p class="titulo-buscar">'.$nombreReceta.'</p>
                                <p>'.$introduccion.'</p>
                            </div>
                            <img src="../img/borrar.png" alt="Icono Editar" style="height: 30px; margin-right: 30px" onclick="window.location.href = \'eliminar.php?idReceta='.$idReceta.'\'">
                        </div>';
                }
            }
        ?>
        </section>
        </div>
        <div class="piePagina">
            <div class="copyright">
                Copyright © BEL'S RECIPES 2023
            </div>
            <div class="redesSociales">
                <a class="btn btn-primary btn-social mx-2" href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-primary btn-social mx-2" href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-primary btn-social mx-2" href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="pptu">
                <a href="#">Política de seguridad</a>
                <a href="#">Términos de uso</a>
            </div>
        </div>
    </body>
</html>