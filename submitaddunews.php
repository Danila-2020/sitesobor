<?php
session_start();
require_once('bd.php');
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
    $utitle = $_POST['utitle'];
    $udescription = $_POST['udescription'];
    $textunews = $_POST['textunews'];
    $dateunews = $_POST['dateunews'];
    $query = "INSERT INTO `unews`(`utitle`, `udescription`, `textunews`, `dateunews`, `id_uprofile`) VALUES ('$utitle','$udescription','$textunews','$dateunews','$id')";
    $result = $mysqli->query($query);
    echo("<script>alert('Новость успешно добавлена!!!')</script>");
    //echo('<script>window.location.href="addunews.php"</script>');
    //Добавили новость, теперь загружаем картинку
    
    //Загрузка обложки новости
    /*if(!empty($_POST['ucover'])){
        if($result){
        $queryid = "SELECT MAX(`id_unews`) AS 'id_unews' FROM `unews`";
        $resultid = $mysqli->query($queryid);
        while($row = $resultid->fetch_array()){
            $idunews = $_row['id_unews'];
            $img_type = substr($_FILES['ucover'] ['type'],0,5);
            $img_size = 2*1024*1024;
            if(!empty($_FILES['ucover'] ['tmp_name']) and ($img_type === 'image') and ($_FILES['ucover']['size'] <=$img_size)){
                $img = addslashes(file_get_contents($_FILES['ucover'] ['tmp_name']));
                $mysqli->query("INSERT INTO `uphotonews`(`uphotonews`, `id_unews`) VALUES ('$img','$idunews')");
                echo("<script>alert('Новость успешно добавлена!!!')</script>");
                echo('<script>window.location.href="addunewsadmin.php"</script>');
            };
        };
        };
    }*/
}
?>