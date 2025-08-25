<?php
// Страница отделы (Все пользователи)

ob_start();
session_start();
require_once('bd.php');

include('template/head.php');
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
            <div class="clearfix">
                <ul class="center h2 list-reset mt0 head-menu">
                    <li class="inline-block mr1">
                        <a href="scedule.php">Расписание богослужений</a>
                    </li>
                    <li class="inline-block mr1">
                        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
                    </li>
                    <li class="inline-block mr1">
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

                <ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
                    <li class="inline-block mr1">
                        <a class="" href="clergy.php">Духовенство</a>
                    </li>
                    <li class="inline-block mr1">
                        <a class="" href="story.php">История</a>
                    </li>
                    <li class="inline-block mr1">
                        <a class="" href="paintingalluser.php">Роспись</a>
                    </li>
                    <li class="inline-block mr1">
                        <a class="" href="alluotdel.php">Отделы</a>
                    </li>
                </ul>

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
                <div class="social">
                    <div class="container">
                        <?php include('template/social-icons.php'); ?>
                    </div>
                </div>
                <div class="container" style="margin-top:1%; margin-bottom:1%;">
                    <div class="clearfix">
                        <div class="md-col md-col-12 lg-col-12 p2">
                        <h2>Отделы</h2>
                        <?php
                        $idotdel = $_SESSION['id_otdel'];

                        // Запрос для получения данных отдела
                        $query = "
                            SELECT 
                                `otdel`.`id_otdel`, 
                                `otdel`.`naim_otdel`, 
                                `otdel`.`desc_otdel`,
                                `otdel`.`id_uprofile`,
                                `uphotootdel`.`id_uphotootdel`, 
                                `uphotootdel`.`uphotootdel`
                            FROM `otdel` 
                            LEFT JOIN `uphotootdel` ON `otdel`.`id_otdel` = `uphotootdel`.`id_otdel`
                            WHERE 1=1
                            AND `otdel`.`id_otdel` = '$idotdel'
                        ";

                        $result = $mysqli->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();

                            // Вывод названия и описания отдела
                            echo('
                                <div class="col col-12">
                                    <h1>' . htmlspecialchars($row['naim_otdel']) . '</h1>
                                </div>
                                <p>
                                    ' . htmlspecialchars($row['desc_otdel']) . '
                                </p>
                            ');

                            // Собираем все фотографии отдела в массив
                            $photos = [];
                            
                            // Первая фотография из основного запроса
                            if (!empty($row['uphotootdel'])) {
                                $photos[] = [
                                    'src' => 'data:image/jpeg;base64,' . base64_encode($row['uphotootdel']),
                                    'alt' => 'Фотография отдела'
                                ];
                            }

                            // Дополнительный запрос для получения всех фотографий отдела
                            $photoQuery = "
                                SELECT 
                                    `uphotootdel`.`id_uphotootdel`, 
                                    `uphotootdel`.`uphotootdel`
                                FROM `uphotootdel` 
                                WHERE 1=1
                            ";

                            $photoResult = $mysqli->query($photoQuery);

                            // Отладочная информация
                            if (!$photoResult) {
                                echo "<p>Ошибка при выполнении запроса к таблице uphotootdel: " . $mysqli->error . "</p>";
                            }

                            // Добавляем остальные фотографии
                            if ($photoResult && $photoResult->num_rows > 0) {
                                while ($photoRow = $photoResult->fetch_assoc()) {
                                    if (!empty($photoRow['uphotootdel'])) {
                                        $photos[] = [
                                            'src' => 'data:image/jpeg;base64,' . base64_encode($photoRow['uphotootdel']),
                                            'alt' => 'Фотография отдела'
                                        ];
                                    }
                                }
                            }

                            // Если есть фотографии, выводим их в виде карусели
                            if (!empty($photos)) {
                                echo('
                                    <div class="col col-12">
                                        <amp-carousel width="400" height="300" layout="responsive" type="slides" controls loop autoplay delay="3000">
                                            ' . implode('', array_map(function ($photo) {
                                                return '<amp-img src="' . $photo['src'] . '" width="400" height="300" layout="responsive" alt="' . $photo['alt'] . '"></amp-img>';
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
                        } else {
                            echo "Нет данных для отображения.";
                        }
                        ?><br>
                        <button type="submit" class="btn btn-primary" OnClick='window.location.href="index.php"' style="margin-top:5%;">Вернуться на главную</button>
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