<?php
session_start();//Тут идёт session_start, он наверное не нужен
ob_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $naimimgpainting = $_POST['naimimgpainting'];
    $textimgpainting = $_POST['textimgpainting'];
    if(!empty($_FILES['newimg'] ['tmp_name'])){
        $img = addslashes(file_get_contents($_FILES['newimg']['tmp_name']));
        $query = ("UPDATE `imgpainting` 
        SET `naimimgpainting`='$naimimgpainting',
        `textimgpainting`='$textimgpainting',
        `images`='$img',`id_painting`= 1 
        WHERE `id_imgpainting`= $id");
        $result = $mysqli->query($query);
        if($result){
            // echo("<script>alert('Изменения успешно сохранены!');</script>");
            // var_dump($query);
            // sleep(10);
            // header('Location: editpaintinggeneral.php');

            $_SESSION['message'] = 'Изменения успешно сохранены!';
            header('Location: editpaintinggeneral.php');
            exit();

            if (isset($_SESSION['message'])) {
                echo "<script>alert('" . $_SESSION['message'] . "');</script>";
                unset($_SESSION['message']); // Удаляем сообщение из сессии после его отображения
            }
        }
    }
    if(empty($_FILES['newimg']['tmp_name'])){
        $id = $_POST['id'];
        $naimimgpainting = $_POST['naimimgpainting'];
        $textimgpainting = $_POST['textimgpainting'];
        $query = ("UPDATE `imgpainting` 
        SET `naimimgpainting`='$naimimgpainting',
        `textimgpainting`='$textimgpainting',
        `id_painting`= 1 
        WHERE `id_imgpainting`= $id");
        $result = $mysqli->query($query);
        if($result){
            // echo("<script>alert('Изменения успешно сохранены!');</script>");
            // var_dump($query);
            // sleep(10);
            // header('Location: editpaintinggeneral.php');

            $_SESSION['message'] = 'Изменения успешно сохранены!';
            header('Location: editpaintinggeneral.php');
            exit();

            if (isset($_SESSION['message'])) {
                echo "<script>alert('" . $_SESSION['message'] . "');</script>";
                unset($_SESSION['message']); // Удаляем сообщение из сессии после его отображения
            }
        }
    }
}
?>