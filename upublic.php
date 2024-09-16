<?php
session_start();

include('template/head.php');
require_once('bd.php');

$_SESSION['id'] = $_POST['id'];
$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
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

<ul class="mx-auto center list-reset social-icons-wrap">
    <!--<li class="inline-block mr1">
        <a href="https://instagram.com/soborvpyatigorske" target="_blank">
            <i class="fab fa-instagram fa-lg"></i>
        </a>
    </li>-->
    <li class="inline-block mr1">
        <a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <!--<li class="inline-block mr1">
        <a href="https://www.flickr.com/people/157787163@N07/" target="_blank">
            <i class="fab fa-flickr fa-lg"></i>
        </a>
    </li>-->
    <!--<li class="inline-block mr1">
        <a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">
            <i class="fab fa-soundcloud fa-lg"></i>
        </a>
    </li>-->
    <!--<li class="inline-block">
        <a href="https://www.facebook.com/soborvpyatigorske/" target="_blank">
            <i class="fab fa-facebook-f fa-lg"></i>
        </a>
    </li>-->
    <li class="inline-block">
        <a href="https://t.me/soborvpyatigorske" target="_blank">
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>

    </div>

    <div class="clearfix">

            <div class="md-col md-col-12 lg-col-12 p2">
                <h2>Публикации тест</h2>
                        <?php
                        $query = ("SELECT `upublic`.`id_upublic`, `upublic`.`id_uphoto`, `upublic`.`naim`, 
                        `upublic`.`uptext`, `upublic`.`statusupublic`, `upublic`.`id_uprofile`,
                        `uphoto`.`id_uphoto`, `uphoto`.`uphoto`,`uphoto`.`id_upublic`
                        FROM `upublic` 
                        INNER JOIN `uphoto` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic` 
                        INNER JOIN `uprofile` ON `upublic`.`id_uprofile` = `uprofile`.`id_uprofile`
                        WHERE `upublic`.`statusupublic` = 'active' AND `upublic`.`id_upublic` = $id");
                        $result = $mysqli->query($query);
                        while($row = $result->fetch_array()){
                        ?>
                        <div class="col col-12">
                            <?php echo('<h1>'.$row['naim'].'</h1>');
                            $img = base64_encode($row['uphoto']);
                            ?>
                            <img src="data:image/jpeg; base64,<?=$img?>" class="img-fluid" layout="responsive">
                        </div>
                        <p>
                        <?php
                        echo($row['uptext']);
                        ?>
                        </p>
                        <!--__-__-->
                        <div class="col col-12">
                            <!--<img src="img/no_img.jpeg" class="img-fluid" layout="responsive">-->
                        </div>
                        <!--<div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            Заголовок
                        </div>
                        <p>
                            Текст
                        </p>-->
                        <?php
                        };
                        ?>
                
                        <form action="" method="post">
                            <button type="submit" name="submit" class="btn btn-primary">Вернуться назад</button>
                            <?php
                            if(isset($_POST['submit'])){
                                $_SESSION['id'] = "";
                            }
                            ?>
                        </form>
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
    
<ul class="mx-auto center list-reset social-icons-wrap">
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
</ul>

<ul class="mx-auto center h2 list-reset">
    <li class="inline-block mr1">
        <a href="#">Задать вопрос</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Подать записку</a>
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
        <a href="#" target="_blank">Общецерковные новости</a>
    </li>
</ul>


       <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
        </div>
</div>



</body>
</html>