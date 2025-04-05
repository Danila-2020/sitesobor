<?php
// Страница просмотра деятельности
session_start();
ob_start();
require_once('bd.php');

include('template/scedulehead.php');
include('template/barber.php');

$id = $_POST['hidden'];
$_SESSION['id_activity'] = $id;
if (empty($id)) {
    header('Location: activity.php');
    exit; // Добавляем exit для завершения скрипта после редиректа
}

// Функция для получения данных из таблицы activity
function getActivities($mysqli, $id) {
    $sql = "SELECT activity.id_activity, activity.nactivity, activity.descactivity, activity.id_uprofile, imgactivity.images,
    uprofile.ulastname, uprofile.ufirstname
    FROM activity
    LEFT JOIN imgactivity ON activity.id_activity = imgactivity.id_activity
    LEFT JOIN uprofile ON activity.id_uprofile = uprofile.id_uprofile
    WHERE activity.id_activity = $id"; // Включаем ID в запрос

    $result = $mysqli->query($sql);
    
    if ($result === false) {
        die("Ошибка выполнения запроса: " . $mysqli->error);
    }

    return $result;
}

// Получение данных
$result = getActivities($mysqli, $id);

// Проверка, если результат пустой
if ($result->num_rows === 0) {
    die("Ошибка: Деятельность с ID $id не найдена.");
}
?>
<body>
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
    <div class="max-width-4 mx-auto p2">
        <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
            <div class="clearfix p1">
                <div class="desk-logo-wrap mx-auto block">
                    <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                </div>
            </div>
            <div class="clearfix">
                <ul class="center h2 list-reset mt0 head-menu">
                    <li class="inline-block mr1">
                        <a href="scedule.php">Расписание богослужений</a>
                    </li>
                    <li class="inline-block mr1">
                        <a href="about.php">О соборе</a>
                    </li>
                    <li class="inline-block mr1">
                        <a href="activity.php">Деятельность</a>
                    </li>
                    <li class="inline-block mr1">
                        <a href="note.php">Подать записку</a>
                    </li>
                    <li class="inline-block mr1">
                        <button type="submit" class="btn btn-primary" OnClick='window.location.href="signin.php"'>Вход</button>
                    </li>
                </ul>
                <hr>
            </div>
            <div class="container mt-5">
    <h1 class="text-center">Сведения о деятельности</h1>
    <div class="row justify-content-center">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <?php
                    if (!empty($row['images'])) {
                        echo '<img src="' . htmlspecialchars($row['images']) . '" class="card-img-top" alt="' . htmlspecialchars($row['nactivity']) . '">';
                    } else {
                        ?>
                        <img src="img/no_img — копия.jpeg" class="card-img-top" alt="<?php echo htmlspecialchars($row['nactivity']); ?>">
                        <?php
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nactivity']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['descactivity']); ?></p>
                        <p class="card-text">Разместил: <?php echo htmlspecialchars($row['ufirstname'] . ' ' . $row['ulastname']); ?></p>
                        <button type="submit" class="btn btn-outline-success form-control" onclick="window.location.href='activity.php'">Вернуться назад</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Закрытие соединения с базой данных
$mysqli->close();
?>