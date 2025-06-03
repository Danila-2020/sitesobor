<?php
// Главная страница сайта

ob_start();
session_start();
require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');
echo getStyles();
?>
<style>
    @font-face {
      font-family: 'Russian Land Cyrillic';
      src: url('fonts/russianlandcyrillic.ttf') format('truetype');<!--RussianLandCyrillic.ttf-->
    }

    h,h1,h2,h3,h4,h5 {
      font-family: 'Russian Land Cyrillic', Arial, sans-serif;
      font-size: 24px;
      color: #fdfdfd;
    }
    
    body {
        font-family: 'CONSTANTIA', Arial, sans-serif;
        background: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%);
        background-attachment: fixed;
        color: #fdfdfd;
        min-height: 100vh;
    }
    
    .content-wrap, 
    .max-width-4, 
    .rounded, 
    .border, 
    .bg-white, 
    .alpha-90-dep, 
    .alpha-90 {
        background-color: rgba(0, 69, 113, 0.8) !important;
        color: #fdfdfd !important;
        border-color: #fdfdfd !important;
    }
    
    .media-label,
    .h3 {
        color: #fdfdfd !important;
    }
    
    a {
        color: #fdfdfd !important;
    }
    
    .btn-primary {
        background-color: rgba(96, 150, 184, 0.7) !important;
        border-color: #fdfdfd !important;
        color: #fdfdfd !important;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: rgba(96, 150, 184, 1) !important;
    }
    
    .btn-outline-primary {
        border-color: #fdfdfd !important;
        color: #fdfdfd !important;
    }
    
    .btn-outline-primary:hover {
        background-color: #fdfdfd !important;
        color: #004571 !important;
    }
    
    .land-see-hero-container {
        display: none; /* Скрываем герой-секцию с фоновым изображением */
    }
    
    /* Дополнительные стили для улучшения читаемости */
    .module-wrap {
        background-color: rgba(0, 69, 113, 0.6);
        padding: 20px;
        border-radius: 8px;
    }
    
    .img-fluid {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }
    
    .img-fluid:hover {
        transform: scale(1.02);
    }
    
    .media-label {
        background-color: rgba(0, 69, 113, 0.7) !important;
        border-radius: 0 0 8px 8px;
    }
    
    .clearfix {
        background: linear-gradient(to right, rgba(0, 69, 113, 0.9), rgba(96, 150, 184, 0.7));
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(253, 253, 253, 0.2);
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
        background: linear-gradient(to right, transparent, rgba(253, 253, 253, 0.1), transparent);
        height: 1px;
        margin: 15px 0;
    }

    /* Стили для колонок внутри clearfix */
    .md-col {
        background-color: rgba(0, 69, 113, 0.6);
        border-radius: 8px;
        margin: 10px 0;
        transition: all 0.3s ease;
        border: 1px solid rgba(253, 253, 253, 0.1);
    }

    .md-col:hover {
        background-color: rgba(0, 69, 113, 0.8);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Стили для галереи */
    .gallery-item {
        margin-bottom: 20px;
    }
    
    .ekko-lightbox .modal-content {
        background-color: rgba(0, 69, 113, 0.95);
    }
    
    .ekko-lightbox .modal-header {
        border-bottom: 1px solid rgba(253, 253, 253, 0.2);
    }
    
    .ekko-lightbox .close {
        color: #fdfdfd;
        opacity: 0.8;
        text-shadow: none;
    }
</style>
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
    
  <div class="clearfix"><!--rounded border border-grey bg-white alpha-90-dep-->
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive">
        </div>
    </div>
    <?php
    include('template/allnavbar.php');
    ?>

    <div class="clearfix">

    <div class="md-col md-col-6 lg-col-4 p2">
    <?php
    // Вывод заголовка "Новости"
    echo '<h1>Новости</h1>';
    
// Запрос для получения новостей с уникальными заголовками
$query = "
    SELECT 
        `unews`.`id_unews`, 
        `unews`.`utitle`, 
        `unews`.`udescription`, 
        `unews`.`textunews`, 
        MAX(`uphotonews`.`uphotonews`) AS uphotonews
    FROM `unews` 
    LEFT JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews` 
    GROUP BY `unews`.`utitle`
    ORDER BY `unews`.`id_unews` ASC
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
echo '<h1>Мероприятия</h1>';

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
    GROUP BY `events`.`id_events`
    ORDER BY `events`.`id_events` ASC
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
                echo('<h1>Публикации</h1>');
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
                    <button type="submit" name="submit_upublic" class="btn btn-primary" style="width:100%;">Подробнее</button>
                    <?php echo('</form>');
                }

                // Обработка отправленной формы
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_upublic'])) {
                    // Получаем ID мероприятия из POST
                    $idupublic = $_POST['idupublic'];

                    // Проверяем, что ID является числом (защита от инъекций)
                    if (is_numeric($idupublic)) {
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
            <div class="md-col md-col-12 p2">
                <div class="module-wrap">
                    <h2>Фотогалерея</h2>
                    
                    <!-- Слайдер галереи -->
                    <div id="gallerySlider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $galleryDir = 'gallery/';
                            $images = glob($galleryDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                            
                            if (!empty($images)) {
                                foreach ($images as $index => $image) {
                                    $active = $index === 0 ? 'active' : '';
                                    echo '
                                    <div class="carousel-item '.$active.'">
                                        <a href="'.$image.'" data-toggle="lightbox" data-gallery="gallery">
                                            <img src="'.$image.'" class="d-block w-100 rounded" alt="Слайд '.($index+1).'" loading="lazy">
                                        </a>
                                    </div>';
                                }
                            } else {
                                echo '<p>В галерее пока нет фотографий.</p>';
                            }
                            ?>
                        </div>
                        
                        <!-- Элементы управления -->
                        <a class="carousel-control-prev" href="#gallerySlider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Назад</span>
                        </a>
                        <a class="carousel-control-next" href="#gallerySlider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Вперед</span>
                        </a>
                        
                        <!-- Индикаторы -->
                        <ol class="carousel-indicators">
                            <?php
                            if (!empty($images)) {
                                foreach ($images as $index => $image) {
                                    $active = $index === 0 ? 'active' : '';
                                    echo '<li data-target="#gallerySlider" data-slide-to="'.$index.'" class="'.$active.'"></li>';
                                }
                            }
                            ?>
                        </ol>
                    </div>
                    
                    <a href="photogallery.php" class="btn btn-primary mt-3">Посмотреть все фото</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Стили для карусели -->
<style>
    #gallerySlider {
        background: rgba(0, 69, 113, 0.3);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .carousel-item {
        height: 400px; /* Фиксированная высота слайдов */
    }
    
    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        background: rgba(0, 69, 113, 0.5);
    }
    
    .carousel-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(253, 253, 253, 0.5);
    }
    
    .carousel-indicators .active {
        background-color: #6096b8;
    }
    
    @media (max-width: 768px) {
        .carousel-item {
            height: 300px;
        }
    }
</style>

<?php
include('template/footer2.php');
?>

<!-- Подключение Ekko Lightbox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
  // Активация Lightbox
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      wrapping: false,
      onShown: function() {
        $('.ekko-lightbox').css('background-color', 'rgba(0, 69, 113, 0.95)');
      }
    });
  });
</script>
</body>
</html>