<?php
// Редактирование мероприятия (Пользователь user)

session_start();
ob_start();
require_once('bd.php');

include('template/scedulehead.php');
include('template/barber.php');
// Выводим стили
echo getStyles();

$idevents = $_SESSION['idevents'];
?>
<?php
// Подключение к базе данных
require_once('bd.php');

// Проверяем, передан ли ID мероприятия через GET или POST
if (!empty($_SESSION['idevents'])) { //$_POST['idevents']
    // $id_events = intval($_POST['idevents']); // Преобразуем ID в число для безопасности

    // Запрос для получения данных мероприятия
    $query = "SELECT `caption`, `description`, `datep` 
              FROM `events` 
              WHERE `id_events` = $idevents";

    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc(); // Получаем данные мероприятия
    } else {
        die("Мероприятие не найдено.");
    }
} else {
    die("ID мероприятия не передан.");
}
?>
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
            <a href="userprofile.php">Профиль</a>
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
            <a class="" href="addeventsuser.php">Мероприятие</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="addupublicuser.php">Публикацию</a>
        </li>
    </ul>

    <ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
        <li class="inline-block mr1">    
        <a class="viewunewsuser.php" href="#">Новости</a>
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
    <div class="container" style="margin-bottom:5%;">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <form action="updateevents.php" method="post" class="">
            <h3>Редактирование мероприятия</h3>

            <!-- Поле для названия -->
            <input type="text" name="caption" value="<?php echo htmlspecialchars($event['caption']); ?>" placeholder="Введите название" class="form-control" required /><br>

            <!-- Поле для описания -->
            <textarea rows="5" cols="1" name="description" placeholder="Введите описание" class="form-control"><?php echo htmlspecialchars($event['description']); ?></textarea><br>

            <!-- Поле для даты проведения -->
            <label for="datep">Дата проведения</label>
            <input type="date" name="datep" value="<?php echo htmlspecialchars($event['datep']); ?>" class="form-control"><br>

            <!-- Скрытое поле для ID мероприятия -->
            <input type="hidden" name="idevents" value="<?php echo $id_events; ?>">

            <!-- Кнопка отправки формы -->
            <button type="submit" name="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
        </div>
    </div>
<?php
include('template/footer.php');
?>