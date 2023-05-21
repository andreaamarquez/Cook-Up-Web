<?php

class Conexion
{
    #Atributos
    private $host; //Localhost o IP
    private $db; //nombre de la bd
    private $usuario; //Usuario de la bd
    private $pass; //contraseña de usuario
    private $charset; //utf8

    #Constructor
    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'blogrecetas'; //Aqui va tu nombre de bd
        $this->usuario = 'root';
        $this->pass='';
        $this->charset = 'utf8';
    }

    #Método conectar
    public function conectar()
    {
       #Conectar a la BD -> PDO
       $com = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
       $enlace = new PDO($com, $this->usuario, $this->pass);
       #print_r($enlace);
       return $enlace;

    }
}

//$conexion = new Conexion();
//$conexion->conectar();
?>