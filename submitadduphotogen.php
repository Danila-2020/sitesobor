<?php
// Обработчик добавления Фото в Публикацию(Пользователь General)

session_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $upublic = $_POST['upublic'];
    $img_type = substr($_FILES['uphoto']['type'],0,5);
    $img_size = 2*1024*1024;
    if(!empty($_FILES['uphoto']['tmp_name']) and ($img_type === 'image/jpeg' or $img_type === 'image/png' or $img_type === 'image' and $_FILES['uphoto']['size'] <= $img_size)){
        $uphoto = addslashes(file_get_contents($_FILES['uphoto']['tmp_name']));
        $query = ("INSERT INTO `uphoto`(`uphoto`, `id_upublic`) VALUES ('$uphoto','$upublic')");
        $result = $mysqli->query($query);
        if($result){
            echo("<script>alert('Фото успешно добавлено!!!');</script>");//Встъебенено успешно!!!
            echo('<script>window.location.href="adduphotogen.php";</script>');
        }
    }
}
?>