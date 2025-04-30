<?php
// Обработчик обновления мероприятия (Пользователь General)

ob_start();
session_start();
require_once('bd.php');

// Проверяем, что форма отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из POST
    $idevents = $_SESSION['idevents'];
    $caption = $mysqli->real_escape_string($_POST['caption']); // Название
    $description = $mysqli->real_escape_string($_POST['description']); // Описание
    $datep = $mysqli->real_escape_string($_POST['datep']); // Дата проведения

    // Формируем SQL-запрос для обновления данных
    $query = "
        UPDATE events 
        SET caption = '$caption', 
            description = '$description', 
            datep = '$datep' 
        WHERE id_events = $idevents
    ";

    // Выполняем запрос
    if ($mysqli->query($query)) {
        echo "<script>alert('Данные успешно обновлены!!!');</script>";
        header('Location: viewueventsuser.php');
    } else {
        echo "Ошибка выполнения запроса: " . $mysqli->error;
    }
} else {
    echo "Неверный метод запроса.";
}
?>