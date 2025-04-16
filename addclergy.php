<?php
// Модуль добавления Духовенства(Пользователь Admin)

ob_start();
session_start(); // Тут идёт session_start(), он наверное не нужен
require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>
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
        <a href="adminprofile.php">Профиль</a>
    </li>
    <li class="inline-block mr1">
        <a href="adduser.php">Добавить пользователя</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    </li>
    <li class="inline-block mr1">
        <form action="exitadmin.php" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
        </form>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="addunewsadmin.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addeventsadmin.php">Мероприятие</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addclergy.php">Духовенство</a>
    </li>
    <!-- <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Публикацию</a>
    </li> -->
    <li class="inline-block mr1">
        <a class="" href="addpoems.php">Новый стих</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">
        <a href="viewunewsadmin.php">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Публикации</a>
    </li>
</ul>

<hr>
</div>
<div class="container" style="background-image: url('img/background2.jpg');">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"><h2 class="text-center">Добавить нового священника</h2>
        <form action="submitaddclergy.php" method="post" enctype="multipart/form-data" style="margin-bottom:5%;">
            <div class="form-group">
                <label for="titleclergy">ФИО священника:</label>
                <input type="text" class="form-control" id="titleclergy" name="titleclergy" required>
            </div>
            <div class="form-group">
                <label for="imagesclergy">Фотография:</label>
                <input type="file" class="form-control" id="imagesclergy" name="imagesclergy" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="textclergy">Биография:</label>
                <textarea class="form-control" id="textclergy" name="textclergy" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="datesclergy">Даты:</label>
                <textarea class="form-control" id="datesclergy" name="datesclergy" rows="6"><textarea>
            </div>
            <div class="form-group">
                <label for="educlergy">Образование:</label>
                <textarea class="form-control" id="educlergy" name="educlergy" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="awardsclergy">Награды:</label>
                <textarea class="form-control" id="awardsclergy" name="awardsclergy" rows="4"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Добавить священника</button>
        </form>
    </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
    </div>
</div>
<?php
include('template/footer.php');
?>