<?php
// Обработчик удаления новости(пользователь General)

session_start();
require_once('bd.php');
$id = $_SESSION['id'];
    if(isset($_POST['submit'])){
        $idunews = $_POST['id'];
        $query = "delete from unews where id_unews = $idunews";
        $result = $mysqli->query($query);
        echo("<script>alert('Новость полностью удалена!!!');</script>");
        echo('<script>window.location.href="viewunewsgeneral.php"</script>');
    }
?>