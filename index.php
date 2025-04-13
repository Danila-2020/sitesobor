<?php
// Главная страница сайта

ob_start();
// Стартуем сессию ДО подключения шаблонов
session_start();

// Подключаем модуль базы данных
require_once('bd.php');

// Подключаем шаблоны
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>

<body>
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
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive">
        </div>
    </div>
    <div class="clearfix">
            <!--Тут был заголовок-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="scedule.php">Расписание богослужений</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
    </li>
    <li class="inline-block mr1">
        <!-- <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Деятельность</a> -->
         <a href="activity.php">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Таинства</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    </li>
    <li class="inline-block mr1">
        <button type="submit" class="btn btn-primary" OnClick='window.location.href="signin.php"'>Вход</button>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="story.php">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="paintingalluser.php">Роспись</a><!--Тут отображаем, но не загружаем😀-->
    </li>
</ul>

<!-- <ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
<!--<p style="font-weight: bold; font-size: 14pt; color: blue; border: 1px solid #000;">Данные разделы примерные, содержимое будет изменено в процессе разработки</p>
    <li class="inline-block mr1">
        <a href="#">Воскресная школа</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Молодежный центр</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Библиотека</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Социальная деятельность</a>
    </li>
</ul> -->

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
    <li class="inline-block mr1">
        <a href="christening.php">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="wedding.php">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="confession.php">Исповедь</a>
    </li>
    <li class="inline-block mr1">
        <a href="eucharist.php">Причастие</a>
    </li>
    <li class="inline-block mr1">
        <a href="unction.php">Соборование</a>
    </li>
</ul>

<hr>
    </div>

    <div class="clearfix">

    <div class="md-col md-col-6 lg-col-4 p2">
    <?php
    // Вывод заголовка "Новости"
    echo '<h2>Новости</h2>';

    // Запрос для получения новостей
    $query = "
        SELECT DISTINCT 
            `unews`.`id_unews`, 
            `unews`.`utitle`, 
            `unews`.`udescription`, 
            `unews`.`textunews`, 
            `uphotonews`.`uphotonews` 
        FROM `unews` 
        INNER JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews` 
        LIMIT 3
    ";
    $result = $mysqli->query($query);

    // Проверка наличия данных
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idunews = $row['id_unews']; // ID новости
            $img = ''; // Переменная для изображения

            // Кодируем изображение в base64, если оно существует
            if (!empty($row['uphotonews'])) {
                $img = 'data:image/jpeg;base64,' . base64_encode($row['uphotonews']);
            } else {
                $img = 'img/no_img.jpeg'; // Заглушка, если изображение отсутствует
            }

            // Форма для каждой новости
            echo '
                <form method="POST" action="" style="margin-bottom:1%;">
                    <input type="hidden" name="idunews" value="' . htmlspecialchars($idunews) . '">
                    <a href="#" name="link" class="block relative clearfix mb2">
                        <div class="col col-12">
                            <img src="' . $img . '" alt="image" class="img-fluid" layout="responsive">
                        </div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            ' . htmlspecialchars($row['utitle']) . '
                        </div>
                    </a>
                    <button type="submit" name="submit" class="btn btn-primary" style="width:100%;">Подробнее</button>
                </form>
            ';
        }
    } else {
        echo '<p>Нет новостей для отображения.</p>';
    }

    // Обработка отправленной формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Получаем ID новости из POST
        $idunews = $_POST['idunews'];

        // Проверяем, что ID является числом (защита от инъекций)
        if (is_numeric($idunews)) {
            // Сохраняем ID в сессии
            $_SESSION['idunews'] = $idunews;

            // Перенаправляем на страницу новости
            header('Location: unews.php');
            exit();
        } else {
            echo '<script>alert("Некорректный ID новости.");</script>';
        }
    }

    // Ссылка на все новости
    echo '<a href="allunews.php" class="h3">Все новости</a>';
    ?>
</div>
            <div class="md-col md-col-6 lg-col-4 p2">
            <?php
// Вывод заголовка "Мероприятия"
echo '<h2>Мероприятия</h2>';

// Запрос для получения мероприятий
$query = "
    SELECT DISTINCT 
        events.id_events, 
        events.caption, 
        events.description, 
        events.datep, 
        events.id_uprofile, 
        uphotoevent.id_uphotoevent, 
        uphotoevent.uphotoevent, 
        uprofile.ulastname, 
        uprofile.ufirstname, 
        uprofile.upatronymic 
    FROM `events` 
    INNER JOIN `uphotoevent` ON `events`.`id_events` = `uphotoevent`.`id_events` 
    INNER JOIN `uprofile` ON `events`.`id_uprofile` = `uprofile`.`id_uprofile` 
    LIMIT 3
";
$result = $mysqli->query($query);

// Проверка наличия данных
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idevents = $row['id_events']; // ID мероприятия
        $img = ''; // Переменная для изображения

        // Кодируем изображение в base64, если оно существует
        if (!empty($row['uphotoevent'])) {
            $img = 'data:image/jpeg;base64,' . base64_encode($row['uphotoevent']);
        } else {
            $img = 'img/no_img.jpeg'; // Заглушка, если изображение отсутствует
        }

        // Форма для каждого мероприятия
        echo '
            <form method="POST" action="" style="margin-bottom:1%;">
                <input type="hidden" name="idevents" value="' . htmlspecialchars($idevents) . '">
                <a href="#" name="link" class="block relative clearfix mb2">
                    <div class="col col-12">
                        <img src="' . $img . '" alt="image" class="img-fluid" layout="responsive">
                    </div>
                    <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                        ' . htmlspecialchars($row['caption']) . '
                    </div>
                </a>
                <button type="submit" name="submit_event" class="btn btn-primary" style="width:100%;">Подробнее</button>
            </form>
        ';
    }
} else {
    echo '<p>Нет мероприятий для отображения.</p>';
}

// Обработка отправленной формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_event'])) {
    // Получаем ID мероприятия из POST
    $idevents = $_POST['idevents'];

    // Проверяем, что ID является числом (защита от инъекций)
    if (is_numeric($idevents)) {
        // Сохраняем ID в сессии
        $_SESSION['idevents'] = $idevents;

        // Перенаправляем на страницу мероприятия
        header('Location: events.php');
        exit();
    } else {
        echo '<script>alert("Некорректный ID мероприятия.");</script>';
    }
}

// Ссылка на все мероприятия
echo '<a href="allevents.php" class="h3">Все мероприятия</a>';
?>
            </div>
            <div class="md-col md-col-6 lg-col-4 p2">
            <?php
                echo('<h2>Публикации</h2>');
                $result = $mysqli->query("SELECT DISTINCT `upublic`.`id_upublic`, `upublic`.`id_uphoto`, 
                `upublic`.`naim`, `upublic`.`uptext`, `upublic`.`id_uprofile`,`uprofile`.`ulastname`, 
                `uprofile`.`ufirstname`, `uprofile`.`upatronymic`,`uphoto`.`uphoto` 
                FROM `upublic` 
                INNER JOIN `uphoto` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic` 
                INNER JOIN `uprofile` ON `upublic`.`id_uprofile` = `uprofile`.`id_uprofile` 
                WHERE 1=1
                GROUP BY `upublic`.`id_upublic`
                LIMIT 3");
                
                $count = $result->num_rows;
                while($row = $result->fetch_array()){
                    $img = base64_encode($row['uphoto']);
                    echo('<form method="POST" action="" style="margin-bottom:1%;">
                    <input type="hidden" name="idupublic" value="'.$row['id_upublic'].'"></input>');
                    echo('<a href="#" class="block relative clearfix mb2">
                        <div class="col col-12">');?>
                            <img src="data:image/jpeg; base64,<?=$img?>" alt="image" class="img-fluid" layout="responsive">
                            <?php
                    echo('</div>
                        <div class="absolute bg-white-a60 col col-12 h3 p1 media-label">
                            '.$row['naim'].'
                        </div>
                    </a>');?>
                    <button type="submit" class="btn btn-primary" style="width:100%;">Подробнее</button>
                    <?php echo('</form>');
                }

                // Обработка отправленной формы
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_event'])) {
                    // Получаем ID мероприятия из POST
                    $idupublic = $_POST['idupublic'];

                    // Проверяем, что ID является числом (защита от инъекций)
                    if (is_numeric($idevents)) {
                        // Сохраняем ID в сессии
                        $_SESSION['idupublic'] = $idupublic;

                        // Перенаправляем на страницу публикации
                        header('Location: upublic.php');
                        exit();
                    } else {
                        echo '<script>alert("Некорректный ID публикации.");</script>';
                    }
                }

                // Ссылка на все публикации
                echo '<a href="allupublic.php" class="h3">Все публикации</a>';
                ?>
            </div>

    </div>
  </div>
 </div>

 <div class="max-width-4 mx-auto p2">
    <div class="rounded border border-grey bg-white alpha-90 clearfix">
        <div class="clearfix">
            <div class="md-col md-col-6 p2">

                <div class="module-wrap"></div>
                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
            <div class="md-col md-col-6 p2">
                <div class="module-wrap mb2">
                    <h2><a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">Музыка</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
 </div>

</div><!-- content-wrap -->

</div> <!-- page-wrap -->




<div class="bg-white alpha-90 fit relative pt1" style="height:fit-content;">

<ul class="mx-auto center h2 list-reset">
    <li class="inline-block mr1">
        <a href="contacts.php">Задать вопрос</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    <li>
    <li class="inline-block mr1">
        <a href="contacts.php">Контакты</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Новости собора</a>
    </li>
    <li class="inline-block mr1">
        <a href="#" target="_blank">Новости епархии</a>
    </li>
    <li class="inline-block mr1">
        <a href="http://www.patriarchia.ru/db/news/" target="_blank">Общецерковные новости</a>
    </li>
    <li class="inline-block mr1">
        <button type="submit" class="btn btn-primary" OnClick='location.href="signin.php"'>Вход</button>
    </li>
</ul>

        <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
        </div>
</div>
</body>
</html>