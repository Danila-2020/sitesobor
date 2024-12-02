<?php
// Обработчик обновления Духовенства(Пользователь general)

session_start(); // Запускаем сессию
ob_start();
$id = $_SESSION['id'];

// Подключение к базе данных
require_once('bd.php');

// Проверка, был ли отправлен запрос
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $id_clergy = mysqli_real_escape_string($mysqli, $_POST['hidden']); // id_clergy из скрытого поля
    $titleclergy = mysqli_real_escape_string($mysqli, $_POST['titleclergy']);
    $textclergy = mysqli_real_escape_string($mysqli, $_POST['textclergy']);
    $datesclergy = mysqli_real_escape_string($mysqli, $_POST['datesclergy']);
    $educlergy = mysqli_real_escape_string($mysqli, $_POST['educlergy']);
    $awardsclergy = mysqli_real_escape_string($mysqli, $_POST['awardsclergy']); // Награды из формы
    $id_uprofile = mysqli_real_escape_string($mysqli, $_SESSION['id']); // id_uprofile из сессии

    // Обработка изображения (если оно загружено)
    $imagesclergy = null;
    if (isset($_FILES['imagesclergy']) && $_FILES['imagesclergy']['error'] == UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['imagesclergy']['tmp_name']);
        $imagesclergy = base64_encode($imageData); // Кодируем изображение в Base64
    }

    // Обновляем информацию о священнике
    $sql = "UPDATE clergy SET 
                titleclergy='$titleclergy', 
                imagesclergy='$imagesclergy', 
                textclergy='$textclergy', 
                datesclergy='$datesclergy', 
                educlergy='$educlergy', 
                awardsclergy='$awardsclergy', 
                id_uprofile='$id_uprofile' 
            WHERE id_clergy='$id_clergy'";
    
    if ($mysqli->query($sql) === TRUE) {
        // Перенаправляем на страницу успеха
        header("Location: updclergy.php"); // Ехаем назад на страницу успеха
        exit();
    } else {
        echo "Ошибка обновления: " . $mysqli->error;
    }
}

// Закрываем соединение
$mysqli->close();
?>