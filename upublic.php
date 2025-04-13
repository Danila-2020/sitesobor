<?php
// Просмотр публикации (Все пользователи)

session_start(); // Стартуем сессию
ob_start(); // Включаем буферизацию вывода
require_once('bd.php'); // Подключаем файл базы данных

include('template/head.php'); // Подключаем шаблон head.php
include('template/barber.php'); // Подключаем шаблон barber.php
include('template/nav.php'); // Подключаем шаблон nav.php

// Выводим стили
echo getStyles();
?>
<div class="container">
    <div class="clearfix">
        <div class="md-col md-col-12 lg-col-12 p2">
            <h2>Публикации</h2>
            <?php
            // Проверяем, установлен ли ID публикации в сессии
            if (empty($_SESSION['idupublic'])) {
                header('Location: index.php');
                exit();
            }

            $idupublic = $_SESSION['idupublic'];

            // Формируем SQL-запрос
            $query = "
                SELECT 
                    `upublic`.`id_upublic`, 
                    `upublic`.`naim`, 
                    `upublic`.`uptext`,
                    `upublic`.`statusupublic`, 
                    `uphoto`.`uphoto`
                FROM `upublic` 
                LEFT JOIN `uphoto` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic` 
                WHERE `upublic`.`statusupublic` = 'active' AND `upublic`.`id_upublic` = $idupublic
            ";

            // Выполняем запрос
            $result = $mysqli->query($query);

            // Проверяем, есть ли данные в результате
            if ($result && $result->num_rows > 0) {
                // Обрабатываем каждую строку результата
                while ($row = $result->fetch_assoc()) {
                    // Кодируем изображение в base64, если оно существует
                    $img = '';
                    if (!empty($row['uphoto'])) {
                        $img = 'data:image/jpeg;base64,' . base64_encode($row['uphoto']);
                    } else {
                        $img = 'img/no_img.jpeg'; // Заглушка, если изображение отсутствует
                    }

                    // Выводим данные
                    echo('
                        <div class="col col-12">
                            <h1>' . htmlspecialchars($row['naim']) . '</h1>
                        </div>
                        <!--__-__-->
                        <div class="col col-12">
                            <img src="' . $img . '" class="img-fluid" layout="responsive">
                        </div>
                        <p>
                            Описание: ' . htmlspecialchars($row['uptext']) . '
                        </p>
                    ');
                }
            } else {
                // Если данных нет, выводим сообщение
                echo "Нет данных для отображения.";
            }
            ?>
            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Вернуться на главную</button>

            <div class="col col-12">
                <h1><?php echo htmlspecialchars($name); ?></h1>

                <?php if (!empty($photos)): ?>
                    <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($photos as $index => $img): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="data:image/jpeg;base64,<?= htmlspecialchars($img) ?>" class="d-block w-100" alt="Фото">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#photoCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <?php else: ?>
                    <img src="../img/no_img.jpeg" alt="Нет изображения" class="img-fluid">
                <?php endif; ?>

                <!-- Выводим текст публикации один раз после фотогалереи -->
                <p><?php echo htmlspecialchars($uptext); ?></p>
            </div>

            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Вернуться на главную</button>
        </div>
    </div>
</div>
<?php
include('template/footer.php'); // Подключаем шаблон footer.php
?>