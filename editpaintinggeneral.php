<?php
// Редактирование Росписи (пользователь General)

session_start();

include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

require_once('bd.php');

?>

<body>
    <?php
    include('template/generalheader.php')
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
    <h1 class="text-center">Роспись</h1>
        <?php    
    $query = ("SELECT `painting`.`id_painting`, `painting`.`npainting`, `painting`.`descpainting`, 
    `painting`.`id_uprofile`,`imgpainting`.`id_imgpainting`, `imgpainting`.`naimimgpainting`, 
    `imgpainting`.`textimgpainting`, `imgpainting`.`images`, `imgpainting`.`imagesstatus`, 
    `imgpainting`.`id_painting` 
    FROM `painting`
    RIGHT JOIN `imgpainting` ON `imgpainting`.`id_painting` = `painting`.`id_painting`
    WHERE 1=1");
    $descquery =("SELECT `painting`.`id_painting`,`painting`.`descpainting`, 
    `painting`.`id_uprofile` 
    FROM `painting`
    INNER JOIN `imgpainting` ON `imgpainting`.`id_painting` = `painting`.`id_painting`
    WHERE 1=1
    LIMIT 1");
    $resultdesc = $mysqli->query($descquery);
    while($rowdesc = $resultdesc->fetch_assoc()){
    ?>
    <h2>Редактирование описания</h2>
        <form action="save_description.php" method="post">
            <div class="form-group">
                <input type="hidden" name="hidden" value="<?php echo($rowdesc['id_painting']);?>">
                <textarea id="descpainting" name="descpainting" cols="1" rows="6" class="form-control"><?php echo htmlspecialchars($rowdesc['descpainting']); ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить описание</button>
        </form>
    <?php
    }//Конец цикла
    $i = 0;
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){
        $img = base64_encode($row['images']);
        ?>
        <form action="updpaintinggensubmit.php" method="post" enctype="multipart/form-data">
            <?php $i = $row['id_imgpainting']?>
            <div class="form-group">
                <h2>Название</h2>
                <input type="hidden" name="id" value="<?php echo($i);?>">
                <input type="text" name="naimimgpainting" value="<?php echo($row['naimimgpainting']); ?>" placeholder="Название" class="form-control" required/><br>
                <textarea name="textimgpainting" cols="1" rows="6" class="form-control" placeholder="Текст"><?php echo($row['textimgpainting']);?></textarea>
                <h2>Изображение</h2>
                <?php
                if(!empty($row['images'])){
                    echo '<img class="center-img img-fluid" src="data:image/jpeg;base64,'.$img.'"></img>';
                }else{
                    echo '<img class="center-img" src="img/no-image.png" class="img-fluid"></img>';
                }
                ?>
                <label for="newimg">Редактировать изображение</label>
                <input type="file" name="newimg" id="newimg" class="form-control"/><br>
                <button type="submit" name="submit" class="btn btn-primary">Изменить сохранение</button>
            </div>
        </form>
    <?php
    }
    ?>
        
    
</div>

<?php
include('template/footer3.php');
?>