<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['id'])) {
    header('Location: signin.php');
    exit();
}

require_once('bd.php');

// Получаем данные из формы
$title = $mysqli->real_escape_string(trim($_POST['title'] ?? ''));
$url = $mysqli->real_escape_string(trim($_POST['url'] ?? ''));
$description = isset($_POST['description']) ? $mysqli->real_escape_string(trim($_POST['description'])) : null;
$user_id = (int)$_SESSION['id'];

// Валидация данных
if (empty($title)) {
    header('Location: add_iframes.php?error=empty_title');
    exit();
}

if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
    header('Location: add_iframes.php?error=invalid_url');
    exit();
}

// SQL запрос для вставки данных
$sql = "INSERT INTO iframes (utitle, url, description, id_uprofile) 
        VALUES ('$title', '$url', " . ($description ? "'$description'" : "NULL") . ", $user_id)";

if ($mysqli->query($sql)) {
    header('Location: add_iframes.php?success=1');
} else {
    header('Location: add_iframes.php?error=save_failed&db_error=' . urlencode($mysqli->error));
}

$mysqli->close();
?>