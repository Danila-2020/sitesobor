<?php
    $from = "robot.sobor@mail.ru";
    $to = "sobor.noreply@mail.ru";
    $subject = "Новая записка";

    if(isset($_POST['submitform'])){
        $type = $_POST['type'];
        $period = $_POST['period'];
        $time = $_POST['time'];
        $targetNames = $_POST['targetNames'];
        
        $message = ('Записка\r\n');
        $message .= ('$type\r\n');
        $message .= ('$period\r\n');
        $message .= ('$time\r\n');
        $message .= ('$targetNames\r\n');

        mail($to, $subject, $message, $from);

        header('Location: note.php');
    }
?>