<?php
session_start();

// Конфигурация базы данных - ЗАПОЛНИТЕ СВОИ ДАННЫЕ!
define('DB_HOST', 'localhost');
define('DB_NAME', 'sobor');
define('DB_USER', 'root'); // замените на вашего пользователя
define('DB_PASS', '');     // замените на ваш пароль

// Подключение к БД
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", 
        DB_USER, 
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Проверка авторизации
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
}

// Получение названий таблиц
function getTableNames($pdo) {
    $stmt = $pdo->query("SHOW TABLES");
    $tables = array();
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }
    return $tables;
}

// Выход из системы
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>