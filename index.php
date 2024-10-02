<?php
session_start();

include('template/head.php');
include('template/barber.php');
require_once('bd.php');

?>

<body>
    <amp-analytics type="metrika">
        <script type="application/json">
            {
                "vars": {
                    "counterId": "53592163"
                }
            }
        </script>
    </amp-analytics>

    
<div class="relative page-wrap">
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive">
        </div>
    </div>
    <div class="clearfix">
            <!--Тут был заголовок-->

            
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
    <li class="inline-block mr1">
        <button type="submit" class="btn btn-primary" OnClick='window.location.href="signin.php"'>Вход</button>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=1">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Роспись</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
<p style="font-weight: bold; font-size: 14pt; color: blue; border: 1px solid #000;">Данные разделы примерные, содержимое будет изменено в процессе разработки</p>
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
    </div>

    <div class="clearfix">

            <div class="md-col md-col-6 lg-col-4 p2">
                <?php
                echo('<h2>Новости</h2>');
                $result = $mysqli->query("SELECT DISTINCT `unews`.`id_unews`, `unews`.`utitle`, `unews`.`udescription`, `unews`.`textunews`,`uphotonews`.`uphotonews` FROM `unews` INNER JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews` LIMIT 3");
                $count = $result->num_rows;
                while($row = $result->fetch_array()){
                    $img = base64_encode($row['uphotonews']);
                    echo('<form method="POST" action="unews.php" style="margin-bottom:1%;">
                    <input type="hidden" name="id" value="'.$row['id_unews'].'"></input>');
                    echo('<a href="" name="link" class="block relative clearfix mb2">
                        <div class="col col-12">');?>
                            <img src="data:image/jpeg; base64,<?=$img?>" alt="image" class="img-fluid" layout="responsive">
                            <?php
                    echo('</div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            '.$row['utitle'].'
                        </div>
                    </a>');?>
                    <button type="submit" class="btn btn-primary" style="width:100%;">Подробнее</button>
                    <?php echo('</form>');
                };
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $_SESSION['id'] = $id;
                    echo("<script>alert('$id')</script>");
                    header('Location: unews.php');
                };
                echo('<a href="allunews.php" class="h3">Все новости</a>');
                ?>
            </div>
            <div class="md-col md-col-6 lg-col-4 p2">
                <?php
                 echo('<h2>Мероприятия</h2>');
                 $result = $mysqli->query("SELECT events.id_events, events.caption, events.description, events.datep, events.id_uprofile, uphotoevent.id_uphotoevent, uphotoevent.uphotoevent, uprofile.ulastname, uprofile.ufirstname, uprofile.upatronymic FROM `events` INNER JOIN `uphotoevent` ON `events`.`id_events` = `uphotoevent`.`id_events` INNER JOIN `uprofile` ON `events`.`id_uprofile` = `uprofile`.`id_uprofile` LIMIT 3");
                 $count = $result->num_rows;
                 while($row = $result->fetch_array()){
                     $img = base64_encode($row['uphotoevent']);
                     echo('<form method="POST" action="events.php" style="margin-bottom:1%;">
                     <input type="hidden" name="id" value="'.$row['id_events'].'"></input>');
                     echo('<a href="#" class="block relative clearfix mb2">
                         <div class="col col-12">');?>
                             <img src="data:image/jpeg; base64,<?=$img?>" alt="image" class="img-fluid" layout="responsive">
                             <?php
                     echo('</div>
                         <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                             '.$row['caption'].'
                         </div>
                     </a>');?>
                     <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">Подробнее</button>
                     <?php echo('</form>');
                 }
                 echo('<a href="allevents.php" class="h3">Все мероприятия</a>');
                ?>
            </div>
            <div class="md-col md-col-6 lg-col-4 p2">
            <?php
                echo('<h2>Публикации</h2>');
                $result = $mysqli->query("SELECT `upublic`.`id_upublic`, `upublic`.`id_uphoto`, `upublic`.`naim`, `upublic`.`uptext`, `upublic`.`id_uprofile`,`uprofile`.`ulastname`, `uprofile`.`ufirstname`, `uprofile`.`upatronymic`,`uphoto`.`id_uphoto`,`uphoto`.`uphoto` FROM `upublic` INNER JOIN `uphoto` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic` INNER JOIN `uprofile` ON `upublic`.`id_uprofile` = `uprofile`.`id_uprofile` LIMIT 3");
                $count = $result->num_rows;
                while($row = $result->fetch_array()){
                    $img = base64_encode($row['uphoto']);
                    echo('<form method="POST" action="upublic.php" style="margin-bottom:1%;">
                    <input type="hidden" name="id" value="'.$row['id_upublic'].'"></input>');
                    echo('<a href="#" class="block relative clearfix mb2">
                        <div class="col col-12">');?>
                            <img src="data:image/jpeg; base64,<?=$img?>" alt="image" class="img-fluid" layout="responsive">
                            <?php
                    echo('</div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            '.$row['naim'].'
                        </div>
                    </a>');?>
                    <button type="submit" class="btn btn-primary" style="width:100%;">Подробнее</button>
                    <?php echo('</form>');
                }
                echo('<a href="allupublic.php" class="h3">Все публикации</a>');
                ?>
            </div>

    </div>
  </div>
 </div>

 <div class="max-width-4 mx-auto p2">
    <div class="rounded border border-grey bg-white alpha-90 clearfix">
        <div class="clearfix">
            <div class="md-col md-col-6 p2">

                <div class="module-wrap"></div>
                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
            <div class="md-col md-col-6 p2">
                <div class="module-wrap mb2">
                    <h2><a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">Музыка</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
 </div>

</div><!-- content-wrap -->

</div> <!-- page-wrap -->




<div class="bg-white alpha-90 fit relative pt1" style="height:fit-content;">

<ul class="mx-auto center h2 list-reset">
    <li class="inline-block mr1">
        <a href="contacts.php">Задать вопрос</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    <li>
    <li class="inline-block mr1">
        <a href="contacts.php">Контакты</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Новости собора</a>
    </li>
    <li class="inline-block mr1">
        <a href="#" target="_blank">Новости епархии</a>
    </li>
    <li class="inline-block mr1">
        <a href="http://www.patriarchia.ru/db/news/" target="_blank">Общецерковные новости</a>
    </li>
    <li class="inline-block mr1">
        <button type="submit" class="btn btn-primary" OnClick='location.href="signin.php"'>Вход</button>
    </li>
</ul>

        <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
        </div>
</div>
</body>
</html>