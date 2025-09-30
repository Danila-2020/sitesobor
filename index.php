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
    <!-- Подключение Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        
        /* Стили для iframe контейнера */
        .iframe-news-container {
            padding: 30px 0;
            background: transparent;
        }
        
        .iframe-eternal-container {
            padding: 30px 0;
            background: transparent;
        }
        
        .news-header {
            text-align: center;
            margin-bottom: 30px;
            color: #fdfdfd;
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
            font-size: 28px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .iframe-wrapper {
            width: 100%;
            height: 800px;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            background: white;
        }
        
        .iframe-controls {
            text-align: center;
            margin-top: 20px;
        }
        
        .iframe-btn {
            background: rgba(96, 150, 184, 0.7);
            border: 2px solid #fdfdfd;
            color: #fdfdfd;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0 10px;
            font-weight: bold;
        }
        
        .iframe-btn:hover {
            background: rgba(96, 150, 184, 1);
            transform: translateY(-2px);
            text-decoration: none;
            color: #fdfdfd;
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
            
            .iframe-wrapper {
                height: 600px;
            }
            
            /* Исправления для мобильного меню */
            .dropdown-menu {
                background-color: rgba(0, 69, 113, 0.8) !important;
                border: 1px solid rgba(253, 253, 253, 0.2);
                margin-left: 20px;
                padding: 0.5rem 0;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
            
            .dropdown-item {
                padding: 0.5rem 1.5rem;
                color: #fdfdfd !important;
            }
            
            .dropdown-item:hover {
                background-color: rgba(96, 150, 184, 0.5);
            }
            
            .dropdown-toggle::after {
                float: right;
                margin-top: 0.7rem;
            }
            
            .nav-item.dropdown.show .dropdown-menu {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .iframe-wrapper {
                height: 500px;
            }
            
            .iframe-btn {
                padding: 8px 20px;
                margin: 5px;
                display: block;
                width: 200px;
                margin: 10px auto;
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
        
        /* Стили для слайдера новостей - УМЕНЬШЕНЫ В 2 РАЗА */
        #newsSlider {
            background: rgba(0, 69, 113, 0.3);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .news-slide {
            height: 200px; /* Уменьшено с 400px до 200px */
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
            padding: 10px; /* Уменьшено с 15px до 10px */
            color: #fdfdfd;
        }
        
        .news-title {
            font-size: 1rem; /* Уменьшено с 1.2rem до 1rem */
            margin-bottom: 3px; /* Уменьшено с 5px до 3px */
            line-height: 1.2;
        }
        
        .news-description {
            font-size: 0.8rem; /* Уменьшено с 0.9rem до 0.8rem */
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Уменьшено с 3 до 2 строк */
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.2;
        }
        
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            background: rgba(0, 69, 113, 0.5);
        }
        
        .carousel-indicators li {
            width: 10px; /* Уменьшено с 12px до 10px */
            height: 10px; /* Уменьшено с 12px до 10px */
            border-radius: 50%;
            background-color: rgba(253, 253, 253, 0.5);
        }
        
        .carousel-indicators .active {
            background-color: #6096b8;
        }
        
        @media (max-width: 768px) {
            .news-slide {
                height: 150px; /* Уменьшено с 300px до 150px */
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
        
        /* Стили для десктопной версии подменю */
        @media (min-width: 993px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block;
            }
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
                background-color: rgba(0, 69, 113, 0.8);
                border: 1px solid rgba(253, 253, 253, 0.2);
                margin-left: 20px;
                padding: 0.5rem 0;
            }
            
            .dropdown-item {
                padding: 0.5rem 1.5rem;
            }
            
            .btn-outline-primary {
                margin: 10px 15px;
                width: calc(100% - 30px);
                text-align: center;
            }
            
            /* Убираем hover эффект для мобильных, так как он мешает работе */
            .nav-item.dropdown:hover .dropdown-menu {
                display: none;
            }
            
            /* Показываем меню только когда есть класс show */
            .nav-item.dropdown.show .dropdown-menu {
                display: block;
            }
        }

        /* Социальные иконки внизу */
        .social-footer {
            background-color: rgba(0, 69, 113, 0.8);
            padding: 20px 0;
            margin-top: 40px;
            border-top: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .social-share {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-share li a {
            display: block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: rgba(96, 150, 184, 0.7);
            color: #fdfdfd;
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-share li a:hover {
            background: rgba(96, 150, 184, 1);
            transform: translateY(-3px);
        }
        
        /* Футер */
        .footer {
            background-color: rgba(0, 69, 113, 0.9);
            color: #fdfdfd;
            padding: 30px 0;
            margin-top: auto;
            border-top: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .footer h5 {
            color: #fdfdfd;
            margin-bottom: 20px;
        }
        
        .footer a {
            color: #fdfdfd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer a:hover {
            color: #6096b8;
            text-decoration: none;
        }
        
        /* Уменьшенная фотогалерея - высота 600px */
        .gallery-container {
            height: 600px; /* Фиксированная высота 600px */
            overflow: hidden;
        }
        
        .gallery-slide {
            height: 550px; /* Высота слайдов немного меньше контейнера */
        }
        
        .gallery-slide img {
            object-fit: contain; /* Показываем изображение полностью */
            height: 100%;
            width: 100%;
            background-color: rgba(0, 69, 113, 0.3);
        }
        
        .carousel-indicators {
            bottom: -30px;
        }
        
        .carousel-indicators li {
            width: 10px;
            height: 10px;
        }
        
        @media (max-width: 768px) {
            .gallery-container {
                height: 400px;
            }
            
            .gallery-slide {
                height: 350px;
            }
            
            .carousel-indicators {
                bottom: -25px;
            }
        }
        
        /* Стили для блока "Пару минут о вечном" */
        .eternal-content {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            color: #333;
            max-height: 800px;
            overflow-y: auto;
        }
        
        .eternal-content .bishops-word-wrapper,
        .eternal-content .content-block-wrap {
            background: white !important;
            color: #333 !important;
        }
        
        .eternal-content a {
            color: #004571 !important;
        }
        
        .eternal-content a:hover {
            color: #0066cc !important;
            text-decoration: underline;
        }
        
        .eternal-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .eternal-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #004571;
        }
        
        .eternal-date {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .eternal-content img {
            max-width: 100%;
            height: auto;
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

<?php
// Подключаем навбар
include('template/allnavbar.php');
?>

<div class="relative page-wrap">
    <div class="content-wrap relative">
        <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
            <div class="land-see-hero-main mx-auto"></div>
        </section>
        <!-- Блок с iframe вместо карточек новостей -->
        <div class="iframe-news-container">
            <h2 class="news-header">Новости Благочиния</h2>
            <div class="form-control bordered" style="background-color: rgba(0, 69, 113, 0.9); border-color:  rgba(0, 69, 113, 0.9);">
                <?php
                    include('template/social-icons.php');
                ?>
            </div>
            <div style="width: 100%; height: 800px; overflow: hidden; position: relative; border-radius: 12px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);">
                <iframe 
                    src="proxy-news.php"
                    style="width: 100%; height: 1200px; border: none;"
                    title="Новости Благочиния"></iframe>
            </div>
            
            <div class="iframe-controls">
                <a href="https://blago-kavkaz.ru/site/articles?catids%5B0%5D=1&title=%D0%9D%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D0%B8&link_id=news" 
                   target="_blank" 
                   class="iframe-btn">
                    Сайт епархии
                </a>
                <a href="allunews.php" class="iframe-btn">
                    Наши новости
                </a>
            </div>
        </div>
        <?php
                    include('template/social-icons.php');
                ?>        
        <div class="container">
            <div class="row"><h1>Пару минут о вечном</h1></div>
            <!-- Блок с iframe "Пару минут о вечном" -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4">
                <amp-iframe src="https://rutube.ru/play/embed/a34b4a11eb0b7d17d4d726ca10d2d85a/" height="608" width="360" layout="responsive" sandbox="allow-scripts allow-same-origin" allowfullscreen="" class="i-amphtml-element i-amphtml-layout-responsive i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout" i-amphtml-layout="responsive" frameborder="0" style="--loader-delay-offset: 1ms !important;"><i-amphtml-sizer slot="i-amphtml-svc" style="padding-top: 168.889%;"></i-amphtml-sizer><amp-img src="/files/global/iframe.png" width="400" height="273" layout="fill" placeholder="" class="i-amphtml-element i-amphtml-layout-fill i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout amp-hidden" i-amphtml-layout="fill"><img decoding="async" src="/files/global/iframe.png" class="i-amphtml-fill-content i-amphtml-replaced-content"></amp-img><i-amphtml-scroll-container class="amp-active"><iframe class="i-amphtml-fill-content" name="amp_iframe0" allowfullscreen="" frameborder="0" allow="" sandbox="allow-scripts allow-same-origin" src="https://rutube.ru/play/embed/a34b4a11eb0b7d17d4d726ca10d2d85a/#amp=1" style="z-index: 0;"></iframe></i-amphtml-scroll-container></amp-iframe>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-xl-8 col-lg-8">
                <p>Полезно рассуждать? Очень полезно! Но во всяком рассуждении есть свои правила. 
                    Святитель Николай Сербский пишет об этих правилах. 
                    И мне хотелось бы сегодня вместе с вами над ними поразмышлять. 
                    О трёх вещах, пишет святитель Николай, не берись рассуждать: о Боге, пока не укрепишься в вере, 
                    о чужих грехах, пока не вспомнишь о своих,  и о грядущем дне, пока не увидишь рассвет. 
                    Правила рассуждения всегда кроются в осмыслении своей собственной жизни, осмыслении своей 
                    духовной жизни, но ещё и в осмыслении Промысла Божия. Действительно, рассуждение о Боге может 
                    быть полезно и для тебя самого, и для другого человека, когда твоя душа крепка в вере, когда ты 
                    испытал минуты сомнений, и минуты радости, и благодарности, и имеешь очень твёрдую духовную жизнь,
                    основу. Рассуждать о грехах чужих полезно только тогда, когда вспомнишь о своих. Тогда твое  
                    рассуждение о других грехах будет состраданием с надеждой на исправление. 
                    И уж тем более рассуждать о грядущем дне можно тогда, когда ты видишь рассвет. Не мечтать, 
                    не фантазировать, а видеть вокруг себя творение Божие и благодарить Того, Кто подарил нам жизнь.</p>
            </div>
        </div>
        <script>
        // Функция для автоматической регулировки высоты iframe
        function adjustIframeHeight() {
            const iframes = document.querySelectorAll('iframe');
            iframes.forEach(iframe => {
                iframe.onload = function() {
                    // Даем время на полную загрузку контента
                    setTimeout(() => {
                        try {
                            const contentHeight = iframe.contentWindow.document.body.scrollHeight;
                            iframe.style.height = contentHeight + 'px';
                        } catch (e) {
                            console.log('Не удалось изменить высоту iframe:', e);
                        }
                    }, 1000);
                };
            });
        }

        // Вызываем функцию после загрузки DOM
        document.addEventListener('DOMContentLoaded', adjustIframeHeight);

        // Также вызываем при изменении размера окна
        window.addEventListener('resize', adjustIframeHeight);
        
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
        
        // Исправление для мобильного меню
        $(document).ready(function() {
            // Закрытие меню при клике на пункт меню (для мобильных устройств)
            $('.navbar-nav .nav-link').on('click', function() {
                if ($(window).width() < 992) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
            
            // Закрытие меню при клике на dropdown-item
            $('.dropdown-item').on('click', function() {
                if ($(window).width() < 992) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
            
            // Предотвращение закрытия при клике внутри dropdown-menu
            $('.dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });
            
            // Автоматическое закрытие меню при изменении размера окна
            $(window).on('resize', function() {
                if ($(window).width() >= 992) {
                    $('.navbar-collapse').removeClass('show');
                }
            });
        });
        </script>
        </div>
        <!-- Галерея -->
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90 clearfix">
                <div class="clearfix">
                    <div class="col-12 p-2">
                        <div class="module-wrap">
                            <h2 class="text-center">Фотогалерея</h2>
                            
                            <div id="gallerySlider" class="carousel slide gallery-container" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $galleryDir = 'gallery/';
                                    $images = glob($galleryDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                    
                                    if (!empty($images)) {
                                        foreach ($images as $index => $image) {
                                            $active = $index === 0 ? 'active' : '';
                                            echo '
                                            <div class="carousel-item '.$active.' gallery-slide">
                                                <a href="'.$image.'" data-toggle="lightbox" data-gallery="gallery">
                                                    <img src="'.$image.'" class="d-block w-100 rounded" alt="Слайд '.($index+1).'" loading="lazy">
                                                </a>
                                            </div>';
                                        }
                                    } else {
                                        echo '<div class="carousel-item active gallery-slide">
                                            <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
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

<div class="social-footer">
    <div class="container">
        <?php include('template/social-icons.php'); ?>
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
    
    // Исправление для мобильного меню
    $(document).ready(function() {
        // Закрытие меню при клике на пункт меню (для мобильных устройств)
        $('.navbar-nav .nav-link').on('click', function() {
            if ($(window).width() < 992) {
                $('.navbar-collapse').collapse('hide');
            }
        });
        
        // Закрытие меню при клике на dropdown-item
        $('.dropdown-item').on('click', function() {
            if ($(window).width() < 992) {
                $('.navbar-collapse').collapse('hide');
            }
        });
        
        // Предотвращение закрытия при клике внутри dropdown-menu
        $('.dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
        
        // Автоматическое закрытие меню при изменении размера окна
        $(window).on('resize', function() {
            if ($(window).width() >= 992) {
                $('.navbar-collapse').removeClass('show');
            }
        });
    });
    
    // Вызываем функцию после загрузки DOM
    document.addEventListener('DOMContentLoaded', adjustIframeHeight);
</script>
</body>
</html>
<?php ob_end_flush(); ?>