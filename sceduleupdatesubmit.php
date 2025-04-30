<?php
// Обработчик обновления расписания богослужений

ob_start();
session_start();
require_once('bd.php');

if (isset($_POST['submit'])) {
    $id = intval($_POST['id']); // ID записи
    $titlescedule = $mysqli->real_escape_string($_POST['titlescedule']); // Заголовок

    // Проверяем, загружена ли новая картинка
    if (!empty($_FILES['uploadimg']['tmp_name'])) {
        $img_type = substr($_FILES['uploadimg']['type'], 0, 5); // Тип файла
        $img_size = 15 * 1024 * 1024; // Максимальный размер файла (15 МБ)

        // Проверяем тип и размер файла
        if (($img_type === 'image') || ($img_type === 'image/png') && ($_FILES['uploadimg']['size'] <= $img_size)) {
            // Читаем содержимое файла
            $img = addslashes(file_get_contents($_FILES['uploadimg']['tmp_name']));

            // Формируем запрос с обновлением картинки
            $query = "UPDATE `scedule` 
                      SET `titlescedule`='$titlescedule', 
                          `imagescedule`='$img', 
                          `sstatus`='active' 
                      WHERE `id_scedule` = $id";

            // Выполняем запрос
            if ($mysqli->query($query)) {
                echo "<script>alert('Расписание успешно обновлено!!!');</script>";
                sleep(5);
                header("Location: sceduleuploader.php");
                exit;
            } else {
                echo "<script>alert('Ошибка при обновлении расписания!!!');</script>";
                exit;
            }
        } else {
            // Некорректный тип файла или размер превышает допустимый
            echo "<script>alert('Некорректный тип файла или размер превышает 2 МБ. Попробуйте загрузить другой файл!!!');</script>";
            echo '<script>window.location.href="sceduleuploader.php";</script>';
            exit;
        }
    } else {
        // Если картинка не загружена, обновляем только текстовые данные
        $query = "UPDATE `scedule` 
                  SET `titlescedule`='$titlescedule', 
                      `sstatus`='active' 
                  WHERE `id_scedule` = $id";

        // Выполняем запрос
        if ($mysqli->query($query)) {
            echo "<script>alert('Расписание успешно обновлено!!!');</script>";
            sleep(5);
            header("Location: sceduleuploader.php");
            exit;
        } else {
            echo "<script>alert('Ошибка при обновлении расписания!!!');</script>";
            exit;
        }
    }
} else {
    // Если форма не отправлена
    echo "<script>alert('Форма не отправлена. Пожалуйста, попробуйте снова.');</script>";
    echo '<script>window.location.href="sceduleuploader.php";</script>';
    exit;
}
?>