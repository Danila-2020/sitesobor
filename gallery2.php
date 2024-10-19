<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root"; // Замените на ваше имя пользователя
$password = ""; // Замените на ваш пароль
$dbname = "sobor"; // Замените на имя вашей базы данных

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запрос к базе данных
$sql = "SELECT `uphoto`.`id_uphoto`, `uphoto`.`uphoto`, `uphoto`.`uphotostatus`, `uphoto`.`id_upublic`, `upublic`.`naim` FROM `uphoto` 
INNER JOIN `upublic` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic`
WHERE 1=1";
//var_dump($sql);//Смотрим запрос

$result = $mysqli->query($sql);

$images = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = base64_encode($row['uphoto']); // $images[] = $row['uphoto'];
    }
} else {
    echo "Нет изображений";
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фотогалерея</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- <div class="container mt-5" style="margin-bottom: 5%;">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4">
            <form action="" method="post" class="form-group">
            <h1>Поиск публикации</h1>
            <input type="text" name="nupublic" id="" class="form-control" required /><br>
            <button type="submit" name="submit" class="btn btn-outline-primary">Поиск</button>
            <?php
            // if(isset($_POST['submit'])){
            //     $nupublic = $_POST['nupublic'];
            //     $and = " AND `upublic`.`naim` LIKE '%".$nupublic."%'";
            //     $sql .= $and;
            //     var_dump($sql);//Смотрим запрос
            // }
            ?>
            </form>
        </div>
    </div>

</div> -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Фотогалерея</h1>
    <div id="photoCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <?php 
            foreach ($images as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="data:image/jpeg;base64,<?= $image ?>" class="d-block w-100" alt="Изображение <?= $index + 1 ?>">
                    <form action="" method="post" style="margin-top: 1%;">
                        <button type="submit" class="btn btn-primary" style="float: right;">Удалить</button>
                    </form>
                    <div class="carousel-caption">
                        <h1>Image</h1>
                        <p>This is a demo for the Bootstrap Carousel Guide.</p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <a class="carousel-control-prev" href="#photoCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Предыдущее</span>
        </a>
        <a class="carousel-control-next" href="#photoCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Следующее</span>
        </a>
        <ol class="carousel-indicators">
            <?php foreach ($images as $index => $image): ?>
                <li data-target="#photoCarousel" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>