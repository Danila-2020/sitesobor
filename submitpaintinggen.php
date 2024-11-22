<?php
// Обработчик обновления изображений таблица `imgpainting` (Пользователь General)

session_start();
require_once('bd.php');


// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Получение данных из формы
    $hiddenIds = $_POST['hidden']; // id_imgpainting
    $naimimgpainting = $_POST['naimimgpainting']; // названия изображений
    $textimgpainting = $_POST['textimgpainting']; // текст изображений
    $hiddenPaintingIds = $_POST['hiddenpainting']; // id_painting
    $descpainting = $_POST['descpainting']; // описание

    // Обновление описания картины
    $id_painting = $_POST['hiddenid'][0]; // предполагаем, что это одно значение
    $updateDescSql = "UPDATE imgpainting SET descpainting = ? WHERE id_imgpainting = ?";
    $stmt = $mysqli->prepare($updateDescSql);
    $stmt->bind_param("si", $descpainting, $id_painting);
    $stmt->execute();

    // Обновление изображений
    foreach ($hiddenIds as $index => $id_imgpainting) {
        // Обработка загружаемого изображения, если оно было загружено
        $image = null;
        if (isset($_FILES['images']['name'][$index]) && $_FILES['images']['name'][$index] != '') {
            $image = file_get_contents($_FILES['images']['tmp_name'][$index]);
        }

        // Обновление записи
        $updateImageSql = "UPDATE imgpainting SET naimimgpainting = ?, textimgpainting = ?, images = ? WHERE id_imgpainting = ?";
        $stmt = $mysqli->prepare($updateImageSql);
        $stmt->bind_param("ssbi", $naimimgpainting[$index], $textimgpainting[$index], $image, $id_imgpainting);
        $stmt->execute();
    }

    // Закрытие подготовленного выражения
    $stmt->close();
}

// Закрытие соединения
$mysqli->close();

?>