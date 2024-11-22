<?php
// Обработчик добавления записи в таблицу painting
session_start();
require_once('bd.php');
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
    $npainting = $_POST['npainting'];
    $descpainting = $_POST['descpainting'];
    $query = ("INSERT INTO `painting`(`npainting`, `descpainting`, `id_uprofile`) 
    VALUES ('$npainting','$descpainting',$id)");
    // var_dump($query);
    $result = $mysqli->query($query);
    echo("<script>alert('Основные сведения о росписи добавлены.');</script>");
    // $result->free();
    header('Location: addpainting.php');
}
?>