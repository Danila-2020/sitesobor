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
                echo("<script>alert('Отсутствует ID публикации!!!');</script>");
                exit();
            }

            $idupublic = $_SESSION['idupublic'];

            // Формируем SQL-запрос для получения данных публикации
            $query = "
                SELECT 
                    `upublic`.`id_upublic`, 
                    `upublic`.`naim`, 
                    `upublic`.`uptext`,
                    `upublic`.`statusupublic`
                FROM `upublic`
                WHERE `upublic`.`statusupublic` = 'active' AND `upublic`.`id_upublic` = $idupublic
            ";

            // Выполняем запрос
            $result = $mysqli->query($query);

            // Проверяем, есть ли данные в результате
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Выводим основной текст публикации
                echo('
                    <div class="col col-12">
                        <h1>' . htmlspecialchars($row['naim']) . '</h1>
                    </div>
                    <p>
                        Описание: ' . htmlspecialchars($row['uptext']) . '
                    </p>
                ');
            } else {
                echo "Нет данных для отображения.";
                exit();
            }

            // Формируем SQL-запрос для получения фотографий и их текстов
            $photoQuery = "
                SELECT 
                    `uphoto`.`uphoto`, 
                    `uphoto`.`description`
                FROM `uphoto` 
                WHERE `uphoto`.`id_upublic` = $idupublic
            ";

            // Выполняем запрос
            $photoResult = $mysqli->query($query);

            // Проверяем, есть ли фотографии
            if ($photoResult && $photoResult->num_rows > 0) {
                // Создаем массив для хранения фотографий и текстов
                $photos = [];
                while ($photoRow = $photoResult->fetch_assoc()) {
                    $imageData = $photoRow['uphoto'];
                    $imageBase64 = '';
                    if (!empty($imageData)) {
                        // Проверяем, является ли данные изображением
                        if (@exif_imagetype('data://application/octet-stream;base64,' . base64_encode($imageData))) {
                            $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($imageData);
                        } else {
                            $imageBase64 = 'img/no_img.jpeg'; // Заглушка, если данные не являются изображением
                        }
                    } else {
                        $imageBase64 = 'img/no_img.jpeg'; // Заглушка, если данные пустые
                    }

                    $photos[] = [
                        'image' => $imageBase64,
                        'text' => htmlspecialchars($photoRow['description'])
                    ];
                }
            } else {
                $photos = []; // Нет фотографий
            }
            ?>

            <!-- Карусель -->
            <div class="col col-12">
                <?php if (!empty($photos)): ?>
                    <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($photos as $index => $photo): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="<?php echo $photo['image']; ?>" class="d-block w-100" alt="Фото">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p><?php echo $photo['text']; ?></p>
                                    </div>
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
                    <img src="img/no_img.jpeg" alt="Нет изображения" class="img-fluid">
                <?php endif; ?>
            </div>

            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Вернуться на главную</button>
        </div>
    </div>
</div>
<?php
include('template/footer2.php'); // Подключаем шаблон footer.php
?>