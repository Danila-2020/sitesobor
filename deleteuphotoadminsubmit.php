<?php
session_start();
require_once('bd.php');
$id = $_SESSION['id'];
    if(isset($_POST['submit'])){
        $id = $_SESSION['id'];
        $query = "UPDATE `uprofile` SET `uphoto`= '' WHERE `id_uprofile` = $id";
        $result = $mysqli->query($query);
        echo("<script>alert('Фото профиля удалено!!!');</script>");
        echo('<script>window.location.href="adminprofile.php"</script>');
    }
?>