<?php
session_start();
require_once('bd.php');
$id = $_POST['id'];
if(isset($_POST['submit'])){
    $query = "UPDATE `upublic` SET `statusupublic`='deleted' WHERE `id_upublic` = $id";
    var_dump($query);
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Публикация удалена с возможностью восстановления!!!')</script>");
        echo('<script>window.location.href="viewupublicgeneral.php"</script>');
    }
}
?>