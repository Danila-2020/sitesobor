<?php
session_start();
require_once('bd.php');

$id=$_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
}

if(isset($_POST['uploadbutton'])){
    $titlescedule = $_POST['titlescedule'];
    $img_type = substr($_FILES['imagescedule']['type'],0,5);
    $img_size = 2*1024*1024;
    if((!empty($_FILES['imagescedule']['tmp_name']))and(!empty($_POST['titlescedule']))){
        $imagescedule = addslashes(file_get_contents($_FILES['imagescedule']['tmp_name']));
        $result = $mysqli->query("INSERT INTO `scedule`( `titlescedule`, `imagescedule`, `id_uprofile`) VALUES ('$titlescedule','$imagescedule',$id)");
        if($result){
            echo("<script>alert('Тебя Индусы не пропинали?')</script>");
            echo('<script>window.location.href="sceduleuploader.php"</script>');
        }
    }
}
?>