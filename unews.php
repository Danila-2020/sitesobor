<?php
// Страница новости (Все пользователи)

ob_start();
session_start();
require_once('bd.php');

include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>

<amp-analytics type="metrika">
    <script type="application/json">
        {
            "vars": {
                "counterId": "53592163"
            }
        }
    </script>
</amp-analytics>

<div class="relative page-wrap"><!-- page-wrap -->

<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
        <div class="land-see-hero-main mx-auto"></div>
    </section>
    <div class="max-width-4 mx-auto p2">
        <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
            <div class="clearfix p1">
                <div class="desk-logo-wrap mx-auto block">
                    <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
                </div>
            </div>
            <?php
            include('template/allnavbar.php');
            ?>
                <div class="social">
                    <ul class="social-share">
                        <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                        <li><a href="#"><i class="fa fa-vk"></i></a></li>
                        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
                <div class="container" style="margin-top:1%; margin-bottom:1%;">
                    <div class="clearfix">
                        <div class="md-col md-col-12 lg-col-12 p2">
                            <h2>Новости</h2>
                            <?php
                            // Получаем ID новости из GET-параметра
                            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                                echo "<p>Ошибка: Не указан корректный ID новости.</p>";
                                exit;
                            }

                            $idunews = intval($_GET['id']);

                            // Запрос для получения данных новости и связанных фотографий
                            $query = "
                                SELECT 
                                    `unews`.`id_unews`, 
                                    `unews`.`utitle`, 
                                    `unews`.`udescription`, 
                                    `unews`.`textunews`, 
                                    `unews`.`statusunews`, 
                                    `unews`.`dateunews`, 
                                    `unews`.`id_uprofile`,
                                    `uphotonews`.`id_uphotonews`, 
                                    `uphotonews`.`uphotonews`, 
                                    `uphotonews`.`id_unews`
                                FROM `unews`
                                LEFT JOIN `uphotonews` ON `unews`.`id_unews` = `uphotonews`.`id_unews`
                                WHERE `unews`.`id_unews` = $idunews
                            ";

                            $result = $mysqli->query($query);

                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                                // Вывод заголовка и описания новости
                                echo('
                                    <div class="col col-12">
                                        <h1>' . htmlspecialchars($row['utitle']) . '</h1>
                                    </div>
                                    <p>
                                        ' . htmlspecialchars($row['udescription']) . '
                                    </p>
                                ');

                                // Собираем все фотографии новости в массив
                                $photos = [];
                                do {
                                    if (!empty($row['uphotonews'])) {
                                        $photos[] = 'data:image/jpeg;base64,' . base64_encode($row['uphotonews']);
                                    }
                                } while ($row = $result->fetch_assoc());

                                // Если есть фотографии, выводим их в виде карусели
                                if (!empty($photos)) {
                                    echo('
                                        <div class="col col-12">
                                            <amp-carousel width="400" height="300" layout="responsive" type="slides" controls loop autoplay delay="3000">
                                                ' . implode('', array_map(function ($photo) {
                                                    return '<amp-img src="' . $photo . '" width="400" height="300" layout="responsive" alt="Фото"></amp-img>';
                                                }, $photos)) . '
                                            </amp-carousel>
                                        </div>
                                    ');
                                } else {
                                    // Если фотографий нет, выводим заглушку
                                    echo('
                                        <div class="col col-12">
                                            <img src="img/no_img.jpeg" class="img-fluid" alt="Нет изображений">
                                        </div>
                                    ');
                                }

                                // Возвращаем указатель результата к началу, чтобы получить текст новости
                                $result->data_seek(0);
                                $firstRow = $result->fetch_assoc();

                                echo('
                                    <p>
                                        ' . htmlspecialchars($firstRow['textunews']) . '
                                    </p>
                                ');

                            } else {
                                echo "<p>Новость не найдена.</p>";
                            }
                            ?>
                            <button type="submit" class="btn btn-primary" OnClick='window.location.href="index.php"'>Вернуться на главную</button>
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