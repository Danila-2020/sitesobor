<?php
// Страница истории Покровского собора Минеральных Вод

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
    <title>История Покровского собора - Минеральные Воды</title>
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
        }
        
        .history-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .history-image {
            border-radius: 8px;
            border: 2px solid rgba(253, 253, 253, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        
        .history-image:hover {
            transform: scale(1.02);
        }
        
        .timeline-item {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #d4a76a;
            position: relative;
        }
        
        .timeline-year {
            background-color: rgba(212, 167, 106, 0.2);
            color: #d4a76a;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 1.1rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .architectural-feature {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .feature-icon {
            color: #d4a76a;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        /* Стили для навбара (без фиксированного положения) */
        .navbar {
            background-color: rgba(0, 69, 113, 0.95) !important;
            border-bottom: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            position: relative;
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
            .navbar-collapse {
                background-color: rgba(0, 69, 113, 0.95);
                padding: 1rem;
                border-radius: 0 0 8px 8px;
            }
            
            .nav-link {
                margin: 0.2rem 0;
            }
            
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
            
            .history-section {
                padding: 20px;
            }
        }
        
        /* Дополнительные стили для истории */
        .quote-block {
            background-color: rgba(212, 167, 106, 0.1);
            border-left: 4px solid #d4a76a;
            padding: 20px;
            margin: 25px 0;
            font-style: italic;
            border-radius: 0 8px 8px 0;
        }
        
        .historical-fact {
            background-color: rgba(96, 150, 184, 0.3);
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border: 1px solid rgba(253, 253, 253, 0.1);
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

<div class="container mt-4">
    <!-- Заголовок и основное изображение -->
    <div class="history-section text-center">
        <h1 class="mb-4">История Покровского собора</h1>
        <h2 class="mb-4">Минеральные Воды</h2>
        <amp-img src="https://sobory.ru/pic/00400/00490_20070519_212348.jpg" 
                width="800" 
                height="500" 
                layout="responsive" 
                class="history-image"
                alt="Покровский собор Минеральные Воды"></amp-img>
    </div>
    
    <!-- Основная историческая информация -->
    <div class="history-section">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Основание собора</h2>
                <p>Покровский собор в Минеральных Водах - один из старейших и наиболее почитаемых храмов Ставропольского края. Его история начинается в конце XIX века, когда возникла необходимость в строительстве православного храма для быстро растущего населения курортного региона.</p>
                <p>Инициатива строительства принадлежала местным жителям и духовенству, которые понимали важность создания духовного центра для развивающегося города.</p>
                
                <div class="historical-fact">
                    <h4><i class="fa fa-info-circle"></i> Интересный факт</h4>
                    <p>Первоначально храм планировалось посвятить святителю Николаю Чудотворцу, но впоследствии было решено освятить его в честь Покрова Пресвятой Богородицы.</p>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Архитектурные особенности</h2>
                <p>Собор построен в русско-византийском стиле, характерном для церковной архитектуры конца XIX века. Храм представляет собой крестово-купольное сооружение с пятью главами, символизирующими Христа и четырех евангелистов.</p>
                <p>Высота главного купола составляет 33 метра - в память о земных годах жизни Спасителя.</p>
                
                <div class="quote-block">
                    <p>"Покровский собор стал не просто храмом, а духовным символом всего региона Кавказских Минеральных Вод."</p>
                    <small>- Из воспоминаний старожилов города</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Хронология истории -->
    <div class="history-section">
        <h2 class="text-center mb-4">Хронология истории собора</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="timeline-item">
                    <span class="timeline-year">1895</span>
                    <h4>Начало строительства</h4>
                    <p>Закладка первого камня и начало строительства храма. Средства на строительство собирались всем миром - пожертвования поступали от местных жителей, купцов и даже от царской семьи.</p>
                </div>
                
                <div class="timeline-item">
                    <span class="timeline-year">1907</span>
                    <h4>Освящение храма</h4>
                    <p>Торжественное освящение Покровского храма. Первая Божественная литургия собрала hundreds прихожан со всего региона.</p>
                </div>
                
                <div class="timeline-item">
                    <span class="timeline-year">1917-1941</span>
                    <h4>Трудные годы</h4>
                    <p>Храм пережил революцию и гражданскую войну. В 1930-е годы был закрыт и использовался как складское помещение.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="timeline-item">
                    <span class="timeline-year">1943</span>
                    <h4>Возрождение</h4>
                    <p>В годы Великой Отечественной войны храм был возвращен верующим. Службы возобновились и не прекращались даже в самые трудные времена.</p>
                </div>
                
                <div class="timeline-item">
                    <span class="timeline-year">1990-е</span>
                    <h4>Реконструкция</h4>
                    <p>Масштабная реконструкция и восстановление храма. Были воссозданы росписи, установлен новый иконостас.</p>
                </div>
                
                <div class="timeline-item">
                    <span class="timeline-year">2000-е</span>
                    <h4>Современный период</h4>
                    <p>Покровский собор становится кафедральным. При храме открываются воскресная школа, библиотека и социальная служба.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Архитектурные особенности -->
    <div class="history-section">
        <h2 class="text-center mb-4">Архитектурные особенности</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="architectural-feature">
                    <div class="feature-icon">
                        <i class="fa fa-building-o"></i>
                    </div>
                    <h4>Стиль</h4>
                    <p>Русско-византийский стиль с элементами классицизма</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="architectural-feature">
                    <div class="feature-icon">
                        <i class="fa fa-arrows-alt"></i>
                    </div>
                    <h4>Размеры</h4>
                    <p>Высота - 33 метра, вместимость - до 1000 человек</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="architectural-feature">
                    <div class="feature-icon">
                        <i class="fa fa-paint-brush"></i>
                    </div>
                    <h4>Росписи</h4>
                    <p>Стеновые росписи выполнены в традициях русской церковной живописи</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Современное состояние -->
    <div class="history-section">
        <h2 class="text-center mb-4">Современная жизнь собора</h2>
        <div class="row">
            <div class="col-md-6">
                <amp-img src="https://avatars.mds.yandex.net/get-altay/223006/2a0000015a7e5bf6de3d8a0c88c8c0b1c577/XXL" 
                        width="600" 
                        height="400" 
                        layout="responsive" 
                        class="history-image"
                        alt="Внутреннее убранство собора"></amp-img>
            </div>
            <div class="col-md-6">
                <h3>Духовный центр региона</h3>
                <p>Сегодня Покровский собор является не только архитектурной доминантой города, но и важным духовным центром. Здесь регулярно проходят богослужения, совершаются таинства, работает воскресная школа для детей и взрослых.</p>
                <p>При соборе действует социальная служба, оказывающая помощь нуждающимся, и библиотека православной литературы.</p>
                
                <div class="historical-fact">
                    <h4><i class="fa fa-heart"></i> Благотворительность</h4>
                    <p>Собор активно занимается благотворительной деятельностью, помогая многодетным семьям, инвалидам и пожилым людям.</p>
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
</body>
</html>
<?php ob_end_flush(); ?>