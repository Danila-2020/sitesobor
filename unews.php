<?php
// Страница новости (Все пользователи)
ob_start();
session_start();

require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр новости</title>
    <!-- Подключение Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Подключение Ekko Lightbox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <!-- Подключение Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Все ваши стили остаются без изменений */
        @font-face {
            font-family: 'Russian Land Cyrillic';
            src: url('fonts/russianlandcyrillic.ttf') format('truetype');
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
            padding-top: 56px;
        }
        
        /* ... остальные стили ... */
    </style>
</head>
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

<!-- Навбар -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #004571 !important;">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <amp-img src="img/mestologo.png" width="50" height="50" layout="fixed"></amp-img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        О Соборе
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown" style="background-color: #004571 !important;">
                        <a class="dropdown-item" href="clergy.php">Духовенство</a>
                        <a class="dropdown-item" href="history.php">История</a>
                        <a class="dropdown-item" href="feodosiy.php">Прп. Феодосий Кавказский</a>
                        <a class="dropdown-item" href="tour.php">Виртуальный тур</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Благочиния
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blagochiniyaDropdown" style="background-color: #004571 !important;">
                        <a class="dropdown-item" href="blagochiniya-info.php">Общие сведения</a>
                        <a class="dropdown-item" href="blagochiniya-temples.php">Храмы</a>
                        <a class="dropdown-item" href="blagochiniya-clergy.php">Духовенство</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown" style="background-color: #004571 !important;">
                        <a class="dropdown-item" href="sunday-school.php">Воскресная школа</a>
                        <a class="dropdown-item" href="youth-center.php">Молодёжный центр</a>
                        <a class="dropdown-item" href="tea-room.php">Чайный дворик</a>
                        <a class="dropdown-item" href="social-activity.php">Социальная деятельность</a>
                    </div>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="allunews.php">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photogallery.php">Галерея</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Контакты</a>
                </li>
                
                <li class="nav-item">
                    <a class="btn btn-outline-primary ml-2" href="signin.php">Вход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="relative page-wrap">
    <div class="content-wrap relative">
        <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
            <div class="land-see-hero-main mx-auto"></div>
        </section>
        
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
                <div class="clearfix p1 text-center">
                    <amp-img class="mx-auto" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                </div>
                
                <div class="social text-center mb-4">
                    <div class="container">
                        <?php include('template/social-icons.php'); ?>
                    </div>
                </div>
                
                <div class="clearfix">
                    <div class="col-12 p-4">
                        <?php
                        // Получаем ID новости
                        if (isset($_POST['idunews'])) {
                            $idunews = intval($_POST['idunews']);
                            $_SESSION['idunews'] = $idunews;
                        } elseif (isset($_SESSION['idunews'])) {
                            $idunews = intval($_SESSION['idunews']);
                        } else {
                            echo "<div class='alert alert-danger'>Ошибка: Не указан ID новости.</div>";
                            echo "<div class='text-center mt-4'><button class='btn btn-primary' onclick='window.location.href=\"index.php\"'>На главную</button></div>";
                            exit;
                        }

                        // Получаем данные новости
                        $newsQuery = "SELECT * FROM `unews` WHERE `id_unews` = $idunews";
                        var_dump($newsQuery);
                        $newsResult = $mysqli->query($newsQuery);

                        if ($newsResult && $newsResult->num_rows > 0) {
                            $newsRow = $newsResult->fetch_assoc();

                            // Вывод заголовка и описания в самом верху
                            echo('
                                <div class="col col-12">
                                    <h1 class="text-center mb-4">' .$newsRow['utitle'].'</h1>
                                    <p class="lead text-center mb-4">
                                        ' .$newsRow['udescription']. '
                                    </p>
                                </div>
                            ');
                            
                            // Получаем фотографии
                            $photosQuery = "SELECT `uphotonews` FROM `uphotonews` WHERE `id_unews` = $idunews";
                            $photosResult = $mysqli->query($photosQuery);
                            
                            $photos = array();
                            if ($photosResult && $photosResult->num_rows > 0) {
                                while ($photoRow = $photosResult->fetch_assoc()) {
                                    if (!empty($photoRow['uphotonews'])) {
                                        // Кодируем изображение в base64
                                        $show_img = base64_encode($photoRow['uphotonews']);
                                        $photos[] = 'data:image/jpeg;base64,' . $show_img;
                                    }
                                }
                            }

                            // Вывод галереи после заголовка и описания
                            if (!empty($photos)) {
                                echo('
                                <div class="gallery-slider">
                                    <div id="newsGallery" class="carousel slide" data-ride="carousel" data-interval="false">
                                        <div class="carousel-inner">
                                ');
                                
                                foreach ($photos as $index => $photo) {
                                    $active = $index === 0 ? 'active' : '';
                                    echo('
                                        <div class="carousel-item '.$active.'">
                                            <a href="'.$photo.'" data-toggle="lightbox" data-gallery="news-gallery" class="gallery-item">
                                                <img src="'.$photo.'" class="d-block w-100" alt="Фото новости">
                                            </a>
                                        </div>
                                    ');
                                }
                                
                                echo('
                                        </div>
                                ');
                                
                                if (count($photos) > 1) {
                                    echo('
                                        <a class="carousel-control-prev" href="#newsGallery" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Предыдущее</span>
                                        </a>
                                        <a class="carousel-control-next" href="#newsGallery" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Следующее</span>
                                        </a>
                                        <ol class="carousel-indicators">
                                    ');
                                    
                                    foreach ($photos as $index => $photo) {
                                        $active = $index === 0 ? 'active' : '';
                                        echo('<li data-target="#newsGallery" data-slide-to="'.$index.'" class="'.$active.'"></li>');
                                    }
                                    
                                    echo('
                                        </ol>
                                    ');
                                }
                                
                                echo('
                                    </div>
                                </div>
                                ');
                            } else {
                                echo('
                                    <div class="col col-12 mb-4">
                                        <img src="img/no_img.jpeg" class="img-fluid mx-auto d-block" alt="Нет изображений">
                                    </div>
                                ');
                            }
                            
                            // Текст новости выводится ПОСЛЕ изображений
                            echo('
                                <div class="col col-12">
                                    <div class="news-content">
                                        ' . nl2br(htmlspecialchars($newsRow['textunews'])) . '
                                    </div>
                                </div>
                            ');
                            
                            // Дата публикации
                            if (!empty($newsRow['dateunews'])) {
                                $date = date('d.m.Y', strtotime($newsRow['dateunews']));
                                echo('<div class="text-right mt-4"><small>Опубликовано: ' . $date . '</small></div>');
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Новость не найдена.</div>";
                        }
                        ?>
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='allunews.php'">К списку новостей</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('template/footer2.php');
?>

<!-- Подключение JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            wrapping: false,
            onShown: function() {
                $('.ekko-lightbox').css('background-color', 'rgba(0, 69, 113, 0.95)');
                $('.ekko-lightbox-nav-overlay a').css('color', '#fdfdfd');
            }
        });
    });
</script>
</body>
</html>
<?php 
$mysqli->close();
ob_end_flush(); 
?>