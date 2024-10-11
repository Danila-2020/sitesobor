<?php
session_start();
require_once('bd.php');
$id = $_SESSION['id'];
    if(isset($_POST['submitupdate'])){
        $img_type = substr($_FILES['uphoto'] ['type'],0,5);
        $img_size = 2*1024*1024;
        //var_dump($_FILES);
        if(!empty($_FILES['uphoto']['tmp_name']) and ($img_type === 'image' and $_FILES['uphoto']['size'] <=$img_size)){
            $img = addslashes(file_get_contents($_FILES['uphoto']['tmp_name']));
            $query = ("UPDATE `uprofile` SET `uphoto` = '$img' WHERE `uprofile`.`id_uprofile` = $id");
            //var_dump($query);
            $mysqli->query($query);
            echo("<script>alert('Фото профиля обновлено!!!');</script>");
            echo('<script>window.location.href="userprofile.php"</script>');
        };
    };
?>