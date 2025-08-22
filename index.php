<?php
// Главная страница сайта

ob_start();
session_start();
require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');
echo getStyles();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <!-- Подключение Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
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
            padding-top: 56px; /* Для фиксированного навбара */
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
            display: none;
        }
        
        /* Стили для навбара */
        .navbar {
            background-color: rgba(0, 69, 113, 0.95) !important;
            border-bottom: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            padding: 0;
        }

        .nav-link {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(96, 150, 184, 0.5);
        }

        .nav-item.active .nav-link {
            background-color: rgba(96, 150, 184, 0.7);
        }

        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: rgba(0, 69, 113, 0.95);
                padding: 1rem;
                border-radius: 0 0 8px 8px;
            }
            
            .nav-link {
                margin: 0.2rem 0;
            }
        }
        
        /* Остальные стили */
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
        
        /* Стили для слайдера новостей */
        #newsSlider {
            background: rgba(0, 69, 113, 0.3);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .news-slide {
            height: 400px;
            position: relative;
        }
        
        .news-slide img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        
        .news-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 69, 113, 0.8);
            padding: 15px;
            color: #fdfdfd;
        }
        
        .news-title {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .news-description {
            font-size: 0.9rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
            .news-slide {
                height: 300px;
            }
        }
        
        .clickable-block {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .clickable-block:hover {
            opacity: 0.9;
        }
        
        /* Стили для логотипа */
        .logo-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 0;
        }
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

<!-- Навбар на всю ширину -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                
                <!-- Пункт "О Соборе" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        О Соборе
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown" style="background-color: rgba(0, 69, 113, 0.95);">
                        <a class="dropdown-item" href="clergy.php" style="color: #fdfdfd;">Духовенство</a>
                        <a class="dropdown-item" href="history.php" style="color: #fdfdfd;">История</a>
                        <a class="dropdown-item" href="feodosiy.php" style="color: #fdfdfd;">Прп. Феодосий Кавказский</a>
                        <a class="dropdown-item" href="tour.php" style="color: #fdfdfd;">Виртуальный тур</a>
                    </div>
                </li>
                
                <!-- Пункт "Благочиние" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Благочиние
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blagochiniyaDropdown" style="background-color: rgba(0, 69, 113, 0.95);">
                        <a class="dropdown-item" href="blagochiniya-info.php" style="color: #fdfdfd;">Общие сведения</a>
                        <a class="dropdown-item" href="blagochiniya-temples.php" style="color: #fdfdfd;">Храмы</a>
                        <a class="dropdown-item" href="blagochiniya-clergy.php" style="color: #fdfdfd;">Духовенство</a>
                    </div>
                </li>
                
                <!-- Пункт "Деятельность" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown" style="background-color: rgba(0, 69, 113, 0.95);">
                        <a class="dropdown-item" href="sunday-school.php" style="color: #fdfdfd;">Воскресная школа</a>
                        <a class="dropdown-item" href="youth-center.php" style="color: #fdfdfd;">Молодёжный центр</a>
                        <a class="dropdown-item" href="tea-room.php" style="color: #fdfdfd;">Чайный дворик</a>
                        <a class="dropdown-item" href="social-activity.php" style="color: #fdfdfd;">Социальная деятельность</a>
                    </div>
                </li>

                <!-- Пункт "Таинства" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Таинства
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown" style="background-color: rgba(0, 69, 113, 0.95);">
                        <a class="dropdown-item" href="christening.php" style="color: #fdfdfd;">Крещение</a>
                        <a class="dropdown-item" href="wedding.php" style="color: #fdfdfd;">Венчание</a>
                        <a class="dropdown-item" href="confession.php" style="color: #fdfdfd;">Исповедь</a>
                        <a class="dropdown-item" href="eucharist.php" style="color: #fdfdfd;">Причастие</a>
                        <a class="dropdown-item" href="unction.php" style="color: #fdfdfd;">Соборование</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="allunews.php">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photogallery.php">Галерея</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Контакты</a>
                </li>
                
                <!-- Кнопка "Вход" -->
                <li class="nav-item">
                    <a class="btn btn-outline-primary ml-2" href="signin.php">Вход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Стили для выпадающих меню */
    .dropdown-menu {
        border: 1px solid rgba(253, 253, 253, 0.2);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .dropdown-item {
        transition: all 0.3s ease;
        padding: 8px 20px;
    }
    
    .dropdown-item:hover {
        background-color: rgba(96, 150, 184, 0.5);
    }
    
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }
    
    /* Стили для кнопки Вход */
    .btn-outline-primary {
        border-color: #fdfdfd;
        color: #fdfdfd;
        margin-left: 10px;
    }
    
    .btn-outline-primary:hover {
        background-color: #fdfdfd;
        color: #004571;
    }
    
    /* Адаптация для мобильных устройств */
    @media (max-width: 992px) {
        .dropdown-menu {
            background-color: transparent;
            border: none;
            box-shadow: none;
            margin-left: 15px;
        }
        
        .dropdown-item {
            padding: 8px 15px;
        }
        
        .nav-item.dropdown:hover .dropdown-menu {
            display: none;
        }
        
        .btn-outline-primary {
            margin: 10px 15px;
            width: calc(100% - 30px);
            text-align: center;
        }
    }
</style>

<div class="relative page-wrap">
    <div class="content-wrap relative">
        <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
            <div class="land-see-hero-main mx-auto"></div>
        </section>
        
        <div class="container mt-4">
            <!-- Логотип по центру в пределах container -->
            <div class="logo-container text-center">
                <amp-img src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
            </div>

            <!-- Слайдер новостей -->
            <div class="clearfix">
                <h1 class="text-center mb-4">Последние новости</h1>
                
                <div id="newsSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // Запрос для получения 5 последних новостей
                        $query = "
                            SELECT 
                                `unews`.`id_unews`, 
                                `unews`.`utitle`, 
                                `unews`.`udescription`, 
                                `unews`.`textunews`, 
                                MAX(`uphotonews`.`uphotonews`) AS uphotonews
                            FROM `unews` 
                            LEFT JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews` 
                            GROUP BY `unews`.`id_unews`
                            ORDER BY `unews`.`id_unews` DESC
                            LIMIT 5
                        ";
                        $result = $mysqli->query($query);

                        if ($result && $result->num_rows > 0) {
                            $first = true;
                            while ($row = $result->fetch_assoc()) {
                                $idunews = $row['id_unews'];
                                $img = !empty($row['uphotonews']) ? 'data:image/jpeg;base64,' . base64_encode($row['uphotonews']) : 'img/no_img.jpeg';
                                $active = $first ? 'active' : '';
                                $first = false;

                                echo '
                                <div class="carousel-item '.$active.'">
                                    <a href="unews.php?id=' . htmlspecialchars($idunews) . '" class="news-slide">
                                        <img src="' . $img . '" class="d-block w-100" alt="'.htmlspecialchars($row['utitle']).'">
                                        <div class="news-caption">
                                            <div class="news-title">'.htmlspecialchars($row['utitle']).'</div>
                                            <div class="news-description">'.htmlspecialchars($row['udescription']).'</div>
                                        </div>
                                    </a>
                                </div>
                                ';
                            }
                        } else {
                            echo '<div class="carousel-item active">
                                <div class="news-slide bg-secondary d-flex align-items-center justify-content-center">
                                    <div class="text-center p-4">Нет новостей для отображения</div>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                    
                    <a class="carousel-control-prev" href="#newsSlider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Назад</span>
                    </a>
                    <a class="carousel-control-next" href="#newsSlider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Вперед</span>
                    </a>
                    
                    <ol class="carousel-indicators">
                        <?php
                        if ($result && $result->num_rows > 0) {
                            $result->data_seek(0);
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $active = $i === 0 ? 'active' : '';
                                echo '<li data-target="#newsSlider" data-slide-to="'.$i.'" class="'.$active.'"></li>';
                            }
                        }
                        ?>
                    </ol>
                </div>
                
                <div class="text-center mt-3">
                    <a href="allunews.php" class="btn btn-primary">Все новости</a>
                </div>
            </div>
        </div>

        <!-- Галерея -->
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90 clearfix">
                <div class="clearfix">
                    <div class="col-12 p-2">
                        <div class="module-wrap">
                            <h2 class="text-center">Фотогалерея</h2>
                            
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
                                        echo '<div class="carousel-item active">
                                            <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                                                <p>В галерее пока нет фотографий</p>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                                
                                <a class="carousel-control-prev" href="#gallerySlider" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Назад</span>
                                </a>
                                <a class="carousel-control-next" href="#gallerySlider" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Вперед</span>
                                </a>
                                
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
                            
                            <div class="text-center mt-3">
                                <a href="photogallery.php" class="btn btn-primary">Посмотреть все фото</a>
                            </div>
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

<!-- Подключение Ekko Lightbox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
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
<?php ob_end_flush(); ?>