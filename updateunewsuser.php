<?php
// Форма обновления Новости (Пользователь User)

session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}
//$idunews = $_POST['id'];
?>
<div class="container">
    <?php
    if(empty($_SESSION['idunews'])){
    $idunews = $_POST['id'];//Получить ID новости
    $_SESSION['idunews'] = $idunews;//Передать ID новости
    }else if(!empty($_SESSION['idunews'])){
        $idunews = $_SESSION['idunews'];//Передать ID новости
        }
    $query = "SELECT `id_unews`, `utitle`, `udescription`, `textunews`, `statusunews`, `dateunews`, `id_uprofile` FROM `unews` WHERE `id_unews` = $idunews";
    //var_dump($query);
    $result = $mysqli->query($query);
    while($row=$result->fetch_array()){
    ?>
    <form action="updateunewsgeneralsubmit.php" method="post" class="form-group">
        <h2 class="text-center">Редактирование новости</h2>
        <label for="utitle">Название</label>
        <input type="text" name="utitle" class="form-control" value="<?php echo($row['utitle']);?>" required />
        <label for="udescription">Описание</label>
        <textarea name="udescription" rows="5" class="form-control" value="<?php echo($row['udescription']);?>"><?php echo($row['udescription']);?></textarea>
        <label for="textunews">Текст после изображений</label>
        <textarea name="textunews" rows="5" class="form-control" value="<?php echo($row['textunews']);?>"><?php echo($row['textunews']);?></textarea>
        <label for="dateunews">Дата</label>
        <input type="date" name="dateunews" value="<?php echo($row['dateunews']);?>" class="form-control" /><br>
        <button type="submit" name="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
    <form action="" method="post">
        <button type="submit" name="exit" class="btn btn-danger">Вернуться назад</button>
        <?php
            if(isset($_POST['exit'])){
                $_SESSION['idunews'] = "";
                echo('<script>window.location.href="viewunewsuser.php"</script>');
            }
        ?>
    </form>
    <br>
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