<?php
// Обработчик обновления Новости (Пользователь Admin)

session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

$id = $_SESSION['id'];
$idunews = $_SESSION['idunews'];

if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}

if(isset($_POST['submit'])){
    $utitle = $_POST['utitle'];
    $udescription = $_POST['udescription'];
    $textunews = $_POST['textunews'];
    $dateunews = $_POST['dateunews'];
    $query = ("UPDATE `unews` SET `utitle`='$utitle',`udescription`='$udescription',`textunews`='$textunews',`statusunews`='active',`dateunews`='$dateunews' WHERE `id_unews` = $idunews");
    $result = $mysqli->query($query);
    //var_dump($query);
    echo("<script>alert('Изменения успешно внесенны!');</script>");
    echo('<script>window.location.href="updateunewsadmin.php"</script>');
}
?>