<?php
// Страница Чайного дворика

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
    <title>Чайный дворик</title>
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
        
        .tea-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .tea-card {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(253, 253, 253, 0.1);
            height: 100%;
        }
        
        .tea-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .tea-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .tea-menu {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .tea-menu th {
            background-color: rgba(96, 150, 184, 0.5);
        }
        
        .tea-menu td, 
        .tea-menu th {
            border-color: rgba(253, 253, 253, 0.2) !important;
            padding: 12px 15px;
        }
        
        .badge-tea {
            background-color: rgba(96, 150, 184, 0.7);
            color: #fdfdfd;
            font-size: 0.8rem;
        }
        
        .tea-gallery img {
            transition: all 0.3s ease;
        }
        
        .tea-gallery img:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        /* Специальные стили для чайной тематики */
        .tea-icon {
            color: #d4a76a;
            margin-right: 8px;
        }
        
        .tea-price {
            color: #d4a76a;
            font-weight: bold;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .tea-menu td, 
            .tea-menu th {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
            
            .tea-photo {
                height: 150px;
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
                        <a class="dropdown-item active" href="tea-room.php" style="color: #fdfdfd;">Чайный дворик</a>
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
            <!-- Заголовок и описание -->
            <div class="tea-section text-center">
                <h1 class="mb-4">Чайный дворик</h1>
                <p class="lead">Уютное место для отдыха, общения и духовных бесед за чашкой ароматного чая</p>
                <amp-img src="img/tea-room-main.jpg" width="800" height="450" layout="responsive" class="rounded mt-3"></amp-img>
            </div>
            
            <!-- О чайном дворике -->
            <div class="tea-section">
                <h2 class="text-center mb-4">О нашем чайном дворике</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Наш Чайный дворик - это особое место при храме, где каждый может отдохнуть душой, насладиться вкусным чаем и приятной беседой в атмосфере тепла и уюта.</p>
                        <p>Мы предлагаем:</p>
                        <ul>
                            <li>Более 30 сортов натурального чая и травяных сборов</li>
                            <li>Домашнюю выпечку и постные сладости</li>
                            <li>Уютную атмосферу для общения и отдыха</li>
                            <li>Тематические вечера и духовные беседы</li>
                            <li>Возможность приобрести чайные наборы в подарок</li>
                        </ul>
                        <p>Все вырученные средства идут на поддержку социальных проектов прихода.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="tea-gallery">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <a href="img/tea-room/tea1.jpg" data-toggle="lightbox" data-gallery="tea-gallery">
                                        <img src="img/tea-room/tea1.jpg" alt="Интерьер чайного дворика" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="img/tea-room/tea2.jpg" data-toggle="lightbox" data-gallery="tea-gallery">
                                        <img src="img/tea-room/tea2.jpg" alt="Чайная церемония" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="img/tea-room/tea3.jpg" data-toggle="lightbox" data-gallery="tea-gallery">
                                        <img src="img/tea-room/tea3.jpg" alt="Чайная коллекция" class="img-fluid rounded">
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="img/tea-room/tea4.jpg" data-toggle="lightbox" data-gallery="tea-gallery">
                                        <img src="img/tea-room/tea4.jpg" alt="Выпечка" class="img-fluid rounded">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Чайная карта -->
            <div class="tea-section">
                <h2 class="text-center mb-4">Наши чаи</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="tea-card">
                            <img src="img/tea-types/black-tea.jpg" alt="Чёрный чай" class="tea-photo">
                            <h3>Чёрные чаи</h3>
                            <p>Классические насыщенные сорта из Индии, Китая и Цейлона</p>
                            <p><span class="tea-icon">☕</span> <span class="tea-price">от 150 руб.</span></p>
                            <span class="badge badge-tea">Хит</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tea-card">
                            <img src="img/tea-types/green-tea.jpg" alt="Зелёный чай" class="tea-photo">
                            <h3>Зелёные чаи</h3>
                            <p>Тонкие ароматные сорта с полезными свойствами</p>
                            <p><span class="tea-icon">🍵</span> <span class="tea-price">от 200 руб.</span></p>
                            <span class="badge badge-tea">Популярный</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tea-card">
                            <img src="img/tea-types/herbal-tea.jpg" alt="Травяной сбор" class="tea-photo">
                            <h3>Травяные сборы</h3>
                            <p>Полезные напитки из местных трав и ягод</p>
                            <p><span class="tea-icon">🌿</span> <span class="tea-price">от 100 руб.</span></p>
                            <span class="badge badge-tea">Новинка</span>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="#full-menu" class="btn btn-primary">Посмотреть полное меню</a>
                </div>
            </div>
            
            <!-- Меню -->
            <div class="tea-section" id="full-menu">
                <h2 class="text-center mb-4">Меню чайного дворика</h2>
                <div class="table-responsive">
                    <table class="table tea-menu">
                        <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th>Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ассам золотой</td>
                                <td>Крепкий индийский чай с солодовым вкусом</td>
                                <td>180 руб.</td>
                            </tr>
                            <tr>
                                <td>Жасминовая жемчужина</td>
                                <td>Зелёный чай с цветами жасмина</td>
                                <td>220 руб.</td>
                            </tr>
                            <tr>
                                <td>Иван-чай</td>
                                <td>Традиционный русский травяной напиток</td>
                                <td>120 руб.</td>
                            </tr>
                            <tr>
                                <td>Монастырский сбор</td>
                                <td>Травяной чай по старинному рецепту</td>
                                <td>150 руб.</td>
                            </tr>
                            <tr>
                                <td>Пирог яблочный</td>
                                <td>Домашняя выпечка по бабушкиному рецепту</td>
                                <td>90 руб.</td>
                            </tr>
                            <tr>
                                <td>Медовик постный</td>
                                <td>Традиционный десерт без животных продуктов</td>
                                <td>110 руб.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Мероприятия -->
            <div class="tea-section">
                <h2 class="text-center mb-4">Чайные мероприятия</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="tea-card">
                            <h3>Чайные церемонии</h3>
                            <p><i class="fa fa-calendar tea-icon"></i> Каждую субботу, 17:00</p>
                            <p>Знакомство с традициями чаепития разных стран под руководством опытного чайного мастера.</p>
                            <a href="#" class="btn btn-primary">Записаться</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tea-card">
                            <h3>Литературные вечера</h3>
                            <p><i class="fa fa-calendar tea-icon"></i> Последнее воскресенье месяца, 18:00</p>
                            <p>Чтение и обсуждение классической литературы за чашкой ароматного чая.</p>
                            <a href="#" class="btn btn-primary">Записаться</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Контакты -->
            <div class="tea-section">
                <h2 class="text-center mb-4">Посетите нас</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h4><i class="fa fa-clock-o tea-icon"></i> Часы работы:</h4>
                        <p>Пн-Пт: 12:00 - 20:00</p>
                        <p>Сб-Вс: 10:00 - 22:00</p>
                        
                        <h4 class="mt-4"><i class="fa fa-map-marker tea-icon"></i> Адрес:</h4>
                        <p>ул. Церковная, 1 (территория храма, левое крыло)</p>
                        
                        <h4 class="mt-4"><i class="fa fa-phone tea-icon"></i> Телефон:</h4>
                        <p>+7 (123) 456-78-92</p>
                    </div>
                    <div class="col-md-6">
                        <h4><i class="fa fa-info-circle tea-icon"></i> Правила посещения:</h4>
                        <ul>
                            <li>Мы соблюдаем постные дни (среда и пятница)</li>
                            <li>Приветствуется скромная одежда</li>
                            <li>Дети до 12 лет - только в сопровождении взрослых</li>
                            <li>Разрешены домашние животные на поводке</li>
                        </ul>
                        <div class="mt-4">
                            <a href="contacts.php" class="btn btn-primary mr-2">Схема проезда</a>
                            <a href="#" class="btn btn-outline-primary">Забронировать столик</a>
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