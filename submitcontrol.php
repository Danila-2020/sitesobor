<?php
session_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $id = $_POST['hidden'];
    $query = "UPDATE `uprofile` SET `statusuprofile`='deleted' WHERE `id_uprofile`= $id";
    var_dump($query);
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Пользователь удалён с возможностью восстановления!!!')</script>");
        echo('<script>window.location.href="controluprofile.php"</script>');
    }
}
?>