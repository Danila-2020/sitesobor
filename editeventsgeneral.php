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
    <?php
        include('template/generalheader.php');//Бошка подходит
    ?>
    
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
    $caption = $_POST['caption'];
    $description = $_POST['description'];
    $datep = $_POST['datep'];
    $statusevents = $_POST['statusevents'];
        if((!empty($_POST['caption'])) and (!empty($_POST['statusevents']))){
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
                        <option value="deleted" <?php echo ($event['statusevents'] === 'deleted') ? 'selected' : ''; ?>>Удалённый</option>
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