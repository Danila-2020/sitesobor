<?php
// Страница Духовенства(Все пользователи).

ob_start();
// Стартуем сессию ДО подключения шаблонов
session_start();

// Подключаем модуль базы данных
require_once('bd.php');

// Подключаем шаблоны
// include('template/clergyhead.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

// Получаем данные из базы данных
$query = "SELECT `id_clergy`, `titleclergy`, `imagesclergy`, `textclergy`, `datesclergy`, `educlergy`,
 `awardsclergy`, `statusclergy`, `id_uprofile` 
FROM `clergy` 
WHERE 1=1 
AND `statusclergy` = 'active'";
$result = $mysqli->query($query);

if (!$result) {
    die("Ошибка запроса: " . $mysqli->error);
}
?>
<body>

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

<div class="social">
    <ul class="social-share">
        <li><a href="#"><i class="fa fa-telegram"></i></a></li>
        <li><a href="#"><i class="fa fa-vk"></i></a></li>
        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
        <li><a href="#"><i class="fa fa-skype"></i></a></li>
    </ul>
</div>

<div class="container mt-5">
    <div class="overflow-container">
        <div class="row">
            <?php while ($clergy = $result->fetch_assoc()): 
                $img = base64_encode($clergy['imagesclergy']); ?>
                <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                    <div class="card clergy-card">
                        <img src="data:image/jpeg;base64,<?=$img?>" class="card-img-top" alt="<?php echo htmlspecialchars($clergy['titleclergy']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($clergy['titleclergy']); ?></h5>
                            <p class="card-text">Дата: <?php echo htmlspecialchars($clergy['datesclergy']); ?></p>
                            <p class="card-text">Образование: <?php echo htmlspecialchars($clergy['educlergy']); ?></p>
                            <p class="card-text">Награды: <?php echo htmlspecialchars($clergy['awardsclergy']); ?></p>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#clergyModal<?php echo $clergy['id_clergy']; ?>">
                                Подробнее
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Модальное окно для подробной информации -->
                <div class="modal fade" id="clergyModal<?php echo $clergy['id_clergy']; ?>" tabindex="-1" role="dialog" aria-labelledby="clergyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="clergyModalLabel"><?php echo htmlspecialchars($clergy['titleclergy']); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo nl2br(htmlspecialchars($clergy['textclergy'])); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>