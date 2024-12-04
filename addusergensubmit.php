<?php
// Обработчик добавления пользователя(Пользователь General)
session_start();//Тут идёт session_start, он наверное не нужен ☺
require_once('bd.php');
if(isset($_POST['submit'])){
    $ulastname = $_POST['ulastname'];
    $ufirstname = $_POST['ufirstname'];
    $upatronymic = $_POST['upatronymic'];
    $uemail = $_POST['uemail'];
    $urole = $_POST['urole'];
    $uphone = $_POST['uphone'];
    $ulogin = $_POST['ulogin'];
    $upassword = $_POST['upassword'];
    $ucode = ("[".$ulogin."]_[".$upassword."]");
    //var_dump($ucode);
    $query = "INSERT INTO `uprofile`(`ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`) 
    VALUES ('$ulastname','$ufirstname','$upatronymic','$uemail','$urole','$ulogin','$upassword','$ucode','$uphone')";
    //var_dump($query);
    $mysqli->query($query);
    echo("<script>alert('Пользователь успешно добавлен!!!')</script>");
    echo('<script>window.location.href="addusergen.php"</script>');
}
?>