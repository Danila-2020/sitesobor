<?php
// Обработчик восстановления Новости(Пользователь User)

require_once('bd.php');

if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $query = ("UPDATE `unews` SET `statusunews`='active' WHERE `id_unews` = $id");
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Новость успешно восстановлена!')</script>");
        echo('<script>window.location.href="viewunewsuser.php"</script>');
    }
}
?>