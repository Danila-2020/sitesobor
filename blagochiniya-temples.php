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
        
        /* Стили для навбара */
        .navbar {
            background-color: rgba(0, 69, 113, 0.95) !important;
            border-bottom: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .nav-link {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background-color: rgba(96, 150, 184, 0.5);
        }

        .nav-item.active .nav-link {
            background-color: rgba(96, 150, 184, 0.7);
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #fdfdfd;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: rgba(0, 69, 113, 0.95);
                padding: 1rem;
                border-radius: 0 0 8px 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .nav-link {
                margin: 0.2rem 0;
                padding: 0.75rem 1rem;
            }
            
            .nav-link:after {
                display: none;
            }
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
        <div class="logo-container text-center">
            <a href="index.php"><amp-img src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img></a>
        </div>
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
                
                <!-- Пункт "Благочиния" с подменю -->
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Благочиния
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blagochiniyaDropdown" style="background-color: rgba(0, 69, 113, 0.95);">
                        <a class="dropdown-item" href="blagochiniya-info.php" style="color: #fdfdfd;">Общие сведения</a>
                        <a class="dropdown-item active" href="blagochiniya-temples.php" style="color: #fdfdfd;">Храмы</a>
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
                    <ul class="social-share">
                        <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                        <li><a href="#"><i class="fa fa-vk"></i></a></li>
                        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
                
                <div class="clearfix">
                    <div class="col-12 p-4">
                        <h1 class="text-center mb-4">Храмы благочиний</h1>
                        
                        <!-- Карта храмов -->
                        <div class="temples-map">
                            <!-- Здесь будет карта с храмами -->
                            <img src="img/temples-map.jpg" alt="Карта храмов благочиний" class="img-fluid rounded">
                        </div>
                        
                        <!-- Фильтр храмов -->
                        <div class="filter-section">
                            <h3 class="filter-title">Фильтр храмов</h3>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="blagochinieFilter">Благочиние</label>
                                    <select class="form-control" id="blagochinieFilter">
                                        <option value="all">Все благочиния</option>
                                        <option value="central">Центральное</option>
                                        <option value="north">Северное</option>
                                        <option value="south">Южное</option>
                                        <option value="east">Восточное</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="typeFilter">Тип храма</label>
                                    <select class="form-control" id="typeFilter">
                                        <option value="all">Все типы</option>
                                        <option value="cathedral">Собор</option>
                                        <option value="church">Церковь</option>
                                        <option value="chapel">Часовня</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="yearFilter">Год постройки</label>
                                    <select class="form-control" id="yearFilter">
                                        <option value="all">Любой год</option>
                                        <option value="19century">До 1900 года</option>
                                        <option value="20century">1901-2000 года</option>
                                        <option value="21century">После 2000 года</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary">Применить фильтры</button>
                                <button class="btn btn-outline-primary ml-2">Сбросить</button>
                            </div>
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