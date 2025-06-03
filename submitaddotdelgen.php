<?php
// Обработчик добавления отдела (Пользователь General)
ob_start();
session_start();
require_once('bd.php');

// Проверка авторизации
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Проверяем, что форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iduprofile = $_SESSION['id'];
    $departmentName = $mysqli->real_escape_string(trim($_POST['departmentName']));
    $departmentDescription = $mysqli->real_escape_string(trim($_POST['departmentDescription']));

    // Валидация данных
    if (empty($departmentName) || empty($departmentDescription)) {
        die("Все поля обязательны для заполнения");
    }

    // Простой INSERT (небезопасно без экранирования!)
    $query = "INSERT INTO `otdel` (`naim_otdel`, `desc_otdel`, `id_uprofile`) 
              VALUES ('$departmentName', '$departmentDescription', '$iduprofile')";

    $result = $mysqli->query($query);

    if ($result) {
        // Успешное добавление
        header('Location: addotdelgen.php?success=1');
        exit();
    } else {
        // Ошибка при выполнении запроса
        die("Ошибка при добавлении отдела: " . $mysqli->error);
    }
} else {
    // Если форма не отправлена, перенаправляем
    header('Location: addotdelgen.php');
    exit();
}
?>