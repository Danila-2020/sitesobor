<?php
// ob_start();
session_start();
include('template/head.php');
require_once('bd.php');

if(isset($_POST['submit'])){
    // Редактирование описания
    $idpainting = $_POST['hiddenid']; // id_painting
    $descpainting = $_POST['descpainting']; // descpainting
    $qpainting = "UPDATE `painting` SET `descpainting`='$descpainting' WHERE `id_painting` = $idpainting";
    $mysqli->query($qpainting);
    echo("<script>alert('Описание успешно сохранено!');</script>");

    // Редактирование изображения
    if(!empty($_FILES['images']['tmp_name'])){ //&& !empty($_POST['naimimgpainting'])
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
            echo("<script>alert('Размер изображения не должен превышать 15 МБ.');</script>");
            exit;
        }

        // Получение содержимого изображения
        $new_img = addslashes(file_get_contents($_FILES['images']['tmp_name']));

        // Запрос
        $query = "UPDATE `imgpainting` SET `naimimgpainting`='$naimimgpainting', `textimgpainting`='$textimgpainting', `images`='$new_img' WHERE `id_imgpainting` = $idimg";
        $result = $mysqli->query($query);

        if($result) {
            echo("<script>alert('Изменения сохранены');</script>");
            echo('<div class="container" style="margin-top: 2%">
            <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"><a href="editpaintinggeneral.php" class="btn btn-warning" style="width:100%">Вернуться назад</a></div></div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
            </div>');
            
            // echo('<a href="editpaintinggeneral.php">Вернуться назад</a>');
            //header("Location: editpaintinggeneral.php");
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
            echo('<a href="editpaintinggeneral.php" class="btn btn-outline-primary">Вернуться назад</a>');
            //header("Location: editpaintinggeneral.php");
        } else {
            echo("<script>alert('Ошибка при сохранении изменений: " . $mysqli->error . "');</script>");
        }
    }
}
?>