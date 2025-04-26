<?php
//Обработчик обновления записи о деятельности (Пользователь General)

session_start();
ob_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $idactivity = $_POST['idactivity'];
    $nactivity = $_POST['nactivity'];
    $descactivity = $_POST['descactivity'];

    $query = "UPDATE `activity` 
    SET 
    `nactivity`='$nactivity',
    `descactivity`='$descactivity',
    `sstatus`= 'active' 
    WHERE `activity`.`id_activity` = '$idactivity'";
    $result = $mysqli->query($query);

    if($result == true){
        header('Location: viewactivitygen.php');
    }else{
        exit('Ошибка обновления данных');
    }
}
?>