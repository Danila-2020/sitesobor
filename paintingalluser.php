<?php
// session_start();

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
$i=0;
echo('<h1 class="text-center">Роспись</h1>');
    while($row = $result->fetch_assoc()){
        $img = base64_encode($row['images']);
        if($i == 0) {
        echo('<p>'.$row['descpainting'].'</p>
        <img src="data:image/jpeg;base64, '.$img.'" class="img-fluid center-img"></img>');
        $i++;
        }
        if($i > 0){
        echo('<img src="data:image/jpeg;base64, '.$img.'" class="img-fluid center-img"></img>
        <p>'.$row['textimgpainting'].'</p>');
        $i++;
        }
    }
    ?>
</div>

<?php
include('template/footer3.php');
?>