<?php
// Страница просмотра Мероприятия(Все пользователи)

session_start();
ob_start();//обнуляем буфер
require_once('bd.php');
include('template/head.php');
include('template/barber.php');
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
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="/site/article?id=4">Расписание богослужений</a>
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
        <a class="" href="/site/article?id=3">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=1">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=2">Святыни</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Роспись</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'">
    <li class="inline-block mr1">
        <a href="/site/article?id=6">Воскресная школа</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=7">Молодежный центр</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=8">Библиотека</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=9">Социальная деятельность</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
    <li class="inline-block mr1">
        <a href="/site/article?id=10">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=11">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=12">Исповедь</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=13">Причастие</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=184">Соборование</a>
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

    </div>
    <div class="clearfix">
    <div class="md-col md-col-12 lg-col-12 p2">
    <h2>Мероприятия</h2>
            <?php
            $id = $_POST['id'];
            $_SESSION['id'] = $id;
            if(empty($id)) {
                header('Location: allevents.php');
            }
            $query = "SELECT `events`.`id_events`, `events`.`caption`, `events`.`description`, `events`.`datep`, `events`.`statusevents`, `events`.`id_uprofile` FROM `events`
            INNER JOIN `uprofile` ON `events`.`id_uprofile` = `uprofile`.`id_uprofile`
            WHERE 1=1 AND `events`.`id_events` = $id
            ORDER BY `events`.`id_events` ASC";//переменная для запроса
            // var_dump($query);
            // var_dump($id);
            $result = $mysqli->query($query);
            while($row = $result->fetch_array()) {

                echo('
                <div class="col col-12">
                    <h1>'.$row['caption'].'</h1>
                    <img src="img/no_img.jpeg" class="img-fluid" layout="responsive">
                </div>
                <p>
                    '.$row['description'].'
                </p>
                <p>
                    <h2>Текст</h2>
                </p>
                ');
            }
            ?>
    </div>

            <!-- <div class="md-col md-col-12 lg-col-12 p2">
                <h2>Мероприятия</h2>
                        <div class="col col-12">
                            <h1>Тестовое мероприятие</h1>
                            <img src="img/no_img.jpeg" class="img-fluid" layout="responsive">
                        </div>
                        <p>
                            Текст
                        </p>
                        <!--__-__-->
                        <!-- <div class="col col-12">
                            <img src="img/no_img.jpeg" class="img-fluid" layout="responsive">
                        </div>
                        <p>
                            <h2>Текст</h2>
                        </p>
                        
                
                <a href="#" class="h3" >Вернуться назад</a>
            </div>-->
            

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




<?php
include('template/footer.php');
?>