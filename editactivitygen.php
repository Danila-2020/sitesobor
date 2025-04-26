<?php
// Редактирование деятельности (Пользователь general)

session_start(); // Стартуем сессию
if (!isset($_SESSION['id'])) {
    header("Location: signin.php");
    exit(); // Завершаем выполнение скрипта
}

require_once('bd.php'); // Подключаем базу данных
include('template/scedulehead.php'); // Подключаем шаблон head.php
include('template/barber.php'); // Подключаем шаблон barber.php

// Выводим стили
echo getStyles();

$iduser = $_SESSION['id'];
?>
<style>
body { background-image: url('img/background3.jpg'); }
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
                    <amp-img class="" src="../img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                </div>
            </div>
            <div class="clearfix">
                <!-- Меню -->
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

                <!-- Выпадающие меню -->
                <ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
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

                <ul class="hide" [class]="activitiesMenu||'hide'">
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

                <ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
                    <li class="inline-block mr1">
                        <a href="controluprofile.php">Управление</a>
                    </li>
                </ul>

                <hr>
            </div>
            <div class="container" style="margin-top:30px">
                <div class="row" style="margin-bottom:5%;">
                    <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4"></div>
                    <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4">
                        <form action="updateactivity.php" method="post">
                            <?php
                            // Проверяем, авторизован ли пользователь
                            if (empty($_SESSION['id'])) {
                                header("Location: signin.php");
                                exit; // Завершаем выполнение скрипта
                            }

                            // Проверяем, установлен ли ID деятельности в сессии
                            if (isset($_SESSION['idactivity'])) {
                                $idactivity = intval($_SESSION['idactivity']); // Преобразуем в число для безопасности

                                // Экранируем входные данные для защиты от SQL-инъекций
                                $idactivity = $mysqli->real_escape_string($idactivity);

                                // Получаем данные деятельности из базы данных
                                $query = "SELECT * FROM `activity` WHERE `id_activity` = '$idactivity'";
                                $result = $mysqli->query($query);

                                if ($result && $result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    // Выводим форму для редактирования
                                    echo '
                                        <input type="hidden" name="idactivity" value="' . htmlspecialchars($row['id_activity']) . '">
                                        <label for="nactivity">Название:</label>
                                        <input type="text" name="nactivity" value="' . htmlspecialchars($row['nactivity']) . '" class="form-control" required><br>
                                        <label for="descactivity">Описание:</label>
                                        <textarea name="descactivity" class="form-control">' . htmlspecialchars($row['descactivity']) . '</textarea><br>
                                        <button type="submit" name="submit" class="btn btn-primary">Сохранить изменения</button>
                                    ';
                                } else {
                                    echo "Деятельность не найдена.";
                                }
                            } else {
                                echo "Ошибка: ID деятельности не установлен.";
                            }
                            ?>
                        </form>

                        <button type="button" class="btn btn-success" style="margin-top: 5%;" onclick="location.href='viewactivitygen.php'">Вернуться назад</button>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('template/footer.php');
?>