<?php
session_start();
require_once('bd.php');
require_once('template/confessionhead.php');
require_once('template/barber.php');
?>

    <noscript><style amp-boilerplate="">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

<script src="https://cdn.ampproject.org/v0.js" async="async"></script>
<script src="https://cdn.ampproject.org/v0/amp-bind-0.1.js" async="async" custom-element="amp-bind"></script>
<script src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js" async="async" custom-element="amp-analytics"></script></head>
<body class="land-see ">
    <amp-analytics type="metrika">
        <script type="application/json">
            {
                "vars": {
                    "counterId": "53592163"
                }
            }
        </script>
    </amp-analytics>

    
<div class="site-article">
    <div class="content-wrap"><!-- content-wrap -->
        <a href="/" class="block relative sm-hide md-hide lg-hide logo-wrap logo-wrap-mob"></a>

        <div class="max-width-4 mx-auto p2"><!-- full-width-wrap -->
            <div class="border border-grey bg-white-a70 rounded clearfix p2"><!-- clearfix -->
                
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
        <a class="" href="/site/article?id=1">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Роспись</a>
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
        <a href="#">Исповедь</a>
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


            <ul class="list-reset breadcrumbs">
                    <li class="inline-block mr1">
                                    <a href="index.php">Главная</a>
                            </li>
                    <li class="inline-block mr1">
                                    <a href="#">Таинства</a>
                            </li>
                    <li class="inline-block mr1">Исповедь</li>
            </ul>
                <!--Тут вставка цикла выборки из БД-->
                <?php
                $result = $mysqli->query("SELECT DISTINCT `id_sacraments`, `nsacraments`, `textsacraments`, `id_uprofile`, `images` 
                FROM `sacraments` 
                INNER JOIN `imgsacraments` 
                ON `imgsacraments`.`id_sacramets` = `sacraments`.`id_sacraments` WHERE `nsacraments`='Исповедь'");
                while($row = $result->fetch_array()){
                    $img = base64_encode($row['images']);
                    echo('<h1>'.$row['nsacraments'].'</h1>');
                    ?>
                    <img src="data:image/jpeg;base64, <?=$img?>" class="img-fluid" alt="image">
                    <?php
                    echo($row['textsacraments']);
                };
                ?>
                </div>
                <!--Конец цикла вывода-->
            </div><!-- clearfix-end -->
        </div><!-- full-width-wrap-end -->
    </div><!-- content-wrap-end -->
</div>



<div class="bg-white alpha-90 fit relative pt1" style="height:fit-content;">

<div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
          </div>

<ul class="mx-auto center h2 list-reset">
    <li class="inline-block mr1">
        <a href="contacts.php">Задать вопрос</a>
    </li>
    <li class="inline-block mr1">
        <a href="addnote.php">Подать записку</a>
    <li>
    <li class="inline-block mr1">
        <a href="#">Контакты</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Новости собора</a>
    </li>
    <li class="inline-block mr1">
        <a href="http://blago-kavkaz.ru/article/blog?catids%5B0%5D=1" target="_blank">Новости епархии</a>
    </li>
    <li class="inline-block mr1">
        <a href="http://www.patriarchia.ru/db/news/" target="_blank">Общецерковные новости</a>
    </li>
</ul>
       <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img>
        </div>
</div>
</body>
</html>