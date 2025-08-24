<?php
// Страница "Все Новости"

ob_start();
session_start();
require_once('bd.php');

include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

// Пагинация
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$total_records_per_page = 5;
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query($mysqli,"SELECT COUNT(*) as total_records FROM unews");
$total_records = $result_count->fetch_array();
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все новости</title>
    <!-- Подключение Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Подключение Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @font-face {
            font-family: 'Russian Land Cyrillic';
            src: url('fonts/russianlandcyrillic.ttf') format('truetype');
        }

        h,h1,h2,h3,h4,h5 {
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
            font-size: 24px;
            color: #fdfdfd;
        }
        
        body {
            font-family: 'CONSTANTIA', Arial, sans-serif;
            background: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%);
            background-attachment: fixed;
            color: #fdfdfd;
            min-height: 100vh;
            padding-top: 56px;
        }
        
        .news-container {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .news-card {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(253, 253, 253, 0.1);
            transition: all 0.3s ease;
        }
        
        .news-card:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .news-title {
            color: #d4a76a;
            margin-bottom: 10px;
        }
        
        .news-date {
            color: rgba(253, 253, 253, 0.7);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .news-author {
            font-style: italic;
            color: rgba(253, 253, 253, 0.8);
        }
        
        .btn-view {
            background-color: #d4a76a;
            border: none;
            color: #004571;
            font-weight: bold;
        }
        
        .btn-view:hover {
            background-color: #c0955f;
        }
        
        .page-link {
            background-color: rgba(0, 69, 113, 0.6);
            border: 1px solid rgba(253, 253, 253, 0.2);
            color: #fdfdfd;
        }
        
        .page-item.active .page-link {
            background-color: #d4a76a;
            border-color: #d4a76a;
            color: #004571;
        }
        
        .page-item.disabled .page-link {
            background-color: rgba(0, 69, 113, 0.3);
            color: rgba(253, 253, 253, 0.5);
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .news-container {
                padding: 20px;
            }
            
            .news-card {
                padding: 15px;
            }
        }
    </style>
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

<!-- Навбар -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #004571 !important;">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <amp-img src="img/mestologo.png" width="50" height="50" layout="fixed"></amp-img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        О Соборе
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown" style="background-color: #004571 !important;">
                        <a class="dropdown-item" href="clergy.php">Духовенство</a>
                        <a class="dropdown-item" href="history.php">История</a>
                        <a class="dropdown-item" href="feodosiy.php">Прп. Феодосий Кавказский</a>
                        <a class="dropdown-item" href="tour.php">Виртуальный тур</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Благочиния
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blagochiniyaDropdown" style="background-color: #004571 !important;">
                        <a class="dropdown-item" href="blagochiniya-info.php">Общие сведения</a>
                        <a class="dropdown-item" href="blagochiniya-temples.php">Храмы</a>
                        <a class="dropdown-item" href="blagochiniya-clergy.php">Духовенство</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown" style="background-color: #004571 !important;">
                        <a class="dropdown-item" href="sunday-school.php">Воскресная школа</a>
                        <a class="dropdown-item" href="youth-center.php">Молодёжный центр</a>
                        <a class="dropdown-item" href="tea-room.php">Чайный дворик</a>
                        <a class="dropdown-item" href="social-activity.php">Социальная деятельность</a>
                    </div>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="allunews.php">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photogallery.php">Галерея</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Контакты</a>
                </li>
                
                <li class="nav-item">
                    <a class="btn btn-outline-primary ml-2" href="signin.php">Вход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- <div class="container"> -->
    <div class="news-container">
        <h1 class="text-center mb-4">Все новости</h1>
        
        <?php 
        $query = "SELECT `unews`.`id_unews`, `unews`.`utitle`,`unews`.`udescription`,`unews`.`textunews`,`unews`.`statusunews`,`unews`.`dateunews`,`uprofile`.`ulastname`,`uprofile`.`ufirstname` 
                  FROM `unews` 
                  INNER JOIN `uprofile` ON `unews`.`id_uprofile` = `uprofile`.`id_uprofile`
                  WHERE `statusunews` = 'active'
                  LIMIT $offset, $total_records_per_page";
        
        $result = $mysqli->query($query);
        
        while($row = $result->fetch_array()) {
            if($row['statusunews'] == "active") {
                echo '<div class="news-card">';
                echo '<h3 class="news-title">'.$row['utitle'].'</h3>';
                if(!empty($row['dateunews'])){
                echo '<div class="news-date">'.date('d.m.Y', strtotime($row['dateunews'])).'</div>';
                };
                echo '<p>'.$row['udescription'].'</p>';
                echo '<div class="news-author">Автор: '.$row['ulastname'].' '.$row['ufirstname'].'</div>';
                
                echo '<form method="POST" action="" class="mt-3">';
                echo '<input type="hidden" name="idunews" value="'.$row['id_unews'].'">';
                echo '<button type="submit" name="submit" class="btn btn-view">Подробнее</button>';
                echo '</form>';
                
                echo '</div>';
            }
        }
        
        // Обработка кнопки "Просмотр"
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $_SESSION['idunews'] = $_POST['idunews'];
            header('Location: unews.php');
            exit();
        }
        ?>
        
        <!-- Пагинация -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page_no <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php if($page_no > 1) echo '?page_no='.$previous_page; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                
                <?php 
                if ($total_no_of_pages <= 10) {
                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                        echo '<li class="page-item '.($counter == $page_no ? 'active' : '').'">';
                        echo '<a class="page-link" href="?page_no='.$counter.'">'.$counter.'</a>';
                        echo '</li>';
                    }
                } elseif($total_no_of_pages > 10) {
                    if($page_no <= 4) {
                        for ($counter = 1; $counter < 8; $counter++) {
                            echo '<li class="page-item '.($counter == $page_no ? 'active' : '').'">';
                            echo '<a class="page-link" href="?page_no='.$counter.'">'.$counter.'</a>';
                            echo '</li>';
                        }
                        echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?page_no='.$second_last.'">'.$second_last.'</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?page_no='.$total_no_of_pages.'">'.$total_no_of_pages.'</a></li>';
                    } elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo '<li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>';
                        echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        
                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                            echo '<li class="page-item '.($counter == $page_no ? 'active' : '').'">';
                            echo '<a class="page-link" href="?page_no='.$counter.'">'.$counter.'</a>';
                            echo '</li>';
                        }
                        
                        echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?page_no='.$second_last.'">'.$second_last.'</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?page_no='.$total_no_of_pages.'">'.$total_no_of_pages.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>';
                        echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
                        
                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                            echo '<li class="page-item '.($counter == $page_no ? 'active' : '').'">';
                            echo '<a class="page-link" href="?page_no='.$counter.'">'.$counter.'</a>';
                            echo '</li>';
                        }
                    }
                }
                ?>
                
                <li class="page-item <?php if($page_no >= $total_no_of_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php if($page_no < $total_no_of_pages) echo '?page_no='.$next_page; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
<!-- </div> -->

<?php
include('template/footer2.php');
?>

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
$result->free();
$mysqli->close();
ob_end_flush(); 
?>