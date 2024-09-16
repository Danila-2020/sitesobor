<?php 
$mysqli = new mysqli('localhost','root','','sobor');
$mysqli->set_charset("utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--<link rel="canonical" href="http://spasskiy-sobor.ru/site/article?id=10">-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="amp-google-client-id-api" content="googleanalytics">
    <link rel="icon" type="image/png" href="/16x16/files/sobor-small-rounded.png" />
    <link rel="apple-touch-icon" href="/57x57/files/sobor-small-rounded.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/brands.css" integrity="sha384-i2PyM6FMpVnxjRPi0KW/xIS7hkeSznkllv+Hx/MtYDaHA5VcF0yL3KVlvzp8bWjQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/fontawesome.css" integrity="sha384-sri+NftO+0hcisDKgr287Y/1LVnInHJ1l+XC7+FOabmTTIK0HnE2ID+xxvJ21c5J" crossorigin="anonymous">
    
        <title>Расписание богослужений</title>

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
    <link rel="stylesheet" href="css/style.css">
    
        <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="d1hbQfdU7Io0AZ-BqiENSvmVtbizA1Odfcmb6j4w7g0_aWowvx2W-FxX8sbkYjh5sNLs9N8uGK82r-mnCFrcOA==">
    
    <script src="https://cdn.ampproject.org/v0.js" async="async"></script>
    <script src="https://cdn.ampproject.org/v0/amp-bind-0.1.js" async="async" custom-element="amp-bind"></script>
    <script src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js" async="async" custom-element="amp-analytics"></script>
</head>
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
            <a class="" href="#">Духовенство</a>
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
    
    <ul class="mx-auto center list-reset social-icons-wrap">
        <!--<li class="inline-block mr1">
            <a href="https://instagram.com/soborvpyatigorske" target="_blank">
                <i class="fab fa-instagram fa-lg"></i>
            </a>
        </li>-->
        <li class="inline-block mr1">
            <a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank"><!--https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg-->
                <i class="fab fa-youtube fa-lg"></i>
            </a>
        </li>
        <!--<li class="inline-block mr1">
            <a href="https://www.flickr.com/people/157787163@N07/" target="_blank">
                <i class="fab fa-flickr fa-lg"></i>
            </a>
        </li>-->
        <li class="inline-block mr1">
            <a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">
                <i class="fab fa-soundcloud fa-lg"></i>
            </a>
        </li>
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
<?php
        $result = $mysqli->query("SELECT scedule.id_scedule, scedule.titlescedule, scedule.imagescedule, scedule.sstatus, scedule.id_uprofile, uprofile.ulastname, uprofile.ufirstname, uprofile.upatronymic FROM `scedule` INNER JOIN `uprofile` ON scedule.id_uprofile = uprofile.id_uprofile WHERE 1=1 AND `scedule`.`sstatus` = 'active'");
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
                
                    <h1><?php echo($row['titlescedule'])?></h1>
                    <p>Расписание показано для примера!!!</p>
    
                    <div class="article-wrap">
                        <?php
                        $img = base64_encode($row['imagescedule']);
                        ?>
                        <p><amp-img src="data:image/jpeg; base64, <?=$img?>" height="2436" width="1125" layout="responsive" class="i-amphtml-element i-amphtml-layout-responsive i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout" i-amphtml-layout="responsive" style="--loader-delay-offset: 1ms !important;"><i-amphtml-sizer slot="i-amphtml-svc" style="padding-top: 216.533%;"></i-amphtml-sizer></amp-img></p><!--<img decoding="async" src="/files/new/june2023/rast.png" class="i-amphtml-fill-content i-amphtml-replaced-content">-->
                    </div>
                    <?php }; ?><!--Конец цикла-->

                </div><!-- clearfix-end -->
            </div><!-- full-width-wrap-end -->
        </div><!-- content-wrap-end -->
    </div>
    
    <?php
    include('template\footer2.php');
    ?>