<?php
// Страница преподобный Феодосий Кавказский

ob_start();
// Стартуем сессию ДО подключения шаблонов
session_start();

// Подключаем модуль базы данных
require_once('bd.php');

// Подключаем шаблоны
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>

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

    
<div class="relative page-wrap">
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive">
        </div>
    </div>
    <?php
    include('template/allnavbar.php');
    ?>

    <div class="container p2">
        <h1 class="text-center">Виртуальный тур</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!4v1747810284953!6m8!1m7!1sCAoSFkNJSE0wb2dLRUlDQWdJQzRrdk9EUVE.!2m2!1d44.20203034895457!2d43.12536741966107!3f96.85097907240393!4f-3.463901050392508!5f0.7820865974627469" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    

 <div class="max-width-4 mx-auto p2">
    <div class="rounded border border-grey bg-white alpha-90 clearfix">
        <div class="clearfix">
            <div class="md-col md-col-6 p2">
                <div class="module-wrap"></div>
                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <a data-flickr-embed="true" data-footer="true" href="https://www.flickr.com/photos/200795418@N07" title=""><img src="https://live.staticflickr.com/65535/54538859626_5b527e3c79_w.jpg" width="400" height="300" alt=""/></a><script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>
                </div>
            </div>
            <div class="md-col md-col-6 p2">
                <div class="module-wrap mb2">
                    <h2><a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">Акафист преподобному</a></h2>
                    <amp-img src="img/ikona-feodosiya-kavkazskogo.jpg" width="600" height="400" layout="responsive" alt="Икона преподобного Феодосия"></amp-img>
                </div>
            </div>
        </div>
    </div>
 </div>

</div><!-- content-wrap -->

</div> <!-- page-wrap -->
</body>
</html>