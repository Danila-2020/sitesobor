<?php
// Файл отвечающий за обработку POST-запросов и сохранение ID отдела в сессии(General)
session_start();
ob_start();
require_once('bd.php'); // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idotdel'])) {
        // Сохраняем ID отдела в сессию
        $_SESSION['idotdel'] = intval($_POST['idotdel']);
        // Перенаправляем на страницу просмотра
        header("Location: uotdel.php");
        exit();
    } else {
        die("Ошибка: ID отдела не передан.");
    }
}
?>