<?php
ob_start();
session_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    // Редактирование описания
    $idpainting = $_POST['hiddenid']; // id_painting
    $descpainting = $_POST['descpainting']; // descpainting
    $qpainting = "UPDATE `painting` SET `descpainting`='$descpainting' WHERE `id_painting` = $idpainting";
    $mysqli->query($qpainting);

    // Редактирование изображения
    if(!empty($_FILES['images']['tmp_name']) && !empty($_POST['naimimgpainting'])){
        $idimg = $_POST['hidden']; // id_imgpainting
        $naimimgpainting = $_POST['naimimgpainting'];
        $textimgpainting = $_POST['textimgpainting'];

        // Проверка типа файла
        $new_img_type = $_FILES['images']['type'];
        if (strpos($new_img_type, 'image/') !== 0) {
            echo("<script>alert('Неверный тип файла. Пожалуйста, загрузите изображение.');</script>");
            exit;
        }

        // Проверка размера файла
        $new_img_size = $_FILES['images']['size'];
        if ($new_img_size > 15 * 1024 * 1024) {
            echo("<script>alert('Размер изображения не должен превышать 2 МБ.');</script>");
            exit;
        }

        // Получение содержимого изображения
        $new_img = addslashes(file_get_contents($_FILES['images']['tmp_name']));

        // Запрос
        $query = "UPDATE `imgpainting` SET `naimimgpainting`='$naimimgpainting', `textimgpainting`='$textimgpainting', `images`='$new_img' WHERE `id_imgpainting` = $idimg";
        $result = $mysqli->query($query);

        if($result) {
            echo("<script>alert('Изменения сохранены');</script>");
            header("Location: editpaintinggeneral.php");
        } else {
            echo("<script>alert('Ошибка при сохранении изменений: " . $mysqli->error . "');</script>");
        }
    } else {
        $idimg = $_POST['hidden']; // id_imgpainting
        $naimimgpainting = $_POST['naimimgpainting'];
        $textimgpainting = $_POST['textimgpainting'];

        // Запрос без обновления изображения
        $query = "UPDATE `imgpainting` SET `naimimgpainting`='$naimimgpainting', `textimgpainting`='$textimgpainting' WHERE `id_imgpainting` = $idimg";
        $result = $mysqli->query($query);

        if($result) {
            echo("<script>alert('Изменения сохранены');</script>");
            header("Location: editpaintinggeneral.php");
        } else {
            echo("<script>alert('Ошибка при сохранении изменений: " . $mysqli->error . "');</script>");
        }
    }
}
?>