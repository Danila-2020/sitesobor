<?php
/* Добавление мероприятий user*/
session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
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
        <a href="userprofile.php">Профиль</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
    </li>
    <li class="inline-block mr1">
        <form action="exituser.php" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
        </form>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="addunewsuser.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="#">Мероприятие</a><!--Текущая страница-->
    </li>
    <li class="inline-block mr1">
        <a class="" href="addupublicuser.php">Публикацию</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">
        <a href="viewunewsuser.php">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewueventsuser.php">Мероприятия</a><!--viewueventsgeneral.php-->
    </li>
    <li class="inline-block mr1">
        <a href="viewupublicuser.php">Публикации</a>
    </li>
</ul>
</div>
<div class="container" style="margin-top:30px">
        <div class="row" style="margin-bottom:5%;">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <form action="submitaddeventsuser.php" method="post" class=""><!-- style="border:1px solid #000000; border-radius:15px;"
                Бордер обрамление наверное жопное, хотя незнаю-->
            <h3>Добавление мероприятия</h3>
            <input type="text" name="caption" placeholder="Введите название" class="form-control" required /><br>
            <textarea rows="5" cols="1" name="description" placeholder="Введите описание" class="form-control"></textarea><br>
            <label for="dateunews">Дата проведения</label>
            <input type="date" name="datep" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
            </form>
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <!--Тут будут мероприятия-->
            </div>
        </div>
      </div>
<hr>

<?php
include('template/footer.php');
?>