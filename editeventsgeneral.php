<?php
//Редактирование мероприятия (Пользователь general)
ob_start();
session_start();
require_once('bd.php');

include('template/scedulehead.php');//Обычная бошка не подходит, надо будет переписать в нормальную.
include('template/barber.php');
// Выводим стили
echo getStyles();

// $id = $_SESSION['id'];
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
    <?php
// Подключение к базе данных
require_once('bd.php');

// Проверка, что пользователь авторизован
if (!isset($_SESSION['id'])) {
    die("Вы не авторизованы.");
}

// Получение ID мероприятия из сессии
if (!isset($_SESSION['idevents'])) {
    die("ID мероприятия не указан.");
}
$id_events = intval($_SESSION['idevents']); // Защита от SQL-инъекций

// Получение данных мероприятия из базы данных
$query = "SELECT * FROM events WHERE id_events = $id_events";
$result = $mysqli->query($query); // Выполняем запрос

if (!$result || mysqli_num_rows($result) === 0) {
    die("Мероприятие не найдено.");
}

$event = mysqli_fetch_assoc($result);

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $caption = trim($_POST['caption']);
    $description = trim($_POST['description']);
    $datep = $_POST['datep'];
    $statusevents = $_POST['statusevents'];

    // Валидация данных (можно добавить дополнительные проверки)
    if (empty($caption) || empty($description) || empty($datep)) {
        echo "<p style='color:red;'>Все поля обязательны для заполнения.</p>";
    } else {
        // Экранируем входные данные для защиты от SQL-инъекций
        $caption = $mysqli->real_escape_string($caption);
        $description = $mysqli->real_escape_string($description);
        $datep = $mysqli->real_escape_string($datep);
        $statusevents = $mysqli->real_escape_string($statusevents);

        // Обновление данных в базе данных
        $updateQuery = "UPDATE events 
                        SET caption = '$caption', description = '$description', datep = '$datep', statusevents = '$statusevents' 
                        WHERE id_events = $id_events";
        $updateResult = $mysqli->query($updateQuery);

        if ($updateResult) {
            echo "<p style='color:green;'>Мероприятие успешно обновлено.</p>";
        } else {
            echo "<p style='color:red;'>Ошибка при обновлении мероприятия: " . $mysqli->error . "</p>";
        }
    }
}
?>

<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <h2>Редактирование мероприятия</h2>
            <form action="" method="post">
                <!-- Заголовок -->
                <div class="form-group">
                    <label for="caption">Заголовок:</label>
                    <input type="text" class="form-control" id="caption" name="caption" value="<?php echo htmlspecialchars($event['caption']); ?>" required>
                </div>

                <!-- Описание -->
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                </div>

                <!-- Дата -->
                <div class="form-group">
                    <label for="datep">Дата:</label>
                    <input type="date" class="form-control" id="datep" name="datep" value="<?php echo htmlspecialchars($event['datep']); ?>">
                </div>

                <!-- Статус -->
                <div class="form-group">
                    <label for="statusevents">Статус:</label>
                    <select class="form-control" id="statusevents" name="statusevents" required>
                        <option value="active" <?php echo ($event['statusevents'] === 'active') ? 'selected' : ''; ?>>Активный</option>
                        <option value="inactive" <?php echo ($event['statusevents'] === 'inactive') ? 'selected' : ''; ?>>Неактивный</option>
                        <option value="cancelled" <?php echo ($event['statusevents'] === 'cancelled') ? 'selected' : ''; ?>>Отменен</option>
                    </select>
                </div>

                <!-- Скрытый input для id_uprofile -->
                <input type="hidden" name="id_uprofile" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">

                <!-- Кнопка отправки -->
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </form>
            <br>
            <hr class="d-sm-none">
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
    </div>
</div>
        
        </div>
      </div>
<?php
include('template/footer.php');
?>