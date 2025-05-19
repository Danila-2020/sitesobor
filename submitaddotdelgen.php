<?php
// Обработчик добавления отдела (Пользователь General)
ob_start();
session_start();
require_once('bd.php');

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: addotdelgen.php');
    exit();
}

// Получаем данные из формы
$departmentName = trim($_POST['departmentName'] ?? '');
$departmentDescription = trim($_POST['departmentDescription'] ?? '');

// Проверяем обязательные поля
if (empty($departmentName) || empty($departmentDescription)) {
    $_SESSION['error'] = 'Название и описание отдела обязательны для заполнения';
    header('Location: addotdelgen.php');
    exit();
}

// Добавляем отдел в базу данных
try {
    // Экранируем специальные символы
    $name = $mysqli->real_escape_string($departmentName);
    $description = $mysqli->real_escape_string($departmentDescription);
    
    // Вставляем данные отдела
    $query = "INSERT INTO otdel (naim_otdel, desc_otdel) 
              VALUES ('$name', '$description')";
    
    if (!$mysqli->query($query)) {
        throw new Exception('Ошибка при добавлении отдела: ' . $mysqli->error);
    }
    
    $_SESSION['success'] = 'Отдел успешно добавлен!';
    header('Location: uotdel.php');
    exit();

} catch (Exception $e) {
    $_SESSION['error'] = 'Ошибка: ' . $e->getMessage();
    $_SESSION['form_data'] = [
        'departmentName' => $departmentName,
        'departmentDescription' => $departmentDescription
    ];
    header('Location: addotdelgen.php');
    exit();
}
?>