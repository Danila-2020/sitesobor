<?php
require_once('bd.php');
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $query = "UPDATE `scedule` SET `sstatus`='deleted' WHERE `id_scedule` = $id";
    $result = $mysqli->query($query);
    echo("<script>alert('Расписание успешно удалено!')</script>");
    echo('<script>window.location.href="sceduleuploader.php"</script>');
}
?>