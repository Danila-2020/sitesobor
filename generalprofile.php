<?php
// Профиль General-Администратора

session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

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
            <amp-img class="" src="../img/mestologo.png" width="1024" height="540" layout="responsive">
        </div>
    </div>
    <div class="clearfix">
            <!--<h1 class="hide h2 center">Спасский Кафедральный собор Пятигорска</h1>-->

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="generalprofile.php">Профиль</a>
    </li>
    <li class="inline-block mr1">
        <a href="genclergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a href="adduser.php">Добавить пользователя</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
    </li>
    <li class="inline-block mr1">
        <a href="adduphotogen.php">Добавить фото</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Профили</a>
    </li>
    <li class="inline-block mr1">
        <form action="" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
            <?php
            if(isset($_POST['submit'])){
                $_SESSION['id'] = "";
                session_unset();
                echo'<script>window.location.href="signin.php"</script>';
            }
            ?>
        </form>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="addunewsgeneral.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addeventsgen.php">Мероприятие</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addupublicgen.php">Публикацию</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addactivity.php">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addpainting.php">Сведения о Росписи</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">
        <a href="viewunewsgeneral.php">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewueventsgeneral.php">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewupublicgeneral.php">Публикации</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewactivitygen.php">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a href="gallery.php">Фотогалерея</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
    <li class="inline-block mr1">
        <a href="controluprofile.php">Управление</a>
    </li>
</ul>

<hr>

    </div>
    
    <div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
          <h2>Профиль general администратора</h2>
            <form action="editgeneralprofile.php" method="post">
            <?php
            $result = $mysqli->query("SELECT `id_uprofile`, `ulastname`, `ufirstname`, `upatronymic`, `uemail`, `urole`, `ulogin`, `upassword`, `ucode`, `uphone`, `uvisible`, `uphoto` FROM `uprofile` WHERE `id_uprofile`=$id");
            while($row = $result->fetch_array()){
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
            <input type="text" name="upatronymic" placeholder="Отчество" value="<?php echo($row['upatronymic']);?>" class="form-control" />
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
            <form action="updateuphotogeneralsubmit.php" method="post" enctype="multipart/form-data">
            <label for="uphoto">Загрузить новое фото</label>
            <input type="file" name="uphoto" class="form-control" required /><br>
            <button type="submit" name="submitupdate" class="btn btn-success">Сохранить фото</button>
            </form>
            <br>
            <form action="deleteuphotogeneralsubmit.php" method="post" enctype="multipart/form-data">
                <button type="submit" name="submit" class="btn btn-danger">Удалить фото</button>
            </form>
            <br>
            
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
        <div class="row">
            <div class="container">
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
      </div>




<?php
include('template/footer.php');
?>