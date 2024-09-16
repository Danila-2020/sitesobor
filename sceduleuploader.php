<?php
session_start();

//include('template/head.php');
//include('template/head2.php');
//include('template/uploadnav.php');
require_once('bd.php');
$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
}

?>
<link rel="stylesheet" href="css/style2.css">
<body>
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <!--<div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive">
            <h1 style="font-family: Calibri; font-weight: bold; text-align: center; margin-bottom: 25%; margin-top:0;">Логотип</h1>
        </div>-->
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            


<!--<hr>-->

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
    <!--<form action="" method="post">
    <div class="frame">
        <div class="center">
            <div class="title">
                <h1>Загрузить новое расписание</h1>
            </div>
    
            <div class="dropzone">
                <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
                <input type="file" class="upload-input" />
            </div>
    
            <button type="button" class="btn" name="uploadbutton">Загрузить файл</button>
    
        </div>
    </div>
    </form>-->
    <?php
    
?>
<form action="scedulesubmit.php" method="POST" enctype="multipart/form-data">

        <div class="frame">
        <div class="center">
            <div class="title">
                <h1>Загрузить новое расписание</h1>
            </div>
            <input type="text" name="titlescedule" placeholder="Заголовок" class="form-control" required /><br>
            <div class="dropzone">
                <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
                <input type="file" name="imagescedule" class="upload-input" required />
            </div>
            <button type="submit" class="btn" name="uploadbutton">Загрузить файл</button>
        </div>
    </div>
        <!--Копированный код-->
        <!--<input type="file" name="imagescedule" required /><br>-->
        </form>

<?php
include('template/footerupload.php');
?>