<?php
session_start();
require_once('bd.php');
include('template/head.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    if(empty($id)){
        echo('<script>widow.location.href="sceduleuploader.php";</script>');
    }
    $_SESSION['idscedule'] = $id;
    $sid = $_SESSION['idscedule'];
    var_dump($sid);
};
?>
<body>
    <div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4"></div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4">
            <?php
            $query = "SELECT `scedule`.`id_scedule`, `scedule`.`titlescedule`, `scedule`.`imagescedule`, `scedule`.`sstatus`, `uprofile`.`ulastname`, `uprofile`.`ufirstname`, `uprofile`.`upatronymic` 
                    FROM `scedule` 
                    INNER JOIN `uprofile` ON `scedule`.`id_uprofile` = `uprofile`.`id_uprofile`
                    WHERE `id_scedule` = $sid";//Запрос для выборки всех записей из таблицы sceduleи записи из таблицы uprofile, в которых id_uprofile = id_uprofile
            //var_dump($query);
            $result = $mysqli->query($query);
            while($row = $result->fetch_assoc()){
                $img = base64_encode($row['imagescedule']);
                ?>
                <form action="sceduleupdatesubmit.php" method="post" enctype="multipart/form-data">
                <h3 class="text-center">Редактировать сведения о расписании</h3>
                <label for="utitle" >Название</label>
                <input type="text" name="titlescedule" value="<?php echo($row['titlescedule']);?>" class="form-control" required /><br>
                <label for="imagescedule">Изображение</label>
                <img src="data:image/jpeg;base64,<?=$img?>" alt="image" class="img-fluid"></img><br>
                <label for="uploadimg">Загрузить новое изображение</label>
                <input type="file" name="uploadimg" class="form-control" /><br>
                <input type="hidden" name="id" value="<?php echo($id);?>" />
                <button type="submit" name="submit" class="btn btn-primary">Сохранить изменения</button>
            </form>
                <?php
            }
            ?>
            
            <br>
           <button type="submit" name="back" OnClick='location.href="sceduleuploader.php"' class="btn btn-danger">Вернуться назад</button>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4"></div>
    </div>
    </div>
<!--Это ниже в Футере-->
</body>
</html>