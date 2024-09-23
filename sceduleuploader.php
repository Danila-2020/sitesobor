<?php
session_start();

//include('template/head.php');
include('template/head2.php');
//include('template/uploadnav.php');
require_once('bd.php');
$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
}

?>
<link rel="stylesheet" href="css/style2.css">
<body>
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>

<form action="scedulesubmit.php" method="POST" enctype="multipart/form-data">

    <div class="frame">
        <div class="center">
            <div class="title">
                <h1>Загрузить новое расписание</h1>
            </div>
            <input type="text" name="titlescedule" placeholder="Заголовок" class="form-control" required /><br>
            <div class="dropzone">
                <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
                <input type="file" name="imagescedule" class="upload-input" required />
            </div>
            <button type="submit" class="btn" name="uploadbutton">Загрузить файл</button>
        </div>
    </div>
        <!--Копированный код-->
        <!--<input type="file" name="imagescedule" required /><br>-->
        </form>
</div><!--content-wrap relative-->
<div class="container">
    <h2 class="text-center">Расписания</h2>
    <form action="sceduleuploader.php" method="post">
    <label htmlFor="">Сортировка</label>
    <select id="" name="sstatus" value="active">
        <option value="active">Активные</option>
        <option value="deleted">Удалённые</option>
    </select>
    <button type="submit" name="submit" class="btn btn-primary">Найти</button>
    <?
    $query = "SELECT * FROM `scedule` INNER JOIN `uprofile` ON `scedule`.`id_uprofile` = `uprofile`.`id_uprofile` WHERE 1=1";//Черновой запрос для проверки
    $active = ' AND `scedule`.`sstatus` ="active"'; //Для активных записей
    $deleted = ' AND `scedule`.`sstatus` ="deleted"'; //Для удалённых записей
    if(isset($_POST['submit'])){
        $sstatus = $_POST['sstatus'];
        $query = $query;//Возвращаем исходный запрос
        if($sstatus == "active"){
            $query = $query.$active;
            //$query .= $active;
            //var_dump($query);
        }
        if($sstatus == "deleted"){
            $query = $query.$deleted;
            //$query .= $deleted;
            //var_dump($query);
        }
        var_dump($query);
        //var_dump($sstatus);
    }
    ?>
    </form>
    <table class="table table-striped">
        <tr style="font-weight:bold;">
            <td>ID</td>
            <td>Название</td>
            <td>Статус</td>
            <td>Добавил</td>
            <td>Действие</td>
        </tr>
        <?php
        if(isset($_POST['submit'])){
            $sstatus = $_POST['sstatus'];
            if($sstatus == "active"){
                $query = $query.$active; //$query = $query.$active;
                var_dump($querys);
            }
            if($sstatus == "deleted"){
                $query .= $query.$deleted; //$query = $query.$deleted;
                var_dump($querys);
            }
            var_dump($query);
            //var_dump($sstatus);
        }
        //Проверка скопирована сверху
        $active .= ' AND `scedule`.`sstatus` ="active"'; //Для активных записей
        $deleted .= ' AND `scedule`.`sstatus` ="deleted"'; //Для удалённых записей
        $result = $mysqli->query($query);
        var_dump("query: ".$query);
        while($row = $result->fetch_array()){
            echo('<tr>
            <td>'.$row['id_scedule'].'</td>
            <td>'.$row['titlescedule'].'</td>
            <td>');?><?php if($row['sstatus']=="active"){
                echo("Активный");
            }; if($row['sstatus']=="deleted"){
                echo("Удалённый");
            }; ?><?php echo('</td>
            <td>'.$row['ulastname']." ".$row['ufirstname'].'</td>
            <td><form method="POST" action=""><input type="hidden" name="id" value="'.$row['id_scedule'].'"></input>
            '); if($row['sstatus']=="active"){
                echo('<button type="submit" name="submit" class="btn btn-primary">Редактировать</button>');
            };
            if($row['sstatus']=="deleted"){
                echo('<button type="submit" name="submit" class="btn btn-primary">Восстановить</button>');
            }; 
            echo('</form>');?>
            <?php
            if($row['sstatus']=="active"){
                echo('<form method="POST" action=""><input type="hidden" name="id" value="'.$row['id_scedule'].'"></input>
            <button type="submit" name="submit" class="btn btn-danger">Удалить</button>
            </form>');
            };?>
            <?php echo('</td>');
        }
        ?>
    </table>
</div>
<?php
include('template/footerupload.php');
?>