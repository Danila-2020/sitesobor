<?php
//Редактирование деятельности (Пользователь general)
session_start();
ob_start();
require_once('bd.php');

include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$iduser = $_SESSION['id'];
?>
<style>
body{background-image:url('img/background3.jpg');};
</style>

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
<body>
    
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
        <a href="generalprofile.php">Профиль</a>
    </li>
    <li class="inline-block mr1">
        <a href="genclergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a href="addusergen.php">Добавить пользователя</a>
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
        <!-- <form action="" method="post">exitgen.php -->
            <!-- <button type="submit" name="submit" class="btn btn-danger">Выход</button> -->
        <!-- </form> -->
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
    <li class="inline-block mr1">
        <a class="" href="addpoemsgen.php">Новый стих</a>
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
</div>
<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4"></div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4">
        <form action="editactivitygensubmit.php" method="post">
    <?php
    
    $id = $_POST['id'];

    // Подготовка SQL-запроса
    $query = "SELECT `activity`.`id_activity`, `activity`.`nactivity`, `activity`.`descactivity`, `activity`.`sstatus`, `activity`.`id_uprofile` 
              FROM `activity`
              INNER JOIN `uprofile` ON `activity`.`id_uprofile` = `uprofile`.`id_uprofile`
              WHERE `activity`.`id_activity` = '$id' AND `activity`.`sstatus` = 'active'";

    // Выполнение запроса
    $result = $mysqli->query($query);

    // Проверка на наличие ошибок в выполнении запроса
    if (!$result) {
        echo "Ошибка выполнения запроса: " . $mysqli->error; // Выводим сообщение об ошибке
        exit; // Останавливаем дальнейшее выполнение
    }

    // Получение результатов
    while ($row = $result->fetch_array()) {
        ?>
        <h2 style="text-align: center;">Редактирование деятельности</h2><br>
        <label for="nactivity">Название</label>
        <input type="text" name="nactivity" class="form-control" value="<?php echo htmlspecialchars($row['nactivity']); ?>" required /><br>
        <label for="descactivity">Описание</label>
        <textarea name="descactivity" cols="1" rows="6" class="form-control"><?php echo htmlspecialchars($row['descactivity']); ?></textarea><br>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_activity']); ?>" />
        <?php
    } // Конец цикла
    ?>
    <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
    </form>

            <button type="submit" class="btn btn-success" style="margin-top: 5%;" OnClick='location.href="viewactivitygen.php"'>Вернуться назад</button>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4"></div>
    </div>
</div>

<?php
include('template/footer.php');
?>