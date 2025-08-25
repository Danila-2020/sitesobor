<?php
// Страница публикации (Все пользователи)

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
                        <h2>Публикация</h2>
                        <?php
                        $idupublic = $_SESSION['idupublic'];

                        // Запрос для получения данных публикации
                        $query = "
                            SELECT 
                                `upublic`.`id_upublic`, 
                                `upublic`.`naim`, 
                                `upublic`.`uptext`,
                                `upublic`.`statusupublic`
                            FROM `upublic`
                            WHERE `upublic`.`statusupublic` = 'active' AND `upublic`.`id_upublic` = $idupublic
                        ";

                        $result = $mysqli->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();

                            // Вывод заголовка и текста публикации
                            echo('
                                <div class="col col-12">
                                    <h1>' . htmlspecialchars($row['naim']) . '</h1>
                                </div>
                                <p>
                                    ' . htmlspecialchars($row['uptext']) . '
                                </p>
                            ');

                            // Запрос для получения фотографий, связанных с публикацией
                            $photoQuery = "
                                SELECT 
                                    `uphoto`.`id_uphoto`, 
                                    `uphoto`.`uphoto`
                                FROM `uphoto` 
                                WHERE `uphoto`.`id_upublic` = $idupublic
                            ";

                            $photoResult = $mysqli->query($photoQuery);

                            // Отладочная информация
                            if (!$photoResult) {
                                echo "<p>Ошибка при выполнении запроса к таблице uphoto: " . $mysqli->error . "</p>";
                            } elseif ($photoResult->num_rows === 0) {
                                echo "<p>Нет фотографий для публикации №$idupublic.</p>";
                            }

                            // Собираем все фотографии публикации в массив
                            $photos = [];
                            if ($photoResult && $photoResult->num_rows > 0) {
                                while ($photoRow = $photoResult->fetch_assoc()) {
                                    if (!empty($photoRow['uphoto'])) {
                                        $photos[] = [
                                            'src' => 'data:image/jpeg;base64,' . base64_encode($photoRow['uphoto']),
                                            'alt' => 'Фотография публикации'
                                        ];
                                    } else {
                                        echo "<p>Фотография для публикации №$idupublic пуста или повреждена.</p>";
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
                        ?>
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