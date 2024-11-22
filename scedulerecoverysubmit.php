<?php
// Обработчик восстановления расписания богослужений(Пользователь Admin)

require_once('bd.php');
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $query = "UPDATE `scedule` SET `sstatus`='active' WHERE `id_scedule` = $id";
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Расписание успешно восстановлено!')</script>");
        echo('<script>window.location.href="sceduleuploader.php"</script>');
    }
}
?>