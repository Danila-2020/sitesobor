<?php
session_start();

include('template/head.php');
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

    
<div class="relative page-wrap"><!-- page-wrap -->
<!--    <div class="fixed bg-video-wrap">
        <div class="video-wrap xs-hide sm-hide">
            <amp-video width="1280"
                height="720"
            src="https://blago-kavkaz.ru/from_sky.m4v"
            poster="/img/static-bg.jpg"
            layout="responsive"
            loop
            noaudio
            autoplay>
                <div fallback>
                    <p>Your browser doesn not support HTML5 video.</p>
                </div>
            </amp-video>
        </div>
    </div>-->
<!--    <div class="fixed bg-video-wrap-mob">
        <div class="video-wrap-mob md-hide lg-hide">
            <amp-video width="406"
                height="720"
            src="https://blago-kavkaz.ru/from_sky_phone_na.m4v"
            poster="/img/mob-poster.jpg"
            layout="responsive"
            loop
            noaudio
            autoplay>
                <div fallback>
                    <p>Your browser doesn not support HTML5 video.</p>
                </div>
            </amp-video>
        </div>
    </div>-->

<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"><!--/files/logo-color.png-->
            <!--<h1 style="font-family: Calibri; font-weight: bold; text-align: center; margin-bottom: 25%; margin-top:0;">Логотип</h1>-->
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
    <!--<li class="inline-block mr1">
        <a class="" href="/site/article?id=2">Святыни</a>
    </li>-->
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

<!--<ul class="mx-auto center list-reset social-icons-wrap">
    <!--<li class="inline-block mr1">
        <a href="https://instagram.com/soborvpyatigorske" target="_blank">
            <i class="fab fa-instagram fa-lg"></i>
        </a>
    </li>-->
    <!--<li class="inline-block mr1">
        <a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="https://www.flickr.com/people/157787163@N07/" target="_blank">
            <i class="fab fa-flickr fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">
            <i class="fab fa-soundcloud fa-lg"></i>
        </a>
    </li>-->
    <!--<li class="inline-block">
        <a href="https://www.facebook.com/soborvpyatigorske/" target="_blank">
            <i class="fab fa-facebook-f fa-lg"></i>
        </a>
    </li>-->
    <!--<li class="inline-block">
        <a href="https://t.me/soborvpyatigorske" target="_blank">
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>-->



        <!--<amp-video width="1280"
            height="720"
            src="https://blago-kavkaz.ru/from_sky.m4v"
            poster="/img/static-bg.jpg"
            layout="responsive"
            loop
            noaudio
            autoplay>
                <div fallback>
                    <p>Your browser doesn not support HTML5 video.</p>
                </div>
        </amp-video>-->
            <!--<amp-iframe
            layout="responsive"
            sandbox="allow-scripts allow-same-origin allow-popups"
            height="500"
            width="600"
            allowfullscreen
            mozallowfullscreen
            webkitallowfullscreen
            src="https://pano.parsuna.ru/embed/spasptg?startscene=scene_inside-6441&startactions=lookat(-118.93,-37.83,122.59,0,0);">
                <amp-img layout="fill" src="/img/3d-view-placeholder.png" width="1920" height="1080" placeholder></amp-img>
            </amp-iframe>-->
    </div>

    <div class="clearfix">

            <div class="md-col md-col-6 lg-col-4 p2">
                <!--<h2>Новости</h2>

                                    <a href="/site/article?id=326" class="block relative clearfix mb2">
                        <div class="col col-12">
                            <amp-img src="img/no_img.jpeg" width="700" height="470" layout="responsive">
                        </div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            Неделя Торжества Православия                        </div>
                    </a>
                                    <a href="/site/article?id=325" class="block relative clearfix mb2">
                        <div class="col col-12">
                            <amp-img src="img/no_img.jpeg" width="700" height="470" layout="responsive">
                        </div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            В Спасском соборе совершили богослужения первой седмицы                        </div>
                    </a>
                                    <a href="/site/article?id=324" class="block relative clearfix mb2">
                        <div class="col col-12">
                            <amp-img src="img/no_img.jpeg" width="700" height="470" layout="responsive">
                        </div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            в соборе была совершена хиротония                        </div>
                    </a>
                
                <a href="/site/articles?catids%5B0%5D=4" class="h3" >Все новости</a>-->
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
                echo('<a href="#" class="h3">Все новости</a>');
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
                     <button type="submit" class="btn btn-primary" style="width: 100%;">Подробнее</button>
                     <?php echo('</form>');
                 }
                 echo('<a href="#" class="h3">Все мероприятия</a>');
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
                echo('<a href="#" class="h3">Все публикации</a>');
                ?>
            </div>

    </div>
  </div>
 </div>

 <div class="max-width-4 mx-auto p2">
    <div class="rounded border border-grey bg-white alpha-90 clearfix">
        <div class="clearfix">
            <div class="md-col md-col-6 p2">

                <div class="module-wrap">
                    <!--<h2><a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">Видео</a></h2>
                    <amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups allow-presentation" height="350" width="500" src="https://www.youtube.com/embed/videoseries?list=PLG2O6oS1iDoq5D4jO4dJfr_El-6VbgiJA" class="i-amphtml-element i-amphtml-layout-responsive i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout" i-amphtml-layout="responsive" frameborder="0" style="--loader-delay-offset:80ms !important;"><i-amphtml-sizer slot="i-amphtml-svc" style="padding-top: 70%;"></i-amphtml-sizer>
                    <i-amphtml-scroll-container class="amp-active"><iframe class="i-amphtml-fill-content" name="amp_iframe2" frameborder="0" allow="" sandbox="allow-scripts allow-same-origin allow-popups allow-presentation" src="https://www.youtube.com/embed/videoseries?list=PLG2O6oS1iDoq5D4jO4dJfr_El-6VbgiJA#amp=1"></iframe></i-amphtml-scroll-container></amp-iframe>
                    -->
                </div>

                <!--<div class="module-wrap mb2">
                    <h2><a href="https://www.instagram.com/soborvpyatigorske/" target="_blank">Instagram</a></h2>
                    <amp-iframe
                        layout="responsive"
                        sandbox="allow-scripts allow-same-origin allow-popups"
                        height="350"
                        width="500"
                        src="https://snapwidget.com/embed/691883">
                    </amp-iframe>
                </div>-->

                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                    <!--<amp-iframe
                        layout="responsive"
                        sandbox="allow-scripts allow-same-origin allow-popups"
                        height="350"
                        width="500"
                        referrerpolicy="no-referrer"
                        src="#"><!--https://flickrembed.com/cms_embed.php?source=flickr&layout=responsive&input=157787163@N07&sort=2&by=user&theme=default&scale=fill&speed=3000&limit=10&skin=default&autoplay=true-->
                    <!--</amp-iframe>-->
                </div>
            </div>
            <div class="md-col md-col-6 p2">
                <div class="module-wrap mb2">
                    <h2><a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">Музыка</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                    <!--<amp-iframe 
                        layout="responsive"
                        sandbox="allow-scripts allow-same-origin allow-popups"
                        height="350"
                        width="500"
                        src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/626827014&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true">
                    </amp-iframe>-->
                </div>

                <!--<div class="module-wrap">
                    <h2><a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">Видео</a></h2>
                    <amp-iframe
                        layout="responsive"
                        sandbox="allow-scripts allow-same-origin allow-popups allow-presentation"
                        height="350"
                        width="500"
                        src="https://www.youtube.com/embed/videoseries?list=PLG2O6oS1iDoq5D4jO4dJfr_El-6VbgiJA">
                    </amp-iframe>
                </div>-->
            </div>
        </div>
    </div>
 </div>

</div><!-- content-wrap -->

</div> <!-- page-wrap -->




<div class="bg-white alpha-90 fit relative pt1" style="height:fit-content;">
    
<!--<ul class="mx-auto center list-reset social-icons-wrap">
    <li class="inline-block mr1">
        <a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="https://www.flickr.com/people/157787163@N07/" target="_blank">
            <i class="fab fa-flickr fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">
            <i class="fab fa-soundcloud fa-lg"></i>
        </a>
    </li>
    <li class="inline-block">
        <a href="https://t.me/soborvpyatigorske" target="_blank">
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>-->

<ul class="mx-auto center h2 list-reset">
    <li class="inline-block mr1">
        <a href="contacts.php">Задать вопрос</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    <li>
    <li class="inline-block mr1">
        <a href="#">Контакты</a>
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
        <button type="submit" class="btn btn-primary">Вход</button>
    </li>
</ul>


        <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
        </div>
</div>



</body>
</html>