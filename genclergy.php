<?php
// Страница Духовенства(Пользователь general).

session_start();

include('template/head.php');
include('template/barber.php');
require_once('bd.php');

// Выводим стили
echo getStyles();


// Получаем данные из базы данных
$query = "SELECT `id_clergy`, `titleclergy`, `imagesclergy`, `textclergy`, `datesclergy`, `educlergy`, 
`awardsclergy`,`statusclergy` FROM `clergy` WHERE 1=1";
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
    <li class="inline-block mr1">
        <a class="" href="addpainting.php">Сведения о Росписи</a>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#clergyModal<?php echo $clergy['id_clergy']; ?>" style="margin-bottom:5%;">
                                Подробнее
                            </button>
                            <?php
                            if($clergy['statusclergy'] == 'active'){
                                ?>
                                <form action="editclergygen.php" method="post">
                                <input type="hidden" name="hiddenid" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submit" class="btn btn-primary">Редактировать</button>
                                </form>
                                <form action="deleteclergygen.php" method="post" style="margin-top: 5%;">
                                <input type="hidden" name="hidden" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submitdel" class="btn btn-success">Удалить</button>
                                </form>
                                <form action="fulldeleteclergygen.php" method="post" style="margin-top: 5%;">
                                <input type="hidden" name="hidden" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submitfulldel" class="btn btn-danger">Полное удаление</button>
                                </form>
                                <?php
                            }
                            if($clergy['statusclergy'] == 'deleted'){
                                ?>
                                <form action="recoveryclergygen.php" method="post" style="margin-top: 5%;">
                                <input type="hidden" name="hidden" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submitrec" class="btn btn-success">Восстановить</button>
                                </form>
                                <?php
                            }
                            ?>
                            
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