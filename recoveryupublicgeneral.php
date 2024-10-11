<?php
session_start();
require_once('bd.php');
$idupublic = $_POST['id'];
    if(empty($idupublic)){
        echo('<script>window.location.href = "viewupublicgeneral.php";</script>');
    }
    if(isset($_POST['submit'])){
        $query = "UPDATE `upublic` SET `statusupublic`='active' WHERE `id_upublic` = $idupublic";
        $result = $mysqli->query($query);
        if($result){
            echo("<script>alert('Публикация успешно восстановлена');</script>");
            echo('<script>window.location.href="viewupublicgeneral.php"</script>');
        }
    }
?>