<?php
// Удаление мероприятия (Пользователь user)

session_start();
ob_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $query = ("UPDATE `events` SET `statusevents`='deleted' WHERE `id_events` = '$id'");
    $result = $mysqli->query($query);

    if($result){
        echo("<script>alert('Мероприятие успешно удалено с возможностью восстановления!!!');</script>");
        echo("<script>window.location.href='viewueventsuser.php';</script>");
        exit(); // Завершите выполнение скрипта
    }
}
?>