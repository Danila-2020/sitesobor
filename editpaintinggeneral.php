<?php
session_start();

include('template/head.php');
include('template/barber.php');
require_once('bd.php');

?>

<body>
    <ul class="center h2 list-reset mt0 head-menu">
        <li class="inline-block mr1">
            <a href="scedule.php">Расписание богослужений</a>
        </li>
        <li class="inline-block mr1">
            <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
        </li>
        <li class="inline-block mr1">
            <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Деятельность</a>
        </li>
        <li class="inline-block mr1">
            <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Таинства</a>
        </li>
        <li class="inline-block mr1">
            <a href="note.php">Подать записку</a>
        </li>
    </ul>
    
    <ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
        <li class="inline-block mr1">
            <a class="" href="clergy.php">Духовенство</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="#">История</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="#">Святыни</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="paintingalluser.php">Роспись</a>
        </li>
    </ul>
    
    <ul class="hide" [class]="activitiesMenu||'hide'">
        <li class="inline-block mr1">
            <a href="#">Воскресная школа</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Молодежный центр</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Библиотека</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Социальная деятельность</a>
        </li>
    </ul>
    
    <ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
        <li class="inline-block mr1">
            <a href="christening.php">Крещение</a>
        </li>
        <li class="inline-block mr1">
            <a href="wedding.php">Венчание</a>
        </li>
        <li class="inline-block mr1">
            <a href="confession.php">Исповедь</a>
        </li>
        <li class="inline-block mr1">
            <a href="eucharist.php">Причастие</a>
        </li>
        <li class="inline-block mr1">
            <a href="unction.php">Соборование</a>
        </li>
    </ul>
    
    <hr>
<div class="container" style="margin-top: 1%; margin-bottom: 5%;"><!--py-5-->
<!-- Центрирование изображений -->
<style>
.center-img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
    <?php    
    $query = ("SELECT `painting`.`id_painting`, `painting`.`npainting`, `painting`.`descpainting`, 
            `painting`.`id_uprofile`,`imgpainting`.`id_imgpainting`, `imgpainting`.`naimimgpainting`, 
            `imgpainting`.`textimgpainting`, `imgpainting`.`images`, `imgpainting`.`imagesstatus`, 
            `imgpainting`.`id_painting` 
            FROM `painting`
            RIGHT JOIN `imgpainting` ON `imgpainting`.`id_painting` = `painting`.`id_painting`
            WHERE 1=1");
    $descquery =("SELECT `painting`.`id_painting`,`painting`.`descpainting`, 
    `painting`.`id_uprofile` 
    FROM `painting`
    INNER JOIN `imgpainting` ON `imgpainting`.`id_painting` = `painting`.`id_painting`
    WHERE 1=1
    LIMIT 1");
    $resultdesc = $mysqli->query($descquery);
    $result = $mysqli->query($query);
    echo('<h1 class="text-center">Роспись</h1>');
    $i=0;
    while($row = $result->fetch_assoc()){
        $img = base64_encode($row['images']);
    
    if($i == 0) {
        // echo($i."<br>");
        echo('<form method="post" action="submitpaintinggen.php" enctype="multipart/form-data">
        <input type="hidden" name="hiddenid" value="'.$row['id_painting'].'"></input>
        <textarea rows="6" cols="1" class="form-control" name="descpainting">'.$row['descpainting'].'</textarea><br>
        ');//submitpaintingdescgen.php
        $i++;
        echo($i);
    }if($i > 0){
    echo('
    
    <label for="" style="font-weight:bold;">Редактировать изображение</label><br>
    <input type="file" name="images" class="form-control" /><br>');
    echo('<img src="data:image/jpeg;base64, '.$img.'" class="img-fluid center-img"></img><br>
    <h2>Название</h2>
    <input type="text" class="form-control" name="naimimgpainting" value="'.$row['naimimgpainting'].'"></input><br>');
    echo('
    <input type="hidden" name="hidden" value="'.$row['id_imgpainting'].'"></input>
    <input type="hidden" name="hiddenpainting" value="'.$row['id_painting'].'"></input>
    <textarea rows="6" cols="1" class="form-control" name="textimgpainting">'.$row['textimgpainting'].'</textarea><br>');
    $i++;
    }
    }
    echo('<button type="submit" name="submit" class="btn btn-primary">Сохранить изменения</button><br>
    </form><br>');

    ?>
</div>

<div class="relative">
	<amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
</div>
<div class="jumbotron text-center">
	<b><i>&copy; Колодочкин Алексей<br>
	Дробилко Данила</i></b>
</div>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script src="js/script.js"></script>
</body>
</html>