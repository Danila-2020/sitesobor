<?php
// Обработчик добавления изображений Росписи в таблицу `imgpainting` (Пользователь General)

session_start();
ob_start();

require_once('bd.php');

if(isset($_POST['submit'])){
    $naimimgpainting = $_POST['naimimgpainting'];
    $textimgpainting = $_POST['textimgpainting'];
    $img_type = substr($_FILES['images'] ['type'], 0, 5);
    $img_size = 15*1024*1024;

    if(!empty($_FILES['images'] ['tmp_name']) && !empty($naimimgpainting) && !empty($textimgpainting)){
        $images = addslashes(file_get_contents($_FILES['images'] ['tmp_name']));
        $sel = ("SELECT MAX(id_painting) AS `id` FROM painting");
        $result = $mysqli->query($sel);
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
        }
        $id = intval($id);
        var_dump($id);
        $query = ("INSERT INTO `imgpainting`( `naimimgpainting`, `textimgpainting`, `images`, `id_painting`) 
        VALUES ('$naimimgpainting','$textimgpainting','$images',$id)");
        $result = $mysqli->query($query);
        if($result){
            echo("<script>alert('Изменения произведены успешно')</script>");
            header('Location: inspainting.php');
        }
    }
}
?>