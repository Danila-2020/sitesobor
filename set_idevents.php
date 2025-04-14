<?php
// Файл отвечающий за обработку POST-запросов и сохранение ID мероприятия в сессии(General)
session_start();
ob_start();
require_once('bd.php'); // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idevents'])) {
        // Сохраняем ID мероприятия в сессию
        $_SESSION['idevents'] = intval($_POST['idevents']);
        // Перенаправляем на страницу редактирования
        header("Location: editeventsgeneral.php");
        exit();
    } else {
        die("Ошибка: ID мероприятия не передан.");
    }
}
?>