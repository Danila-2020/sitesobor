<?php
ob_start();//Разьебедить
session_start();
require_once("bd.php");
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
    $nactivity = $_POST['nactivity'];
    $descactivity = $_POST['descactivity'];
    $sel = $mysqli->query("SELECT `id_activity`, `nactivity`, `descactivity`, `id_uprofile` FROM activity WHERE nactivity = '$nactivity' OR descactivity = '$descactivity' ") or die(mysqli_error($mysqli));
    $result = $mysqli->query($sel);
    $countsel = $result->num_rows;
    var_dump($countsel);
    if($countsel > 0){
        exit("<script>alert('Деятктура с таким номером уже существует');</script>");
    }else{
        $insert = $mysqli->query("INSERT INTO `activity`(`nactivity`, `descactivity`, `id_uprofile`) VALUES ('$nactivity','$descactivity',$id)") or die(mysqli_error($mysqli));
        header("Location: addactivity.php");
        echo("<script>alert('Деятельность добавлена!');</script>");
    }
}
?>