<?php
// Страница просмотра Росписи(Все пользователи)

// session_start();

include('template/scedulehead.php');
include('template/barber.php');
require_once('bd.php');

// Выводим стили
echo getStyles();
?>
<body>
    <?php
    include('template/allnavbar.php');
    ?>
<div class="container" style="margin-top: 1%; margin-bottom: 5%;"><!--py-5-->
<!-- Центрирование изображений -->
<style>
.center-img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
    <div class="container">
    <?php
    $query = ("SELECT `painting`.`id_painting`, `painting`.`npainting`, `painting`.`descpainting`, 
    `painting`.`id_uprofile`, `imgpainting`.`id_imgpainting`, `imgpainting`.`naimimgpainting`, 
    `imgpainting`.`textimgpainting`, `imgpainting`.`images`, `imgpainting`.`imagesstatus`, 
    `imgpainting`.`id_painting` 
    FROM `painting`
    LEFT JOIN `imgpainting` ON `imgpainting`.`id_painting` = `painting`.`id_painting`
    WHERE 1=1");
    
$result = $mysqli->query($query);
$hasImages = false;
$descriptionDisplayed = false;

echo('<h1 class="text-center">Роспись</h1>');
echo('<div class="container">');
echo('  <div class="row">');

while($row = $result->fetch_assoc()) {
    // Выводим описание только один раз слева
    if (!$descriptionDisplayed) {
        echo('    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">');
        echo('      <p>'.$row['descpainting'].'</p>');
        echo('    </div>');
        $descriptionDisplayed = true;
    }
    
    // Выводим изображения справа
    if (!empty($row['images'])) {
        echo('    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">');
        $img = base64_encode($row['images']);
        echo('      <img src="data:image/jpeg;base64, '.$img.'" class="img-fluid"></img>');
        if (!empty($row['textimgpainting'])) {
            echo('      <p>'.$row['textimgpainting'].'</p>');
        }
        echo('    </div>');
        $hasImages = true;
    }
}

// Если изображений нет, закрываем row и container
if (!$hasImages) {
    echo('    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"></div>'); // Пустая колонка для баланса
}

echo('  </div>');
echo('</div>');
    ?>
    </div>
</div>

<?php
include('template/footer3.php');
?>