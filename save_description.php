<?php
session_start();
ob_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $id = $_POST['hidden'];
    $descpainting = $_POST['descpainting'];
    $query = ("UPDATE `painting` SET `descpainting`='$descpainting' WHERE `id_painting` = $id");
    // var_dump($query);
    $result = $mysqli->query($query);
    echo("<script>alert('Изменения сохранены!');</script>");
    header('Location: editpaintinggeneral.php');
}
?>