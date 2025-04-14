<?php
//Обработчик выхода из аккаунта(Пользователь User)

session_start();
ob_start();
require_once("bd.php");

// Проверяем, была ли отправлена форма с кнопкой "submit"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Уничтожаем сессию
    $_SESSION = []; // Очищаем все данные сессии
    session_unset(); // Удаляем все переменные сессии
    session_destroy(); // Уничтожаем сессию

    // Перенаправляем пользователя на страницу входа
    header("Location: signin.php");
    exit(); // Завершаем выполнение скрипта
}
?>