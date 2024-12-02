<?php
// Страница редактирования духовенства(Пользователь general)

session_start();
ob_start();
require_once('bd.php');

$id = $_POST['hiddenid'];
if(empty($id)){
    header('Location: genclergy.php');
}


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование Духовенства</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Редактирование Духовенства</h1>
        <?php
        $query = "SELECT `id_clergy`, `titleclergy`, `imagesclergy`, `textclergy`, `datesclergy`, `educlergy`, 
        `awardsclergy`, `id_uprofile` 
        FROM `clergy` 
        WHERE `id_clergy` = $id";
        $result = $mysqli->query($query);
        while($row = $result->fetch_assoc()){
        ?><div class="row" style="margin-bottom:5%;">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <form action="editclergygensubmit.php" method="post" enctype="multipart/form-data" style="margin-bottom:5%;">
            <div class="form-group">
                <label for="titleclergy">ФИО</label>
                <input type="text" class="form-control" id="titleclergy" name="titleclergy" value="<?php echo($row['titleclergy'])?>" required>
            </div>
            <div class="form-group">
                <label for="imagesclergy">Изображение</label>
                <?php
                if(!empty($row['imagesclergy'])){
                    $img = base64_encode($row['imagesclergy']);?>
                    <img src="data:image/jpeg;base64,<?php echo $img; ?>" alt="" class="img-fluid"><br>
                <?php
                }else{
                ?>
                <img src="img/no_img.jpeg" alt="" class="img-fluid">
                <?php }?><br>
                <input type="file" class="form-control-file" id="imagesclergy" name="imagesclergy">
            </div>
            <div class="form-group">
                <label for="textclergy">Биография</label>
                <textarea class="form-control" id="textclergy" name="textclergy" required><?php echo($row['textclergy']);?></textarea>
            </div>
            <div class="form-group">
                <label for="datesclergy">Дата рождения</label>
                <input type="date" class="form-control" id="datesclergy" name="datesclergy" value="<?php echo($row['datesclergy']);?>" required>
            </div>
            <div class="form-group">
                <label for="educlergy">Образование</label>
                <textarea class="form-control" id="educlergy" name="educlergy" required><?php echo($row['educlergy']);?></textarea>
            </div>
            <div class="form-group">
                <label for="awardsclergy">Награды</label>
                <textarea class="form-control" id="awardsclergy" name="awardsclergy" required><?php echo($row['awardsclergy']);?></textarea>
            </div>
            <input type="hidden" name="id_clergy" value="<?php echo ($id); ?>">
            <button type="submit" name="submit" class="btn btn-primary">Обновить</button>
        </form>
        <button type="submit" name="submit" OnClick='window.location.href="generalprofile.php"' class="btn btn-success">Вернуться назад</button>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
        </div>
        <?php
        }
        ?>
        
    </div>
</body>
</html>