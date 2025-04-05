<?php
// Страница Деятельности(Все пользователи)
require_once('bd.php');


// Функция для получения данных из таблицы activity
function getActivities($mysqli) {
    $sql = "SELECT activity.id_activity, activity.nactivity, activity.descactivity, activity.id_uprofile, imgactivity.images,
    uprofile.ulastname, uprofile.ufirstname
    FROM activity
    LEFT JOIN imgactivity ON activity.id_activity = imgactivity.id_activity
    LEFT JOIN uprofile ON activity.id_uprofile = uprofile.id_uprofile";
    $result = $mysqli->query($sql);
    
    if ($result === false) {
        die("Ошибка выполнения запроса: " . $mysqli->error);
    }

    return $result;
}

// Получение данных
$result = getActivities($mysqli);

include('template/scedulehead.php');
include('template/barber.php');
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
        <a class="" href="/site/article?id=1">История</a>
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
    <div class="container mt-5">
        <h1 class="text-center">Деятельность</h1>
        <div class="row card-container mt-4">
        <?php if ($result->num_rows > 0): ?>
        <?php while ($activity = $result->fetch_assoc()): 
            $img = base64_encode($activity['images']);
        ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <?php if (!empty($activity['images'])): ?>
                        <img src="data:image/jpeg;base64,<?=$img?>" class="card-img-top" alt="Изображение активности">
                    <?php else: ?>
                        <img src="img/no_img — копия.jpeg" class="card-img-top" alt="Изображение активности">
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlspecialchars($activity['nactivity']); ?></h4>
                        <p class="card-text">Описание: <?php echo htmlspecialchars($activity['descactivity']); ?></p>
                        <p class="card-text"><small class="text-muted">Добавил: <?php echo htmlspecialchars($activity['ulastname']) . " " . htmlspecialchars($activity['ufirstname']); ?></small></p>
                        <form action="viewactivity.php" method="post">
                            <input type="hidden" name="hidden" value="<?php echo(htmlspecialchars($activity['id_activity']));?>">
                            <button type="submit" class="btn btn-outline-primary form-control">Просмотр</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-warning text-center">Нет записей для отображения</div>
        </div>
    <?php endif; ?>
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