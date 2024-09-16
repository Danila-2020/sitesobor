<?php
    $from = "robot.sobor@mail.ru";
    $to = "sobor.noreply@mail.ru";
    $subject = "Новое письмо с сайта";

    if(isset($_POST['submitform'])){
        var_dump($_POST);
        
        
        $umessage = $_POST['umessage'];

        mail($to, $subject, $umessage, $from);

        header('Location: contacts.php');
    }
?>