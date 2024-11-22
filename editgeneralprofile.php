<?php
// Обработчик редактирования профиля (Пользователь General)

sesssion_start();//Тут идёт session_start(), он наверное не нужен
require_once('bd.php');
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
    $ucode = ($ulogin." ".$upassword);
    $query = ("UPDATE `uprofile` SET `ulastname`='$ulastname',
    `ufirstname`='$ufirstname',`upatronymic`='$upatronymic',
    `uemail`='$uemail',
    `urole`='general',
    `ulogin`='$ulogin',
    `upassword`='$upassword',
    `ucode`='$ucode',
    `uphone`='$uphone',
    `uvisible`=1,
    `statusuprofile` = 'active' WHERE `id_uprofile` = $id");
    $result = $mysqli->query($query);
    header('Location: generalprofile.php');
}
?>