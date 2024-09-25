<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/brands.css" integrity="sha384-i2PyM6FMpVnxjRPi0KW/xIS7hkeSznkllv+Hx/MtYDaHA5VcF0yL3KVlvzp8bWjQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/fontawesome.css" integrity="sha384-sri+NftO+0hcisDKgr287Y/1LVnInHJ1l+XC7+FOabmTTIK0HnE2ID+xxvJ21c5J" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/custom-style1.css">
    <link rel="stylesheet" href="../css/favicon-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <style amp-boilerplate="">
    body
    {
        -webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;
        -moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;
        -ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;
        animation:-amp-start 8s steps(1,end) 0s 1 normal both
    }
        @-webkit-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @-moz-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @-ms-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @-o-keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
        @keyframes -amp-start
    {
        from{visibility:hidden}to{visibility:visible}
    }
    </style>
    <noscript>
        <style amp-boilerplate="">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style>
    </noscript>
    
        <style>
            body{background-image: url('https://catherineasquithgallery.com/uploads/posts/2021-02/1612767162_15-p-fon-goluboe-nebo-s-oblakami-19.jpg');}
        </style>
         <meta name="csrf-param" content="_csrf-frontend">
         <meta name="csrf-token" content="rufNjNmfaRuKJ-ssgba1NeE69mEJj3aI0QWIBDjgdkDc0YLLjMY6Tv4fmX_jwfJlh0O3J37HEOqjYtdDbLM5cg==">
         
         <script src="https://cdn.ampproject.org/v0.js" async="async"></script>
         <script src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js" async="async" custom-element="amp-iframe"></script>
         <script src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js" async="async" custom-element="amp-lightbox"></script>
         <script src="https://cdn.ampproject.org/v0/amp-list-0.1.js" async="async" custom-element="amp-list"></script>
         <script src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js" async="async" custom-template="amp-mustache"></script>
         <script src="https://cdn.ampproject.org/v0/amp-bind-0.1.js" async="async" custom-element="amp-bind"></script>
         <script src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js" async="async" custom-element="amp-carousel"></script>
         <script src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js" async="async" custom-element="amp-analytics"></script>
         
</head>
<body>
<div class="content-wrap relative"><!-- content-wrap -->
    <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
      <div class="land-see-hero-main mx-auto"></div>
    </section>
 <div class="max-width-4 mx-auto p2">
    
  <div class="rounded border border-grey bg-white alpha-90-dep clearfix">
    <div class="clearfix p1">
        <div class="desk-logo-wrap mx-auto block">
            <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"><!--/files/logo-color.png-->
        </div>
    </div>
    <div class="clearfix">

            
<ul class="center h2 list-reset mt0 head-menu">
    <li class="inline-block mr1">
        <a href="#">Расписание богослужений</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="aboutItem" on="tap:AMP.setState({sacramentsItem: null, sacramentsMenu: null, activitiesItem: null, activitiesMenu: null, aboutItem: 'underline', aboutMenu: 'center h4 list-reset'})">О соборе</a>
    </li>
    <li class="inline-block mr1">
        <a [class]="activitiesItem" on="tap:AMP.setState({aboutItem:null, aboutMenu: null, sacramentsItem: null, sacramentsMenu: null, activitiesItem: 'underline', activitiesMenu: 'center h4 list-reset'})">Деятельность</a>
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
        <a class="" href="/site/article?id=1">История</a>
    </li>
    <li class="inline-block mr1">
        <a class="" href="/site/article?id=5">Роспись</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'">
    <p style="font-weight: bold; font-size: 14pt; color: blue; border: 1px solid #000;">Данные разделы примерные, содержимое будет изменено в процессе разработки</p>
    <li class="inline-block mr1">
        <a href="/site/article?id=6">Воскресная школа</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=7">Молодежный центр</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=8">Библиотека</a>
    </li>
    <li class="inline-block mr1">
        <a href="/site/article?id=9">Социальная деятельность</a>
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
                                $umessage = $_POST['umessage'];

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
