<?php

require_once "conexion.php";

class CAD
{
    public $con;

    static public function agregaUsuario($nombre, $contrasena, $correo)
    {

        $con = new Conexion(); //Establecer conexion a la bd
        $query = $con->conectar()->prepare("INSERT INTO usuario (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')");
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

}