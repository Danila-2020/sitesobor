<?php
// Добавление деятельности
session_start();
require_once('bd.php');
// include('template/head.php');
include('template/scedulehead.php');//Обычная голова не работает
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
}
?>
<style>
body{background-image:url('img/background3.jpg');};
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
            <amp-img class="" src="../img/mestologo.png" width="1024" height="540" layout="responsive">
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
            <ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="sceduleuploader.php">Расписание богослужений</a>
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
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Профили</a>
    </li>
    <li class="inline-block mr1">
        <form action="exitgen.php" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
        </form>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="addunewsgeneral.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addeventsgen.php">Мероприятие</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addupublicgen.php">Публикацию</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="#">Деятельность</a><!--Текущая страница-->
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">
        <a href="#">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Публикации</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewactivitygen.php">Деятельность</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
    <li class="inline-block mr1">
        <a href="#">Управление</a>
    </li>
</ul>

<hr>
<div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
          <form action="submitaddactivity.php" method="post">
            <h2 style="font-weight:bold; text-align:center;">Добавление деятельности</h2>
            <input type="text" name="nactivity" placeholder="Название деятельности" class="form-control" required /><br>
            <textarea name="descactivity" placeholder="Описание" cols="1" rows="6" class="form-control"></textarea><br>
            <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
          </form>
            <br>
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
        
        </div>
      </div>

    </div>
    <?php
    include('template/footer.php');
    ?>