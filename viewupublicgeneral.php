<?php
// Просмотр Публикаций(Пользователь General)

session_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

$id = $_SESSION['id'];
if(empty($id)){
    echo('<script>window.location.href="index.php"</script>');
}

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
        <a href="generalprofile.php">Профиль</a>
    </li>
    <li class="inline-block mr1">
        <a href="genclergy.php">Духовенство</a>
    </li>
    <li class="inline-block mr1">
        <a href="addusergen.php">Добавить пользователя</a>
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
    <!-- Данный раздел временно отключен. -->
    <!-- <li class="inline-block mr1">
        <a class="" href="addpoemsgen.php">Новый стих</a>
    </li> -->
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
        <a href="gallerygen.php">Фотогалерея</a>
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
    <h1>Все публикации</h1>
    <table class="table table-striped">
			<tr style="font-weight:bold; font-style:itallic;">
			<td>ID</td>
            <td>Название</td>
            <td>Текст</td>
            <td>Статус</td>
            <td>Разместил</td>
            <td>Действие</td>
			  </tr>
<?php 

$result = $mysqli->query("SELECT DISTINCT `upublic`.`id_upublic`, `upublic`.`id_uphoto`, `upublic`.`naim`, `upublic`.`uptext`, upublic.statusupublic, upublic.id_uprofile, uprofile.ulastname, uprofile.ufirstname FROM `upublic` 
INNER JOIN `uprofile` ON `upublic`.`id_uprofile` = `uprofile`.`id_uprofile`
LEFT JOIN `uphoto` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic`
WHERE 1=1 
ORDER BY `upublic`.`id_upublic`  ASC
LIMIT $offset, $total_records_per_page");

while($row = $result->fetch_array()){			
    if($row['statusupublic'] == "active"){
    echo('<tr>
    <td>'.$row['id_upublic'].'</td>
    <td>'.$row['naim'].'</td>
    <td>'.$row['uptext'].'</td>
    <td>'.$row['statusupublic'].'</td>
    <td>'.$row['ulastname'].' '.$row['ufirstname'].'</td>
    <td>
    <form method="POST" action="updupublicgeneral.php">
    <input type="hidden" name="id" value="'.$row['id_upublic'].'">
    <button type="submit" name="submit" class="btn btn-primary">Изменить</button>
    </form><br>
    <form method="POST" action="deleteupublicgeneral.php">
    <input type="hidden" name="id" value="'.$row['id_upublic'].'">
    <button type="submit" name="submit" class="btn btn-success">Удалить</button>
    </form><br>
    <form method="POST" action="fulldeleteupublicgeneral.php">
    <input type="hidden" name="id" value="'.$row['id_upublic'].'">
    <button type="submit" name="submit" class="btn btn-danger">Полное удаление</button>
    </form>
    </td>
    </tr>');
    }
    if($row['statusupublic'] == "deleted"){
        echo('<tr>
        <td>'.$row['id_upublic'].'</td>
        <td>'.$row['naim'].'</td>
        <td>'.$row['uptext'].'</td>
        <td>'.$row['statusupublic'].'</td>
        <td>'.$row['ulastname'].' '.$row['ufirstname'].'</td>
        <td>
        <form method="POST" action="recoveryupublicgeneral.php">
        <input type="hidden" name="id" value="'.$row['id_upublic'].'">
        <button type="submit" name="submit" class="btn btn-success">Восстановить</button>
        </form>
        </td>
        </tr>');
        }
    }
    $result->free();
    $mysqli->close();
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
	else if($total_no_of_pages > 10){
		
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




<?php
include('template/footer.php');
?>