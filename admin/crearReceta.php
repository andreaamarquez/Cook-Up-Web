<?php
    require_once "../php/conexion.php";

    $flag = 0;

    if(isset($_POST['nombre']) && isset($_POST['porciones']) && isset($_POST['ingredientes']) && isset($_POST['procedimiento']))
    {
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $introduccion = $_POST['introduccion'];
        $porciones = isset($_POST['porciones']) ? $_POST['porciones'] : '';
        $imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : '';
        $archivo = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : '';
        $ruta = "../img";
        $ruta = $ruta."/".$imagen;
        move_uploaded_file($archivo, $ruta);
        $ingredientes = $_POST['ingredientes'];
        $procedimiento = $_POST['procedimiento'];

        $con = new Conexion();
        $query = $con->conectar()->prepare("INSERT INTO recetas (idCategoria, nombreReceta, introduccion, porciones, imagen, ingredientes,procedimiento) VALUES ('$categoria','$nombre','$introduccion','$porciones','$ruta','$ingredientes','$procedimiento')");
        if($query->execute())
        {
            $flag = 1;
        }
        else {
            $flag = 2;
        }
    }

    unset($_POST['nombre']);
    unset($_POST['categoria']);
    unset($_POST['introduccion']);
    unset($_POST['porciones']);
    unset($_FILES['imagen']);
    unset($_POST['ingredientes']);
    unset($_POST['procedimiento']);
?>


<html>
    <head>
        <meta charset="UTF-8">
        <link href="../estilo.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <title>Añadir</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icono.png">
    </head>
    <body>
        <nav>
            <div class = "encabezado">
                <div class = "logo">
                     <img src="../img/logo.png" style="height: 70px;">
                </div>

                <di class="login">
                    <img src="../img/user.png" class="user-pic" onclick="toggleMenu()">
                </div>

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="../img/user.png">
                            <h2>Pidu</h2>
                        </div>
                        <hr>

                        <a href="#" class="sub-menu-link">
                            <img src="../img/profile.png">
                            <p>Perfil</p>
                            <span>></span>
                        </a>
                        <a href="editaUsuario.html" class="sub-menu-link">
                            <img src="../img/setting.png">
                            <p>Editar perfil</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <img src="../img/logout.png">
                            <p>Cerrar sesión</p>
                            <span>></span>
                        </a>

                    </div>
                </div>

             </div>
        </nav>
        
        <div class="mainPageAdmin">
            <div class = "titlePageAd"><a href="menuConfig.html">Configuración <span>></span></a>Añadir receta <span> ></span></div>
            <?php
            if($flag == 1)
                echo '<div class="mensaje" style="margin-bottom: 20px; border-radius: 20px; background-color: #7ee67c; color: #0b9c06; text-align: center;">Añadido con éxito</div>';
            else if($flag == 2)
                echo '<div class="mensaje" style="margin-bottom: 20px; border-radius: 20px; background-color: pink; color: red; text-align: center;">Ocurrió un error</div>';
        ?>
            <div class=form>
                <form action="crearReceta.php" method="POST" enctype="multipart/form-data">
                    <!--h1 class="title">Crear receta</h1-->
                    <p class="especificaDatos">Categoría:</p>
                    <select name="categoria">
                        <?php
                            require_once "../php/conexion.php";
                            $con = new Conexion();
                            $getCat1 = $con->conectar()->prepare("SELECT * from categoria order by idCategoria");
                            $getCat1->execute();
                            $getCat2 = $getCat1->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($getCat2 as $row) {
                                $id = $row['idCategoria'];
                                $cat = $row['nombreCategoria'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $cat; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <p class="especificaDatos">Nombre de la receta:</p>
                    <input placeholder="Nombre" type="text" name="nombre">
                    <p class="especificaDatos">Introducción:</p>
                    <textarea placeholder="¿Qué es la receta?" type="text" name="introduccion" rows="5" cols="50"></textarea>
                    <p class="especificaDatos">Porciones:</p>
                    <select name="porciones">
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                    <p class="especificaDatos">Imagen:</p>
                    <input type="file" name="imagen">
                    <p class="especificaDatos">Ingredientes:</p>
                    <textarea placeholder="Enlistar ingredientes" type="text" name="ingredientes" rows="10" cols="50"></textarea>
                    <p class="especificaDatos">Procedimiento:</p>
                    <textarea placeholder="Pasos a seguir" type="text" name="procedimiento" rows="15" cols="50"></textarea>
                    <br><br>
                    <input type="submit" value="Añadir nueva receta" class="boton">
                </form>
            </div>   
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

        <script>
            let subMenu = document.getElementById("subMenu");

            function toggleMenu(){
                subMenu.classList.toggle("open-menu");
            }
        </script>
    </body>
</html>