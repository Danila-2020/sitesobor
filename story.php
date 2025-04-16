<?php
// Страница "История"

ob_start();
require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>
<!-- Прикрутим голову из index(-a) -->
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
    <div class="clearfix">
            <!--Тут был заголовок-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="scedule.php">Расписание богослужений</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
    </li>
    <li class="inline-block mr1">
        <!-- <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Деятельность</a> -->
         <a href="activity.php">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Таинства</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    </li>
    <li class="inline-block mr1">
        <button type="submit" class="btn btn-primary" OnClick='window.location.href="signin.php"'>Вход</button>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="story.php">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="paintingalluser.php">Роспись</a><!--Тут отображаем, но не загружаем😀-->
    </li>
</ul>

<!-- <ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
<!--<p style="font-weight: bold; font-size: 14pt; color: blue; border: 1px solid #000;">Данные разделы примерные, содержимое будет изменено в процессе разработки</p>
    <li class="inline-block mr1">
        <a href="#">Воскресная школа</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Молодежный центр</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Библиотека</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Социальная деятельность</a>
    </li>
</ul> -->

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
    <li class="inline-block mr1">
        <a href="christening.php">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="wedding.php">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="confession.php">Исповедь</a>
    </li>
    <li class="inline-block mr1">
        <a href="eucharist.php">Причастие</a>
    </li>
    <li class="inline-block mr1">
        <a href="unction.php">Соборование</a>
    </li>
</ul>

<hr>
    </div>
<!-- Основной контент страницы -->
<div class="container mt-5">
    <div class="row">
        <?php
        $result = $mysqli->query("SELECT `story`.`id_story`, `story`.`naimstory`, `story`.`textstory`, `story`.`id_uprofile`,
        `imgstory`.`id_imgstory`, `imgstory`.`naimimages`, `imgstory`.`textimages`, `imgstory`.`imagesstory`, `imgstory`.`id_story`,
        `uprofile`.`id_uprofile`, `uprofile`.`ulastname`
        FROM `story` 
        LEFT JOIN `imgstory` ON `story`.`id_story` = `imgstory`.`id_story`
        LEFT JOIN `uprofile` ON `story`.`id_uprofile` = `uprofile`.`id_uprofile`
        WHERE 1=1");

        $currentStoryId = null; // Переменная для хранения текущего ID истории
        $images = []; // Массив для хранения изображений текущей истории

        while($row = $result->fetch_array()){
            // Проверяем, если это новая история
            if ($currentStoryId !== $row['id_story']) {
                // Выводим заголовок и текст истории
                
                /*Если это делать тут, будет юзиказия, потому что не найдет данные для вывода

                // echo('<h1 class="text-center">'.$row['naimstory'].'</h1>
                //       <p>'.$row['textstory'].'</p>');

                И вот тут, то все будет ок*/
            }
        
            // Если это не первая история, выводим предыдущую
            if ($currentStoryId !== null) {
                // Выводим карточку с историей
                echo ("<div class='col-md-12 mb-4'>
                        <div class='card'>
                            <div class='card-body'>");
        
                // Заголовок и текст истории
                if (!empty($row['naimstory']) && !empty($row['textstory'])) {
                    echo ("<h1 class='card-title text-center'>{$row['naimstory']}</h1>
                           <p class='card-text text-center'>{$row['textstory']}</p>");
                } else {
                    echo "<p>История не найдена.</p>";
                }
        
                // Выводим все изображения с заголовками и текстами
                foreach ($images as $image) {
                    $img = base64_encode($image['image']);
                    echo ("<div class='mb-4'>
                            <img src='data:image/jpeg;base64,{$img}' class='img-fluid mb-2' alt='story'>
                            <p>{$image['text']}</p>
                           </div>");
                }
        
                echo ("
                            </div>
                        </div>
                    </div>");
            }
        
            // Обновляем текущий ID истории и очищаем массив изображений
            $currentStoryId = $row['id_story'];
            $images = []; // Сбрасываем массив изображений
        
            // Если есть изображение, добавляем его в массив
            if (!empty($row['imagesstory'])) {
                $images[] = [
                    'image' => $row['imagesstory'],
                    'title' => $row['naimimages'],
                    'text' => $row['textimages']
                ];
            }
        }

        // Выводим последнюю историю после завершения цикла
        if ($currentStoryId !== null) {
            echo ("<div class='col-md-12 mb-4'>
                    <div class='card'>
                        <div class='card-body'>");

            // Заголовок и текст истории
            echo ("<h3 class='card-title'>{$row['naimstory']}</h3>
                   <p class='card-text'>{$row['textstory']}</p>");

            // Выводим все изображения с заголовками и текстами
            foreach ($images as $image) {
                $img = base64_encode($image['image']);
                echo ("<div class='mb-4'>
                        <h3>{$image['title']}</h3>
                        <img src='data:image/jpeg;base64,{$img}' class='img-fluid mb-2' alt='story'>
                        <p>{$image['text']}</p>
                       </div>");
            }

            echo ("
                        </div>
                    </div>
                </div>");
        }
        ?>
    </div>
</div>
<!-- Футер сайта -->
<?php
include('template/footer.php');
?>