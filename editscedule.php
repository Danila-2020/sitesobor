<?php
session_start();
require_once('bd.php');
include('template/head.php');

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
?>
    
    <!--<amp-analytics type="metrika">
        <script type="application/json">
            {
                "vars": {
                    "counterId": "53592163"
                }
            }
        </script>
    </amp-analytics>-->

    <div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"><!--/files/logo-color.png-->
            <!--<h1 style="font-family: Calibri; font-weight: bold; text-align: center; margin-bottom: 25%; margin-top:0;">Логотип</h1>-->
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="userprofile.php">Профиль</a>
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
        <a class="" href="editscedule.php">Редактировать Расписание</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="#">История</a>
    </li>
    <!--<li class="inline-block mr1">
        <a class="" href="/site/article?id=2">Святыни</a>
    </li>-->
    <li class="inline-block mr1">
        <a class="" href="#">Роспись</a>
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

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
    <li class="inline-block mr1">
        <a href="christening.php">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Исповедь</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Причастие</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Соборование</a>
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
          <div class="col-sm-4">
            <h2>Расписание</h2>
            <form action="editscedule.php" method="post">
            <?php
            $query = ("SELECT `id_scedule`, `titlescedule`, `imagescedule`, `sstatus`, `id_uprofile` FROM `scedule` WHERE 1=1");
            $result = $mysqli->query($query);
            while($row = $result->fetch_array()){?>
                <input type="text" name="titlescedule" placeholder="Заголовок" value="<?php echo($row['titlescedule']);?>" class="form-control" required />
            <?php }; ?>
            <br>
            <input type="file" name="imagescedule" id="" required />
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button><br>
            <?php
                if(isset($_POST['submit'])){
                    /*$img_type = substr($_FILES['imagescedule']['type'],0,5);
                    $img_size = 2*1024*1024;*/
                    $titlescedule = $_POST['titlescedule'];
                    echo($titlescedule);                    
                }
            ?>
            </form>
            <br>
            
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-8">
            <img src="img/background1.jpg" alt="Пример изображения" class="img-fluid">
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
<!--Футер-->
<?php
include('template\footer.php');
?>