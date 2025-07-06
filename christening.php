<?php
// Модуль таинства крещения
ob_start();
session_start();
require_once('bd.php');
include('template/christeningheadnew.php');
include('template/scedulehead.php');
include('template/barber.php');
echo getStyles();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таинство Крещения</title>
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
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
            color: #fdfdfd !important;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: rgba(96, 150, 184, 1) !important;
        }
        
        .btn-outline-primary {
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border-bottom: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
        }
        
        .img-fluid {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
        }
        
        .img-fluid:hover {
            transform: scale(1.02);
        }
        
        .media-label {
            background-color: rgba(0, 69, 113, 0.7) !important;
            border-radius: 0 0 8px 8px;
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
        }
        
        .clearfix {
            background: linear-gradient(to right, rgba(0, 69, 113, 0.9), rgba(96, 150, 184, 0.7));
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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

        /* Стили для выпадающих меню */
        .dropdown-menu {
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: rgba(0, 69, 113, 0.95) !important;
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
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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

        /* Стили для списков и групп */
        .list-group-item {
            background-color: rgba(0, 69, 113, 0.5);
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
            color: #fdfdfd;
        }

        .highlight-box {
            background-color: rgba(0, 69, 113, 0.6);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid;
            border-image: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%) 1 !important;
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
                
                <!-- Пункт "Благочиния" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Благочиния
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

<!-- Основное содержимое страницы -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="img-container">
                <img src="img/christening.png" alt="Таинство Крещения" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <h1 class="display-4">Таинство Крещения</h1>
        </div>
    </div>

    <div class="content-section mt-4">
        <p class="lead">Крещение — это одно из важнейших таинств в христианской традиции, символизирующее очищение от грехов и вступление в христианскую общину. Это священное действие имеет глубокое духовное значение и является первым шагом на пути к вере.</p>
    </div>

    <div class="content-section">
        <h2 class="section-title">История Крещения</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Крещение имеет свои корни в Библии, где Иисус Христос сам был крещен Иоанном Крестителем. Это событие стало основой для последующего установления таинства в христианской церкви.</p>
                <div class="highlight-box">
                    <p>"Иисус отвечал: истинно, истинно говорю тебе, если кто не родится от воды и Духа, не может войти в Царствие Божие." (Ин. 3:5)</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-container">
                    <img src="img/christening-001.jpg" alt="Исторические обряды" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2 class="section-title">Символика Крещения</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Во время крещения используются различные символы, такие как:</p>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Вода</strong> — символ очищения и новой жизни.</li>
                    <li class="list-group-item"><strong>Масло</strong> — символ Святого Духа, который приходит к новокрещенному.</li>
                    <li class="list-group-item"><strong>Свечи</strong> — символ света Христова, который освещает путь верующего.</li>
                    <li class="list-group-item"><strong>Белая одежда</strong> — символ чистоты и новой жизни во Христе.</li>
                    <li class="list-group-item"><strong>Крест</strong> — символ принадлежности Христу.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-container">
                    <img src="img/image-001.png" alt="Крещенская свеча" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2 class="section-title">Подготовка к Крещению</h2>
        <div class="row">
            <div class="col-md-6 order-md-2">
                <p>Подготовка к крещению включает в себя:</p>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">Выбор даты и места проведения церемонии.</li>
                    <li class="list-group-item">Согласование с духовным лицом.</li>
                    <li class="list-group-item">Подготовка необходимых документов.</li>
                    <li class="list-group-item">Духовная подготовка и исповедь.</li>
                    <li class="list-group-item">Выбор крестных родителей (для детей).</li>
                    <li class="list-group-item">Приобретение крестильного набора.</li>
                </ol>
            </div>
            <div class="col-md-6 order-md-1">
                <div class="img-container">
                    <img src="img/image-002.jpg" alt="Подготовка к крещению" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2 class="section-title">Процесс Крещения</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Церемония крещения обычно включает в себя следующие этапы:</p>
                <ul class="list-group">
                    <li class="list-group-item">Молитва и благословение священника.</li>
                    <li class="list-group-item">Погружение в воду или обливание водой.</li>
                    <li class="list-group-item">Помазание святым маслом.</li>
                    <li class="list-group-item">Объявление новокрещенного членом христианской общины.</li>
                    <li class="list-group-item">Пострижение волос (символ жертвы Богу).</li>
                    <li class="list-group-item">Облачение в белую одежду.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-container">
                    <img src="img/christening-002.jpg" alt="Процесс крещения" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2 class="section-title">Заключение</h2>
        <div class="highlight-box">
            <p class="lead">Крещение — это не только обряд, но и важный духовный процесс, который открывает новые горизонты веры и общения с Богом. Это начало нового духовного пути для каждого верующего.</p>
        </div>
        <div class="text-center mt-4">
            <a href="contacts.php" class="btn btn-primary btn-lg">Записаться на крещение</a>
        </div>
    </div>
</div>

<?php
include('template/christeningfooter.php');
?>

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>