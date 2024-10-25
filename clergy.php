<?php 
require_once('bd.php');
include('template/clergyhead.php');
include('template/barber.php');
?>

<body class="land-see ">
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
        <a href="scedule.php">Расписание богослужений</a><!--/site/article?id=4-->
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
        <a href="/site/order">Подать записку</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="">Роспись</a>
    </li>
</ul>

<!--Деятельность-->
<!--
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
</ul>-->

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

<!--<ul class="mx-auto center list-reset social-icons-wrap">
    <li class="inline-block mr1">
        <a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <li class="inline-block">
        <a href="https://t.me/soborvpyatigorske" target="_blank">
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>-->


    <ul class="list-reset breadcrumbs">
                    <li class="inline-block mr1">
                                    <a href="/">
                
                Главная
                                    </a>
                    </li>
                    <li class="inline-block mr1">
                                    <a href="/site/articles?catids%5B0%5D=1">О Соборе</a>
                            </li>
                    <li class="inline-block mr1">Духовенство</li>
    </ul>

                <h1>Духовенство</h1>

                <div class="article-wrap">
                    <div class="article-wrap">
<div>&nbsp;</div>
<div class="row">
<?php
    $query = "SELECT `id_clergy`, `titleclergy`, `imagesclergy`, `textclergy`, `datesclergy`, `educlergy`, `awardsclergy` FROM `clergy` WHERE 1=1 LIMIT 5";
    $result = $mysqli->query($query);
    
    while($row = $result->fetch_array()){
        $img = base64_encode($row['imagesclergy']);
        echo('<h1 style="margin-left:2%;">'.$row['titleclergy'].'</h1>')?>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <img src="data:image/jpeg;base64,<?=$img?>" alt="" style="margin:0;" class="img-fluid">
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <?php
                $id = $row['id_clergy'];
                echo('<input type="hidden" name="id_clergy" value="'.$id.'">');
                echo('<h2>ИД: '.$id.'</h2>
                <p>'.$row['datesclergy'].'</p>
                <h2>Образование</h2>
                <p>'.$row['educlergy'].'</p>');
                if(!empty($row['awardsclergy'])){
                    echo('<h2>Награды</h2>
                    <p>'.$row['awardsclergy'].'</p>');
                }
                ?>
                <button class="btn btn-primary show" id="show<?=$id;?>" style="float:right; margin-right: 1%;" onclick="toggleBio(<?=$id;?>)">Подробнее</button>
                <div class="bio" id="bio<?=$id;?>" style="display:none;">
                    <p><?=$row['textclergy'];?></p>
                    <button class="btn btn-secondary" style="float:right; margin-right: 1%;" onclick="toggleBio(<?=$id;?>)">Скрыть</button>
                </div>
            </div>
            <?php
    }
    ?>
</div>

<script>
function toggleBio(id) {
    var bio = document.getElementById('bio' + id);
    if (bio.style.display === "none") {
        bio.style.display = "block";
    } else {
        bio.style.display = "none";
    }
}
</script>

<!-- Найти еще -->
            </div>
                </div>
                    <p style="border: 1px solid;" class="text-center">Данный раздел находится в разработке, содержимое будет добавляться.</p>
                    </div>
                </div>
            </div><!-- clearfix-end -->
        </div><!-- full-width-wrap-end -->
    </div><!-- content-wrap-end -->
</div>



<?php
include('template\footer2.php');
?>