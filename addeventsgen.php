<?php
/* Добавление мероприятий general*/
session_start();
require_once('bd.php');
// include('template/head.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="signin.php"</script>');
}
?>
<style>
body{background-image:url('img/background3.jpg');};
</style>
<body>
    <?php
    include('template/generalheader.php');
    ?>
    <div class="container" style="margin-top:30px">
        <div class="row" style="margin-bottom:5%;">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <form action="submitaddeventsgen.php" method="post" class=""><!-- style="border:1px solid #000000; border-radius:15px;"
                Бордер обрамление наверное жопное, хотя незнаю-->
            <h3>Добавление мероприятия</h3>
            <input type="text" name="caption" placeholder="Введите название" class="form-control" required /><br>
            <textarea rows="5" cols="1" name="description" placeholder="Введите описание" class="form-control"></textarea><br>
            <label for="dateunews">Дата проведения</label>
            <input type="date" name="datep" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
            </form>
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <!--Тут будут мероприятия-->
            </div>
        </div>
      </div>
    <hr>
    <?php
    include('template/footer.php');
    ?>