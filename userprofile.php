<?php
session_start();
require_once('bd.php');
include('template/head.php');

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
?>
<style>
body{
    background-image:url('img/background4.jpg');
    background-repeat: repeat;/*no-repeat*/
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
};

</style>
<body>
    <script>
        $(document).ready(function() { 
            $("#phone").mask("+7(999) 999-99-99");
        });
    </script>
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
            <amp-img class="" src="/files/logo-color.png" width="1024" height="540" layout="responsive">
            <h1 style="font-family: Calibri; font-weight: bold; text-align: center; margin-bottom: 25%; margin-top:0;">Логотип</h1>
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="sceduleuploader.php">Расписание богослужений</a>
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
        <form action="" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
            <?php
            if(isset($_POST['submit'])){
                $_SESSION['id'] = "";
                session_unset();
                echo'<script>window.location.href="signin.php"</script>';
            }
            ?>
        </form>
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
    
    <div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <h2>Профиль священника</h2>
            <form action="edituserprofile.php" method="post">
            <?php
            $result = $mysqli->query("SELECT `id_uprofile`, `ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`, `uvisible`, `uphoto` FROM `uprofile` WHERE `id_uprofile`=$id");
            while($row = $result->fetch_array()){
                $img = base64_encode($row['uphoto']);
                ?>
            <div class="fakeimg">
                <img src="img/no_img — копия.jpeg" alt="" class="img-fluid">
            </div>
            <label for="ulastname">Фамилия</label>
            <input type="text" name="ulastname" placeholder="Фамилия" value="<?php echo($row['ulastname']);?>" class="form-control" required />
            <label for="ufirstname">Имя</label>
            <input type="text" name="ufirstname" placeholder="Имя" value="<?php echo($row['ufirstname']);?>" class="form-control" required />
            <label for="ulastname">Отчество</label>
            <input type="text" name="upatronymic" placeholder="Отчество" value="<?php echo($row['upatronymic'])?>" class="form-control" />
            <label for="uemail">E-Mail - Адрес</label>
            <input type="text" name="uemail" placeholder="E-Mail Адрес" value="<?php echo($row['uemail'])?>" class="form-control" required />
            <label for="uphone">Номер телефона</label>
            <input type="text" name="uphone" placeholder="+7(999) 999-99-99" id="phone" value="<?php echo($row['uphone'])?>" class="form-control" required />
            <label for="ulogin">Логин</label>
            <input type="text" name="ulogin" placeholder="Логин" value="<?php echo($row['ulogin'])?>" class="form-control" required />
            <label for="upassword">Пароль</label>
            <input type="text" name="upassword" placeholder="Пароль" value="<?php echo($row['upassword'])?>" class="form-control" required /><br>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button><br>
            <?php
            };
            ?>
            </form>
            <br>
            
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
            <!--<h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2017</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
            <br>
            <h2>TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2017</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>-->
          </div>
        </div>
      </div>




<?php
include('template/footer.php');
?>