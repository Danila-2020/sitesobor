<?php
// Страница Социальной деятельности

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
    <title>Социальная деятельность</title>
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
        
        .social-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .project-card {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(253, 253, 253, 0.1);
            height: 100%;
        }
        
        .project-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .help-card {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #d4a76a;
        }
        
        .social-icon {
            font-size: 2rem;
            color: #d4a76a;
            margin-bottom: 15px;
        }
        
        .social-gallery img {
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .social-gallery img:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .badge-social {
            background-color: rgba(96, 150, 184, 0.7);
            color: #fdfdfd;
            font-size: 0.8rem;
            margin-right: 5px;
        }
        
        .volunteer-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 3px solid rgba(253, 253, 253, 0.3);
        }
        
        /* Специальные стили для социальной тематики */
        .help-icon {
            color: #d4a76a;
            margin-right: 8px;
        }
        
        .urgent {
            color: #ff6b6b;
            font-weight: bold;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .volunteer-photo {
                width: 100px;
                height: 100px;
            }
            
            .help-card {
                margin-bottom: 15px;
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
                        <a class="dropdown-item" href="youth-center.php" style="color: #fdfdfd;">Молодёжный центр</a>
                        <a class="dropdown-item" href="tea-room.php" style="color: #fdfdfd;">Чайный дворик</a>
                        <a class="dropdown-item active" href="social-activity.php" style="color: #fdfdfd;">Социальная деятельность</a>
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
            <!-- Заголовок и описание -->
            <div class="social-section text-center">
                <h1 class="mb-4">Социальная деятельность</h1>
                <p class="lead">"Так как вы сделали это одному из сих братьев Моих меньших, то сделали Мне" (Мф. 25:40)</p>
                <amp-img src="img/social-main.jpg" width="800" height="450" layout="responsive" class="rounded mt-3"></amp-img>
            </div>
            
            <!-- О социальной деятельности -->
            <div class="social-section">
                <h2 class="text-center mb-4">Наша миссия</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Социальное служение - важная часть жизни нашего прихода. Мы стремимся помогать тем, кто оказался в трудной жизненной ситуации, следуя заповедям Христа о любви к ближнему.</p>
                        <p>Наши основные принципы:</p>
                        <ul>
                            <li>Помощь без унижения достоинства человека</li>
                            <li>Индивидуальный подход к каждому нуждающемуся</li>
                            <li>Совместная работа с государственными социальными службами</li>
                            <li>Духовная поддержка вместе с материальной помощью</li>
                            <li>Привлечение волонтёров из приходской общины</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="social-gallery">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <a href="img/social/social1.jpg" data-toggle="lightbox" data-gallery="social-gallery">
                                        <img src="img/social/social1.jpg" alt="Социальная помощь" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="img/social/social2.jpg" data-toggle="lightbox" data-gallery="social-gallery">
                                        <img src="img/social/social2.jpg" alt="Работа волонтёров" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="img/social/social3.jpg" data-toggle="lightbox" data-gallery="social-gallery">
                                        <img src="img/social/social3.jpg" alt="Благотворительная акция" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="img/social/social4.jpg" data-toggle="lightbox" data-gallery="social-gallery">
                                        <img src="img/social/social4.jpg" alt="Праздник для детей" class="img-fluid rounded">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Проекты -->
            <div class="social-section">
                <h2 class="text-center mb-4">Наши проекты</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="project-card">
                            <h3>Помощь нуждающимся</h3>
                            <span class="badge badge-social">Активно</span>
                            <p><i class="fa fa-calendar help-icon"></i> Постоянный проект</p>
                            <p>Регулярная раздача продуктовых наборов, одежды и предметов первой необходимости.</p>
                            <p class="urgent"><i class="fa fa-exclamation-circle"></i> Сейчас особенно нужны: детская одежда, крупы, сахар</p>
                            <a href="#" class="btn btn-primary">Помочь</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="project-card">
                            <h3>Дом для мам</h3>
                            <span class="badge badge-social">Новый</span>
                            <p><i class="fa fa-calendar help-icon"></i> С 2021 года</p>
                            <p>Приют для беременных и матерей с детьми, оказавшихся в трудной ситуации.</p>
                            <p><i class="fa fa-check-circle help-icon"></i> Сейчас в приюте: 5 мам и 8 детей</p>
                            <a href="#" class="btn btn-primary">Поддержать</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="project-card">
                            <h3>Добрый автобус</h3>
                            <span class="badge badge-social">Активно</span>
                            <p><i class="fa fa-calendar help-icon"></i> Каждую субботу</p>
                            <p>Выезды волонтёров в отдалённые деревни с гуманитарной помощью и духовной поддержкой.</p>
                            <p><i class="fa fa-users help-icon"></i> Охвачено 15 населённых пунктов</p>
                            <a href="#" class="btn btn-primary">Присоединиться</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Как помочь -->
            <div class="social-section">
                <h2 class="text-center mb-4">Как вы можете помочь</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="help-card">
                            <div class="social-icon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <h4>Материальная помощь</h4>
                            <p>Продукты, одежда, лекарства, предметы гигиены</p>
                            <a href="#" class="btn btn-primary">Что нужно?</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="help-card">
                            <div class="social-icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <h4>Финансовая поддержка</h4>
                            <p>Пожертвования на развитие социальных проектов</p>
                            <a href="#" class="btn btn-primary">Пожертвовать</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="help-card">
                            <div class="social-icon">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                            <h4>Волонтёрство</h4>
                            <p>Ваше время и навыки для помощи нуждающимся</p>
                            <a href="#" class="btn btn-primary">Стать волонтёром</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Волонтёры -->
            <div class="social-section">
                <h2 class="text-center mb-4">Наши волонтёры</h2>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center mb-4">
                            <img src="img/volunteers/vol1.jpg" alt="Волонтёр" class="volunteer-photo">
                            <h5>Ольга Смирнова</h5>
                            <p>Координатор помощи</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center mb-4">
                            <img src="img/volunteers/vol2.jpg" alt="Волонтёр" class="volunteer-photo">
                            <h5>Дмитрий Иванов</h5>
                            <p>Водитель автобуса</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center mb-4">
                            <img src="img/volunteers/vol3.jpg" alt="Волонтёр" class="volunteer-photo">
                            <h5>Анна Ковалёва</h5>
                            <p>Социальный работник</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center mb-4">
                            <img src="img/volunteers/vol4.jpg" alt="Волонтёр" class="volunteer-photo">
                            <h5>Сергей Петров</h5>
                            <p>Ремонтные работы</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="btn btn-primary">Присоединиться к команде</a>
                </div>
            </div>
            
            <!-- Контакты -->
            <div class="social-section">
                <h2 class="text-center mb-4">Контакты социальной службы</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h4><i class="fa fa-clock-o help-icon"></i> Часы работы:</h4>
                        <p>Пн-Пт: 10:00 - 18:00</p>
                        <p>Суббота: 10:00 - 15:00</p>
                        
                        <h4 class="mt-4"><i class="fa fa-map-marker help-icon"></i> Адрес:</h4>
                        <p>ул. Церковная, 1 (цокольный этаж, вход со двора)</p>
                    </div>
                    <div class="col-md-6">
                        <h4><i class="fa fa-phone help-icon"></i> Телефоны:</h4>
                        <p>+7 (123) 456-78-93 - Социальный работник</p>
                        <p>+7 (123) 456-78-94 - Гуманитарная помощь</p>
                        
                        <h4 class="mt-4"><i class="fa fa-envelope help-icon"></i> Email:</h4>
                        <p>social@example.com</p>
                        
                        <div class="mt-4">
                            <a href="contacts.php" class="btn btn-primary">Схема проезда</a>
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