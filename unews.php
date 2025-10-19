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
        
        /* Стили для галереи */
        .gallery-slider {
            position: relative;
            margin: 20px 0;
            background: rgba(0, 69, 113, 0.3);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .gallery-item {
            cursor: pointer;
            transition: all 0.3s ease;
            height: 500px;
        }
        
        .gallery-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        
        .gallery-item:hover {
            opacity: 0.9;
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
            .gallery-item {
                height: 300px;
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
        }
        
        @media (max-width: 576px) {
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
                                    <h1 class="text-center mb-4">' . htmlspecialchars($newsRow['utitle']) . '</h1>
                                    <p class="lead text-center mb-4">
                                        ' . htmlspecialchars($newsRow['udescription']) . '
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
                                        
                                        $photos[] = 'data:' . $mime_type . ';base64,' . $show_img;
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

    // Добавляем индикацию скролла для мобильных устройств
    document.addEventListener('DOMContentLoaded', function() {
        const scrollContainer = document.querySelector('.iframes-scroll-container');
        const scrollIndicator = document.querySelector('.scroll-indicator');
        
        if (scrollContainer && window.innerWidth < 992) {
            let scrollTimeout;
            
            scrollContainer.addEventListener('scroll', function() {
                const scrollLeft = this.scrollLeft;
                const maxScroll = this.scrollWidth - this.clientWidth;
                
                // Показываем/скрываем индикатор в зависимости от позиции скролла
                if (scrollIndicator) {
                    if (scrollLeft > 10 || scrollLeft < maxScroll - 10) {
                        scrollIndicator.style.opacity = '0.7';
                    } else {
                        scrollIndicator.style.opacity = '1';
                    }
                }
                
                // Сбрасываем таймер при скролле
                clearTimeout(scrollTimeout);
                
                // Скрываем индикатор через 2 секунды после остановки скролла
                scrollTimeout = setTimeout(function() {
                    if (scrollIndicator) {
                        scrollIndicator.style.opacity = '0.3';
                    }
                }, 2000);
            });
            
            // Инициализация прозрачности индикатора
            if (scrollIndicator) {
                scrollIndicator.style.transition = 'opacity 0.3s ease';
                scrollIndicator.style.opacity = '1';
            }
        }
    });

    // Автоматическое обновление высоты iframe для лучшего отображения
    function resizeIframes() {
        const iframes = document.querySelectorAll('.embed-responsive iframe');
        iframes.forEach(iframe => {
            iframe.style.height = '100%';
            iframe.style.width = '100%';
        });
    }

    // Вызываем функцию при загрузке и изменении размера окна
    window.addEventListener('load', resizeIframes);
    window.addEventListener('resize', resizeIframes);
</script>
</body>
</html>
<?php 
$mysqli->close();
ob_end_flush(); 
?>