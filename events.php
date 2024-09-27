<?php
session_start();

include('template/head.php');
include('template/barber.php');
require_once('bd.php');

$_SESSION['id'] = $_POST['id'];
$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
?>

    
    <style amp-boilerplate="">
    body
    {
        -webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;
        -moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;
        -ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;
        animation:-amp-start 8s steps(1,end) 0s 1 normal both
    }
        @-webkit-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @-moz-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @-ms-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @-o-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
    </style>
    <noscript>
        <style amp-boilerplate="">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style>
    </noscript>
    <!--Стилизация-->
        <style>
            body{background-image: url('https://catherineasquithgallery.com/uploads/posts/2021-02/1612767162_15-p-fon-goluboe-nebo-s-oblakami-19.jpg');}
        </style>
         <meta name="csrf-param" content="_csrf-frontend">
         <meta name="csrf-token" content="rufNjNmfaRuKJ-ssgba1NeE69mEJj3aI0QWIBDjgdkDc0YLLjMY6Tv4fmX_jwfJlh0O3J37HEOqjYtdDbLM5cg==">
         
         <script src="https://cdn.ampproject.org/v0.js" async="async"></script>
         <script src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js" async="async" custom-element="amp-iframe"></script>
         <script src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js" async="async" custom-element="amp-lightbox"></script>
         <script src="https://cdn.ampproject.org/v0/amp-list-0.1.js" async="async" custom-element="amp-list"></script>
         <script src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js" async="async" custom-template="amp-mustache"></script>
         <script src="https://cdn.ampproject.org/v0/amp-bind-0.1.js" async="async" custom-element="amp-bind"></script>
         <script src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js" async="async" custom-element="amp-carousel"></script>
         <script src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js" async="async" custom-element="amp-analytics"></script>
</head>
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
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
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
<p style="font-weight: bold; font-size: 14pt; color: blue; border: 1px solid #000;">Данные разделы примерные, содержимое будет изменено в процессе разработки</p>
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
        <a href="christening.php">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="wedding.php">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="сonfession.php">Исповедь</a>
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

    </div>

    <div class="clearfix">

            <div class="md-col md-col-12 lg-col-12 p2">
                <h2>Мероприятия</h2>
                <?php
                    $result = $mysqli->query("SELECT events.id_events, events.caption, events.datep, events.description, uphotoevent.uphotoevent
                    FROM events 
                    INNER JOIN uprofile ON events.id_uprofile = uprofile.id_uprofile
                    INNER JOIN uphotoevent ON events.id_events = uphotoevent.id_events
                    WHERE events.id_events=$id");
                    while($row = $result->fetch_array()){
                        $img = base64_encode($row['uphotoevent']);
                        echo('
                        <div class="col col-12">
                            <h1>'.$row['caption'].'</h1>
                            ');?>
                            <img src="data:image/jpeg;base64, <?=$img?>" class="img-fluid" layout="responsive">
                            <?php
                        echo('
                        </div>
                        <p>
                            '.$row['description'].'
                        </p>
                        <!--__-__-->
                        <p>
                            <i>Дата проведения: '.$row['datep'].'</i>
                        </p>');
                    }
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
                        <!--Тут был YouTube-->
                </div>

                <!--Тут был Instagram-->

                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
            <div class="md-col md-col-6 p2">
                <div class="module-wrap mb2">
                    <h2><a href="" target="_blank">Музыка</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                        <!--Тут был soundcloud-->
                </div>
            </div>
        </div>
    </div>
 </div>

</div><!-- content-wrap -->

</div> <!-- page-wrap -->

<!--Футер-->
<?php
include('template\footer.php');
?>