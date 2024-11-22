<?php
// Обработчик обновления описания Росписи в таблице `painting` (Пользователь General)

session_start();
ob_start();
require_once('bd.php');

if(isset($_POST['submit'])) {
    $idpainting = $_POST['hiddenid'];
    $descpainting = $_POST['descpainting'];
    $query = ("UPDATE `painting` SET `descpainting`='".$descpainting."' WHERE `id_painting` = $idpainting");
    $result = $mysqli->query($query);
    
    if($result) {
        echo("<script>alert('Сведения о росписи успешно изменены!!!')</script>");
        // sleep(15);
        header("Refresh: 0.2; url=editpaintinggeneral.php");
    }
    //var_dump($query);
}
?>