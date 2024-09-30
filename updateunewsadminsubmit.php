<?php
session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}

if(isset($_POST['submit'])){
    $utitle = $_POST['utitle'];
    $udescription = $_POST['udescription'];
    $textunews = $_POST['textunews'];
    $query = ("UPDATE `unews` SET `utitle`='$utitle',`udescription`='$udescription',`textunews`='$textunews',`statusunews`='active',`dateunews`='' WHERE `id_unews` = 1");
    $result = $mysqli->query($query);
    echo("<script>alert('Изменения успешно внесенны!');</script>");
    echo('<script>window.location.href="updateunewsadmin.php"</script>');
}
?>