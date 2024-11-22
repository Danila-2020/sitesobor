<?php
// Обработчик удаления деятельности (пользователь general)

ob_start();
session_start(); //Тут идёт session_start(), он наверное не нужен
require_once('bd.php');
if(isset($_POST['submit'])){
    $idactivity = $_POST['hidden'];
    $nactivity = $_POST['nactivity'];
    $descactivity = $_POST['descactivity'];
    $query = ("DELETE FROM `activity` WHERE `id_activity`= $idactivity");
    $result = $mysqli->query($query);
    echo("<script>alert('Деятельность успешно удалена');</script>");
    echo("<script>window.location.href='editactivitygen.php';</script>");
}
?>