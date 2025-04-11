<?php
// Добавление записи в таблицу painting
session_start();
ob_start();

include('template/head.php');//Две башки, которые не нужны
include('template/sceduleuploaderhead.php');
include('template/barber.php');
require_once('bd.php');

// Выводим стили
echo getStyles();
?>
<body>
    <ul class="center h2 list-reset mt0 head-menu">
        <li class="inline-block mr1">
            <a href="sceduleuploader.php">Расписание богослужений</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Добавить пользователя</a><!--adduser.php-->
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
        <li class="inline-block mr1">
            <a href="editpaintinggeneral.php">Роспись(Редактирование)</a>
        </li>
    </ul>
    
    <ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
        <li class="inline-block mr1">
            <a href="controluprofile.php">Управление</a>
        </li>
    </ul>
    <?php
    $id = $_SESSION['id'];
    if(empty($id)){
        header('Location: signin.php');
    }
    // echo('<h1>Сейчас авторизован пользователь '.$id.'</h1>');
    ?>
    <hr>
<div class="container"><!--py-5-->

  <div class="row py-4">
    <div class="col-lg-6 mx-auto">
		<form action="addpaintingsubmit.php" method="post" enctype="multipart/form-data">
		<h2>Добавить сведения о Росписи</h2>
		<input type="text" name="npainting" placeholder="Заголовок" class="form-control" required /><br>
        <textarea name="descpainting" cols="1" rows="6" placeholder="Описание" class="form-control"></textarea><br>
      <!-- Upload image input-->
	  <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
		<input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
		<label id="upload-label" for="upload" class="font-weight-light text-muted">Выберите файл</label>
		<div class="input-group-append">
		 <label for="upload" class="btn btn-warning m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Выбрать</small></label>
		</div>
	  </div>
	  <div class="image-area mt-4" style="margin-bottom: 1%;"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

	  <button type="submit" name="submit" class="btn btn-warning" style="float: right;">Загрузить</button>
	  </form>
	  <!--Конец формы-->
    </div>
  </div>
</div>

<?php
include('template/footer3.php');
?>