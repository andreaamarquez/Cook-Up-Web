<?php
require_once "CAD.php";
    session_start();
    $idRol = 0;
    $idUsuario = 0;
    if (isset($_SESSION['idRol'])) {
        $idRol = $_SESSION['idRol'];
        $idUsuario = $_SESSION['idUsuario'];
    }
    $cad = new CAD();
    if(isset($_GET['idReceta']))
    {
        $idReceta = $_GET['idReceta'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = $_POST['comentario'];
        }
        if($cad->agregaComentario($idReceta, $idUsuario, $comentario))
            header("Location: ../receta.php?idReceta=$idReceta");
    }
    
    exit;
?>