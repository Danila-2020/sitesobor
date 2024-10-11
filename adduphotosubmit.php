<?php
session_start();
require_once('bd.php');
if(isset($_POST['submit'])){
            $upublic = $_POST['upublic'];
            $img_type = substr($_FILES['img_upload']['type'],0,5);
            $img_size = 2*1024*1024;
                if(!empty($_FILES['uphoto']['tmp_name']) and ($img_type === 'image' and $_FILES['img_upload']['size'] <=$img_size)){
                    $uphoto = addslashes(file_get_contents($_FILES['uphoto']['tmp_name']));
                    $query = "insert into uphoto (uphoto, id_upublic)values($uphoto, '$upublic')";
                    var_dump($query);
                    $mysqli->query($query);
                    echo("<script>alert('Уеб фото добавлено');window.location.href='adduphoto.php';</script>");
                }
}
?>