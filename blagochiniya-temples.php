<?php
// Страница храмов благочиний

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
    <title>Храмы благочиний</title>
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
        
        /* Стили для храмов */
        .temple-card {
            background-color: rgba(0, 69, 113, 0.6);
            border: 1px solid rgba(253, 253, 253, 0.2);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .temple-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }
        
        .temple-image {
            height: 250px;
            overflow: hidden;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        
        .temple-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .temple-card:hover .temple-image img {
            transform: scale(1.05);
        }
        
        .temple-title {
            color: #fdfdfd;
            border-bottom: 1px solid rgba(253, 253, 253, 0.3);
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .temple-meta {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .temple-meta i {
            margin-right: 5px;
            width: 20px;
            text-align: center;
        }
        
        /* Стили для фильтра */
        .filter-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .filter-title {
            margin-bottom: 20px;
            text-align: center;
        }
        
        /* Стили для карты */
        .temples-map {
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        /* Стили для iframe контейнера - АНАЛОГИЧНО blagochiniya-clergy.php */
        .iframes-container {
            background-color: rgba(0, 69, 113, 0.8);
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }

        .iframe-item {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }

        .iframe-item h4 {
            color: #fdfdfd;
            margin-bottom: 10px;
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
            border-bottom: 1px solid rgba(253, 253, 253, 0.3);
            padding-bottom: 8px;
        }

        .embed-responsive {
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid rgba(253, 253, 253, 0.2);
            background: #ffffff; /* Белый фон для контейнера iframe */
        }

        .embed-responsive iframe {
            background: transparent; /* Прозрачный фон для самого iframe */
        }
        
        .iframe-description {
            color: #fdfdfd;
            font-style: italic;
            margin-bottom: 10px;
            background: rgba(0, 69, 113, 0.4);
            padding: 8px 12px;
            border-radius: 4px;
            border-left: 3px solid rgba(96, 150, 184, 0.7);
        }
        
        /* Стили для пустого состояния фреймов */
        .no-iframes {
            text-align: center;
            padding: 40px 20px;
            color: #fdfdfd;
            background: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            border: 1px dashed rgba(253, 253, 253, 0.3);
        }
        
        .no-iframes i {
            font-size: 48px;
            margin-bottom: 15px;
            color: rgba(253, 253, 253, 0.5);
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
        
        @media (max-width: 768px) {
            .temple-image {
                height: 200px;
            }
            
            .temples-map {
                height: 300px;
            }
            
            .iframes-container {
                padding: 15px;
            }
            
            .iframe-item {
                padding: 12px;
            }
            
            .iframe-item h4 {
                font-size: 1.1rem;
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

<?php
// Подключаем навбар
include('template/allnavbar.php');
?>

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
                        <h1 class="text-center mb-4">Храмы благочиний</h1>
                        
                        <!-- Карта храмов -->
                        <div class="temples-map">
                            <!-- Здесь будет карта с храмами -->
                            <img src="img/temples-map.jpg" alt="Карта храмов благочиний" class="img-fluid rounded">
                        </div>                        
                        <!-- Список храмов -->
                        <div class="row">
                            <!-- Храм 1 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="temple-card">
                                    <div class="temple-image">
                                        <a href="img/temples/temple1.jpg" data-toggle="lightbox" data-gallery="temples-gallery">
                                            <img src="img/temples/temple1.jpg" alt="Собор Рождества Пресвятой Богородицы">
                                        </a>
                                    </div>
                                    <h3 class="temple-title">Собор Рождества Пресвятой Богородицы</h3>
                                    <div class="temple-meta">
                                        <div><i class="fa fa-map-marker"></i> Центральное благочиние</div>
                                        <div><i class="fa fa-calendar"></i> 1895 год</div>
                                        <div><i class="fa fa-home"></i> Собор</div>
                                    </div>
                                    <p>Главный собор епархии, построенный в византийском стиле. Вмещает до 1000 прихожан.</p>
                                    <a href="temple-detail.php?id=1" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Храм 2 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="temple-card">
                                    <div class="temple-image">
                                        <a href="img/temples/temple2.jpg" data-toggle="lightbox" data-gallery="temples-gallery">
                                            <img src="img/temples/temple2.jpg" alt="Храм Святого Николая Чудотворца">
                                        </a>
                                    </div>
                                    <h3 class="temple-title">Храм Святого Николая Чудотворца</h3>
                                    <div class="temple-meta">
                                        <div><i class="fa fa-map-marker"></i> Северное благочиние</div>
                                        <div><i class="fa fa-calendar"></i> 1912 год</div>
                                        <div><i class="fa fa-home"></i> Церковь</div>
                                    </div>
                                    <p>Красивый храм в русском стиле с богатой историей. Известен своим хором.</p>
                                    <a href="temple-detail.php?id=2" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Храм 3 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="temple-card">
                                    <div class="temple-image">
                                        <a href="img/temples/temple3.jpg" data-toggle="lightbox" data-gallery="temples-gallery">
                                            <img src="img/temples/temple3.jpg" alt="Часовня Святого Пантелеймона">
                                        </a>
                                    </div>
                                    <h3 class="temple-title">Часовня Святого Пантелеймона</h3>
                                    <div class="temple-meta">
                                        <div><i class="fa fa-map-marker"></i> Южное благочиние</div>
                                        <div><i class="fa fa-calendar"></i> 2005 год</div>
                                        <div><i class="fa fa-home"></i> Часовня</div>
                                    </div>
                                    <p>Небольшая уютная часовня при больнице. Освящена в честь целителя Пантелеймона.</p>
                                    <a href="temple-detail.php?id=3" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Храм 4 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="temple-card">
                                    <div class="temple-image">
                                        <a href="img/temples/temple4.jpg" data-toggle="lightbox" data-gallery="temples-gallery">
                                            <img src="img/temples/temple4.jpg" alt="Храм Успения Пресвятой Богородицы">
                                        </a>
                                    </div>
                                    <h3 class="temple-title">Храм Успения Пресвятой Богородицы</h3>
                                    <div class="temple-meta">
                                        <div><i class="fa fa-map-marker"></i> Восточное благочиние</div>
                                        <div><i class="fa fa-calendar"></i> 1853 год</div>
                                        <div><i class="fa fa-home"></i> Церковь</div>
                                    </div>
                                    <p>Один из старейших храмов региона с уникальными фресками и иконостасом.</p>
                                    <a href="temple-detail.php?id=4" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Храм 5 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="temple-card">
                                    <div class="temple-image">
                                        <a href="img/temples/temple5.jpg" data-toggle="lightbox" data-gallery="temples-gallery">
                                            <img src="img/temples/temple5.jpg" alt="Храм Преображения Господня">
                                        </a>
                                    </div>
                                    <h3 class="temple-title">Храм Преображения Господня</h3>
                                    <div class="temple-meta">
                                        <div><i class="fa fa-map-marker"></i> Центральное благочиние</div>
                                        <div><i class="fa fa-calendar"></i> 2010 год</div>
                                        <div><i class="fa fa-home"></i> Церковь</div>
                                    </div>
                                    <p>Современный храм с традиционной архитектурой. Известен своей социальной работой.</p>
                                    <a href="temple-detail.php?id=5" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Храм 6 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="temple-card">
                                    <div class="temple-image">
                                        <a href="img/temples/temple6.jpg" data-toggle="lightbox" data-gallery="temples-gallery">
                                            <img src="img/temples/temple6.jpg" alt="Часовня Святой Варвары">
                                        </a>
                                    </div>
                                    <h3 class="temple-title">Часовня Святой Варвары</h3>
                                    <div class="temple-meta">
                                        <div><i class="fa fa-map-marker"></i> Северное благочиние</div>
                                        <div><i class="fa fa-calendar"></i> 1998 год</div>
                                        <div><i class="fa fa-home"></i> Часовня</div>
                                    </div>
                                    <p>Небольшая часовня на территории кладбища. Освящена в честь великомученицы Варвары.</p>
                                    <a href="temple-detail.php?id=6" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Пагинация -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Назад</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Вперед</a>
                                </li>
                            </ul>
                        </nav>

                        <!-- Отображение iframe для этой страницы -->
                        <?php
                        // Подключаем функцию отображения iframe
                        require_once 'display_iframes.php';
                        
                        // ИСПРАВЛЕНО: Правильный порядок параметров
                        displayIframes('blagochiniya-temples.php', null, $mysqli);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('template/footer2.php');
?>
<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<!-- Подключение Ekko Lightbox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    // Активация Lightbox для галереи храмов
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
<?php ob_end_flush(); ?>