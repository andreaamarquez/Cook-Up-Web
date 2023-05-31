<?php

require_once "conexion.php";

class CAD
{
    public $con;

    static public function agregaUsuario($nombre, $contrasena, $correo)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("INSERT INTO usuario (nombre, correo, contrasena, idRol) VALUES ('$nombre', '$correo', '$contrasena', '1')");
        if($query->execute())
        {
            return 1;
        }
        else{
            #echo "hubo un error";
            #print_r($con->conectar()->errorInfo());
            return 0;
        }
    }

    static public function verificaEmail($correo)
    {
        $con = new Conexion();
        $query = $con->conectar()->prepare("SELECT * FROM usuario WHERE correo= '$correo'");
        if($query->execute())
        {
            /*Un solo registro */
            $row = $query->fetch(PDO::FETCH_NUM);
            if($row)
            {
                return 0;
            }
            else
            {
                return 1;
            }
        }
        else
        {
            return 0;
        }
    }

    static public function verificaUsuario($correo, $contrasena)
    {
        $con = new Conexion();
        $query = $con->conectar()->prepare("SELECT * FROM usuario WHERE correo= '$correo' and contrasena = '$contrasena'");
        if($query->execute())
        {
            /*Un solo registro */
            $row = $query->fetch(PDO::FETCH_NUM);
            if($row)
            {
                #echo $row[0]." - ".$row[1]." - ".$row[2]." - ".$row[3];
                #$_SESSION['idUsuario'] = $row[0];
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }

    
    static public function modificaUsuario($consulta, $idUsuario)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("UPDATE usuarios SET $consulta WHERE idUsuario = $idUsuario");
        if($query->execute())
        {
            return 1;
        }
        else{
            print_r($con->conectar()->errorInfo());
            return 0;
        }
    }

    static public function traeUsuarios()
    {
        $con = new Conexion();
        $query = $con->conectar()->prepare("SELECT * FROM usuarios ORDER BY idUsuario DESC");
        if($query->execute())
        {
            $datos = [];
            /*Más de un registro */
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $datos[] = $row;
            }
            #print_r($datos);
            return $datos;
        }
        else
        {
            return false;
        }
    }

    static public function traeUsuario($correo)
    {
        $con = new Conexion();
        $query = $con->conectar()->prepare("SELECT idRol FROM usuario WHERE correo = '$correo'");
        if ($query->execute()) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return 0;
        }
    }
    

    static public function eliminaUsuario($idUsuario)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("DELETE from usuarios WHERE idUsuario = $idUsuario");
        if($query->execute())
        {
            return 1;
        }
        else{
            print_r($con->conectar()->errorInfo());
            return 0;
        }
    }

    static public function eliminaReceta($idReceta)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("DELETE from recetas WHERE idReceta = $idReceta");
        if($query->execute())
        {
            return 1;
        }
        else{
            return 0;
        }
    }
    static public function creaReceta($nombreReceta, $categoria, $intro, $porciones, $rutaImg, $ingredientes, $procedimiento)
    {
        $con = new Conexion();
        
        $query = $con->conectar()->prepare("SELECT nombreCategoria from categoria WHERE idCategoria = '$categoria'");
        if($query->execute()) 
        {
            $flag = 0;
            $cat = $query->fetch(PDO::FETCH_ASSOC);
            $ruta = "../categorias/".$cat['nombreCategoria'];
            $archivo = fopen($nombreReceta.".html", "a");
            if($archivo)
            {
                $texto = '<html>
                        <head>
                            <meta charset="UTF-8">
                            <link rel="icon" type="image/png" href="../../img/icono.png">
                            <link href="../../estilo.css" rel="stylesheet" type="text/css">
                            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
                            <title>'.$nombreReceta.'</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body>
                            <div class = "encabezado">
                                <div class = "logo">
                                <img src="../../img/logo.png" style="height: 70px;">
                                </div>
                                <div class = "login">
                                    <div class = "inicioSesion"><a href="../../iniciarSesion/iniciarSesion.html">Iniciar sesión</a></div>
                                    <div class = "registro"><a href="../../registrarse/registrarse.html">Registrarse</a></div>
                                </div>
                            </div>
                            <div class = "titleRecipe"><a href="../../index.html">Inicio <span>></span></a>'.$nombreReceta.'</div>
                            <div class = "introductionRecipe">'.$intro.'
                            </div>
                            <div class="imgContenedor">
                                <div class="imageRecipe" style="--i:url('.$rutaImg.')"></div>
                                <div class="commentRecipe">
                                    <div class = "foodPortions"><i class="fa-regular fa-user"></i> Rinde '.$porciones.'</div>
                                    <div class = "foodPortions"><i class="fa-regular fa-save"></i> Guardar receta</div>
                                </div>
                            </div>
                            <div class="ingredientsTitle">Ingredientes</div>
                            <div class="ingredientsList">
                                <ul>
                                    '.$ingredientes.'                   
                                </ul>
                            </div>
                            <div class="procedureTitle">Procedimiento</div>
                            <div class="procedureList">
                                <ul>
                                    '.$procedimiento.'
                                </ul>
                            </div>
                            <div class="rating">Califica esta receta:</div>
                            <div class="ratingContainer">
                                <input type="radio" name="rating" id="star1">
                                <label for="star1"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star2">
                                <label for="star2"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star3">
                                <label for="star3"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star4">
                                <label for="star4"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star5">
                                <label for="star5"><i class="fa-solid fa-star"></i></label>
                            </div>
                            <div class="comments">Comentarios:</div>
                                <ul id="commentsList" class="commentsContainer2">
                    
                            </ul>
                            <main class="commentsContainer">
                                <section class="container-agg-com">
                                    <div class="userImage">
                                        <img src="data:image/png;base64,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">
                                    </div>
                                    <div class="inputComments">
                                        <input id="newComment" type="text" placeholder="Escribe un comentario">
                                        <div class="buttonAgg">
                                            <button onclick="comments()">Comentar</button>
                                        </div>
                                    </div>
                                </section>
                            </main>
                            <div class="piePagina">
                                <div class="copyright">
                                    Copyright © BELS RECIPES 2023
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
                        <script type="text/javascript" src="script.js"></script>
                    </html>';
                    if(fwrite($archivo, $texto))
                        $flag = 1;
                    else 
                        $flag = 0;
                    
                    fclose($archivo);
            }

            return $flag;

        }
        else
            return $flag;   
    }

    static public function traeRecetas()
    {
        $con = new Conexion();
        $query = $con->conectar()->prepare("SELECT * FROM recetas ORDER BY nombreReceta ASC");
        if($query->execute())
        {
            $datos = [];
            /*Más de un registro */
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $datos[] = $row;
            }
            #print_r($datos);
            return $datos;
        }
        else
        {
            return false;
        }
    }

    static public function traeReceta($idReceta)
    {
        $con = new Conexion();
        $query = $con->conectar()->prepare("SELECT * FROM recetas WHERE idReceta = '$idReceta'");
        if($query->execute())
        {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else
        {
            return false;
        }
    }

    /*static public function modificaReceta($n, $i, $por, $im, $ingr, $pro, $id)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("UPDATE recetas SET nombreReceta = $n, introduccion = $i, porciones = $por, imagen = $im, ingredientes = $ingr, procedimiento = $pro WHERE idReceta = $id");
        
        if($query->execute())
        {
            return 1;
        }
        else{
            print_r($con->conectar()->errorInfo());
            return 0;
        }
    }*/

    /*static public function modificaRecetaNombre($nombre, $id)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("UPDATE recetas SET nombreReceta = $nombre WHERE idReceta = $id");
        
        if($query->execute())
        {
            return 1;
        }
        else{
            print_r($con->conectar()->errorInfo());
            return 0;
        }
    }*/
    static public function modificaRecetaNombre($nombre, $id)
    {
        $con = new Conexion(); // Establecer conexión a la base de datos
        $query = $con->conectar()->prepare("UPDATE recetas SET nombreReceta = nombre WHERE idReceta = :id");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            return 1;
        } else {
            print_r($con->conectar()->errorInfo());
            return 0;
        }
    }

    static public function modificaReceta($n, $i, $por, $im, $ingr, $pro, $id)
    {
        $img = substr($im, 3);
        $con = new Conexion(); // Establecer conexión a la base de datos
        $query = $con->conectar()->prepare("UPDATE recetas SET nombreReceta = :nombre, introduccion = :introduccion, porciones = :porciones, imagen = :imagen, ingredientes = :ingredientes, procedimiento = :procedimiento WHERE idReceta = :id");
        $query->bindParam(':nombre', $n);
        $query->bindParam(':introduccion', $i);
        $query->bindParam(':porciones', $por);
        $query->bindParam(':imagen', $im);
        $query->bindParam(':ingredientes', $ingr);
        $query->bindParam(':procedimiento', $pro);
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            $query1 = $con->conectar()->prepare("SELECT c.nombreCategoria FROM recetas r 
            INNER JOIN categoria c ON r.idCategoria = c.idCategoria
            WHERE r.idReceta = $id");
            if($query1->execute()) 
            {
                $flag = 0;
                $cat = $query1->fetch(PDO::FETCH_ASSOC);
                $ruta = "../categorias/".$cat['nombreCategoria'];
                $archivo = fopen("../categorias/".$cat['nombreCategoria']."/".$n.".html", "w");
            if($archivo)
            {
                $texto = '<html>
                        <head>
                            <meta charset="UTF-8">
                            <link rel="icon" type="image/png" href="../../img/icono.png">
                            <link href="../../estilo.css" rel="stylesheet" type="text/css">
                            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
                            <title>'.$n.'</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body>
                            <div class = "encabezado">
                                <div class = "logo">
                                <img src="../../img/logo.png" style="height: 70px;">
                                </div>
                                <div class = "login">
                                    <div class = "inicioSesion"><a href="../../iniciarSesion/iniciarSesion.html">Iniciar sesión</a></div>
                                    <div class = "registro"><a href="../../registrarse/registrarse.html">Registrarse</a></div>
                                </div>
                            </div>
                            <div class = "titleRecipe"><a href="../../index.html">Inicio <span>></span></a>'.$n.'</div>
                            <div class = "introductionRecipe">'.$i.'
                            </div>
                            <div class="imgContenedor">
                                <div class="imageRecipe" style="--i:url('.$img.')"></div>
                                <div class="commentRecipe">
                                    <div class = "foodPortions"><i class="fa-regular fa-user"></i> Rinde '.$por.'</div>
                                    <div class = "foodPortions"><i class="fa-regular fa-save"></i> Guardar receta</div>
                                </div>
                            </div>
                            <div class="ingredientsTitle">Ingredientes</div>
                            <div class="ingredientsList">
                                <ul>
                                    '.$ingr.'                   
                                </ul>
                            </div>
                            <div class="procedureTitle">Procedimiento</div>
                            <div class="procedureList">
                                <ul>
                                    '.$pro.'
                                </ul>
                            </div>
                            <div class="rating">Califica esta receta:'.$img.'</div>
                            <div class="ratingContainer">
                                <input type="radio" name="rating" id="star1">
                                <label for="star1"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star2">
                                <label for="star2"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star3">
                                <label for="star3"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star4">
                                <label for="star4"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="rating" id="star5">
                                <label for="star5"><i class="fa-solid fa-star"></i></label>
                            </div>
                            <div class="comments">Comentarios:</div>
                                <ul id="commentsList" class="commentsContainer2">
                    
                            </ul>
                            <main class="commentsContainer">
                                <section class="container-agg-com">
                                    <div class="userImage">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAaVBMVEX///9MgcJJf8E/er9FfcBCe8A7eL45d77x9frj6/VRhcS2yeRxmc37/f7q8PeLq9WUsdh7oNBdjMfc5fJkkcmqweC8zubO2+31+PzH1upXiMXV4O+DpdPd5vKct9ttlsyjvN2xxuOattvAhmB3AAAKvElEQVR4nO1d2bKiMBCFbCCLLILgjv7/Rw6IMqgBAt1RbhWnpuZlppBDOr2nYxgLFixYsGDBggULFixYsGDBggXj4fv+r18BHfl6lbnpOTh6lySO984+jpOLdwzOqZut1vmvXw8Ef5UVRy82haCcM0ZKmGb1pwRjnFMhzNg7FtnqL67rehcmJqMlr4pTJ8p/ZeX/MpNwt/71K6vDX7uBaVFG+qi9ESWMWmbgrv/AYtpZmIiSnTK5Fk1GRRJm9q8p9CHfRo6YxO4/S+FE25mqH38X8WmL97GUPNrNT1xPIRMMzO6J8lnh6deU2sjdC+Xw1WuDcHpx5yKt9s2kuPQeJKl5m4PaOR0thM3XwZFZx18L6yFC3H0yMBEdfsjvFFG9/O4cafSrdVx9g9+D4+oH/Oyb9R1+d47W93WO6/Cv8avAHfer/DYJ/Sq/CjTZfI2fHwpd9qEPRIRf8uWyLwvof3An+wK/PBA/4ldBBNo9ucP+expUBrbX7AAU1i92YBvEKjTyW1++r0I/QS/aUjqZ+VsJfYKZmhRO+ksV8wqRauDnH+dDsKR4RDeNdjIPCX2CJciO6sqZF8GSooMab2TawvjpIAxR32x/bgVlINYWi6D7E0d7GEQgRVTpTAmaWFajsH7NowcYLtysCWJQnJEjIwdUUN25EywpgtTNdt4iWgNiNLK/QLCkONn0r2ZrJd5AJjpwtvNnGDqT3HAfO5qoWkwYr/pOxjQxKIElU4KpI2bOkHBhmV4QntNreg4Dz7QEakmVH8cTxDOEhFF6ub71WNjZ9UIxyv4PjDeLGVbOiVAn2MmTnPkucNCqx3SkQl0j/S6zkt5qfO4maCXWcRk4HC1DLG84f3vwcKJPlowheMaQUUJjNcnJEhRZpWd1ggcMLcNMdW9qi5KJFcoJ/3yP0NkkojFW2I4QwmyyVy3bBPAPSuhYjx8jVcICtd/awf1t5owvLawREpbWTuWXfPDvmNyb4ifaHoIXpeK9heBPSYNpKXc/AKtwFg7/zAH8K0JxN0gAry/TYX2aQDc8nU6wpAj9vmTQ7oMTMxxCsKQI3YtDaRsfGrkxD0TQMDygGiCkXwlA1QxxoHU9H5pZ6Fc2K+A2IAxe8lpBg0ba9w5H4BJSjGrQFviZWU+8vwFuc1WvaQBQr5F3N8BFwEc7OA1LuQN7DRJ1PXkDdEinZ2bfAM1EW12LCFTUffI/EkB90GWyTrAvRxheq9IaqE8teWc48MPxGxpBw7jBdB6RihPwuxETs8HF7j21OPwyUnk6A5ewQCRoGAVsEZkkKwX+aritrTm+RLkwTwLJ2P8H0OxL8kTAuNDCPvOxAmr2jzgRaO3BQdMngNb5w+pDhQKtAasB0AF/3zY+cGMT/EM7NiwYJ+w1Ut0BP1inrwsAMA6gO9Sn4QspXExfvjrUGBId3fNroJi+mETg5yKxBoKGEcMM2ItgAYUU3dzXAOr3tpgC1ZaebQiXLPLfkQRqUlPoOcS6AmanW9oUmiWlWggaBjTp9j9zCs386FE0YFVjOs8HAZ1czATNK6Dp2yYccKFp0kITwwKaOH2GULPIdMuAlv2G1kKErtO5GVCZksdGXEHL2kLXMfINtJj5KBRBraEucwg3iE+LCG5NsHSdWl1D+14eFvECrdxbuk6Q51CG5FI9xgb3eAltDKFSSvZVBLUC9+nMdw1NXqmIHbiHxdI1WcUGMxSVqoE6DnPWNLW7BfVo5mwPa68GrEprUdAB+AaqlCm4f0VaI8ABsJZi1v09YI1cioKOCQcVUnjHaWnJwJ7RjOND8+5RQv13c8YxvnmPe7YIjbmWJoYIxx/51rgiMJxpru3O8AotmN8xz3xpzbBAaOuea867frUQQ1/NtG5RMzwaHsaRI6ZjOiU4u1KBeEaC8BjsZpoaGDrQNBMchmTSOdwBQDu+ayQowl7aC3wxhXbv1ShVxB7hMVrE9IpzTncPrco8oEGbgo+21HAMlMeUjhv2OENow3IDpDXEb4rCsNMVHKR9iJ7KWGOdlt8bCCdi70BuGgqRJjqUCgLHWpjIfg344MwTJUMUi18B1f0GH2FrkOD4pXdQvJ24QZuTWvqlWDqrKhKgMcRSDvfYAiMIe2DMUINeoIx0qFHuHWCL/uvjcJTNCXEyTulOIuQkG7ALBkHU4UbsipIMaSAKBIYF5hvxLc6UjwYCnpNCm/1Tv1CGUKNrg4ADRZywsIFYwU9vvwNWTMSYq9KGyMt9jftIlkBq3vkFd4Ta/Ww59GjsO7g3PWfj4+Rm/uPejIGREn4Bn7yKPvIKPpzlFP22iqmDqO0Y/1UKA6OU/AFiTslpbJCVTIV7AR46R0EGwseX9nc6Zobf5yvkWHmMNogYOYVHz901j6GY2PqrBo/HSOphr+XumrqvDaFlSP50Ear2Stmhlsv3mt5EXEew/XyzUBFVP9V2M8ijdGtru/aAcFoMraNdYF8O2cJzmEyM8zipg8tJuOleSP8UMn38Sqv1+B2MRAahlieNXAkX8VkecGxusXz9GNKlfE0OFxwEV0Nm3TKmiOQPIow5UfoyhNbO0sjhHRaQelsPZT5t044GOzNDOPOeN/jeunRiSVJYZH+JglsQXWJiiS56pTRUCtDeegQsv/+P0AOqM0wkacsLdfvU/v0SbjZ0VXfz4ddpDJtPS5pzT5MniVQ3ob7Z9Q1wviMn7QceAsgV0a0s/LRcDeGOxBb4kMmARBzfIq+8mH4Vb6vv1Z/gmhIRu3IzsJtswLlsbK3vxtNcVmK2vtZoe1Hy23aaOTuY9ErEOspzPP52EseXptCRLZil+uzmV2GTjH8l2ueqbyc4Bi/ddvmoVmhOij569SvFo7YPofuBTGtKRsoZec36jUhHlaGfUsJwd1HW9Uxc+mWiwnqk7L8VpdXdGr5XPm2YRZaCbBFuRYpzv+MxztfbXAxfUcwJPY+J3e1r6Xn2WDTCOI2v6kduzurL+D7bRDGnyPaj67yr1NtXLN9fjVTsHC8dl5bbKKfjPoruKr4pmXiTa75Jj0l1owVn1fUd5d/VbRfJMd2MPzDlh4pq/3Oy4HC2hkAKS36+zty0OAfH8FykbrbOp2bG1a65k8wTHkybIl84OB2rWGFHSVrP/YFIf9oUci3Io8HNSGSDRvub9gFDujXgOGQ2pMOEe0uToCHdGnAb2FPyecY9fg1aHwkail6KHSexuueXzo/gAMWuCYBdizivPfhEj2HsbHbtOGfEdQxjQ0B3d193w7I0EMZpA9KBLielp9VV2tU54bqRL8HuyBGyHudZsohoI6w1QN7t3nukdf0h2lTXGV8UpDLL3ztX/yOIGncR1vchad4YuIjFftuJPSPqZ4FPzdGeQyfF6xF4PkNT/4oPb3r4atm2CpZ66POC/1YDUdhWp9a6z1vN1HjLoXGF/ohzs+6E6H9BOF4OjKgdiWiyw/Sq++0w8Ko5lHIjz0oUYbOJ6vvQzterTll5eDaazqCj49boRuU3flx1rHDB1yzQ3I6jfv/h4+61WMPpZS145tDGLEl1GfBfEdKmSD8uE1GG+1TXbCR01KpxZBxbKijEa2M0w7fMCbePH7gz/J/mgn1l2kbHCOlskxefKM3blJrKn9mG1QQNqnA751/G1sK/QGRe2M0/ygPi9Ee8rwULFixYsGDBggULFixYsGDBgh78A5ayqmKHhgYpAAAAAElFTkSuQmCC">
                                    </div>
                                    <div class="inputComments">
                                        <input id="newComment" type="text" placeholder="Escribe un comentario">
                                        <div class="buttonAgg">
                                            <button onclick="comments()">Comentar</button>
                                        </div>
                                    </div>
                                </section>
                            </main>
                            <div class="piePagina">
                                <div class="copyright">
                                    Copyright © BELS RECIPES 2023
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
                        <script type="text/javascript" src="script.js"></script>
                    </html>';
                    if(fwrite($archivo, $texto))
                        $flag = 1;
                    else 
                        $flag = 0;
                    
                    fclose($archivo);
            }
            return $flag;
            
        }
            

        } else {
            return 0;
        }
    }
    
}