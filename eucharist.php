<?php
// Таинство причастия (Все пользователи)
ob_start();
session_start();
require_once('bd.php');
include('template/confessionhead.php');
include('template/scedulehead.php');
include('template/barber.php');
echo getStyles();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таинство Евхаристии (Причастие)</title>
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
            padding-top: 76px; /* Для фиксированного навбара */
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
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
        /*.navbar {
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
                max-height: 80vh;
                overflow-y: auto;
            }
            
            .nav-link {
                margin: 0.2rem 0;
                text-align: center;
            }
            
            .dropdown-menu {
                background-color: rgba(0, 69, 113, 0.8) !important;
                border: none !important;
                text-align: center;
                margin: 0.5rem 0;
            }
            
            .dropdown-item {
                color: #fdfdfd !important;
                padding: 0.5rem 1rem;
            }
            
            .btn-outline-primary {
                margin: 10px auto !important;
                display: block;
                width: 80%;
            }
            
            .navbar-nav .dropdown-menu {
                position: static !important;
                float: none !important;
            }
        }*/
        
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
        
        @media (max-width: 768px) {
            body {
                padding-top: 66px;
            }
            
            .social-share {
                gap: 10px;
            }
            
            .social-share li a {
                width: 35px;
                height: 35px;
                line-height: 35px;
            }
            
            .navbar-brand img {
                width: 40px;
                height: 40px;
            }
        }

        .section-title {
            border-bottom: 2px solid rgba(96, 150, 184, 0.7);
            padding-bottom: 10px;
            margin-top: 40px;
            margin-bottom: 20px;
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
            color: #fdfdfd !important;
        }
        
        .dropdown-item:hover {
            background-color: rgba(96, 150, 184, 0.5);
            color: #fdfdfd !important;
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
                background-color: rgba(0, 69, 113, 0.8) !important;
                border: none !important;
                box-shadow: none;
                margin-left: 0;
                text-align: center;
            }
            
            .dropdown-item {
                padding: 8px 15px;
            }
            
            .btn-outline-primary {
                margin: 10px auto !important;
                display: block;
                width: 80%;
                text-align: center;
            }
            
            .navbar-nav .btn {
                margin-left: 0 !important;
            }
            
            .navbar-toggler {
                border-color: rgba(253, 253, 253, 0.5);
            }
            
            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(253, 253, 253, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }
        }
    </style>
</head>
<body>

<?php
// Подключаем навбар
include('template/allnavbar.php');
?>

<!-- Основное содержимое страницы -->
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="img-container">
                    <img src="img/eucharist-001.jpg" alt="Таинство Евхаристии" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <h1 class="display-4">Таинство Евхаристии (Причастие)</h1>
            </div>
        </div>

        <div class="content-section mt-4">
            <p class="lead">Евхаристия, или Причастие, является одним из важнейших таинств в христианской традиции, символизирующим единство верующих с Христом и друг с другом. Это священное действие имеет глубокое духовное значение и является центром христианского богослужения.</p>
        </div>

        <div class="content-section">
            <h2 class="section-title">История Евхаристии</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Евхаристия имеет свои корни в Библии, где Иисус Христос установил это таинство на Тайной вечере, предлагая Своим ученикам хлеб и вино как символ Своего тела и крови.</p>
                </div>
                <div class="col-md-6">
                    <div class="img-container">
                        <img src="img/eucharist-002.jpg" alt="Тайная вечеря" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">Символика Евхаристии</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Во время Евхаристии используются различные символы, такие как:</p>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Хлеб</strong> — символ тела Христова, которое было принесено в жертву.</li>
                        <li class="list-group-item"><strong>Вино</strong> — символ крови Христовой, пролитой для искупления грехов.</li>
                        <li class="list-group-item"><strong>Молитва</strong> — средство обращения к Богу за благословением и единством.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="img-container">
                        <img src="img/eucharist-003.jpg" alt="Причастие" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">Подготовка к Евхаристии</h2>
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <p>Подготовка к Евхаристии включает в себя:</p>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Духовную подготовку и исповедь.</li>
                        <li class="list-group-item">Выбор времени и места проведения таинства.</li>
                        <li class="list-group-item">Согласование с духовным лицом.</li>
                        <li class="list-group-item">Молитва о прощении и помощи в принятии таинства.</li>
                    </ol>
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="img-container">
                        <img src="img/eucharist-004.jpg" alt="Подготовка к Причастию" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">Процесс Евхаристии</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Церемония Евхаристии обычно включает в себя следующие этапы:</p>
                    <ul class="list-group">
                        <li class="list-group-item">Молитва и благословение священника.</li>
                        <li class="list-group-item">Преломление хлебa и наливание вина.</li>
                        <li class="list-group-item">Причащение верующих телом и кровью Христовой.</li>
                        <li class="list-group-item">Благодарственная молитва.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="img-container">
                        <img src="img/eucharist-005.jpg" alt="Процесс Евхаристии" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2 class="section-title">Заключение</h2>
            <div class="highlight-box">
                <p class="lead">Евхаристия — это не только обряд, но и важный духовный процесс, который укрепляет веру и единство верующих. Это возможность для каждого обновить свои отношения с Богом и углубить свою духовную жизнь.</p>
            </div>
            <div class="text-center mt-4">
                <a href="contacts.php" class="btn btn-primary btn-lg">Записаться на причастие</a>
            </div>
        </div>
    </div>

    <!-- Социальные иконки внизу -->
    <div class="social-footer">
        <div class="container">
            <ul class="social-share">
                <li><a href="#"><i class="fab fa-telegram"></i></a></li>
                <li><a href="#"><i class="fab fa-vk"></i></a></li>
                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-skype"></i></a></li>
            </ul>
        </div>
        </div>
</div>

<!-- Футер -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Контакты</h5>
                <p>Адрес: г. Минеральные Воды, ул. Примерная, 123</p>
                <p>Телефон: +7 (123) 456-78-90</p>
                <p>Email: info@sobor.ru</p>
            </div>
            <div class="col-md-4">
                <h5>Быстрые ссылки</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="allunews.php">Новости</a></li>
                    <li><a href="photogallery.php">Галерея</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Время работы</h5>
                <p>Пн-Пт: 8:00 - 18:00</p>
                <p>Сб-Вс: 7:00 - 20:00</p>
            </div>
        </div>
        <hr style="border-color: rgba(253, 253, 253, 0.2);">
        <div class="text-center">
            <p>&copy; <b><i>Дробилко Данила<br>
                            Колодочкин Алексей</i></b></p>
        </div>
    </div>
</footer>

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bundle.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>