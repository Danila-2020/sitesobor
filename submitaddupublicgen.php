<?php
session_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $naim = $_POST['naim'];
    $uptext = $_POST['uptext'];
    $id = $_SESSION['id']; //id_uprofile
    $query = "INSERT INTO upublic(`naim`,`uptext`,`id_uprofile`) VALUES ('$naim','$uptext','$id')";
    $result = $mysqli->query($query);
    echo("<script>alert('Публикация добавлена успешно')</script>");
    echo('<script>window.location.href="addupublicgen.php"</script>');
}
?>