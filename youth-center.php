<?php
// Страница Молодёжного центра

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
    <title>Молодёжный центр</title>
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
        }
        
        /* Стили для Молодёжного центра */
        .youth-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .event-card {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(253, 253, 253, 0.1);
            height: 100%;
        }
        
        .event-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .leader-card {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .leader-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 3px solid rgba(253, 253, 253, 0.3);
        }
        
        .schedule-table {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .schedule-table th {
            background-color: rgba(96, 150, 184, 0.5);
        }
        
        .schedule-table td, 
        .schedule-table th {
            border-color: rgba(253, 253, 253, 0.2) !important;
            padding: 12px 15px;
        }
        
        .gallery-item {
            margin-bottom: 20px;
        }
        
        .gallery-item img {
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .gallery-item img:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .badge-youth {
            background-color: rgba(96, 150, 184, 0.7);
            color: #fdfdfd;
            font-size: 0.8rem;
            margin-right: 5px;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .leader-photo {
                width: 120px;
                height: 120px;
            }
            
            .schedule-table td, 
            .schedule-table th {
                padding: 8px 10px;
                font-size: 0.9rem;
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
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown" style="background-color: rgba(0, 69, 113, 0.95);">
                        <a class="dropdown-item" href="sunday-school.php" style="color: #fdfdfd;">Воскресная школа</a>
                        <a class="dropdown-item active" href="youth-center.php" style="color: #fdfdfd;">Молодёжный центр</a>
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
        <div class="container mt-4">
            <!-- Логотип по центру -->
            <div class="text-center mb-4">
                <amp-img src="img/youth-center-logo.png" width="300" height="300" layout="fixed"></amp-img>
            </div>
            
            <h1 class="text-center mb-4">Молодёжный центр</h1>
            
            <!-- О центре -->
            <div class="youth-section">
                <h2 class="text-center mb-4">О нашем центре</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Молодёжный центр при нашем храме - это место, где молодые люди от 16 до 35 лет могут найти единомышленников, развиваться духовно и творчески, участвовать в интересных проектах и мероприятиях.</p>
                        <p>Наш центр работает с 2010 года и объединяет более 100 активных молодых людей. Мы открыты для всех, кто хочет жить полноценной христианской жизнью в современном мире.</p>
                        <p>Основные направления нашей деятельности:</p>
                        <ul>
                            <li>Духовные беседы и изучение Священного Писания</li>
                            <li>Творческие мастер-классы и кружки</li>
                            <li>Социальное служение и волонтёрство</li>
                            <li>Паломнические поездки</li>
                            <li>Спортивные мероприятия</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="img/youth-center-building.jpg" alt="Молодёжный центр" class="img-fluid rounded">
                    </div>
                </div>
            </div>
            
            <!-- Руководители -->
            <div class="youth-section">
                <h2 class="text-center mb-4">Наша команда</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="leader-card">
                            <img src="img/leaders/leader1.jpg" alt="Руководитель центра" class="leader-photo">
                            <h4>Иерей Андрей Смирнов</h4>
                            <p>Духовник молодёжного центра</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="leader-card">
                            <img src="img/leaders/leader2.jpg" alt="Координатор" class="leader-photo">
                            <h4>Алексей Ковалёв</h4>
                            <p>Координатор проектов</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="leader-card">
                            <img src="img/leaders/leader3.jpg" alt="Руководитель волонтёров" class="leader-photo">
                            <h4>Екатерина Волкова</h4>
                            <p>Руководитель волонтёрского направления</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Мероприятия -->
            <div class="youth-section">
                <h2 class="text-center mb-4">Ближайшие мероприятия</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="event-card">
                            <span class="badge badge-youth">Лекция</span>
                            <span class="badge badge-youth">15+</span>
                            <h3>Христианство и современный мир</h3>
                            <p><i class="fa fa-calendar"></i> 15 октября, 19:00</p>
                            <p><i class="fa fa-map-marker"></i> Конференц-зал</p>
                            <p>Встреча с известным богословом о вызовах современности.</p>
                            <a href="#" class="btn btn-primary">Участвовать</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event-card">
                            <span class="badge badge-youth">Паломничество</span>
                            <span class="badge badge-youth">18+</span>
                            <h3>Поездка в монастырь</h3>
                            <p><i class="fa fa-calendar"></i> 22-23 октября</p>
                            <p><i class="fa fa-map-marker"></i> Свято-Троицкий монастырь</p>
                            <p>Двухдневная паломническая поездка с ночёвкой в обители.</p>
                            <a href="#" class="btn btn-primary">Участвовать</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="event-card">
                            <span class="badge badge-youth">Мастер-класс</span>
                            <span class="badge badge-youth">12+</span>
                            <h3>Иконописная мастерская</h3>
                            <p><i class="fa fa-calendar"></i> Каждую субботу, 16:00</p>
                            <p><i class="fa fa-map-marker"></i> Творческая студия</p>
                            <p>Цикл занятий по основам иконописи с профессиональным мастером.</p>
                            <a href="#" class="btn btn-primary">Участвовать</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="allunews.php?category=youth" class="btn btn-primary">Все мероприятия</a>
                </div>
            </div>
            
            <!-- Расписание -->
            <div class="youth-section">
                <h2 class="text-center mb-4">Регулярные встречи</h2>
                <div class="table-responsive">
                    <table class="table schedule-table">
                        <thead>
                            <tr>
                                <th>День недели</th>
                                <th>Время</th>
                                <th>Мероприятие</th>
                                <th>Руководитель</th>
                                <th>Место</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Понедельник</td>
                                <td>19:00 - 21:00</td>
                                <td>Библейский кружок</td>
                                <td>Иерей Андрей</td>
                                <td>Читальный зал</td>
                            </tr>
                            <tr>
                                <td>Среда</td>
                                <td>18:00 - 20:00</td>
                                <td>Волонтёрский клуб</td>
                                <td>Екатерина Волкова</td>
                                <td>Актовый зал</td>
                            </tr>
                            <tr>
                                <td>Пятница</td>
                                <td>19:30 - 22:00</td>
                                <td>Молодёжные встречи</td>
                                <td>Алексей Ковалёв</td>
                                <td>Гостиная</td>
                            </tr>
                            <tr>
                                <td>Воскресенье</td>
                                <td>15:00 - 17:00</td>
                                <td>Творческие мастерские</td>
                                <td>Приглашённые мастера</td>
                                <td>Творческая студия</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Галерея -->
            <div class="youth-section">
                <h2 class="text-center mb-4">Наши мероприятия</h2>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="img/gallery/youth1.jpg" data-toggle="lightbox" data-gallery="youth-gallery">
                                <img src="img/gallery/youth1.jpg" alt="Молодёжная встреча" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="img/gallery/youth2.jpg" data-toggle="lightbox" data-gallery="youth-gallery">
                                <img src="img/gallery/youth2.jpg" alt="Паломническая поездка" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="img/gallery/youth3.jpg" data-toggle="lightbox" data-gallery="youth-gallery">
                                <img src="img/gallery/youth3.jpg" alt="Волонтёрская акция" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="photogallery.php?album=youth" class="btn btn-primary">Больше фотографий</a>
                </div>
            </div>
            
            <!-- Контакты -->
            <div class="youth-section">
                <h2 class="text-center mb-4">Как присоединиться</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Мы всегда рады новым участникам! Чтобы стать частью нашего молодёжного центра:</p>
                        <ol>
                            <li>Приходите на любую из наших встреч (расписание выше)</li>
                            <li>Подпишитесь на наши соцсети, чтобы быть в курсе событий</li>
                            <li>Заполните анкету участника (можно получить у координатора)</li>
                        </ol>
                        <p>Участие во всех мероприятиях бесплатное. Мы также организуем совместные поездки и паломничества.</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Контактная информация:</h4>
                        <p><i class="fa fa-phone"></i> +7 (123) 456-78-91</p>
                        <p><i class="fa fa-envelope"></i> youth@example.com</p>
                        <p><i class="fa fa-clock-o"></i> Вт-Пт: 17:00 - 21:00, Сб-Вс: 12:00 - 20:00</p>
                        <p><i class="fa fa-map-marker"></i> Адрес: ул. Церковная, 1, 2 этаж</p>
                        
                        <div class="mt-4">
                            <h5>Мы в соцсетях:</h5>
                            <div class="container">
                                <?php include('template/social-icons.php'); ?>
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

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<!-- Подключение Ekko Lightbox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    // Активация Lightbox для галереи
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