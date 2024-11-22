<?php
// Обработчик обновления расписания богослужений

session_start();
require_once('bd.php');
// $sid = $_SESSION['idscedule'];

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $titlescedule = $_POST['titlescedule']; //Заголовок
    $img_type = substr($_FILES['uploadimg']['type'],0,5);
    $img_size = 2*1024*1024;
    if(!empty($_POST['titlescedule']) && !empty($_FILES['uploadimg']['tmp_name' ]) && ($img_type === 'image') || ($img_type === 'image/png') && ($_FILES['uploadimg']['size'] <= $img_size)){
        $img = addslashes(file_get_contents($_FILES['uploadimg']['tmp_name']));
        $query = ("UPDATE `scedule` SET `titlescedule`='$titlescedule',`imagescedule`='$img',`sstatus`='active' WHERE `id_scedule` = $id");
        echo('<script>window.location.href="sceduleuploader.php";</script>');
        //var_dump($query);
        $result = $mysqli->query($query);
    } else echo("<script>alert('Некорректный тип файла, попробуйте загрузить другой файл!!!');</script>"); echo('<script>window.location.href="sceduleuploader.php";</script>'); exit;
}
/*SELECT `scedule`.`id_scedule`, `scedule`.`titlescedule`, `scedule`.`imagescedule`, `scedule`.`sstatus`, `uprofile`.`ulastname`, `uprofile`.`ufirstname`, `uprofile`.`upatronymic` 
FROM `scedule` 
INNER JOIN `uprofile` ON `scedule`.`id_uprofile` = `uprofile`.`id_uprofile`
WHERE 1=1*/
?>