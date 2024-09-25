<div class="bg-white alpha-90 fit relative pt1" style="height:fit-content;">
    
<ul class="mx-auto center list-reset social-icons-wrap">
    <li class="inline-block mr1">
        <a href="https://www.youtube.com/channel/UCT9LuM1abyX14sRm6um0pNg" target="_blank">
            <i class="fab fa-youtube fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="https://www.flickr.com/people/157787163@N07/" target="_blank">
            <i class="fab fa-flickr fa-lg"></i>
        </a>
    </li>
    <li class="inline-block mr1">
        <a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">
            <i class="fab fa-soundcloud fa-lg"></i>
        </a>
    </li>
    <li class="inline-block">
        <a href="#" target="_blank"><!--https://t.me/soborvpyatigorske-->
            <i class="fab fa-telegram fa-lg"></i>
        </a>
    </li>
</ul>

<ul class="mx-auto center h2 list-reset">
    <li class="inline-block mr1">
        <a href="#">Задать вопрос</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Подать записку</a>
    <li>
    <li class="inline-block mr1">
        <a href="#">Контакты</a>
    </li>
    <li class="inline-block mr1">
        <a href="#">Новости собора</a>
    </li>
    <li class="inline-block mr1">
        <a href="#" target="_blank">Новости епархии</a>
    </li>
    <li class="inline-block mr1">
        <a href="http://www.patriarchia.ru/db/news/" target="_blank">Общецерковные новости</a>
    </li>
    <li class="inline-block mr1">
    <form method="POST" action="">
            <button type="submit" name="submit" class="btn btn-danger">Выход</button>
            <?php
            if(isset($_POST['submit'])){
                $_SESSION['id'] = "";
                $id = "";
                session_unset();
                echo'<script>window.location.href="signin.php"</script>';

                //header('Location: signin.php');
            };
            ?>
    </form>
    </li>
</ul>


       <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img><!--/files/mountains-no-sky-sharpened.png-->
        </div>
        <div class="jumbotron text-center">
            <b><i>&copy; Колодочкин Алексей<br>
            Дробилко Данила</i></b>
        </div>
</div>

</body>
</html>