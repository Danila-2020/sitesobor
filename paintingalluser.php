<?php
// Страница просмотра Росписи(Все пользователи)

// session_start();

include('template/head.php');
include('template/barber.php');
require_once('bd.php');

?>
<body>
    <ul class="center h2 list-reset mt0 head-menu">
        <li class="inline-block mr1">
            <a href="scedule.php">Расписание богослужений</a>
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
            <a class="" href="#">История</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="#">Святыни</a>
        </li>
        <li class="inline-block mr1">
            <a class="" href="paintingalluser.php">Роспись</a>
        </li>
    </ul>
    
    <ul class="hide" [class]="activitiesMenu||'hide'">
        <li class="inline-block mr1">
            <a href="#">Воскресная школа</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Молодежный центр</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Библиотека</a>
        </li>
        <li class="inline-block mr1">
            <a href="#">Социальная деятельность</a>
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
            <a href="confession.php">Исповедь</a>
        </li>
        <li class="inline-block mr1">
            <a href="eucharist.php">Причастие</a>
        </li>
        <li class="inline-block mr1">
            <a href="unction.php">Соборование</a>
        </li>
    </ul>
    
    <hr>
<div class="container" style="margin-top: 1%; margin-bottom: 5%;"><!--py-5-->
<!-- Центрирование изображений -->
<style>
.center-img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">В одном маленьком, но живописном городке, где улицы были обрамлены цветущими деревьями, жила группа подруг: Катя, Маша и Лена. Каждое лето они собирались вместе, чтобы исследовать окрестности и создавать незабываемые воспоминания.

Однажды, в теплый солнечный день, девочки решили отправиться в лес, который находился неподалеку. Говорили, что там есть старое заброшенное озеро, о котором ходили легенды. Слухи говорили, что в его глубинах скрыты тайны, и кто найдет это озеро, тот обретет удачу.

Собравшись с рюкзаками, полными закусок и карт, они отправились в путь. По дороге они смеялись, делились секретами и строили планы на будущее. В лесу было прекрасно: солнечные лучи пробивались сквозь листву, создавая волшебную атмосферу.

Когда девочки наконец нашли озеро, их глаза загорелись от восторга. Вода была кристально чистой, а вокруг росли яркие цветы. Они решили устроить пикник на берегу и насладиться моментом. После еды, Маша предложила поиграть в игру: каждая должна была рассказать о своем самом заветном желании.

Катя мечтала о путешествиях по миру, Лена хотела стать известной художницей, а Маша мечтала о том, чтобы открыть свой собственный кафе. В этот момент они поняли, что их мечты могут стать реальностью, если они будут поддерживать друг друга.

После пикника девочки решили искупаться в озере. Вода была прохладной, но это только добавляло веселья. Они смеялись и плескались, забыв обо всех заботах. В этот момент они поняли, что настоящая удача — это не только находка сокровищ, но и дружба, которая поддерживает в любых ситуациях.

С тех пор это озеро стало их особым местом. Каждый год они возвращались туда, чтобы вспоминать свои мечты и делиться новыми. Дружба, как и озеро, была полна жизни и чудес, и они знали, что вместе смогут преодолеть любые преграды.</div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <img src="..\img\no_img — копия.jpeg" alt="" class="img-fluid"></img>
            </div>
        </div>
    <?php
    $query = ("SELECT `painting`.`id_painting`, `painting`.`npainting`, `painting`.`descpainting`, 
    `painting`.`id_uprofile`, `imgpainting`.`id_imgpainting`, `imgpainting`.`naimimgpainting`, 
    `imgpainting`.`textimgpainting`, `imgpainting`.`images`, `imgpainting`.`imagesstatus`, 
    `imgpainting`.`id_painting` 
    FROM `painting`
    LEFT JOIN `imgpainting` ON `imgpainting`.`id_painting` = `painting`.`id_painting`
    WHERE 1=1");
    
$result = $mysqli->query($query);
$hasImages = false;
$descriptionDisplayed = false;

echo('<h1 class="text-center">Роспись</h1>');
echo('<div class="container">');
echo('  <div class="row">');

while($row = $result->fetch_assoc()) {
    // Выводим описание только один раз слева
    if (!$descriptionDisplayed) {
        echo('    <div class="col-md-6">');
        echo('      <p>'.$row['descpainting'].'</p>');
        echo('    </div>');
        $descriptionDisplayed = true;
    }
    
    // Выводим изображения справа
    if (!empty($row['images'])) {
        echo('    <div class="col-md-6">');
        $img = base64_encode($row['images']);
        echo('      <img src="data:image/jpeg;base64, '.$img.'" class="img-fluid"></img>');
        if (!empty($row['textimgpainting'])) {
            echo('      <p>'.$row['textimgpainting'].'</p>');
        }
        echo('    </div>');
        $hasImages = true;
    }
}

// Если изображений нет, закрываем row и container
if (!$hasImages) {
    echo('    <div class="col-md-6"></div>'); // Пустая колонка для баланса
}

echo('  </div>');
echo('</div>');
    ?>
    </div>
</div>

<?php
include('template/footer3.php');
?>