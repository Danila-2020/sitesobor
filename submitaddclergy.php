<?php
// Обработчик добавления Духовенства

session_start();//Тут идёт session_start(), он наверное не нужен
ob_start();
require_once('bd.php');
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
    $titleclergy = $_POST['titleclergy'];
    $img_type = substr($_FILES['imagesclergy']['type'], 0, 5);
    $img_size = 2*1024*1024;
    if((!empty($_FILES['imagesclergy']['tmp_name']))and($_FILES['imagesclergy']['size'] <= $img_size)){
        $img = addslashes(file_get_contents($_FILES['imagesclergy']['tmp_name']));
    }else{
        $img = '';
    }
    $textclergy = ('<div class="textclergy">'.$_POST['textclergy'].'</div>');
    // $datesclergy = $_POST['datesclergy'];
    $educlergy = $_POST['educlergy'];
    $awardsclergy = $_POST['awardsclergy'];

    $query = ("INSERT INTO `clergy`(`titleclergy`, `imagesclergy`, `textclergy`, `educlergy`, `awardsclergy`, `id_uprofile`) VALUES ('$titleclergy','$img','$textclergy','$educlergy','$awardsclergy',$id)");//`datesclergy`, VALUES('$datesclergy',)
    $result = $mysqli->query($query);
    echo("<script>alert('Добавление священника произведено успешно!!!');</script>");
    // header('Location: addclergy.php');
}
?>