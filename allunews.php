<?php
// Страница "Все Новости"

ob_clean(); // Очищаем буфер вывода
ob_start(); // Начинаем буферизацию вывода
session_start(); // Запускаем сессию

require_once('bd.php');
include('template/head.php');
include('template/barber.php');

//Вагинация на печке
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }
	
$total_records_per_page = 5;//4

$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query($mysqli,"SELECT COUNT(*) as total_records FROM unews");
	//$total_records = mysqli_fetch_array($result_count);
    $total_records = $result_count->fetch_array();
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
?>

    
    <style amp-boilerplate="">body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate="">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <!--Стилизация-->
    
        <style>
            body{background-image: url('../img/background2.jpg');}
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

         <link rel="stylesheet" href="../css/custom-style1.css">
    <link rel="stylesheet" href="../css/favicon-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
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
        <a href="index.php">
                <amp-img class="" src="img/mestologo.png" width="1024" height="540" layout="responsive"></amp-img>
            </a>
        </div>
    </div>
    <div class="clearfix">
            <!--Тут заголовок-->

            
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
        <a class="" href="#">Роспись</a>
    </li>
</ul>

<ul class="hide" [class]="activitiesMenu||'hide'">
<p style="font-weight: bold; font-size: 14pt; color: blue; border: 1px solid #000;">Данные разделы примерные, содержимое будет изменено в процессе разработки</p>
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

          <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
          </div>

    </div>
    <script>
        function linkClick(e) {
        var e = window.event || e;
        var target = e.target || e.srcElement;
        var parentForm = getParentForm(target);
        parentForm.submit();
 
        if (window.event) { e.returnValue = false; } else { e.preventDefault(); }
}
    </script>
    <div class="container" style="margin-top:30px">
    <h1>Все новости</h1>
    <table class="table table-striped">
			<tr style="font-weight:bold; font-style:itallic;">
			<td>ID</td>
            <td>Название</td>
            <td>Описание</td>
            <td>Текст</td>
            <td>Дата</td>
            <td>Разместил</td>
            <td>Просмотр</td>
			</tr>
<?php 

$query=("SELECT `unews`.`id_unews`, `unews`.`utitle`,`unews`.`udescription`,`unews`.`textunews`,`unews`.`statusunews`,`unews`.`dateunews`,`uprofile`.`ulastname`,`uprofile`.`ufirstname` 
FROM `unews` 
INNER JOIN `uprofile` ON `unews`.`id_uprofile` = `uprofile`.`id_uprofile`
WHERE 1=1 AND `statusunews` = 'active'
LIMIT $offset, $total_records_per_page");
//var_dump($query);
$result = $mysqli->query($query);

while($row = $result->fetch_array()){
    $idunews = $row['id_unews'];
    if($row['statusunews'] == "active"){
    echo('<tr>
    <td>'.$row['id_unews'].'</td>
    <td>'.$row['utitle'].'</td>
    <td>'.$row['udescription'].'</td>
    <td>'.$row['textunews'].'</td>
    <td>'.$row['dateunews'].'</td>
    <td>'.$row['ulastname'].' '.$row['ufirstname'].'</td>
    <td><form method="POST" action="">
    <input type="hidden" name="idunews" value="'.$idunews.'">
    <button type="submit" name="submit" class="btn btn-primary">Просмотр</button>
    </form></td>
    </tr>');
    }
    }
    if(isset($_POST['submit'])){
        $_SESSION['idunews'] = $_POST['idunews'];
        echo($_SESSION['idunews']);
        //header('Location: unews.php');
    }
    $result->free();
    $mysqli->close();

    // if(isset($_POST['submit'])){
    //     $idunews = $_POST['id'];
    //     $_SESSION['id'] = $idunews;
    //     //header('Location: unews.php');
    //     echo('<script>window.location.href="unews.php"</script>');
    // }//Тут почему-то редиректится на signin.php

	//mysqli_close($mysqli);
  ?>	
</table>
    
    <ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li class='page-item ' <?php if($page_no <= 1){ echo "class='disabled' class='page-item ' "; } ?>>
	<a class='page-link' <?php if($page_no > 1){ echo " class='page-link' href='?page_no=$previous_page'"; } ?>>&laquo; Предыдущая</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active' class='page-item' ><a class='page-link'  >$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active' class='page-item' ><a class='page-link' >$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item' ><a class='page-link'>...</a></li>";
		echo "<li class='page-item' ><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item' ><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link' >...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active' 'page-item' ><a class='page-link'  >$counter</a></li>";	
				}else{
           echo "<li class='page-item'  ><a class='page-link'  href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item' ><a class='page-link' >...</a></li>";
	   echo "<li class='page-item' ><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li class='page-item' ><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item' ><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item' ><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item' ><a class='page-link' >...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li  class='page-item' class='active'><a class='page-link' >$counter</a></li>";	
				}else{
           echo "<li class='page-item' ><a  class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li  class='page-item ' <?php if($page_no >= $total_no_of_pages){ echo "class='disabled' class='page-item'"; } ?>>
	<a class='page-link' <?php if($page_no < $total_no_of_pages) { echo " class='page-link' href='?page_no=$next_page'"; } ?>>Следующая</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item' ><a  class='page-link' href='?page_no=$total_no_of_pages'>Последняя &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>    
    </div>
  </div>
 </div>

 <div class="max-width-4 mx-auto p2">
    <div class="rounded border border-grey bg-white alpha-90 clearfix">
        <div class="clearfix">
            <div class="md-col md-col-6 p2">

                <div class="module-wrap"></div>

                <div class="module-wrap">
                    <h2><a href="#" target="_blank">Фотогалерея</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
            <div class="md-col md-col-6 p2">
                <div class="module-wrap mb2">
                    <h2><a href="https://soundcloud.com/rdyxfnx53xwp" target="_blank">Музыка</a></h2>
                    <img src="img/no_img — копия.jpeg" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
 </div>


 
</div><!-- content-wrap -->

</div> <!-- page-wrap -->

<?php
include('template\footer.php');
?>