<?php
// Расписание богослужений(Все пользователи)

require_once('bd.php');
ob_start();
//session_start();//Тут идёт session_start, он наверное не нужен

include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>

<body class="land-see amp-mode-mouse" style="opacity: 1; visibility: visible; animation: auto ease 0s 1 normal none running none;">
        <amp-analytics type="metrika" class="i-amphtml-element i-amphtml-layout-fixed i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout" i-amphtml-layout="fixed" aria-hidden="true" style="width: 1px; height: 1px;" hidden="">
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
            <a href="#">Расписание богослужений</a>
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
            <a class="" href="#">Роспись</a>
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
    <li class="inline-block mr1">
        <a href="" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="" target="_blank">
            <i class="fab fa-flickr fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="" target="_blank">
            <i class="fab fa-soundcloud fa-lg"></i>
        </a>
    </li>
    <li class="inline-block">
        <a href="" target="_blank">
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>-->
    
    
          <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
          </div>
<?php
        $result = $mysqli->query("SELECT scedule.id_scedule, scedule.titlescedule, scedule.imagescedule, scedule.sstatus, scedule.id_uprofile, uprofile.ulastname, uprofile.ufirstname, uprofile.upatronymic 
        FROM `scedule` 
        INNER JOIN `uprofile` ON scedule.id_uprofile = uprofile.id_uprofile WHERE 1=1 AND scedule.sstatus = 'active'");
        $count = $result->num_rows;
        if($count > 0){
        while($row = $result->fetch_array()){
                ?>
        <ul class="list-reset breadcrumbs">
                        <li class="inline-block mr1">
                                        <a href="index.php">
                    
                    Главная
                                        </a>
                                </li>
                        <li class="inline-block mr1">
                                        <a href="scedule.php">
                    
                    Расписание богослужений
                                        </a>
                                </li>
                        <li class="inline-block mr1">
                    
                    <?php echo($row['titlescedule'])?>
                                </li>
                </ul>
                    <?php 
                    //if($count > 0){?>
                    <h1><?php echo($row['titlescedule'])?></h1>
                    <p>Расписание показано для примера!!!</p>
    
                    <div class="article-wrap">
                        <?php
                        $img = base64_encode($row['imagescedule']);
                        ?>
                        <p><amp-img src="data:image/jpeg; base64, <?=$img?>" layout="responsive" class="i-amphtml-element i-amphtml-layout-responsive i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout img-fluid" i-amphtml-layout="responsive" style="--loader-delay-offset: 1ms !important;"><i-amphtml-sizer slot="i-amphtml-svc" style="padding-top: 216.533%;"></i-amphtml-sizer></amp-img></p><!--<img decoding="async" src="/files/new/june2023/rast.png" class="i-amphtml-fill-content i-amphtml-replaced-content">-->
                        <!--<p><amp-img src="data:image/jpeg; base64, <?=$img?>" height="2436" width="1125" layout="responsive" class="i-amphtml-element i-amphtml-layout-responsive i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout" i-amphtml-layout="responsive" style="--loader-delay-offset: 1ms !important;"><i-amphtml-sizer slot="i-amphtml-svc" style="padding-top: 216.533%;"></i-amphtml-sizer></amp-img></p>--><!--<img decoding="async" src="/files/new/june2023/rast.png" class="i-amphtml-fill-content i-amphtml-replaced-content">-->
                    </div>
                    <?php }?><!--Конец цикла-->
                    <?php }else{//Если активного расписания нет, показываем сообщение пользователю?>
                        <h2 class="text-center">Актуальное расписание будет чуть позже, мы уже работаем над этим.</h2>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <button class="btn btn-primary" OnClick='location.href="index.php"'>Вернуться на главную</button>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                        </div>
                    <?php }?><!--Конец if-->

                </div><!-- clearfix-end -->
            </div><!-- full-width-wrap-end -->
        </div><!-- content-wrap-end -->
    </div>
    <!--Тут подключаем Футер-->
    <?php
    include('template\footer2.php');
    ?>