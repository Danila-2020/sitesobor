<?php
// Страница Духовенства(Все пользователи).

session_start();

include('template/clergyhead.php');
include('template/barber.php');
require_once('bd.php');


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
    <style>
        .clergy-card {
            margin-bottom: 20px;
        }

        .overflow-container {
        overflow-x: auto; /* Включаем горизонтальную прокрутку */
        /* white-space: nowrap; Запрещаем перенос строк */
    }
    </style>
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="scedule.php">Расписание богослужений</a><!--/site/article?id=4-->
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Таинства</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/order">Подать записку</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
    <li class="inline-block mr1">
        <a class="" href="#">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="">Роспись</a>
    </li>
</ul>

<!--Деятельность-->
<!--
<ul class="hide" [class]="activitiesMenu||'hide'">
    <li class="inline-block mr1">
        <a href="/site/article?id=6">Воскресная школа</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=7">Молодежный центр</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=8">Библиотека</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=9">Социальная деятельность</a>
    </li>
</ul>-->

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
    <li class="inline-block mr1">
        <a href="christening.php">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="wedding.php">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="сonfession.php">Исповедь</a>
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
        <div class="row flex-nowrap">
            <?php while ($clergy = $result->fetch_assoc()): 
                $img = base64_encode($clergy['imagesclergy']); ?>
                <div class="col-md-4">
                    <div class="card clergy-card">
                        <img src="data:image/jpeg;base64,<?=$img?>" class="card-img-top" alt="<?php echo $clergy['titleclergy']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $clergy['titleclergy']; ?></h5>
                            <p class="card-text">Дата: <?php echo $clergy['datesclergy']; ?></p>
                            <p class="card-text">Образование: <?php echo $clergy['educlergy']; ?></p>
                            <p class="card-text">Награды: <?php echo $clergy['awardsclergy']; ?></p>
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
                                <h5 class="modal-title" id="clergyModalLabel"><?php echo $clergy['titleclergy']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo $clergy['textclergy']; ?>
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