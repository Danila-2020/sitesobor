<?php
// Обработчик выхода из профиля Admin

ob_start();
session_start();
require_once('bd.php');

    if(isset($_POST['submit'])){
        $_SESSION['id'] = "";
        session_unset();
        session_destroy();
        header('Location: signin.php');
    };
?>