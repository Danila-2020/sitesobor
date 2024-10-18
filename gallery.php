<?php
session_start();//Тут идёт session_start(), он наверное не нужен
require_once('bd.php');
include('template/head.php');
include('template/barber.php');
?>

    <body>
        <form action="" method="POST" enctype="multipart/form-data">
        <p>Загрузить картинку</p>
        <input type="file" name="img_upload" required /><br>
        <input type="text" name="title_img" placeholder="Название изображения" required /><br>
        <textarea name="desc_img" placeholder="Описание изображения" cols="1" rows="10"></textarea><br>
        <input type="submit" name="upload" value="Загрузить" />
        <?php
            if(isset($_POST['upload'])){
                // $title_img = $_POST['title_img'];
                // $desc_img = $_POST['desc_img'];
                $img_type = substr($_FILES['img_upload']['type'],0,5);
                $img_size = 2*1024*1024;
                if(!empty($_FILES['img_upload']['tmp_name']) and (!empty($title_img)) and (!empty($desc_img)) and ($img_type === 'image' and $_FILES['img_upload']['size'] <=$img_size)){
                    $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
                    $mysqli->query("INSERT INTO `images`(`img`, `title_img`, `desc_img`) VALUES ('$img','$title_img','$desc_img')");
                }
            }
        ?>
        </form>
        <?php
        $result = $mysqli->query('SELECT `id_uphoto`, `uphoto`, `uphotostatus`, `id_upublic` FROM `uphoto` WHERE 1=1');
        $count = $query->num_rows;//Считаем количество записей
        echo('Найдено '.$count.' изображений');
        $active = ('active');//Добавляем класс активной карточке
        echo '<div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">';
            while($data = $result->fetch_assoc()) {
                $img = base64_encode($data['uphoto']);
            echo (' <img src="data:image/jpeg;base64,'. $data['uphoto']. '" class="rounded shadow img-fluid" alt="" srcset="">
            <div class="carousel-caption d-none d-md-block">
            </div>
            </div>'); //end while
            }
        for($i = 0; $i < $count; $i++){
            if($i == 0){
            echo('
            <div class="carousel-item '.$active.'">
                    <img src="data:image/jpeg;base64, <?=$img?>" class="img-fluid" alt="">
                    <div class="carousel-caption">
                        <h1>Carousel in a container</h1>
                        <p>This is a demo for the Bootstrap Carousel Guide.</p>
                    </div>
                </div>
            ');
            }else{
                echo('
                <div class="carousel-item">
                        <img src="data:image/jpeg;base64, <?=$img?>" class="img-fluid" alt="">
                        <div class="carousel-caption">
                            <h1>Carousel in a container</h1>
                            <p>This is a demo for the Bootstrap Carousel Guide.</p>
                        </div>
                    </div>
                ');
            }//end if
        }
 
        //} //end for
        ?>
    </body>
</html>