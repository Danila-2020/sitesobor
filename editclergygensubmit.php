<?php
// Обработчик обновления Духовенства (Пользователь general)

session_start();
ob_start();
require_once('bd.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $id_clergy = $_POST['id_clergy'];
    $titleclergy = $_POST['titleclergy'];
    $textclergy = $_POST['textclergy'];
    $datesclergy = $_POST['datesclergy'];
    $educlergy = $_POST['educlergy'];
    $awardsclergy = $_POST['awardsclergy'];

    // Обработка загрузки изображения (если загружено)
    $imagesclergy = null;
    if (isset($_FILES['imagesclergy']) && $_FILES['imagesclergy']['error'] == UPLOAD_ERR_OK) {
        $imagesclergy = file_get_contents($_FILES['imagesclergy']['tmp_name']);
        $imagesclergy = $mysqli->real_escape_string($imagesclergy); // Экранирование данных
    }

    // Подготовка SQL-запроса
    $query = "UPDATE clergy SET 
              titleclergy = '$titleclergy', 
              textclergy = '$textclergy', 
              datesclergy = '$datesclergy', 
              educlergy = '$educlergy', 
              awardsclergy = '$awardsclergy' 
              WHERE id_clergy = '$id_clergy'";

    // Если изображение было загружено, добавляем его в запрос
    if ($imagesclergy !== null) {
        $query = "UPDATE clergy SET 
                  titleclergy = '$titleclergy', 
                  imagesclergy = '$imagesclergy', 
                  textclergy = '$textclergy', 
                  datesclergy = '$datesclergy', 
                  educlergy = '$educlergy', 
                  awardsclergy = '$awardsclergy' 
                  WHERE id_clergy = '$id_clergy'";
    }

    // Выполнение запроса
    if ($mysqli->query($query)) {
        header('Location: genclergy.php?success=update'); // Перенаправление при успешном обновлении
    } else {
        echo 'Ошибка обновления записи: ' . htmlspecialchars($mysqli->error);
    }
} else {
    header('Location: genclergy.php');
}
?>