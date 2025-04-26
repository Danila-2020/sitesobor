<?php
// Файл отвечающий за обработку POST-запросов и сохранение ID деятельности в сессии(General)
session_start();
ob_start();
require_once('bd.php'); // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idactivity'])) {
        // Сохраняем ID деятельности в сессию
        $_SESSION['idactivity'] = intval($_POST['idactivity']);
        // Перенаправляем на страницу редактирования
        header("Location: editactivitygen.php");
        exit();
    } else {
        die("Ошибка: ID мероприятия не передан.");
    }
}
?>