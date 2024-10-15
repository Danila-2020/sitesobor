<?php
session_start();
include('template/sceduleuploaderhead.php');
require_once('bd.php');
?>
<div class="container py-5">
  <div class="row py-4">
    <div class="col-lg-6 mx-auto">
		<form action="#" method="post">
		<h2>Загрузить новое расписание</h2>
		<input type="text" name="" placeholder="Заголовок" class="form-control" required /><br>
      <!-- Upload image input-->
	  <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
		<input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
		<label id="upload-label" for="upload" class="font-weight-light text-muted">Выберите файл</label>
		<div class="input-group-append">
		 <label for="upload" class="btn btn-warning m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Выбрать</small></label>
		</div>
	  </div>
	  <!-- Uploaded image area-->
	  <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
	  <!--<div class="image-area mt-4" style="margin-bottom: 1%;"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>-->
	  <button type="submit" class="btn btn-warning" style="float: right;">Загрузить</button>
	  </form>
	  <!--Конец формы-->
    </div>
  </div>
</div>
<div class="container" style="margin-top: 1%; margin-bottom: 1%;">
	<h1 class="text-center">Расписания</h1>
	<table class="table table-striped">
		<tr style="font-weight: bold; font-style: italic;">
			<td>ID</td>
			<td>Заголовок</td>
			<td>Статус</td>
			<td>Загрузил</td>
			<td>Действие</td>
		</tr>
        <?php
        $query="SELECT `scedule`.`id_scedule`, `scedule`.`titlescedule`, `scedule`.`imagescedule`, `scedule`.`sstatus`, `uprofile`.`ulastname`,`uprofile`.`ufirstname` 
                FROM `scedule` 
                INNER JOIN `uprofile` ON `scedule`.`id_uprofile` = `uprofile`.`id_uprofile` 
                WHERE 1=1";
        $result = $mysqli->query($query);
        //$_SESSION['idscedule'] 
        while($row=$result->fetch_array()){

            $uname = ($row['ulastname']." ".$row['ufirstname']);
            echo('<tr>
            <td>'.$row['id_scedule'].'</td>
            <td>'.$row['titlescedule'].'</td>
            <td>'.$row['sstatus'].'</td>
            <td>'.$uname.'</td>
            <td><form method="POST" action="sceduleupdate.php"><input type="hidden" name="id" value="'.$row['id_scedule'].'"></input>
            '); if($row['sstatus']=="active"){
                echo('<button type="submit" name="submit" class="btn btn-primary" style="margin-bottom:5%;">Редактировать</button>');
            };
            if($row['sstatus']=="deleted"){
                echo('<form method="POST" action="scedulerecoverysubmit.php">
                <input type="hidden" name="id" value="'.$row['id_scedule'].'"></input>
                <button type="submit" name="submit" class="btn btn-success" style="margin-bottom:5%;">Восстановить</button>');
            }; 
            echo('</form>');
            
            ?>
            <?php
            if($row['sstatus']=="active"){
                echo('<form method="POST" action="sceduledeletesubmit.php"><input type="hidden" name="id" value="'.$row['id_scedule'].'"></input>
            <button type="submit" name="submit" class="btn btn-danger">Удалить</button>
            </form>');
            };?>
            <?php echo('</td>');
        //}
            echo('</tr>');
        }
        ?>
		<!--<tr>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
		</tr>-->
	</table>
	<button type="submit" class="btn btn-warning"><a href="userprofile.php" style="text-decoration: none; color: #000000;">На главную</a></button>
</div>

<?php
include('template/sceduleuploaderfooter.php');
?>