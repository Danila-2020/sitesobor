 <?php
 //session_start();
 require_once('bd.php');
 include('template/galleryhead.php');
 include('template/barber.php');
 ?>
   <body>
   <ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="adminprofile.php">Расписание богослужений</a>
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
    <!--<li class="inline-block mr1">
        <a class="" href="/site/article?id=2">Святыни</a>
    </li>-->
    <li class="inline-block mr1">
        <a class="" href="addupublicgen.php">Публикацию</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'"> <!--Выпадающее меню 2-->
    <li class="inline-block mr1">
        <a href="viewunewsgeneral.php">Новости</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Мероприятия</a>
    </li>
    <li class="inline-block mr1">
        <a href="viewupublicgeneral.php">Публикации</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">ФотогалереЯ</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'"> <!--Выпадающее меню 3-->
    <li class="inline-block mr1">
        <a href="controluprofile.php">Управление</a>
    </li>
</ul>
        <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
        </div>
       <div class="container mt-5">
           <h1 class="text-center">Фотогалерея</h1>
           <div class="row">
               <?php
               $sql = "SELECT `uphoto`.`id_uphoto`, `uphoto`.`uphoto`, `uphoto`.`uphotostatus`, `uphoto`.`id_upublic`, `upublic`.`naim` FROM `uphoto` 
                    INNER JOIN `upublic` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic`
                    WHERE 1=1";
               //SELECT image FROM images
               $result = $mysqli->query($sql);

               // Проверяем, есть ли результаты
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                        $img = base64_encode($row['uphoto']);
                       // Выводим каждое изображение
                       echo '<div class="col-md-4 mb-4">';
                       echo '<div class="card">';
                       echo '<form action="" method="post" enctype="multipart/form-data">';
                       echo '<img src="data:image/jpeg;base64,'.$img.'" class="card-img-top" alt="Изображение">';
                       echo '<div class="card-body">Content
                       <button type="submit" class="btn btn-primary" style="float: right;">Подробнее</button></div>';
                       echo '</form>';
                       echo '</div>';
                       echo '</div>';
                   }
               } else {
                   echo "Нет изображений";
               }

               // Закрываем соединение
               $mysqli->close();
               ?>
           </div>
       </div>

       <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
        </div>


        <div class="jumbotron text-center">
            <b><i>&copy; Колодочкин Алексей<br>
            Дробилко Данила</i></b>
        </div>
        <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
        </div>
</div>

       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </body>
   </html>
