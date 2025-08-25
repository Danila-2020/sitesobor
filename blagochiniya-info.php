<?php
// Страница информации о благочиниях

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
    <title>Благочиния - Общие сведения</title>
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
        
        
        /* Стили для галереи */
        .gallery-slider {
            position: relative;
            margin: 20px 0;
            background: rgba(0, 69, 113, 0.3);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .gallery-item {
            cursor: pointer;
            transition: all 0.3s ease;
            height: 500px;
        }
        
        .gallery-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        
        .gallery-item:hover {
            opacity: 0.9;
        }
        
        /* Стили для благочиний */
        .blagochiniya-card {
            background-color: rgba(0, 69, 113, 0.6);
            border: 1px solid rgba(253, 253, 253, 0.2);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .blagochiniya-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .blagochiniya-title {
            color: #fdfdfd;
            border-bottom: 1px solid rgba(253, 253, 253, 0.3);
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .blagochiniya-map {
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        /* Стили для контента */
        .info-content {
            line-height: 1.6;
            font-size: 1.1rem;
            padding: 20px 0;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.8);
            border-color: #dc3545;
        }
        
        /* Стили для социальных иконок */
        .social-share {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .social-share li {
            display: inline-block;
            margin: 0 10px;
        }
        
        .social-share li a i {
            color: #fdfdfd;
            font-size: 24px;
            transition: all 0.3s ease;
        }
        
        .social-share li a i:hover {
            transform: scale(1.2);
        }
        
        @media (max-width: 768px) {
            .gallery-item {
                height: 300px;
            }
            
            .blagochiniya-map {
                height: 300px;
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
        <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
            <div class="land-see-hero-main mx-auto"></div>
        </section>
        
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
                <div class="clearfix p1 text-center">
                    <amp-img class="mx-auto" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                </div>
                
                <div class="social text-center mb-4">
                    <ul class="social-share">
                        <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                        <li><a href="#"><i class="fa fa-vk"></i></a></li>
                        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
                
                <div class="clearfix">
                    <div class="col-12 p-4">
                        <h1 class="text-center mb-4">Благочиния - Общие сведения</h1>
                        
                        <!-- Карта благочиний -->
                        <div class="blagochiniya-map">
                            <!-- Здесь будет карта -->
                            <img src="img/blagochiniya-map.jpg" alt="Карта благочиний" class="img-fluid rounded">
                        </div>
                        
                        <!-- Информация о благочиниях -->
                        <div class="info-content">
                            <p>Благочиние — это церковно-административная единица, объединяющая группу приходов и храмов в пределах определённой территории. В Русской Православной Церкви благочиния создаются по территориальному принципу и входят в состав епархии.</p>
                            
                            <p>На территории нашей епархии действует несколько благочиний, каждое из которых имеет свои особенности и историю. Благочинные назначаются правящим архиереем и несут ответственность за духовную жизнь на вверенной им территории.</p>
                        </div>
                        
                        <!-- Список благочиний -->
                        <div class="row mt-4">
                            <!-- Благочиние 1 -->
                            <div class="col-md-6">
                                <div class="blagochiniya-card">
                                    <h3 class="blagochiniya-title">Центральное благочиние</h3>
                                    <p><strong>Благочинный:</strong> протоиерей Иоанн Иванов</p>
                                    <p><strong>Территория:</strong> центральная часть города и прилегающие районы</p>
                                    <p><strong>Храницы:</strong> от реки на севере до железной дороги на юге</p>
                                    <p><strong>Количество храмов:</strong> 12</p>
                                    <a href="blagochiniya-central.php" class="btn btn-primary mt-2">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Благочиние 2 -->
                            <div class="col-md-6">
                                <div class="blagochiniya-card">
                                    <h3 class="blagochiniya-title">Северное благочиние</h3>
                                    <p><strong>Благочинный:</strong> протоиерей Петр Петров</p>
                                    <p><strong>Территория:</strong> северные районы города и пригород</p>
                                    <p><strong>Границы:</strong> от центра до городской черты на севере</p>
                                    <p><strong>Количество храмов:</strong> 8</p>
                                    <a href="blagochiniya-north.php" class="btn btn-primary mt-2">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Благочиние 3 -->
                            <div class="col-md-6">
                                <div class="blagochiniya-card">
                                    <h3 class="blagochiniya-title">Южное благочиние</h3>
                                    <p><strong>Благочинный:</strong> иерей Сергий Сидоров</p>
                                    <p><strong>Территория:</strong> южные районы города и пригород</p>
                                    <p><strong>Границы:</strong> от центра до городской черты на юге</p>
                                    <p><strong>Количество храмов:</strong> 6</p>
                                    <a href="blagochiniya-south.php" class="btn btn-primary mt-2">Подробнее</a>
                                </div>
                            </div>
                            
                            <!-- Благочиние 4 -->
                            <div class="col-md-6">
                                <div class="blagochiniya-card">
                                    <h3 class="blagochiniya-title">Восточное благочиние</h3>
                                    <p><strong>Благочинный:</strong> иерей Василий Васильев</p>
                                    <p><strong>Территория:</strong> восточные районы города и пригород</p>
                                    <p><strong>Границы:</strong> от центра до городской черты на востоке</p>
                                    <p><strong>Количество храмов:</strong> 5</p>
                                    <a href="blagochiniya-east.php" class="btn btn-primary mt-2">Подробнее</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Дополнительная информация -->
                        <div class="info-content mt-4">
                            <h3 class="text-center mb-3">История создания благочиний</h3>
                            <p>Современная система благочиний в нашей епархии была сформирована в 1990-х годах, после возрождения церковной жизни. Первоначально было создано два благочиния - городское и сельское. По мере роста количества приходов и увеличения численности верующих, возникла необходимость в более детальном делении.</p>
                            
                            <p>В 2005 году было принято решение о создании четырёх благочиний по территориальному принципу, что позволило более эффективно организовать пастырскую работу и координацию деятельности приходов.</p>
                            
                            <h3 class="text-center mb-3 mt-4">Задачи благочиний</h3>
                            <ul>
                                <li>Координация деятельности приходов на территории благочиния</li>
                                <li>Организация совместных мероприятий и богослужений</li>
                                <li>Контроль за соблюдением церковных уставов и распоряжений епархии</li>
                                <li>Решение текущих вопросов приходской жизни</li>
                                <li>Подготовка отчетов для епархиального управления</li>
                            </ul>
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
</script>
</body>
</html>
<?php ob_end_flush(); ?>