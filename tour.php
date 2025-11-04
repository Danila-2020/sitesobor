<?php
// Страница Виртуальный тур

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
    <title>Виртуальный тур</title>
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
            padding-top: 76px; /* Увеличено для фиксированного навбара */
        }
        
        .tour-section {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .tour-iframe {
            height: 70vh;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .tour-point {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(253, 253, 253, 0.1);
        }
        
        .tour-point:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .point-icon {
            font-size: 2rem;
            color: #d4a76a;
            margin-bottom: 15px;
        }
        
        /* Стили для iframe контейнера */
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
        }

        .iframe-item h4 {
            color: #fdfdfd;
            margin-bottom: 10px;
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
        }

        .embed-responsive {
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .iframe-description {
            color: #fdfdfd;
            font-style: italic;
            margin-bottom: 10px;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .tour-iframe {
                height: 50vh;
            }
            
            .iframes-container {
                padding: 15px;
                margin-top: 20px;
            }
            
            body {
                padding-top: 66px; /* Уменьшено для мобильных */
            }
        }
        
        .help-icon {
            color: #d4a76a;
            margin-right: 10px;
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
        <div class="container mt-4">
            <!-- Заголовок и описание -->
            <div class="tour-section text-center">
                <h1 class="mb-4">Виртуальный тур по Собору</h1>
                <p class="lead">"Приидите, поклонимся и припадем ко Христу"</p>
                <amp-img src="img/tour-main.jpg" width="800" height="450" layout="responsive" class="rounded mt-3"></amp-img>
            </div>
            
            <!-- Основной тур -->
            <div class="tour-section">
                <h2 class="text-center mb-4">3D Тур по Собору</h2>
                <iframe class="tour-iframe w-100" src="https://www.google.com/maps/embed?pb=!4v1747810284953!6m8!1m7!1sCAoSFkNJSE0wb2dLRUlDQWdJQzRrdk9EUVE.!2m2!1d44.20203034895457!2d43.12536751966107!3f96.85097907240393!4f-3.463901050392508!5f0.7820865974627469" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                
                <div class="text-center mt-3">
                    <p>Используйте мышь или пальцы для навигации по туру. Кликните на стрелки для перемещения между точками.</p>
                </div>
            </div>
            
            <!-- Точки интереса -->
            <div class="tour-section">
                <h2 class="text-center mb-4">Основные точки интереса</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="tour-point text-center">
                            <div class="point-icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <h3>Главный алтарь</h3>
                            <p>Сердце собора с уникальным иконостасом</p>
                            <a href="#" class="btn btn-primary" onclick="panTo(44.202030, 43.125367)">Перейти</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tour-point text-center">
                            <div class="point-icon">
                                <i class="fa fa-star"></i>
                            </div>
                            <h3>Мощи преподобного</h3>
                            <p>Место упокоения св. Феодосия Кавказского</p>
                            <a href="#" class="btn btn-primary" onclick="panTo(44.202130, 43.125467)">Перейти</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tour-point text-center">
                            <div class="point-icon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <h3>Росписи собора</h3>
                            <p>Уникальные фрески и настенные росписи</p>
                            <a href="#" class="btn btn-primary" onclick="panTo(44.201930, 43.125267)">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Инструкция -->
            <div class="tour-section">
                <h2 class="text-center mb-4">Как пользоваться виртуальным туром</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h4><i class="fa fa-desktop help-icon"></i> На компьютере:</h4>
                        <ul>
                            <li>ЛКМ + движение - поворот обзора</li>
                            <li>ПКМ + движение - перемещение</li>
                            <li>Колесо мыши - приближение/отдаление</li>
                            <li>Клик по стрелкам - переход между точками</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4><i class="fa fa-mobile help-icon"></i> На телефоне/планшете:</h4>
                        <ul>
                            <li>Касание + движение - поворот обзора</li>
                            <li>Два пальца + движение - перемещение</li>
                            <li>Разведение/сведение пальцев - масштаб</li>
                            <li>Клик по стрелкам - переход между точками</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Отображение iframe для этой страницы -->
            <?php
            // Подключаем функцию отображения iframe
            require_once 'display_iframes.php';
            
            // Исправленный вызов функции - передаем только имя страницы
            displayIframes('tour.php');
            ?>
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

<script>
    // Функция для перемещения к определенной точке
    function panTo(lat, lng) {
        // Здесь должна быть реализация перемещения в 3D туре
        alert('В реальном приложении здесь будет переход к точке с координатами: ' + lat + ', ' + lng);
    }
    
    // Исправление для мобильного меню
    $(document).ready(function() {
        // Закрытие меню при клике на обычные ссылки (не dropdown)
        $('.navbar-nav .nav-link:not(.dropdown-toggle)').on('click', function() {
            if ($(window).width() < 992) {
                $('.navbar-collapse').collapse('hide');
            }
        });
        
        // Предотвращение закрытия меню при клике на dropdown-toggle
        $('.dropdown-toggle').on('click', function(e) {
            if ($(window).width() < 992) {
                e.stopPropagation();
                // Bootstrap сам обработает открытие/закрытие подменю
            }
        });
        
        // Закрытие меню при клике на пункты подменю (dropdown-item)
        $('.dropdown-item').on('click', function() {
            if ($(window).width() < 992) {
                $('.navbar-collapse').collapse('hide');
            }
        });
        
        // Закрытие меню при клике вне его области (только для мобильных)
        $(document).on('click', function(event) {
            if ($(window).width() < 992) {
                var clickover = $(event.target);
                var navbar = $(".navbar");
                var _opened = $(".navbar-collapse").hasClass("show");
                
                if (_opened === true && !navbar.is(clickover) && navbar.has(clickover).length === 0) {
                    $(".navbar-collapse").collapse('hide');
                }
            }
        });
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>