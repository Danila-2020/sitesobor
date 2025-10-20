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
    <!-- Подключение Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css">
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
            padding-top: 56px;
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
        
        /* Исправления для навигации */
        .navbar-toggler {
            border-color: #fdfdfd !important;
            background-color: rgba(96, 150, 184, 0.7) !important;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28253, 253, 253, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }
        
        .navbar-collapse {
            background-color: rgba(0, 69, 113, 0.95) !important;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        
        .navbar-nav .nav-link {
            color: #fdfdfd !important;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(253, 253, 253, 0.1);
        }
        
        .navbar-nav .nav-link:hover {
            background-color: rgba(96, 150, 184, 0.3);
            border-radius: 3px;
        }
        
        .navbar-nav .nav-link:last-child {
            border-bottom: none;
        }
        
        /* Стили для одиночного изображения */
        .single-image-container {
            width: 100%;
            max-width: 800px;
            height: 500px;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 69, 113, 0.3);
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .single-image-container:hover {
            transform: scale(1.02);
        }
        
        .single-image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            max-height: 100%;
        }
        
        /* Стили для Swiper слайдера */
        .swiper-container {
            width: 100%;
            height: 500px;
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 69, 113, 0.3);
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .swiper-slide:hover {
            transform: scale(1.02);
        }
        
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            max-height: 100%;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: #fdfdfd;
            background: rgba(0, 69, 113, 0.7);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: all 0.3s ease;
            z-index: 10010 !important;
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(0, 69, 113, 0.9);
            transform: scale(1.1);
        }
        
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #fdfdfd;
            opacity: 0.5;
            transition: all 0.3s ease;
        }
        
        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #6096b8;
            transform: scale(1.2);
        }
        
        .swiper-pagination {
            bottom: 10px !important;
            z-index: 10010 !important;
        }
        
        /* Стили для полноэкранного просмотра */
        .fullscreen-swiper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            display: none;
        }
        
        .fullscreen-swiper .swiper-container {
            height: 100%;
            margin: 0;
            border-radius: 0;
        }
        
        .fullscreen-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .fullscreen-swiper .swiper-slide img {
            object-fit: contain;
            max-width: 90%;
            max-height: 90%;
            transition: transform 0.3s ease;
            cursor: grab;
        }
        
        .fullscreen-swiper .swiper-slide img:active {
            cursor: grabbing;
        }
        
        .fullscreen-swiper .swiper-slide.swiper-slide-active img.zoomed {
            cursor: grab;
        }
        
        .fullscreen-swiper .swiper-slide.swiper-slide-active img.zoomed:active {
            cursor: grabbing;
        }
        
        .close-fullscreen {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fdfdfd;
            background: rgba(0, 69, 113, 0.8);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 24px;
            z-index: 10010;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .close-fullscreen:hover {
            background: rgba(0, 69, 113, 1);
            transform: scale(1.1);
        }
        
        .zoom-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10010;
            display: flex;
            gap: 10px;
        }
        
        .zoom-btn {
            color: #fdfdfd;
            background: rgba(0, 69, 113, 0.8);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .zoom-btn:hover {
            background: rgba(0, 69, 113, 1);
            transform: scale(1.1);
        }
        
        .image-counter {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #fdfdfd;
            background: rgba(0, 69, 113, 0.8);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            z-index: 10010;
        }
        
        .news-content {
            line-height: 1.6;
            font-size: 1.1rem;
            padding: 20px 0;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.8);
            border-color: #dc3545;
        }
        
        /* Стили для iframe контейнера с горизонтальным скроллом */
        .iframes-container {
            background-color: rgba(0, 69, 113, 0.8);
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
            width: 100%;
            max-width: 100%;
        }

        /* Контейнер для горизонтального скролла */
        .iframes-scroll-container {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: rgba(253, 253, 253, 0.3) rgba(0, 69, 113, 0.3);
            padding-bottom: 15px;
        }

        /* Стили для скроллбара в Webkit браузерах */
        .iframes-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        .iframes-scroll-container::-webkit-scrollbar-track {
            background: rgba(0, 69, 113, 0.3);
            border-radius: 4px;
        }

        .iframes-scroll-container::-webkit-scrollbar-thumb {
            background: rgba(253, 253, 253, 0.3);
            border-radius: 4px;
        }

        .iframes-scroll-container::-webkit-scrollbar-thumb:hover {
            background: rgba(253, 253, 253, 0.5);
        }

        /* Внутренний контейнер для flex элементов */
        .iframes-inner-container {
            display: inline-flex;
            gap: 20px;
            min-width: min-content;
            padding: 10px 5px;
        }

        /* Элементы iframe для горизонтального скролла */
        .iframe-scroll-item {
            min-width: 320px;
            flex-shrink: 0;
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
        }

        .iframe-scroll-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .iframe-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .iframe-scroll-item h4 {
            color: #fdfdfd;
            margin-bottom: 10px;
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
            font-size: 1.1rem;
            min-height: 3rem;
            display: flex;
            align-items: center;
        }

        .embed-responsive {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid rgba(253, 253, 253, 0.2);
            background: white;
            flex-grow: 1;
            min-height: 200px;
            width: 100%;
        }

        .embed-responsive iframe {
            background: white !important;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .iframe-description {
            color: #fdfdfd;
            font-style: italic;
            margin-bottom: 12px;
            font-size: 0.9rem;
            line-height: 1.4;
            min-height: 2.5rem;
        }
        
        /* Индикатор скролла */
        .scroll-indicator {
            color: rgba(253, 253, 253, 0.7);
            font-size: 0.85rem;
            text-align: center;
            margin-top: 10px;
        }
        
        .scroll-indicator i {
            margin-right: 5px;
        }
        
        /* Стили для социальных иконок */
        .social-share {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .social-share li {
            display: inline-block;
            margin: 0 10px;
        }
        
        .social-share li a i {
            color: #fdfdfd;
            font-size: 24px;
            transition: all 0.3s ease;
        }
        
        .social-share li a i:hover {
            transform: scale(1.2);
        }
        
        /* Полная ширина для основного контента */
        .full-width-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }
        
        .news-main-content {
            width: 100%;
            max-width: 100%;
        }
        
        /* Адаптивность для мобильных устройств */
        @media (max-width: 768px) {
            .swiper-container,
            .single-image-container {
                height: 300px;
            }
            
            .swiper-button-next,
            .swiper-button-prev {
                width: 40px;
                height: 40px;
            }
            
            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 16px;
            }
            
            .iframes-container {
                padding: 15px;
                margin-top: 20px;
                margin-left: -15px;
                margin-right: -15px;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }
            
            .iframe-scroll-item {
                min-width: 280px;
                padding: 12px;
            }
            
            .iframes-inner-container {
                gap: 15px;
            }
            
            .embed-responsive {
                min-height: 180px;
            }
            
            .container {
                padding-left: 0;
                padding-right: 0;
            }
            
            /* Исправления для навигации на мобильных */
            .navbar-collapse {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                z-index: 1000;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
        }
        
        @media (max-width: 576px) {
            .swiper-container,
            .single-image-container {
                height: 250px;
            }
            
            .iframe-scroll-item {
                min-width: 260px;
                padding: 10px;
            }
            
            .iframes-inner-container {
                gap: 12px;
            }
            
            .embed-responsive {
                min-height: 160px;
            }
            
            .iframe-scroll-item h4 {
                font-size: 1rem;
                min-height: 2.5rem;
            }
            
            .iframes-container {
                padding: 10px;
            }
        }
        
        /* На десктопе убираем горизонтальный скролл и показываем в колонку */
        @media (min-width: 992px) {
            .iframes-scroll-container {
                overflow-x: visible;
            }
            
            .iframes-inner-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
                gap: 20px;
                width: 100%;
            }
            
            .iframe-scroll-item {
                min-width: auto;
                width: 100%;
            }
            
            .scroll-indicator {
                display: none !important;
            }
        }
        
        /* Для очень широких экранов */
        @media (min-width: 1200px) {
            .iframes-inner-container {
                grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            }
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

<!-- Подключение навигации из шаблона -->
<?php include('template/allnavbar.php'); ?>

<div class="relative page-wrap full-width-container">
    <div class="content-wrap relative full-width-container">
        <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
            <div class="land-see-hero-main mx-auto"></div>
        </section>
        
        <div class="container mt-4 full-width-container">
            <div class="rounded bg-white alpha-90-dep clearfix full-width-container">
                <div class="container">
                    <div class="clearfix p1 text-center">
                    <amp-img class="mx-auto" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                    </div>
                </div>
                
                <div class="social text-center mb-4">
                    <div class="container">
                        <?php include('template/social-icons.php'); ?>
                    </div>
                </div>
                
                <div class="clearfix news-main-content">
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
                        $newsResult = $mysqli->query($newsQuery);

                        if ($newsResult && $newsResult->num_rows > 0) {
                            $newsRow = $newsResult->fetch_assoc();

                            // Вывод заголовка и описания в самом верху
                            echo('
                                <div class="col col-12">
                                    <h class="text-center mb-4">' . htmlspecialchars($newsRow['utitle']) . '</h1>
                                    <p class="lead text-center mb-4" style="font-family: Arial;">
                                        ' . htmlspecialchars($newsRow['udescription']) . '
                                    </p>
                                </div>
                            ');
                            
                            // Получаем фотографии с использованием указанного SQL запроса
                            $photosQuery = "SELECT `uphotonews`.`id_uphotonews`, `uphotonews`.`uphotonews`, `uphotonews`.`id_unews` 
                                          FROM `uphotonews` 
                                          INNER JOIN `unews` ON `uphotonews`.`id_unews` = `unews`.`id_unews`
                                          WHERE `uphotonews`.`id_unews` = $idunews
                                          ORDER BY `uphotonews`.`id_uphotonews` ASC";
                            $photosResult = $mysqli->query($photosQuery);
                            
                            $photos = array();
                            if ($photosResult && $photosResult->num_rows > 0) {
                                while ($photoRow = $photosResult->fetch_assoc()) {
                                    if (!empty($photoRow['uphotonews'])) {
                                        // Получаем бинарные данные изображения
                                        $imageData = $photoRow['uphotonews'];
                                        
                                        // Проверяем, является ли данные уже base64
                                        if (base64_encode(base64_decode($imageData, true)) === $imageData) {
                                            // Данные уже в base64
                                            $show_img = $imageData;
                                        } else {
                                            // Кодируем изображение в base64
                                            $show_img = base64_encode($imageData);
                                        }
                                        
                                        // Определяем тип изображения
                                        $finfo = new finfo(FILEINFO_MIME_TYPE);
                                        $mime_type = $finfo->buffer(base64_decode($show_img));
                                        
                                        $photos[] = [
                                            'id' => $photoRow['id_uphotonews'],
                                            'src' => 'data:' . $mime_type . ';base64,' . $show_img,
                                            'title' => htmlspecialchars($newsRow['utitle'])
                                        ];
                                    }
                                }
                            }

                            // Вывод изображений после заголовка и описания
                            if (!empty($photos)) {
                                // Если фото одно - показываем одиночное изображение
                                if (count($photos) === 1) {
                                    echo('
                                    <div class="single-image-container" onclick="openFullscreen(0)">
                                        <img src="' . $photos[0]['src'] . '" alt="' . $photos[0]['title'] . '" 
                                             data-src="' . $photos[0]['src'] . '" data-title="' . $photos[0]['title'] . '">
                                    </div>
                                    ');
                                } else {
                                    // Если фото несколько - показываем слайдер
                                    echo('
                                    <div class="news-gallery-container">
                                        <div class="swiper-container news-swiper">
                                            <div class="swiper-wrapper">
                                    ');
                                    
                                    foreach ($photos as $index => $photo) {
                                        echo('
                                            <div class="swiper-slide" data-index="' . $index . '">
                                                <img src="' . $photo['src'] . '" alt="' . $photo['title'] . ' - Фото ' . ($index + 1) . '" 
                                                     data-src="' . $photo['src'] . '" data-title="' . $photo['title'] . '">
                                            </div>
                                        ');
                                    }
                                    
                                    echo('
                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                    ');
                                }
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
                                    <div class="news-content" style="font-family: Arial;">
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
                        
                        <!-- Отображение iframe для этой страницы с горизонтальным скроллом -->
                        <?php
                        // Подключаем функцию отображения iframe
                        require_once 'display_iframes.php';
                        
                        // Отображаем iframe для этой страницы с учетом ID новости
                        // Передаем существующее подключение к БД как третий параметр
                        displayIframes('unews.php', $idunews, $mysqli);
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

<!-- Полноэкранный слайдер -->
<div class="fullscreen-swiper" id="fullscreenSwiper">
    <button class="close-fullscreen" onclick="closeFullscreen()">×</button>
    <div class="image-counter" id="imageCounter">1 / <?php echo count($photos); ?></div>
    <div class="zoom-controls">
        <button class="zoom-btn" onclick="zoomOut()">-</button>
        <button class="zoom-btn" onclick="resetZoom()">⟲</button>
        <button class="zoom-btn" onclick="zoomIn()">+</button>
    </div>
    <div class="swiper-container fullscreen-swiper-container">
        <div class="swiper-wrapper">
            <?php
            if (!empty($photos)) {
                foreach ($photos as $index => $photo) {
                    echo('
                    <div class="swiper-slide">
                        <img src="' . $photo['src'] . '" alt="' . $photo['title'] . ' - Фото ' . ($index + 1) . '" 
                             data-index="' . $index . '">
                    </div>
                    ');
                }
            }
            ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
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
<!-- Подключение Swiper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>

<script>
    // Исправление для бургер-меню Bootstrap
    $(document).ready(function() {
        // Закрытие меню при клике на ссылку
        $('.navbar-nav .nav-link').on('click', function() {
            $('.navbar-collapse').collapse('hide');
        });
        
        // Закрытие меню при клике вне его области
        $(document).on('click', function(event) {
            var $target = $(event.target);
            if (!$target.closest('.navbar').length && 
                $('.navbar-collapse').hasClass('show')) {
                $('.navbar-collapse').collapse('hide');
            }
        });
        
        // Предотвращаем закрытие при клике внутри меню
        $('.navbar-collapse').on('click', function(event) {
            event.stopPropagation();
        });
    });

    // Инициализация основного Swiper слайдера (только если есть несколько фото)
    <?php if (!empty($photos) && count($photos) > 1): ?>
    var newsSwiper = new Swiper('.news-swiper', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        keyboard: {
            enabled: true,
        },
        // Убрана автопрокрутка
        effect: 'slide',
        speed: 600,
        preloadImages: false,
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 15
            },
            1024: {
                slidesPerView: 1,
                spaceBetween: 20
            }
        }
    });
    <?php endif; ?>

    // Инициализация полноэкранного Swiper
    var fullscreenSwiper;
    var currentZoom = 1;
    var isZoomed = false;
    var currentTranslateX = 0;
    var currentTranslateY = 0;
    var isDragging = false;
    var startX, startY;

    function initFullscreenSwiper(initialSlide = 0) {
        fullscreenSwiper = new Swiper('.fullscreen-swiper-container', {
            initialSlide: initialSlide,
            loop: false,
            pagination: {
                el: '.fullscreen-swiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.fullscreen-swiper .swiper-button-next',
                prevEl: '.fullscreen-swiper .swiper-button-prev',
            },
            keyboard: {
                enabled: true,
            },
            on: {
                slideChange: function() {
                    updateImageCounter();
                    resetZoom();
                }
            }
        });

        // Добавляем обработчики для жестов масштабирования
        const container = document.querySelector('.fullscreen-swiper-container');
        container.addEventListener('wheel', handleWheelZoom, { passive: false });
        
        // Добавляем обработчики для перетаскивания увеличенного изображения
        document.addEventListener('mousedown', startDrag);
        document.addEventListener('touchstart', startDragTouch);
        document.addEventListener('mouseup', stopDrag);
        document.addEventListener('touchend', stopDrag);
    }

    // Обработка колесика мыши для зума
    function handleWheelZoom(e) {
        if (!isZoomed) return;
        
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        currentZoom = Math.max(0.5, Math.min(3, currentZoom + delta));
        applyZoom();
    }

    // Функции для управления масштабированием
    function zoomIn() {
        currentZoom = Math.min(currentZoom + 0.2, 3);
        applyZoom();
        isZoomed = currentZoom > 1;
    }

    function zoomOut() {
        currentZoom = Math.max(currentZoom - 0.2, 0.5);
        applyZoom();
        isZoomed = currentZoom > 1;
    }

    function resetZoom() {
        currentZoom = 1;
        currentTranslateX = 0;
        currentTranslateY = 0;
        applyZoom();
        isZoomed = false;
    }

    function applyZoom() {
        const activeSlide = fullscreenSwiper.slides[fullscreenSwiper.activeIndex];
        const img = activeSlide.querySelector('img');
        if (img) {
            img.style.transform = `scale(${currentZoom}) translate(${currentTranslateX}px, ${currentTranslateY}px)`;
            img.style.transition = 'transform 0.2s ease';
            
            if (currentZoom > 1) {
                img.classList.add('zoomed');
            } else {
                img.classList.remove('zoomed');
            }
        }
    }

    // Функции для перетаскивания увеличенного изображения
    function startDrag(e) {
        if (!isZoomed || e.target.tagName !== 'IMG') return;
        
        isDragging = true;
        startX = e.clientX - currentTranslateX;
        startY = e.clientY - currentTranslateY;
        e.target.style.cursor = 'grabbing';
        
        document.addEventListener('mousemove', drag);
    }

    function startDragTouch(e) {
        if (!isZoomed || e.target.tagName !== 'IMG') return;
        
        isDragging = true;
        startX = e.touches[0].clientX - currentTranslateX;
        startY = e.touches[0].clientY - currentTranslateY;
        
        document.addEventListener('touchmove', dragTouch);
    }

    function drag(e) {
        if (!isDragging) return;
        
        currentTranslateX = e.clientX - startX;
        currentTranslateY = e.clientY - startY;
        
        // Ограничиваем перемещение в зависимости от масштаба
        const maxMove = 200 * (currentZoom - 1);
        currentTranslateX = Math.max(-maxMove, Math.min(maxMove, currentTranslateX));
        currentTranslateY = Math.max(-maxMove, Math.min(maxMove, currentTranslateY));
        
        applyZoom();
    }

    function dragTouch(e) {
        if (!isDragging) return;
        
        currentTranslateX = e.touches[0].clientX - startX;
        currentTranslateY = e.touches[0].clientY - startY;
        
        // Ограничиваем перемещение в зависимости от масштаба
        const maxMove = 200 * (currentZoom - 1);
        currentTranslateX = Math.max(-maxMove, Math.min(maxMove, currentTranslateX));
        currentTranslateY = Math.max(-maxMove, Math.min(maxMove, currentTranslateY));
        
        applyZoom();
    }

    function stopDrag() {
        isDragging = false;
        const activeSlide = fullscreenSwiper.slides[fullscreenSwiper.activeIndex];
        const img = activeSlide.querySelector('img');
        if (img) {
            img.style.cursor = isZoomed ? 'grab' : 'default';
        }
        
        document.removeEventListener('mousemove', drag);
        document.removeEventListener('touchmove', dragTouch);
    }

    // Функции для открытия/закрытия полноэкранного режима
    function openFullscreen(index) {
        document.getElementById('fullscreenSwiper').style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Инициализируем Swiper с указанным слайдом
        if (typeof fullscreenSwiper !== 'undefined') {
            fullscreenSwiper.destroy(true, true);
        }
        
        initFullscreenSwiper(index);
        updateImageCounter();
    }

    function closeFullscreen() {
        document.getElementById('fullscreenSwiper').style.display = 'none';
        document.body.style.overflow = 'auto';
        resetZoom();
    }

    function updateImageCounter() {
        const current = fullscreenSwiper.activeIndex + 1;
        const total = fullscreenSwiper.slides.length;
        document.getElementById('imageCounter').textContent = current + ' / ' + total;
    }

    // Закрытие по ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('fullscreenSwiper').style.display === 'block') {
            closeFullscreen();
        }
    });

    // Закрытие по клику на фон (но не на изображение)
    document.getElementById('fullscreenSwiper').addEventListener('click', function(e) {
        if (e.target === this || e.target.classList.contains('swiper-container')) {
            closeFullscreen();
        }
    });

    // Открытие полноэкранного режима при клике на изображение
    document.addEventListener('DOMContentLoaded', function() {
        // Для одиночного изображения
        const singleImage = document.querySelector('.single-image-container');
        if (singleImage) {
            singleImage.addEventListener('click', function() {
                openFullscreen(0);
            });
        }
        
        // Для слайдов в слайдере
        const slides = document.querySelectorAll('.swiper-slide');
        slides.forEach((slide, index) => {
            slide.addEventListener('click', function() {
                openFullscreen(index);
            });
        });
    });
</script>
</body>
</html>

<?php
ob_end_flush();
?>