<?php
// Обработчик редактирования деятельности(пользователь General)

ob_start();
session_start(); //Тут идёт session_start(), он наверное не нужен
require_once('bd.php');
if(isset($_POST['submit'])){
    $nactivity = $_POST['nactivity'];
    $descactivity = $_POST['descactivity'];
    $idactivity = $_POST['id'];
    $query = ("UPDATE `activity` 
    SET `nactivity`='$nactivity',
    `descactivity`='$descactivity',
    `sstatus`='active' 
    WHERE `id_activity`= $idactivity");
    // var_dump($query);
    $result = $mysqli->query($query);
    echo("<script>alert('Изменения сохранены');</script>");
    echo("<script>window.location.href='editactivitygen.php';</script>");
    // header('location:editactivitygen.php');
}
?>