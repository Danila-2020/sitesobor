<?php
//Страница новости (Все пользователи)

ob_start();
session_start();
require_once('bd.php');

include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>

<amp-analytics type="metrika">
        <script type="application/json">
            {
                "vars": {
                    "counterId": "53592163"
                }
            }
        </script>
    </amp-analytics>

    
<div class="relative page-wrap"><!-- page-wrap -->

<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"><!--/files/logo-color.png-->
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
            <ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="scedule.php">Расписание богослужений</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
    </li>
    <li class="inline-block mr1">
        <!-- <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Деятельность</a> -->
         <a href="activity.php">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Таинства</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    </li>
    <li class="inline-block mr1">
        <button type="submit" class="btn btn-primary" OnClick='window.location.href="signin.php"'>Вход</button>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="story.php">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="paintingalluser.php">Роспись</a><!--Тут отображаем, но не загружаем😀-->
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
        <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
        </div>
<div class="container" style="margin-top:1%; margin-bottom:1%;">
<div class="clearfix">

            <div class="md-col md-col-12 lg-col-12 p2">
                <h2>Новости</h2>
                <?php
                $idunews = $_SESSION['idunews'];
                $query = "SELECT `unews`.`id_unews`, `unews`.`utitle`, `unews`.`udescription`, `unews`.`textunews`, `unews`.`statusunews`, `unews`.`dateunews`, `unews`.`id_uprofile`,`uphotonews`.`id_uphotonews`,`uphotonews`.`uphotonews`,`uphotonews`.`id_unews`
                        FROM `unews`
                        LEFT JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews`
                        WHERE `unews`.`id_unews` = $idunews";
                var_dump($query);
                $result = $mysqli->query($query);
                while($row = $result->fetch_array){
                ?>
                        <div class="col col-12">
                            <h1><?php echo($row['utitle']);?></h1>
                            <img src="img/no_img.jpeg" class="img-fluid" layout="responsive">
                        </div>
                        <p>
                        <?php echo($row['utitle']);?>
                        </p>
                        <!--__-__-->
                        <div class="col col-12">
                            <img src="img/no_img.jpeg" class="img-fluid" layout="responsive">
                        </div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            Неделя Торжества Православия
                        </div>
                        <p>
                            Раннюю Божественную Литургию возглавил настоятель собора - иерей Дмитрий Мовчанов. В конце Божественной Литургии прихожане приступили к Святому Причастию.
                        </p>
                        
                <?php 
                }//Конец while
                ?>
                <a href="#" class="nav-link" >Вернуться назад</a>
            </div>
            

    </div>
</div>
<?php
include('template/footer2.php');
?>