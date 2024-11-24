<?php
//Просмотр публикации(Все пользователи)

session_start();//Тут идёт session_start();, он наверное не нужен
ob_start();
require_once('bd.php');

$id = $_POST['id'];
$_SESSION['id'] = $id;

if(empty($id)){
    header('Location: index.php');
}

include('template/head.php');
include('template/barber.php');
include('template/nav.php');
?>
<div class="container">
<div class="clearfix">
    <div class="md-col md-col-12 lg-col-12 p2">
        <h2>Публикации</h2>
        <?php
        $query = ("SELECT `upublic`.`id_upublic`, `upublic`.`naim`, 
                    `upublic`.`uptext`, `upublic`.`statusupublic`, 
                    `uphoto`.`uphoto`
                    FROM `upublic` 
                    LEFT JOIN `uphoto` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic` 
                    WHERE `upublic`.`statusupublic` = 'active' AND `upublic`.`id_upublic` = $id");
        
        $result = $mysqli->query($query);

        // Создаем массив для хранения всех фотографий
        $photos = [];
        $name = '';
        $uptext = '';

        while ($row = $result->fetch_array()) {
            // Сохраняем название публикации и текст
            if (empty($name)) {
                $name = $row['naim'];
            }
            if (empty($uptext)) {
                $uptext = $row['uptext'];
            }
            // Добавляем фотографию в массив
            if (!empty($row['uphoto'])) {
                $photos[] = base64_encode($row['uphoto']);
            }
        }
        ?>

        <div class="col col-12">
            <h1><?php echo $name; ?></h1>

            <?php if (!empty($photos)): ?>
                <div id="photoCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($photos as $index => $img): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="data:image/jpeg;base64,<?= $img ?>" class="d-block w-100" alt="Фото">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#photoCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#photoCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <?php else: ?>
                <img src="../img/no_img.jpeg" alt="Нет изображения" class="img-fluid">
            <?php endif; ?>

            <!-- Выводим текст публикации один раз после фотогалереи -->
            <p><?php echo $uptext; ?></p>
        </div>

        <form action="allupublic.php" method="post">
            <button type="submit" name="submit" class="btn btn-primary">Вернуться назад</button>
        </form>
    </div>
</div>

</div>
<?php
include('template/footer.php');
?>