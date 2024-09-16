<?php
session_start();
require_once('bd.php');

if(!empty($_POST)){
    $ulogin = $_POST['ulogin'];
    $upassword = $_POST['upassword'];
    $query = ("SELECT `id_uprofile`, `ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`, `uvisible`, `uphoto` FROM `uprofile` WHERE `ulogin` = '$ulogin' AND `upassword` = '$upassword'");
    //var_dump($query."<br>");
    $result = $mysqli->query($query);
    $count = $result->num_rows;
    //var_dump($count);
    if($count != "0"){
        while($row = $result->fetch_array()){
            $_SESSION['id'] = $row['id_uprofile'];
            if($row['urole'] == "user"){
                header('Location: userprofile.php');
            }else if($row['urole'] == "admin"){
                header('Location: adminprofile.php');
            }
        }
    }else{
        header('Location: 404.php');
    }
}
?>