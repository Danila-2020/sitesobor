<?php
// Добавление Росписи в таблицу `imgpainting`

session_start();
require_once('bd.php');
include('template/paintinghead.php');
?>
<body>
    <ul class="center h2 list-reset mt0 head-menu">
        <li class="inline-block mr1">
            <a href="adminprofile.php">Расписание богослужений</a>
        </li>
        <li class="inline-block mr1">
            <a href="adduser.php">Добавить пользователя</a>
        </li>
        <li class="inline-block mr1">
            <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
        </li>
        <li class="inline-block mr1">
            <a href="adduphotogen.php">Добавить фото</a>
        </li>
        <li class="inline-block mr1">
            <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
        </li>
        <li class="inline-block mr1">
            <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Профили</a>
        </li>
        <li class="inline-block mr1">
            <form action="" method="post">
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
            <a class="" href="addactivity.php">Деятельность</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="addpainting.php">Сведения о Росписи</a>
        </li>
    </ul>
    
    <ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
        <li class="inline-block mr1">
            <a href="viewunewsgeneral.php">Новости</a>
        </li>
        <li class="inline-block mr1">
            <a href="viewueventsgeneral.php">Мероприятия</a>
        </li>
        <li class="inline-block mr1">
            <a href="viewupublicgeneral.php">Публикации</a>
        </li>
        <li class="inline-block mr1">
            <a href="viewactivitygen.php">Деятельность</a>
        </li>
        <li class="inline-block mr1">
            <a href="gallery.php">Фотогалерея</a>
        </li>
    </ul>
    
    <ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
        <li class="inline-block mr1">
            <a href="controluprofile.php">Управление</a>
        </li>
    </ul>
    
    <hr>
<div class="container" style="margin-top: 1%; margin-bottom: 5%;"><!--py-5-->
<div class="row">
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <form action="submitinspainting.php" method="post" enctype="multipart/form-data">
            <h2 class="text-center" style="font-weight: bold;">Добавить сведения о росписи</h2>
            <input type="text" name="naimimgpainting" placeholder="Добавить название" class="form-control" required /><br>
            <textarea name="textimgpainting" placeholder="Описание" cols="1" rows="6" class="form-control" required></textarea>
            <label for="images">Добавить изображение</label>
            <input type="file" name="images" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
</div> 
</div>

<?php
include('template/footer3.php');
?>