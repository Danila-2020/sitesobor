<?php
// Профиль администратора
session_start();
require_once('bd.php');
include('template/scedulehead.php');//Обычная бошка не для админа
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
    <script>
        $(document).ready(function() { 
            $("#phone").mask("+7(999)999-99-99");
        });
    </script>
    <amp-analytics type="metrika">
        <script type="application/json">
            {
                "vars": {
                    "counterId": "53592163"
                }
            }
        </script>
    </amp-analytics>

    
<div class="relative page-wrap">

<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="/files/logo-color.png" width="1024" height="540" layout="responsive">
            <h1 style="font-family: Calibri; font-weight: bold; text-align: center; margin-bottom: 25%; margin-top:0;">Логотип</h1>
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="adminprofile.php">Профиль</a>
    </li>
    <li class="inline-block mr1">
        <a href="adduser.php">Добавить пользователя</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
    </li>
    <li class="inline-block mr1">
        <form action="exitadmin.php" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
        </form>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="addunewsadmin.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addeventsadmin.php">Мероприятие</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addclergy.php">Духовенство</a>
    </li>
    <!-- <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Публикацию</a>
    </li> -->
    <!-- Данный раздел временно отключён -->
    <!-- <li class="inline-block mr1">
        <a class="" href="addpoems.php">Новый стих</a>
    </li> -->
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">
        <a href="viewunewsadmin.php">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewueventsadmin.php">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Публикации</a>
    </li>
</ul>

<!-- <ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> Выпадающее меню 3 -->
    <!-- <li class="inline-block mr1">
        <a href="/site/article?id=10">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=11">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=12">Исповедь</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=13">Причастие</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=184">Соборование</a>
    </li>
</ul> -->

<hr>

    </div>
    
    <div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
          <h2>Профиль администратора</h2>
            <form action="editadminprofile.php" method="post">
            <?php
            $result = $mysqli->query("SELECT `id_uprofile`, `ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`, `uvisible`, `uphoto` FROM `uprofile` WHERE `id_uprofile`=$id");
            while($row = $result->fetch_array()){
                $img = base64_encode($row['uphoto']);
                ?>
            <div class="fakeimg">
                <?php
                if(!empty($row['uphoto'])){
                    $img = base64_encode($row['uphoto']);
                    ?>
                    <img src="data:image/jpeg;base64,<?=$img?>" alt="" class="img-fluid">
                    <?php
                }else{
                ?>
                    <img src="img/no_img — копия.jpeg" alt="" class="img-fluid">
                <?php }?>
            </div>
            <label for="ulastname">Фамилия</label>
            <input type="text" name="ulastname" placeholder="Фамилия" value="<?php echo($row['ulastname']);?>" class="form-control" required />
            <label for="ufirstname">Имя</label>
            <input type="text" name="ufirstname" placeholder="Имя" value="<?php echo($row['ufirstname']);?>" class="form-control" required />
            <label for="ulastname">Отчество</label>
            <input type="text" name="upatronymic" placeholder="Отчество" value="<?php echo($row['upatronymic'])?>" class="form-control" />
            <label for="uemail">E-Mail - Адрес</label>
            <input type="text" name="uemail" placeholder="E-Mail Адрес" value="<?php echo($row['uemail'])?>" class="form-control" required />
            <label for="uphone">Номер телефона</label>
            <input type="text" name="uphone" placeholder="+7(999)999-99-99" id="phone" value="<?php echo($row['uphone'])?>" class="form-control" required />
            <label for="ulogin">Логин</label>
            <input type="text" name="ulogin" placeholder="Логин" value="<?php echo($row['ulogin'])?>" class="form-control" required />
            <label for="upassword">Пароль</label>

            <input type="text" name="upassword" placeholder="Пароль" value="<?php echo($row['upassword'])?>" class="form-control" required /><br>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button><br>
            <?php
            };
            ?>
            </form>
            <form action="updateuphotoadminsubmit.php" method="post" enctype="multipart/form-data">
            <label for="uphoto">Загрузить новое фото</label>
            <input type="file" name="uphoto" class="form-control" required /><br>
            <button type="submit" name="submitupdate" class="btn btn-success">Сохранить фото</button>
            </form>
            <br>
            <form action="deleteuphotoadminsubmit.php" method="post" enctype="multipart/form-data">
                <button type="submit" name="submit" class="btn btn-danger">Удалить фото</button>
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