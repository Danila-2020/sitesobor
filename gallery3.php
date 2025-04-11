<?php
// Тестовая галерея изображений 3

// Подключение к базе данных
$servername = "localhost"; // Ваш сервер
$username = "root"; // Ваше имя пользователя
$password = ""; // Ваш пароль
$dbname = "sobor"; // Имя базы данных

// Создание соединения
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Запрос к базе данных
$sql = "SELECT `imgactivity`.`id_imgactivity`, `imgactivity`.`images`, `imgactivity`.`naimimgactivity`, 
`imgactivity`.`textimgactivity`, `imgactivity`.`imgstatus`, `imgactivity`.`id_activity` 
FROM `imgactivity`
INNER JOIN `activity` ON `imgactivity`.`id_activity` = `activity`.`id_activity`
INNER JOIN `uprofile` ON `activity`.`id_uprofile` = `uprofile`.`id_uprofile`
WHERE 1=1";
$result = $mysqli->query($sql);

// Выводим стили
echo getStyles();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фотогалерея</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Фотогалерея</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            // Вывод данных каждой строки
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<a href="' . $row["image_path"] . '" data-lightbox="gallery" data-title="' . $row["naimimgactivity"] . '">';
                echo '<img src="' . $row["image_path"] . '" class="img-fluid" alt="' . $row["description"] . '">';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "0 результатов";
        }
        $mysqli->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>