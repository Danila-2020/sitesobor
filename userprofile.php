<?php
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
body{
    background-image:url('img/background4.jpg');
    background-repeat: repeat;/*no-repeat*/
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
};

</style>
<body>
    <script>
        $(document).ready(function() { 
            $("#phone").mask("+7(999) 999-99-99");
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
            <!--Тут заголовок-->

<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="sceduleuploader.php">Расписание богослужений</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">Добавить</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Просмотреть</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})" href="adduphoto.php">Добавить фото</a>
    </li>
    <li class="inline-block mr1">
        <form action="" method="post">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
            <?php
            if(isset($_POST['submit'])){
                $_SESSION['id'] = "";
                session_unset();
                session_destroy();
                echo('<script>window.location.href="signin.php"</script>');
                exit(); //Выход из страницы
            }
            ?>
        </form>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'"> <!--Выпадающее меню 1-->
    <li class="inline-block mr1">
        <a class="" href="addunewsuser.php">Новость</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="addeventsuser.php">Мероприятие</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="#">Публикацию</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">    
    <a class="" href="#">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewupublicuser.php">Публикации</a>
    </li>
</ul>

<hr>
    </div>
    
    <div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <h2>Профиль священника</h2>
            <form action="edituserprofile.php" method="post">
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
            <input type="text" name="upatronymic" placeholder="Отчество" value="<?php echo($row['upatronymic'])?>" class="form-control" />
            <label for="uemail">E-Mail - Адрес</label>
            <input type="text" name="uemail" placeholder="E-Mail Адрес" value="<?php echo($row['uemail'])?>" class="form-control" required />
            <label for="uphone">Номер телефона</label>
            <input type="text" name="uphone" placeholder="+7(999) 999-99-99" id="phone" value="<?php echo($row['uphone'])?>" class="form-control" required />
            <label for="ulogin">Логин</label>
            <input type="text" name="ulogin" placeholder="Логин" value="<?php echo($row['ulogin'])?>" class="form-control" required />
            <label for="upassword">Пароль</label>
            <input type="text" name="upassword" placeholder="Пароль" value="<?php echo($row['upassword'])?>" class="form-control" required /><br>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button><br>
            <?php
            };
            ?>
            </form>
            <form action="updateuphotousersubmit.php" method="post" enctype="multipart/form-data">
            <label for="uphoto">Загрузить новое фото</label>
            <input type="file" name="uphoto" class="form-control" required /><br>
            <button type="submit" name="submitupdate" class="btn btn-success">Сохранить фото</button>
            </form>
            <br>
            <form action="deleteuphotousersubmit.php" method="post" enctype="multipart/form-data">
                <button type="submit" name="submit" class="btn btn-danger">Удалить фото</button>
            </form>
            <br>
            
            <hr class="d-sm-none">
          </div>
          <div class="col-sm-4">
          </div>
        </div>
      </div>

<?php
include('template/footer.php');
?>