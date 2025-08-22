<?php
// Профиль (Пользователь User)

session_start();
require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
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
            <!--Тут заголовок-->

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
        <a href="galleryuploader.php">Загрузить фото в галерею</a>
    </li>
    <li class="inline-block mr1">
        <form action="" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
            <?php
            if(isset($_POST['submit'])){
                $_SESSION['id'] = "";
                session_unset();
                session_destroy();
                echo('<script>window.location.href="signin.php"</script>');
                exit(); //Выход из страницы
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
        <a class="" href="addeventsuser.php">Мероприятие</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addupublicuser.php">Публикацию</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">    
    <a class="" href="viewunewsuser.php">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewueventsuser.php">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewupublicuser.php">Публикации</a>
    </li>
</ul>

<hr>
    </div>
    <div class="container">
        <!-- Форма загрузки изображений -->
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90 clearfix">
                <div class="clearfix">
                    <div class="col-12 p-2">
                        <div class="module-wrap">
                            <h2 class="text-center">Добавить фото в галерею</h2>
                            
                            <form action="uploadgallery.php" method="post" enctype="multipart/form-data" class="mb-4">
                                <div class="form-group">
                                    <label for="galleryImage">Выберите изображение:</label>
                                    <input type="file" class="form-control-file" id="galleryImage" name="galleryImage" accept="image/jpeg,image/png,image/gif" required>
                                    <small class="form-text text-muted">Допустимые форматы: JPG, PNG, GIF. Максимальный размер: 5MB.</small>
                                </div>
                                <button type="submit" class="btn btn-primary" name="upload">Загрузить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('template/footer.php');
    ?>