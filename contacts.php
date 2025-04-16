<?php
// Форма обратной связи

session_start();
require_once('template\contactshead.php');
require_once('template\contactsstyle.php');
require_once('template\contactscdn.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>
         
<body>
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
        <a href="index.php"><amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"><!--/files/logo-color.png--></a>
        </div>
    </div>
    <div class="clearfix">

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="scedule.php">Расписание богослужений</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
    </li>
    <li class="inline-block mr1">
        <a href="activity.php">Деятельность</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="sacramentsItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, activitiesItem: null, activitiesMenu: null, sacramentsItem: 'underline', sacramentsMenu: 'center h4 list-reset'})">Таинства</a>
    </li>
    <li class="inline-block mr1">
        <a href="note.php">Подать записку</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="aboutMenu||'hide'">
    <li class="inline-block mr1">
        <a class="" href="clergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="story.php">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="paintingalluser.php">Роспись</a>
    </li>
</ul>

<ul class="center h4 list-reset hide" [class]="sacramentsMenu||'hide'">
    <li class="inline-block mr1">
        <a href="christening.php">Крещение</a>
    </li>
    <li class="inline-block mr1">
        <a href="wedding.php">Венчание</a>
    </li>
    <li class="inline-block mr1">
        <a href="сonfession.php">Исповедь</a>
    </li>
    <li class="inline-block mr1">
        <a href="eucharist.php">Причастие</a>
    </li>
    <li class="inline-block mr1">
        <a href="unction.php">Соборование</a>
    </li>
</ul>

<div class="site-article">
    <div class="content-wrap"><!-- content-wrap -->
        <div class="max-width-4 mx-auto p2"><!-- full-width-wrap -->
            <div class="border border-grey bg-white-a60 rounded clearfix p2"><!-- clearfix -->
                
<hr>

        <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
          </div>

<!--<ul class="mx-auto center list-reset social-icons-wrap">
    <li class="inline-block mr1">
        <a href="#" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="#" target="_blank">
            <i class="fab fa-soundcloud fa-lg"></i>
        </a>
    </li>
    <li class="inline-block">
        <a href="#" target="_blank">
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>-->

                        <ul class="list-reset breadcrumbs">
                    <li class="inline-block mr1">
                                    <a href="/">
                
                Главная
                                    </a>
                            </li>
                    <li class="inline-block mr1">
                
                Форма обратной связи
                            </li>
            </ul>

                <h1>Форма обратной связи</h1>

                <div class="form-wrap">
                    <form method="post" action=""  class="amp-form"><!--target="_blank"-->
                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>Ваше имя:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <input class="rounded col-12 fit input" type="text" name="uname" required>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>E-mail:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <input class="rounded col-12 fit input" type="email" name="uemail" required>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>Сообщение:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <textarea class="rounded col-12 fit input" name="umessage" rows="6"></textarea>
                            </div>
                        </div>
                            <div class="clearfix">
                            <div class="col-12 text-center">
                                <button type="submit" name="submit" class="btn btn-outline-primary">Отправить</button>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['submit'])){
                                $uname = $_POST['uname'];
                                $uemail = $_POST['uemail'];
                                $umessage = "Имя: " . $uname . "<br>" . 
                                            "Сообщение: " . nl2br(htmlspecialchars($_POST['umessage'])) . "<br>" . 
                                            "E-Mail для обратной связи: " . $uemail;
                            
                                echo($umessage);
                                $to = "sobor.noreply@mail.ru";
                                $subject = "Новое обращение с сайта";
                                $headers = "Content-type: text/html; charset=utf-8 \r\n";
                                $headers .= "From: robot.sobor@mail.ru";
                            
                                mail($to, $subject, $umessage, $headers);
                            }                            
                        ?>
                  <?php echo('</form>')?>
                  <?php echo('</div>')?>
                

    <?php
    include('template/footer2.php');
    ?>
