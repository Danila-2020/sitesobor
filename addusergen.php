<?php
// Страница добавления пользователя(Пользователь General)
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
?>
<style>
body{background-image:url('img/background3.jpg');};
</style>
<body>
    <?php
        include('template/generalheader.php');
    ?>
    
    <div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
          <h2>Добавить нового пользователя</h2>
            <form action="addusergensubmit.php" method="post">
            <?php
            $result = $mysqli->query("SELECT `id_uprofile`, `ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`, `uvisible`, `uphoto` FROM `uprofile` WHERE `id_uprofile`=$id");
            while($row = $result->fetch_array()){
                $img = base64_encode($row['uphoto']);
                ?>
            <div class="fakeimg">
                <img src="img/no_img — копия.jpeg" alt="" class="img-fluid">
            </div>
            <label for="ulastname">Фамилия</label>
            <input type="text" name="ulastname" placeholder="Фамилия" class="form-control" required />
            <label for="ufirstname">Имя</label>
            <input type="text" name="ufirstname" placeholder="Имя" class="form-control" required />
            <label for="ulastname">Отчество</label>
            <input type="text" name="upatronymic" placeholder="Отчество" class="form-control" />
            <label for="uemail">E-Mail - Адрес</label>
            <input type="text" name="uemail" placeholder="E-Mail Адрес" class="form-control" required />
            <label for="urole">Роль пользователя</label>
            <select name="urole" id="" class="form-control" value="user" required>
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
            </select>
            <label for="uphone">Номер телефона</label>
            <input type="text" name="uphone" placeholder="+7(999)999-99-99" id="phone" class="form-control" required />
            <label for="ulogin">Логин</label>
            <input type="text" name="ulogin" placeholder="Логин" class="form-control" required />
            <label for="upassword">Пароль</label>
            <input type="text" name="upassword" placeholder="Пароль" class="form-control" required /><br>
            <button type="submit" name="submit" class="btn btn-primary">Добавить пользователя</button><br>
            <?php
            };
            ?>
            </form>
            <br>
            
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
            <table class="table table-striped">
                <tr style="font-style:italic; font-weight:bold;">
                    <td>Фамилия</td>
                    <td>Имя</td>
                    <td>Отчество</td>
                    <td>E-Mail - адрес</td>
                    <td>Номер телефона</td>
                    <td>Логин</td>
                    <td>Пароль</td>
                    <td>Роль</td>
                </tr>
            <?php
            $selquery = "SELECT `id_uprofile`, `ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`, `uvisible`, `uphoto` FROM `uprofile` WHERE 1=1";
            $result = $mysqli->query($selquery);//Тут это ломалось
            while($row=$result->fetch_array()){
                echo('<tr>
                <td>'.$row['ulastname'].'</td>
                <td>'.$row['ufirstname'].'</td>
                <td>'.$row['upatronymic'].'</td>
                <td>'.$row['uemail'].'</td>
                <td>'.$row['uphone'].'</td>
                <td>'.$row['ulogin'].'</td>
                <td>'.$row['upassword'].'</td>
                <td>'.$row['urole'].'</td>
                </tr>');
            }
            ?>
            </table>
            </div>
            </div>
        </div>
      </div>




<?php
include('template/footer.php');
?>