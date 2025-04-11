<?php
// Добавление новости (пользователь user)
session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
?>
<style>
body{background-image:url('img/background4.jpg');};
</style>
<body>
    <script>
        $(document).ready(function() { 
            $("#phone").mask("+7(999)999-99-99");
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

    
<div class="relative page-wrap">

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
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})" href="adduphoto.php">Добавить фото</a>
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
        <a class="" href="addunewsuser.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=1">Мероприятие</a>
    </li>
    <!--<li class="inline-block mr1">
        <a class="" href="/site/article?id=2">Святыни</a>
    </li>-->
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Публикацию</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
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

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
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

    </div>
    
    <div class="container" style="margin-top:30px">
        <div class="row" style="margin-bottom:5%;">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <form action="submitaddunews.php" method="post" class=""><!-- style="border:1px solid #000000; border-radius:15px;"
                Бордер обрамление наверное жопное, хотя незнаю-->
            <h3>Добавление новости</h3>
            <input type="text" name="utitle" placeholder="Введите название" class="form-control" required /><br>
            <textarea rows="5" cols="1" name="udescription" placeholder="Введите описание" class="form-control"></textarea><br>
            <textarea rows="5" cols="1" name="textunews" placeholder="Введите текст после изображений" class="form-control"></textarea><br>
            <label for="ucover">Обложка</label>
            <input type="file" name="ucover" id="" class="form-control" />
            <label for="dateunews">Дата</label>
            <input type="date" name="dateunews" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
            </form>
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <!--Тут будут новости-->
            </div>
        </div>
      </div>




<?php
include('template/footer.php');
?>