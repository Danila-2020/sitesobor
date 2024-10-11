<?php
session_start();
include('template/uphotohead.php');
require_once('bd.php');
$id = $_SESSION['id'];
?>
<body>
    <div class="container">
        <div class="container py-5">
            <div class="row py-4">
              <div class="col-lg-6 mx-auto">
                <h1>Добавить фото</h1>
                <!-- Upload image input-->
            
                <form action="adduphotosubmit.php" method="post">
                    <?php
                    $query = "SELECT upublic.id_upublic, `upublic`.`naim`, `upublic`.`id_uprofile`, `uprofile`.`id_uprofile`, `uprofile`.`ulastname`, `uprofile`.`ufirstname`, `uprofile`.`upatronymic`
                            FROM `upublic`
                            INNER JOIN `uprofile` ON `upublic`.`id_uprofile` = `uprofile`.`id_uprofile`
                            WHERE `uprofile`.`id_uprofile` = $id
                            ORDER BY `upublic`.`id_upublic` ASC";
                    $result = $mysqli->query($query);
                    ?>
                    <h4>Выбрать публикацию</h4>
                    <select name="upublic" id="" class="form-control" style="margin-bottom: 2%;" required>
                        <?php
                        while($row = $result->fetch_assoc()) {
                            echo'<option value="'.$row['id_upublic'].'">'.$row['naim'].'</option>';
                        }
                        ?>
                    </select>
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    
                  <input id="upload" type="file" name="uphoto" onchange="readURL(this);" class="form-control border-0" required>
                  <label id="upload-label" for="upload" class="font-weight-light text-muted">Выберите файл</label>
                  <div class="input-group-append">
                   <label for="upload" class="btn btn-warning m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Выбрать</small></label>
                  </div>
                  <button type="submit" name="submit" class="btn btn-outline-dark" style="margin-left: 10px;">Загрузить</button>
                </div>
                </form>

                <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
              </div>
            </div>
          </div>
                    <!--Тут надо указать на какую страницу переходить-->
          <button type="submit" onclick="location.href='allupublic.php'" class="btn btn-outline-dark">Вернуться назад</button>
    </div>
<?php
include('template/uphotofooter.php');
?>