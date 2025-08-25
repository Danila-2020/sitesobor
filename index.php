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
        
        <div style="width: 100%; height: 800px; overflow: hidden; position: relative; border-radius: 12px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);">
            <iframe 
                src="proxy-news.php"
                style="width: 100%; height: 1200px; border: none;"
                title="Новости Благочиния"></iframe>
        </div>
        
    </div>
    
    <div class="iframe-controls">
        <a href="https://blago-kavkaz.ru/site/articles?catids%5B0%5D=1&title=%D0%9D%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D0%B8&link_id=news" 
           target="_blank" 
           class="iframe-btn">
            Открыть в новом окне
        </a>
        <a href="allunews.php" class="iframe-btn">
            Наши новости
        </a>
                </div>
            </div>
        </div>

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
        <!-- <div class="container mt-4"> -->
            <!-- <div class="rounded border border-grey bg-white alpha-90 clearfix"> -->
                <!-- <div class="clearfix"> -->
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
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
</div>

<div class="social-footer">
    <div class="container">
        <ul class="social-share">
            <li><a href="https://t.me/Pokrov_sob_mrv"><i class="fab fa-telegram"></i></a></li>
            <li><a href="#"><i class="fab fa-vk"></i></a></li>
            <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            <li><a href="#"><i class="fab fa-skype"></i></a></li>
        </ul>
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
    
    // Автоматическая высота iframe
    function adjustIframeHeight() {
        const iframe = document.getElementById('newsIframe');
        if (iframe) {
            iframe.onload = function() {
                try {
                    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                    const contentBlock = iframeDoc.querySelector('.content-block-wrap');
                    if (contentBlock) {
                        iframe.style.height = (contentBlock.scrollHeight + 50) + 'px';
                    }
                } catch (e) {
                    console.log('Не удалось настроить высоту iframe:', e);
                }
            };
        }
    }
    
    // Вызываем функцию после загрузки DOM
    document.addEventListener('DOMContentLoaded', adjustIframeHeight);
    
    // Исправление для мобильного меню - предотвращение закрытия при клике внутри подменю
    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>