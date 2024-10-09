<?php
require_once("bd.php");
session_start();

if(isset($_POST['submit'])){
    $caption = $_POST['caption'];
    $description = $_POST['description'];
    $datep = $_POST['datep'];
    $id_uprofile = $_SESSION['id'];
    $insert = "INSERT INTO `events`(`caption`, `description`, `datep`, `id_uprofile`) VALUES ('$caption','$description','$datep',$id_uprofile)";
    $mysqli->query($insert);
    echo("<script>alert('Мероприятие добавлено успешно!');window.location.href='addeventsgen.php';</script>");
}
?>