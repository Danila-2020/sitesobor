<?php
require_once('bd.php');
include('template/head.php');

//session_start();
$_SESSION['id'] = $_POST['id'];
$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
?>

    
    <style amp-boilerplate="">body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate="">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <!--Стилизация-->
    
        <style>
            body{background-image: url('../img/background2.jpg');}
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

         <link rel="stylesheet" href="../css/custom-style1.css">
    <link rel="stylesheet" href="../css/favicon-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <!--Тут заголовок-->

            
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
        <a class="" href="#">Роспись</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'">
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
                <h2>Новости</h2>
                        <?php
                        $query = ("SELECT unews.id_unews, unews.utitle, unews.udescription, unews.textunews, unews.id_uprofile, uphotonews.id_uphotonews, uphotonews.uphotonews, uphotonews.id_unews, uprofile.ulastname, uprofile.ufirstname, uprofile.upatronymic FROM `unews` INNER JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews` INNER JOIN `uprofile` ON `unews`.`id_uprofile` = `uprofile`.`id_uprofile` WHERE unews.id_unews = $id");
                        $result = $mysqli->query($query);
                        ?>
                        <div class="col col-12">
                            <?php
                            $queryimg = ("SELECT unews.id_unews, uphotonews.uphotonews FROM `unews` INNER JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews` INNER JOIN `uprofile` ON `unews`.`id_uprofile` = `uprofile`.`id_uprofile` WHERE unews.id_unews = $id");
                            $resultimg = $mysqli->query($queryimg);//Запрос выборки изображений
                            while($row = $result->fetch_assoc()){

                            echo("<h1>".$row['utitle']."</h1>");
                            echo("<p>".$row['udescription']."</p>");
                            ?>
                        </div>
                        <?php
                            $img = base64_encode($row['uphotonews']);
                        ?>

                        <div class="col col-12">
                            <img src="data:image/jpeg; base64,<?=$img?>" class="img-fluid" layout="responsive">
                        </div>

                            <?php echo("<p>".$row['textunews']."</p>");?>
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

<?php
include('template\footer.php');
?>