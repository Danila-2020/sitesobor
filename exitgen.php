<?php
//Обработчик выхода из аккаунта(Пользователь General)
/*session_start();
ob_start();
require_once("bd.php");

if(isset($_POST['submit'])){
    $_SESSION['id'] = "";
    session_unset();
    session_destroy();
    echo'<script>window.location.href="signin.php"</script>';
}*/

// Обработчик выхода из аккаунта (Пользователь General)
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