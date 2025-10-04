<?php
// Страница Духовенство благочиния

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
    <title>Благочиния - Духовенство</title>
    <!-- Подключение Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Подключение Ekko Lightbox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <!-- Подключение Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Основные стили из предыдущей страницы */
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
        
        /* Стили для духовенства */
        .clergy-card {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
            transition: all 0.3s ease;
        }
        
        .clergy-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .clergy-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 3px solid rgba(253, 253, 253, 0.3);
        }
        
        .clergy-rank {
            color: #d4a76a;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .clergy-name {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        .clergy-divider {
            border-top: 1px solid rgba(253, 253, 253, 0.2);
            margin: 15px 0;
        }
        
        .clergy-badge {
            background-color: rgba(96, 150, 184, 0.7);
            color: #fdfdfd;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-right: 5px;
            display: inline-block;
        }
        
        .blagochiniya-selector {
            background-color: rgba(0, 69, 113, 0.6);
            border: 1px solid rgba(253, 253, 253, 0.2);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
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
        
        /* Стили для навигации по благочиниям */
        .blagochiniya-nav {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
        }
        
        .blagochiniya-nav .nav-link {
            color: #fdfdfd;
            border: 1px solid rgba(253, 253, 253, 0.3);
            margin: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .blagochiniya-nav .nav-link:hover,
        .blagochiniya-nav .nav-link.active {
            background-color: rgba(96, 150, 184, 0.7);
            border-color: #fdfdfd;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .clergy-photo {
                width: 150px;
                height: 150px;
            }
            
            .clergy-card {
                text-align: center;
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

<?php
// Подключаем навбар
include('template/allnavbar.php');
?>

<div class="relative page-wrap">
    <div class="content-wrap relative">
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
                <div class="clearfix p1 text-center">
                    <amp-img class="mx-auto" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                </div>
                
                <div class="social text-center mb-4">
                    <div class="container">
                        <?php include('template/social-icons.php'); ?>
                    </div>
                </div>
                
                <div class="clearfix">
                    <div class="col-12 p-4">
                        <h1 class="text-center mb-4">Духовенство благочиний</h1>
                        
                        <!-- Навигация по благочиниям -->
                        <div class="blagochiniya-nav">
                            <ul class="nav nav-pills justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#central">Центральное</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#north">Северное</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#south">Южное</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#east">Восточное</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div id="central" class="mb-5">
                            <h2 class="text-center mb-4">Центральное благочиние</h2>
                            <div class="row">
                                <!-- Благочинный -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest1.jpg" alt="Протоиерей Иоанн Иванов" class="clergy-photo">
                                        <div class="clergy-rank">Протоиерей, Благочинный</div>
                                        <h3 class="clergy-name">Иоанн Иванов</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Собор Рождества Пресвятой Богородицы</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-90</p>
                                        <p><strong>Email:</strong> ivanov@example.com</p>
                                        <span class="clergy-badge">Благочинный</span>
                                        <span class="clergy-badge">С 2005 года</span>
                                    </div>
                                </div>
                                
                                <!-- Священник -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest2.jpg" alt="Иерей Петр Петров" class="clergy-photo">
                                        <div class="clergy-rank">Иерей</div>
                                        <h3 class="clergy-name">Петр Петров</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. Николая Чудотворца</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-91</p>
                                        <p><strong>Email:</strong> petrov@example.com</p>
                                        <span class="clergy-badge">Кандидат богословия</span>
                                        <span class="clergy-badge">С 2010 года</span>
                                    </div>
                                </div>
                                
                                <!-- Священник -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest3.jpg" alt="Иерей Сергий Сидоров" class="clergy-photo">
                                        <div class="clergy-rank">Иерей</div>
                                        <h3 class="clergy-name">Сергий Сидоров</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. великомученицы Екатерины</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-92</p>
                                        <p><strong>Email:</strong> sidorov@example.com</p>
                                        <span class="clergy-badge">Ответственный за молодежную работу</span>
                                        <span class="clergy-badge">С 2015 года</span>
                                    </div>
                                </div>
                                
                                <!-- Диакон -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/deacon1.jpg" alt="Диакон Василий Васильев" class="clergy-photo">
                                        <div class="clergy-rank">Диакон</div>
                                        <h3 class="clergy-name">Василий Васильев</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Собор Рождества Пресвятой Богородицы</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-93</p>
                                        <p><strong>Email:</strong> vasilev@example.com</p>
                                        <span class="clergy-badge">Регент хора</span>
                                        <span class="clergy-badge">С 2018 года</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Северное благочиние -->
                        <div id="north" class="mb-5">
                            <h2 class="text-center mb-4">Северное благочиние</h2>
                            <div class="row">
                                <!-- Благочинный -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest4.jpg" alt="Протоиерей Александр Александров" class="clergy-photo">
                                        <div class="clergy-rank">Протоиерей, Благочинный</div>
                                        <h3 class="clergy-name">Александр Александров</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. апостолов Петра и Павла</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-94</p>
                                        <p><strong>Email:</strong> alexandrov@example.com</p>
                                        <span class="clergy-badge">Благочинный</span>
                                        <span class="clergy-badge">С 2007 года</span>
                                    </div>
                                </div>
                                
                                <!-- Священник -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest5.jpg" alt="Иерей Михаил Михайлов" class="clergy-photo">
                                        <div class="clergy-rank">Иерей</div>
                                        <h3 class="clergy-name">Михаил Михайлов</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. Серафима Саровского</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-95</p>
                                        <p><strong>Email:</strong> mihailov@example.com</p>
                                        <span class="clergy-badge">Ответственный за социальную работу</span>
                                        <span class="clergy-badge">С 2012 года</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Южное благочиние -->
                        <div id="south" class="mb-5">
                            <h2 class="text-center mb-4">Южное благочиние</h2>
                            <div class="row">
                                <!-- Благочинный -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest6.jpg" alt="Иерей Димитрий Димитриев" class="clergy-photo">
                                        <div class="clergy-rank">Иерей, Благочинный</div>
                                        <h3 class="clergy-name">Димитрий Димитриев</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. великомученика Пантелеимона</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-96</p>
                                        <p><strong>Email:</strong> dimitriev@example.com</p>
                                        <span class="clergy-badge">Благочинный</span>
                                        <span class="clergy-badge">С 2014 года</span>
                                    </div>
                                </div>
                                
                                <!-- Священник -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest7.jpg" alt="Иерей Андрей Андреев" class="clergy-photo">
                                        <div class="clergy-rank">Иерей</div>
                                        <h3 class="clergy-name">Андрей Андреев</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. мученицы Татианы</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-97</p>
                                        <p><strong>Email:</strong> andreev@example.com</p>
                                        <span class="clergy-badge">Ответственный за катехизацию</span>
                                        <span class="clergy-badge">С 2016 года</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Восточное благочиние -->
                        <div id="east" class="mb-5">
                            <h2 class="text-center mb-4">Восточное благочиние</h2>
                            <div class="row">
                                <!-- Благочинный -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest8.jpg" alt="Иерей Георгий Георгиев" class="clergy-photo">
                                        <div class="clergy-rank">Иерей, Благочинный</div>
                                        <h3 class="clergy-name">Георгий Георгиев</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. великомученика Георгия Победоносца</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-98</p>
                                        <p><strong>Email:</strong> georgiev@example.com</p>
                                        <span class="clergy-badge">Благочинный</span>
                                        <span class="clergy-badge">С 2013 года</span>
                                    </div>
                                </div>
                                
                                <!-- Священник -->
                                <div class="col-md-6">
                                    <div class="clergy-card text-center">
                                        <img src="img/clergy/priest9.jpg" alt="Иерей Павел Павлов" class="clergy-photo">
                                        <div class="clergy-rank">Иерей</div>
                                        <h3 class="clergy-name">Павел Павлов</h3>
                                        <div class="clergy-divider"></div>
                                        <p><strong>Храм:</strong> Храм св. апостола Андрея Первозванного</p>
                                        <p><strong>Телефон:</strong> +7 (123) 456-78-99</p>
                                        <p><strong>Email:</strong> pavlov@example.com</p>
                                        <span class="clergy-badge">Ответственный за миссионерскую работу</span>
                                        <span class="clergy-badge">С 2017 года</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Отображение iframe для этой страницы -->
                        <?php
                        // Подключаем функцию отображения iframe
                        require_once 'display_iframes.php';
                        
                        // Отображаем iframe для этой страницы
                        displayIframes('blagochiniya-clergy.php', $mysqli);
                        ?>
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
    // Активация Lightbox для изображений
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
    
    // Плавная прокрутка к выбранному благочинию
    $('a[href^="#"]').on('click', function(event) {
        event.preventDefault();
        var target = $(this).attr('href');
        
        // Обновляем активную вкладку
        $('.blagochiniya-nav .nav-link').removeClass('active');
        $(this).addClass('active');
        
        $('html, body').animate({
            scrollTop: $(target).offset().top - 20
        }, 500);
    });
    
    // Обновление активной вкладки при прокрутке
    $(window).on('scroll', function() {
        var scrollPos = $(document).scrollTop();
        
        $('.blagochiniya-nav .nav-link').each(function() {
            var currLink = $(this);
            var refElement = $(currLink.attr('href'));
            if (refElement.position().top <= scrollPos + 100 && refElement.position().top + refElement.height() > scrollPos) {
                $('.blagochiniya-nav .nav-link').removeClass('active');
                currLink.addClass('active');
            }
        });
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>