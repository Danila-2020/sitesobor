<?php
session_start();

// Включение отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

require_once('bd.php');

// Получаем ID iframe из GET-параметра
$iframe_id = (int)($_GET['id'] ?? 0);
$user_id = (int)$_SESSION['user_id'];

// Проверяем, существует ли iframe и принадлежит ли пользователю
$check_sql = "SELECT id_iframes FROM iframes WHERE id_iframes = $iframe_id AND id_uprofile = $user_id";
$check_result = $mysqli->query($check_sql);

if (!$check_result || $check_result->num_rows === 0) {
    header('Location: my_iframes.php?error=not_found');
    exit();
}

// Удаляем iframe
$delete_sql = "DELETE FROM iframes WHERE id_iframes = $iframe_id AND id_uprofile = $user_id";

if ($mysqli->query($delete_sql)) {
    header('Location: my_iframes.php?success=deleted');
} else {
    header('Location: my_iframes.php?error=delete_failed&db_error=' . urlencode($mysqli->error));
}

$mysqli->close();
exit();
?>