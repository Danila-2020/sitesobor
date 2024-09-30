<?php
session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
$idunews = $_POST['id'];
?>
<div class="container">
    <?php
    $idunews = $_POST['id'];
    $query = "SELECT `id_unews`, `utitle`, `udescription`, `textunews`, `statusunews`, `dateunews`, `id_uprofile` FROM `unews` WHERE `id_unews` = $idunew";
    $result = $mysqli->query($query);
    while($row=$result->fetch_array()){
    ?>
    <form action="updateunewsadminsubmit.php" method="post" class="form-group">
        <h2 class="text-center">Редактирование новости</h2>
        <label for="utitle">Название</label>
        <input type="text" name="utitle" class="form-control" value="<?php echo($row['utitle']);?>" required />
        <label for="udescription">Описание</label>
        <textarea name="udescription" rows="5" class="form-control" value="<?php echo($row['udescription']);?>"></textarea>
        <label for="textunews">Текст после изображений</label>
        <textarea name="textunews" rows="5" class="form-control" value="<?php echo($row['textunews']);?>"></textarea><br>
        <button type="submit" name="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
    <?php
    };//Конец цикла
    ?>
</div>
<div class="jumbotron text-center">
    <p style="font-weight:bold; font-style:itallic;">
    <b><i>&copy; Колодочкин Алексей<br>
    Дробилко Данила</i></b>
    </p>
</div>