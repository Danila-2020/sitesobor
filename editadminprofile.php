<?php
// Обработчик редактирования профиля (Пользователь Admin)

require_once('bd.php');
session_start();
$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
};

if(isset($_POST['submit'])){
    $ulastname = $_POST['ulastname'];
    $ufirstname = $_POST['ufirstname'];
    $upatronymic = $_POST['upatronymic'];
    $uemail = $_POST['uemail'];
    $uphone = $_POST['uphone'];
    $ulogin = $_POST['ulogin'];
    $upassword = $_POST['upassword'];
    $ucode = ($ulogin."_".$upassword);
    $query = ("UPDATE `uprofile` SET `ulastname`='$ulastname',
    `ufirstname`='$ufirstname',`upatronymic`='$upatronymic',
    `uemail`='$uemail',
    `urole`='admin',
    `ulogin`='$ulogin',
    `upassword`='$upassword',
    `ucode`='$ucode',
    `uphone`='$uphone',
    `uvisible`=1, 
    `statusuprofile` = 'active' WHERE `id_uprofile` = $id");
    $result = $mysqli->query($query);
    //var_dump($query);
    header('Location: adminprofile.php');
};
?>