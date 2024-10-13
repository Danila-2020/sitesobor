<?php
include('template/notehead.php');
include('template/notestyle.php');
include('template/noteheadend.php');
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

            <ul class="list-reset breadcrumbs">
                    <li class="inline-block mr1">
                                    <a href="/">Главная</a>
                            </li>
                    <li class="inline-block mr1">Подать записку</li>
            </ul>

                <h1>Подать записку</h1>

                <p class="mb2">
                    В этом разделе сайта Вы можете заказать поминовение о здравии и упокоении православных христиан сроком на 1, 40 дней, полгода или год. Поданные Вами записки будут читаться при совершении Божественной Литургии, молебна с акафистом или панихиды.
                </p>

                <p class="mb2">
                    Чтобы заказать поминовение, прежде всего, Вам нужно выбрать, какое необходимо совершать поминовение: о здравии или об упокоении, и при необходимости определить его длительность:
                </p>

                <div class="form-wrap">
                    <form method="post" action="" target="_top" class="amp-form i-amphtml-form" novalidate="">
                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>Поминовение:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <input type="radio" name="type" value="О здравии" checked=""> О здравии<br>      
                                <input type="radio" name="type" value="Об упокоении"> Об упокоении<br>  
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>Длительность поминовения:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <input type="radio" name="period" value="Единоразово"> Единоразово (вынимание частиц на проскомидии)<br>
                                <input type="radio" name="period" value="40 дней" checked=""> 40 дней 300 руб. / за 1 имя (ориентировочное пожертвование)<br>      
                                <input type="radio" name="period" value="Полгода"> Полгода 1000 руб. / за 1 имя (ориентировочное пожертвование)<br>  
                                <input type="radio" name="period" value="Год"> Год 1500 руб. / за 1 имя (ориентировочное пожертвование)<br>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>Поминовение во время:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <input type="radio" name="time" value="Божественной литургии" checked=""> Божественной литургии в Соборе<br>
                            </div>
                        </div>

                        <p class="mb2">Затем Вам нужно написать имена православных христиан, о которых следует молиться в Соборе. В подаваемых записках необходимо записывать церковные имена (данные при Святом Крещении), указывая их в родительном падеже («Михаила», «Анастасии», «Антония», «Фотинии», «Петра») через запятую:</p>

                        <div class="alert alert-dark" submit-success="">
                            <template type="amp-mustache">{{message}}</template>
                        </div>
                        <div class="alert alert-danger" submit-error="">
                            <template type="amp-mustache">Ошибка!</template>
                        </div>

                        <div class="clearfix">
                            <div class="md-col md-col-2 mb2">
                                <label>Имена:</label>
                            </div>
                            <div class="md-col md-col-10 mb2">
                                <textarea class="rounded col-12 fit input" name="targetNames" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="col-12 text-center mb2">
                                <button type="submit" name="submit" class="btn btn-primary"><b>Заказать поминование</b></button>
                            </div>

                            <a href="/files/qr_payment.png" target="_blank" class=" block block-center max-width-200px text-center">
                                <amp-img src="img/Qr.png" height="390" width="390" layout="responsive" class="i-amphtml-element i-amphtml-layout-responsive i-amphtml-layout-size-defined i-amphtml-built i-amphtml-layout" i-amphtml-layout="responsive"><i-amphtml-sizer slot="i-amphtml-svc" style="padding-top: 100%;"></i-amphtml-sizer>
                            <img decoding="async" src="" class="i-amphtml-fill-content i-amphtml-replaced-content"></amp-img></a>
                            <div>Чтобы внести пожертвование, необходимо зайти в приложение вашего банка, выбрать пункт «оплата по QR-коду» и отсканировать через камеру телефона или добавить из галереи сохранённый QR-код</div>
                        </div>

                        <input type="hidden" name="_csrf-frontend" value="rGV5abZWm7OBkTtCffdgfHEEfHeMF38tDCmR6_HnFzLDVg4b5Bio9N71TjIYhAs9M2sGQuVCJ3VCZPmemaFQCg==">
                        <?php
                            if(isset($_POST['submit'])){
                                $type = $_POST['type'];
                                $period = $_POST['period'];
                                $time = $_POST['time'];
                                $targetNames = $_POST['targetNames'];

                                $message = ('Молитва: '.$type.'<br>'.
                                'Период: '.$period.'<br>'.
                                'Во время: '.$time.'<br>'.
                                'Имена: '.$targetNames.'<br>');

                                echo($message);
                                $to = "sobor.noreply@mail.ru";
                                $subject = "Новая записка";
                                $headers = "Content-type: text/html; charset=utf-8 \r\n";
                                $headers .= "From: robot.sobor@mail.ru";

                                mail($to, $subject, $message, $headers);
                            }
                        ?>
                  <?php echo('</form>')?>
                  <?php echo('</div>')?>
    <?php
    include('template/footer2.php');
    ?>