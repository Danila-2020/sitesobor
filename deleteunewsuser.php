<?php
// Обработчик удаления новости (пользователь user)
require_once('bd.php');

if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $query = ("UPDATE `unews` SET `statusunews`='deleted' WHERE `id_unews` = $id");
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Новость успешно удалена!')</script>");
        echo('<script>window.location.href="viewunewsgeneral.php"</script>');
    }
}
?>