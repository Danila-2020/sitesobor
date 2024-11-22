<?php
// Обработчик полного удаления профиля(Пользователь General)

session_start();
require_once('bd.php');

if(isset($_POST['submit'])){
    $iduprofile = $_POST['hdelete'];
    $query= "DELETE FROM `uprofile` WHERE `uprofile`.`id_uprofile` = '$iduprofile' AND `statusuprofile` = 'active'";
    var_dump($query);
    $result = $mysqli->query($query);
    echo("<script>alert('Пользователь удалён полностью!!!')</script>");
    echo('<script>window.location.href="controluprofile.php"</script>');
}
?>