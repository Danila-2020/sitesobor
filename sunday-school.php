<?php
// Страница Воскресной школы

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
    <title>Воскресная школа</title>
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
        
        /* Стили для Воскресной школы */
        .school-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .class-card {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(253, 253, 253, 0.1);
        }
        
        .class-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .teacher-card {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .teacher-photo {
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
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .teacher-photo {
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
                        <a class="dropdown-item active" href="sunday-school.php" style="color: #fdfdfd;">Воскресная школа</a>
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
        <div class="container mt-4">
            <!-- Логотип по центру -->
            <div class="text-center mb-4">
                <amp-img src="img/sunday-school-logo.png" width="300" height="300" layout="fixed"></amp-img>
            </div>
            
            <h1 class="text-center mb-4">Воскресная школа</h1>
            
            <!-- О школе -->
            <div class="school-section">
                <h2 class="text-center mb-4">О нашей школе</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Воскресная школа при нашем храме существует уже более 20 лет. Мы стремимся дать детям не только знания о православной вере, но и помочь им стать настоящими христианами в своей повседневной жизни.</p>
                        <p>В нашей школе обучаются дети от 5 до 16 лет. Занятия проходят по воскресеньям после Божественной литургии.</p>
                        <p>Основные направления нашей работы:</p>
                        <ul>
                            <li>Изучение Закона Божия</li>
                            <li>Церковнославянский язык</li>
                            <li>Церковное пение</li>
                            <li>Творческие занятия</li>
                            <li>Подготовка к церковным праздникам</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="img/school-building.jpg" alt="Здание воскресной школы" class="img-fluid rounded">
                    </div>
                </div>
            </div>
            
            <!-- Преподаватели -->
            <div class="school-section">
                <h2 class="text-center mb-4">Наши преподаватели</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="teacher-card">
                            <img src="img/teachers/teacher1.jpg" alt="Директор школы" class="teacher-photo">
                            <h4>Протоиерей Иоанн Иванов</h4>
                            <p>Директор школы, преподаватель Закона Божия</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="teacher-card">
                            <img src="img/teachers/teacher2.jpg" alt="Преподаватель" class="teacher-photo">
                            <h4>Мария Петрова</h4>
                            <p>Преподаватель церковнославянского языка</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="teacher-card">
                            <img src="img/teachers/teacher3.jpg" alt="Регент" class="teacher-photo">
                            <h4>Анна Сидорова</h4>
                            <p>Регент детского хора</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Расписание -->
            <div class="school-section">
                <h2 class="text-center mb-4">Расписание занятий</h2>
                <div class="table-responsive">
                    <table class="table schedule-table">
                        <thead>
                            <tr>
                                <th>Группа</th>
                                <th>Время</th>
                                <th>Предмет</th>
                                <th>Преподаватель</th>
                                <th>Кабинет</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Младшая (5-7 лет)</td>
                                <td>11:00 - 11:45</td>
                                <td>Основы православия</td>
                                <td>Мария Петрова</td>
                                <td>№1</td>
                            </tr>
                            <tr>
                                <td>Средняя (8-12 лет)</td>
                                <td>12:00 - 12:45</td>
                                <td>Закон Божий</td>
                                <td>Протоиерей Иоанн</td>
                                <td>№2</td>
                            </tr>
                            <tr>
                                <td>Старшая (13-16 лет)</td>
                                <td>13:00 - 13:45</td>
                                <td>Церковная история</td>
                                <td>Протоиерей Иоанн</td>
                                <td>№2</td>
                            </tr>
                            <tr>
                                <td>Все группы</td>
                                <td>14:00 - 15:00</td>
                                <td>Церковное пение</td>
                                <td>Анна Сидорова</td>
                                <td>Актовый зал</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Группы -->
            <div class="school-section">
                <h2 class="text-center mb-4">Наши группы</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="class-card">
                            <h3>Младшая группа</h3>
                            <p>Возраст: 5-7 лет</p>
                            <p>Занятия в игровой форме, изучение основ православной веры, творческие занятия.</p>
                            <a href="#" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="class-card">
                            <h3>Средняя группа</h3>
                            <p>Возраст: 8-12 лет</p>
                            <p>Изучение Закона Божия, церковнославянского языка, участие в богослужениях.</p>
                            <a href="#" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="class-card">
                            <h3>Старшая группа</h3>
                            <p>Возраст: 13-16 лет</p>
                            <p>Углубленное изучение Священного Писания, церковной истории, подготовка к взрослой жизни в Церкви.</p>
                            <a href="#" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Галерея -->
            <div class="school-section">
                <h2 class="text-center mb-4">Фотогалерея</h2>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="img/gallery/school1.jpg" data-toggle="lightbox" data-gallery="school-gallery">
                                <img src="img/gallery/school1.jpg" alt="Занятия в школе" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="img/gallery/school2.jpg" data-toggle="lightbox" data-gallery="school-gallery">
                                <img src="img/gallery/school2.jpg" alt="Праздник в школе" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="img/gallery/school3.jpg" data-toggle="lightbox" data-gallery="school-gallery">
                                <img src="img/gallery/school3.jpg" alt="Детский хор" class="img-fluid rounded">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="photogallery.php?album=school" class="btn btn-primary">Посмотреть все фото</a>
                </div>
            </div>
            
            <!-- Контакты -->
            <div class="school-section">
                <h2 class="text-center mb-4">Как записаться</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Для записи в воскресную школу необходимо:</p>
                        <ol>
                            <li>Заполнить анкету (можно получить в церковной лавке)</li>
                            <li>Предоставить копию свидетельства о рождении ребенка</li>
                            <li>Побеседовать с директором школы</li>
                        </ol>
                        <p>Занятия бесплатные. При школе также работает библиотека православной литературы для детей.</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Контактная информация:</h4>
                        <p><i class="fa fa-phone"></i> +7 (123) 456-78-90</p>
                        <p><i class="fa fa-envelope"></i> sundayschool@example.com</p>
                        <p><i class="fa fa-clock-o"></i> Воскресенье, 11:00 - 15:00</p>
                        <p><i class="fa fa-map-marker"></i> Адрес: ул. Церковная, 1, кабинет 3</p>
                        <a href="contacts.php" class="btn btn-primary mt-3">Схема проезда</a>
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