<?php
session_start();
require_once('bd.php');
include('template/head.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
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
            //$query = "SELECT `id_scedule`, `titlescedule`, `imagescedule`, `sstatus`, `id_uprofile` FROM `scedule` WHERE `id_scedule` = $sid";
            //var_dump($query);
            //$result = $mysqli->query("SELECT `id_scedule`, `titlescedule`, `imagescedule`, `sstatus`, `id_uprofile` FROM `scedule` WHERE `id_scedule` = $sid");
            //while($result){
            //foreach ($variable as $key => $value) {
                
                /*foreach ($a as $k => $v) {
    echo "\$a[$k] => $v.\n";
}*/
            //$img = base64_encode($row['imagescedule']);
            ?>
            <form action="" method="post">
                <h3 class="text-center">Редактировать сведения о расписании</h3>
                <label for="utitle" >Название</label>
                <input type="text" name="titlescedule" value="<?php echo($row['titlescedule']);?>" class="form-control" required /><br>
                <label for="imagescedule">Изображение</label>
                <img src="data:image/jpeg;base64,<?=$img?>" alt="image" class="img-fluid"></img><br>
                <label for="uploadimg">Загрузить новое изображение</label>
                <input type="file" name="uploadimg" class="form-control" /><br>
                <button type="submit" name="updatesubmit" class="btn btn-primary">Сохранить изменения</button>
                <?php
                //};//Конец цикла

                /*if(isset($_POST['updatesubmit'])){
                    $titlescedule = $_POST['titlescedule'];
                    $img_type = substr($_FILES['uploadimg']['type'],0,5);
                    $img_size = 2*1024*1024;
                    if(!empty($_FILES['uploadimg'] ['tmp_name']) and (!empty($titlescedule) and ($img_type === 'image' and $_FILES['uploadimg']['size'] <= $img_size))){
                        $img = addslashes(file_get_contents($_FILES['uploadimg']['tmp_name']));
                        echo($img);
                        $query = ("UPDATE `scedule` SET `titlescedule`='$titlescedule',`imagescedule`='$img' WHERE `id_scedule` = $sid");
                        $result = $mysqli->query($query);
                    }
                }*/
                ?>
            </form>
           
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4"></div>
    </div>
    </div>
<!--Это ниже в Футере-->
</body>
</html>