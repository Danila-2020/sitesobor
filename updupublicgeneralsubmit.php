<?php
// Обработчик обновления публикации(Пользователь General)

session_start();
require_once('bd.php');
$id = $_SESSION['id_upublic'];
if(isset($_POST['submit'])){
    $naim = $_POST['naim'];
    $uptext = $_POST['uptext'];
    $query = "UPDATE upublic SET naim='$naim',uptext='$uptext' WHERE id_upublic='$id'";
    $result = $mysqli->query($query);
    if($result){
        echo("<script>alert('Данные успешно сохранены!!!')</script>");
        echo('<script>window.location.href="updupublicgeneral.php"</script>');
    }
}
?>