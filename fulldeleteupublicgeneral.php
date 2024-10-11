<?php
session_start();
require_once('bd.php');
$id = $_POST['id'];
if(isset($_POST['submit'])){
    $query = "DELETE FROM `upublic` WHERE `id_upublic` = $id";
    // var_dump($query);
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Публикация полностью удалена')</script>");
        echo('<script>window.location.href = "viewupublicgeneral.php"</script>');
    }
}
?>