<?php
session_start();
require_once('bd.php');

    if(isset($_POST['submit'])){
        $_SESSION['id'] = "";
        session_unset();
        header('Location: signin.php');
    };
?>