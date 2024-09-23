<?php
require_once('bd.php');
session_start();

            if(isset($_POST['uploadbutton'])){
                $id = $_SESSION['id'];
                //var_dump($id);
                $titlescedule = $_POST['titlescedule'];
                //var_dump($titlescedule);
                $img_type = substr($_FILES['imagescedule']['type'],0,5);
                //var_dump($img_type);
                $img_size = 2*1024*1024;
                //var_dump($img_size);
                if(!empty($_FILES['imagescedule']['tmp_name']) and (!empty($titlescedule)) and ($img_type === 'image' and $_FILES['imagescedule']['size'] <=$img_size)){
                    $img = addslashes(file_get_contents($_FILES['imagescedule']['tmp_name']));
                    //var_dump($img);
                    $query = ("INSERT INTO `scedule`(`titlescedule`, `imagescedule`, `id_uprofile`) VALUES ('$titlescedule','$img',$id)");
                    var_dump($query);
                    $result = $mysqli->query($query);
                    $result->free();
                    $mysqli->close();
                };
            };
            echo("<script>alert('Расписание загружено!!!')</script>");
            echo('<script>window.location.href="sceduleuploader.php"</script>');
        ?>