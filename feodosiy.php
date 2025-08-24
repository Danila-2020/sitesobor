<?php
// Страница преподобный Феодосий Кавказский

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
    <title>Преподобный Феодосий Кавказский</title>
    <!-- Подключение Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
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
            /* Убрано padding-top для фиксированного навбара */
        }
        
        .saint-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .saint-image {
            border-radius: 8px;
            border: 2px solid rgba(253, 253, 253, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        
        .saint-image:hover {
            transform: scale(1.02);
        }
        
        .miracle-item {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #d4a76a;
        }
        
        .relics-badge {
            background-color: rgba(212, 167, 106, 0.2);
            color: #d4a76a;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            display: inline-block;
            margin-right: 10px;
        }
        
        .prayer-card {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(253, 253, 253, 0.1);
        }
        
        .prayer-icon {
            color: #d4a76a;
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        /* Стили для навбара (без фиксированного положения) */
        .navbar {
            background-color: rgba(0, 69, 113, 0.95) !important;
            border-bottom: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            position: relative; /* Убрано fixed положение */
            top: 0;
            width: 100%;
            z-index: 1000;
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
        
        /* Стили для выпадающих меню */
        .dropdown-menu {
            border: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: rgba(0, 69, 113, 0.95);
        }
        
        .dropdown-item {
            transition: all 0.3s ease;
            padding: 8px 20px;
            color: #fdfdfd !important;
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
            
            .saint-section {
                padding: 20px;
            }
            
            .saint-image {
                margin-bottom: 20px;
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

<!-- Навбар без фиксированного положения -->
<nav class="navbar navbar-expand-lg navbar-dark">
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
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item" href="clergy.php">Духовенство</a>
                        <a class="dropdown-item" href="history.php">История</a>
                        <a class="dropdown-item" href="feodosiy.php">Прп. Феодосий Кавказский</a>
                        <a class="dropdown-item" href="tour.php">Виртуальный тур</a>
                    </div>
                </li>
                
                <!-- Пункт "Благочиние" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Благочиние
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blagochiniyaDropdown">
                        <a class="dropdown-item" href="blagochiniya-info.php">Общие сведения</a>
                        <a class="dropdown-item" href="blagochiniya-temples.php">Храмы</a>
                        <a class="dropdown-item" href="blagochiniya-clergy.php">Духовенство</a>
                    </div>
                </li>
                
                <!-- Пункт "Деятельность" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown">
                        <a class="dropdown-item" href="sunday-school.php">Воскресная школа</a>
                        <a class="dropdown-item" href="youth-center.php">Молодёжный центр</a>
                        <a class="dropdown-item" href="tea-room.php">Чайный дворик</a>
                        <a class="dropdown-item" href="social-activity.php">Социальная деятельность</a>
                    </div>
                </li>

                <!-- Пункт "Таинства" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Таинства
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown">
                        <a class="dropdown-item" href="christening.php">Крещение</a>
                        <a class="dropdown-item" href="wedding.php">Венчание</a>
                        <a class="dropdown-item" href="confession.php">Исповедь</a>
                        <a class="dropdown-item" href="eucharist.php">Причастие</a>
                        <a class="dropdown-item" href="unction.php">Соборование</a>
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

    <!-- Заголовок и основное изображение -->
    <div class="saint-section text-center">
        <h1 class="mb-4">Преподобный Феодосий Кавказский</h1>
        <amp-img src="https://www.stoletie.ru/upload/resize_cache/iblock/3d6/300_300_1/feodosiy.jpg" 
                width="400" 
                height="500" 
                layout="responsive" 
                class="saint-image"
                alt="Преподобный Феодосий Кавказский"></amp-img>
    </div>
    
    <!-- Житие святого -->
    <div class="saint-section">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Житие святого</h2>
                <p>Преподобный Феодосий Кавказский (в миру Фёдор Фёдорович Кашин; 1841-1948) - православный святой, старец, почитаемый в лике преподобных.</p>
                <p>Родился в Пермской губернии в крестьянской семье. С детства проявлял склонность к монашеской жизни. В 17 лет отправился на Афон, где принял постриг с именем Феодосий.</p>
                <p>После многих лет афонского подвижничества вернулся в Россию, служил в разных монастырях. Последние годы жизни провёл на Кавказе, где принимал множество людей, ищущих духовного совета.</p>
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Духовный путь</h2>
                <p>Прославился даром прозорливости и чудотворений. Канонизирован в 1995 году как местночтимый святой Кубанской епархии.</p>
                <p>Преподобный Феодосий особо почитается на Юге России как покровитель Кавказа и молитвенник за страждущих.</p>
                <div class="mt-4">
                    <span class="relics-badge">День памяти: 8 августа</span>
                    <span class="relics-badge">Годы жизни: 1841-1948</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Чудеса и пророчества -->
    <div class="saint-section">
        <h2 class="text-center mb-4">Чудеса и пророчества</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="miracle-item">
                    <h4><i class="fa fa-heart" style="color: #d4a76a;"></i> Исцеления</h4>
                    <p>Многочисленные свидетельства об исцелении больных, в том числе от неизлечимых болезней, по молитвам старца.</p>
                </div>
                <div class="miracle-item">
                    <h4><i class="fa fa-eye" style="color: #d4a76a;"></i> Прозорливость</h4>
                    <p>Дар предвидения будущего, включая предсказание революции 1917 года и гонений на Церковь.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="miracle-item">
                    <h4><i class="fa fa-star" style="color: #d4a76a;"></i> Пророчества</h4>
                    <p>Пророчества о будущем России и судьбах людей, обращавшихся к нему за советом.</p>
                </div>
                <div class="miracle-item">
                    <h4><i class="fa fa-handshake-o" style="color: #d4a76a;"></i> Помощь</h4>
                    <p>Многочисленные случаи помощи в безвыходных ситуациях по молитвам к преподобному.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Почитание и мощи -->
    <div class="saint-section">
        <h2 class="text-center mb-4">Почитание и мощи</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Преподобный Феодосий Кавказский почил 8 августа 1948 года в возрасте 107 лет. Был похоронен в городе Минеральные Воды.</p>
                <p>В 1995 года состоялось обретение его мощей, которые ныне покоятся в Покровском соборе Минеральных Вод.</p>
                <p>Ежегодно 8 августа совершается память святого. К мощам преподобного Феодосия приезжают паломники со всей России и из-за рубежа, получая по его молитвам исцеления и помощь в житейских нуждах.</p>
            </div>
            <div class="col-md-6">
                <amp-img src="https://ruskline.ru/images/icons/%D0%9A%D0%B0%D0%B2%D0%BA%D0%B0%D0%B7%D0%A4%D0%B5%D0%BE%D0%B4%D0%BE%D1%818.jpg" 
                        width="400" 
                        height="500" 
                        layout="responsive" 
                        class="saint-image"
                        alt="Мощи преподобного Феодосия"></amp-img>
            </div>
        </div>
    </div>
    
    <!-- Молитвы и акафист -->
    <div class="saint-section">
        <h2 class="text-center mb-4">Молитвенное почитание</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="prayer-card text-center">
                    <div class="prayer-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <h3>Акафист</h3>
                    <p>Текст акафиста преподобному Феодосию Кавказскому</p>
                    <a href="https://akafist.ru/saints/feodosij-kavkazskij/akafist" class="btn btn-primary">Читать акафист</a>
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
</body>
</html>
<?php ob_end_flush(); ?>