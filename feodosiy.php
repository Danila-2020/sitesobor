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
        <h1 class="text-center">Преподобный Феодосий Кавказский</h1>
        
        <div class="flex flex-wrap">
            <div class="md-col md-col-6 p2">
                <amp-img src="https://www.stoletie.ru/upload/resize_cache/iblock/3d6/300_300_1/feodosiy.jpg" width="400" height="500" layout="responsive" alt="Преподобный Феодосий Кавказский"></amp-img>
            </div>
            <div class="md-col md-col-6 p2">
                <h2>Житие святого</h2>
                <p>Преподобный Феодосий Кавказский (в миру Фёдор Фёдорович Кашин; 1841-1948) - православный святой, старец, почитаемый в лике преподобных.</p>
                <p>Родился в Пермской губернии в крестьянской семье. С детства проявлял склонность к монашеской жизни. В 17 лет отправился на Афон, где принял постриг с именем Феодосий.</p>
                <p>После многих лет афонского подвижничества вернулся в Россию, служил в разных монастырях. Последние годы жизни провёл на Кавказе, где принимал множество людей, ищущих духовного совета.</p>
                <p>Прославился даром прозорливости и чудотворений. Канонизирован в 1995 году как местночтимый святой Кубанской епархии.</p>
            </div>
        </div>
        
        <div class="p2">
            <h2>Чудеса и пророчества</h2>
            <p>Преподобный Феодосий обладал даром предвидения. Сохранились свидетельства о многих чудесах, совершённых по его молитвам:</p>
            <ul>
                <li>Исцеление больных, в том числе от неизлечимых болезней</li>
                <li>Предсказание революции 1917 года и гонений на Церковь</li>
                <li>Пророчества о будущем России</li>
                <li>Многочисленные случаи помощи в безвыходных ситуациях</li>
            </ul>
        </div>
        
        <div class="p2">
            <h2>Почитание и мощи</h2>
            <div class="flex flex-wrap">
                <div class="md-col md-col-6 p2">
                    <p>Преподобный Феодосий Кавказский почил 8 августа 1948 года в возрасте 107 лет. Был похоронен в городе Минеральные Воды.</p>
                    <p>В 1995 году состоялось обретение его мощей, которые ныне покоятся в Покровском соборе Минеральных Вод. Ежегодно 8 августа совершается память святого.</p>
                    <p>К мощам преподобного Феодосия приезжают паломники со всей России и из-за рубежа, получая по его молитвам исцеления и помощь в житейских нуждах.</p>
                </div>
                <div class="md-col md-col-6 p2">
                    <amp-img src="https://ruskline.ru/images/icons/%D0%9A%D0%B0%D0%B2%D0%BA%D0%B0%D0%B7%D0%A4%D0%B5%D0%BE%D0%B4%D0%BE%D1%818.jpg" 
                            width="400" 
                            height="500" 
                            layout="responsive" 
                            alt="Преподобный Феодосий Кавказский"></amp-img>
                </div>
            </div>
        </div>
    </div>
    

 <div class="max-width-4 mx-auto p2">
    <div class="rounded border border-grey bg-white alpha-90 clearfix">
        <div class="clearfix">
            <div class="md-col md-col-6 p2">
                <div class="module-wrap"></div>
                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <amp-img src="img/feodosiy-kavkazskiy-2.jpg" width="600" height="400" layout="responsive" alt="Фото преподобного Феодосия"></amp-img>
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