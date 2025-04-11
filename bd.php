<?php
// Модуль подключения к базе данных

// $mysqli = new mysqli("localhost","root","jH75DLsvi6Mm","ddrobi4v_example");
// $mysqli->set_charset("utf8");

// $mysqli = new mysqli("localhost","root","","sobor");
// $mysqli->set_charset("utf8");
?>

<?php
ob_start();
// bd.php — файл для подключения к базе данных и инициализации сессии

// 1. Стартуем сессию
session_start();

// 2. Подключаемся к базе данных
$mysqli = new mysqli("localhost","root","","sobor");

// Проверяем соединение
if ($mysqli->connect_error) {
    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
}

// 3. Устанавливаем кодировку
$mysqli->set_charset("utf8");

// 4. Глобальные настройки (если нужны)
date_default_timezone_set('Europe/Moscow');

// 5. Функции для работы с базой данных (если нужны)
function checkUserAuth() {
    // Пример функции для проверки авторизации
    if (!isset($_SESSION['id'])) {
        return false;
    }
    return true;
}

// 6. Если нужно, добавляем обработку ошибок
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

ob_end_flush();
?>