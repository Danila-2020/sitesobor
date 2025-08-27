<?php
// Расписание богослужений(Все пользователи)

require_once('bd.php');
ob_start();
//session_start();//Тут идёт session_start, он наверное не нужен

include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Расписание богослужений</title>
    <!-- Подключение Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Подключение Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            padding-top: 56px; /* Для фиксированного навбара */
        }
        
        .content-wrap, 
        .max-width-4, 
        .rounded, 
        .border, 
        .bg-white, 
        .alpha-90-dep, 
        .alpha-90 {
            background-color: rgba(0, 69, 113, 0.8) !important;
            color: #fdfdfd !important;
            border-color: #fdfdfd !important;
        }
        
        .media-label,
        .h3 {
            color: #fdfdfd !important;
        }
        
        a {
            color: #fdfdfd !important;
        }
        
        .btn-primary {
            background-color: rgba(96, 150, 184, 0.7) !important;
            border-color: #fdfdfd !important;
            color: #fdfdfd !important;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: rgba(96, 150, 184, 1) !important;
        }
        
        .btn-outline-primary {
            border-color: #fdfdfd !important;
            color: #fdfdfd !important;
        }
        
        .btn-outline-primary:hover {
            background-color: #fdfdfd !important;
            color: #004571 !important;
        }
        
        .land-see-hero-container {
            display: none;
        }
        
        /* Стили для навбара */
        .navbar {
            background-color: rgba(0, 69, 113, 0.95) !important;
            border-bottom: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            padding: 0;
        }

        .nav-link {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(96, 150, 184, 0.5);
        }

        .nav-item.active .nav-link {
            background-color: rgba(96, 150, 184, 0.7);
        }

        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: rgba(0, 69, 113, 0.95);
                padding: 1rem;
                border-radius: 0 0 8px 8px;
            }
            
            .nav-link {
                margin: 0.2rem 0;
            }
            
            /* Исправления для мобильного меню */
            .dropdown-menu {
                background-color: rgba(0, 69, 113, 0.8) !important;
                border: 1px solid rgba(253, 253, 253, 0.2);
                margin-left: 20px;
                padding: 0.5rem 0;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
            
            .dropdown-item {
                padding: 0.5rem 1.5rem;
                color: #fdfdfd !important;
            }
            
            .dropdown-item:hover {
                background-color: rgba(96, 150, 184, 0.5);
            }
            
            .dropdown-toggle::after {
                float: right;
                margin-top: 0.7rem;
            }
            
            .nav-item.dropdown.show .dropdown-menu {
                display: block;
            }
        }
        
        /* Остальные стили */
        .module-wrap {
            background-color: rgba(0, 69, 113, 0.6);
            padding: 20px;
            border-radius: 8px;
        }
        
        .img-fluid {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        
        .img-fluid:hover {
            transform: scale(1.02);
        }
        
        .media-label {
            background-color: rgba(0, 69, 113, 0.7) !important;
            border-radius: 0 0 8px 8px;
        }
        
        .clearfix {
            background: linear-gradient(to right, rgba(0, 69, 113, 0.9), rgba(96, 150, 184, 0.7));
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(253, 253, 253, 0.2);
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
            background: linear-gradient(to right, transparent, rgba(253, 253, 253, 0.1), transparent);
            height: 1px;
            margin: 15px 0;
        }

        .md-col {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            margin: 10px 0;
            transition: all 0.3s ease;
            border: 1px solid rgba(253, 253, 253, 0.1);
        }

        .md-col:hover {
            background-color: rgba(0, 69, 113, 0.8);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .clickable-block {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .clickable-block:hover {
            opacity: 0.9;
        }
        
        /* Стили для логотипа */
        .logo-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 0;
        }
        
        /* Стили для выпадающих меню */
        .dropdown-menu {
            border: 1px solid rgba(253, 253, 253, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-item {
            transition: all 0.3s ease;
            padding: 8px 20px;
        }
        
        .dropdown-item:hover {
            background-color: rgba(96, 150, 184, 0.5);
        }
        
        /* Стили для десктопной версии подменю */
        @media (min-width: 993px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block;
            }
        }
        
        /* Стили для кнопки Вход */
        .btn-outline-primary {
            border-color: #fdfdfd;
            color: #fdfdfd;
            margin-left: 10px;
        }
        
        .btn-outline-primary:hover {
            background-color: #fdfdfd;
            color: #004571;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 992px) {
            .dropdown-menu {
                background-color: rgba(0, 69, 113, 0.8);
                border: 1px solid rgba(253, 253, 253, 0.2);
                margin-left: 20px;
                padding: 0.5rem 0;
            }
            
            .dropdown-item {
                padding: 0.5rem 1.5rem;
            }
            
            .btn-outline-primary {
                margin: 10px 15px;
                width: calc(100% - 30px);
                text-align: center;
            }
            
            /* Убираем hover эффект для мобильных, так как он мешает работе */
            .nav-item.dropdown:hover .dropdown-menu {
                display: none;
            }
            
            /* Показываем меню только когда есть класс show */
            .nav-item.dropdown.show .dropdown-menu {
                display: block;
            }
        }

        /* Социальные иконки внизу */
        .social-footer {
            background-color: rgba(0, 69, 113, 0.8);
            padding: 20px 0;
            margin-top: 40px;
            border-top: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .social-share {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-share li a {
            display: block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: rgba(96, 150, 184, 0.7);
            color: #fdfdfd;
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-share li a:hover {
            background: rgba(96, 150, 184, 1);
            transform: translateY(-3px);
        }
        
        /* Футер */
        .footer {
            background-color: rgba(0, 69, 113, 0.9);
            color: #fdfdfd;
            padding: 30px 0;
            margin-top: auto;
            border-top: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .footer h5 {
            color: #fdfdfd;
            margin-bottom: 20px;
        }
        
        .footer a {
            color: #fdfdfd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer a:hover {
            color: #6096b8;
            text-decoration: none;
        }
        
        /* Стили для расписания */
        .schedule-container {
            background-color: rgba(0, 69, 113, 0.8);
            border-radius: 10px;
            padding: 30px;
            margin: 20px 0;
        }
        
        .schedule-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        
        .breadcrumbs {
            background-color: rgba(0, 69, 113, 0.6);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .breadcrumbs li {
            display: inline-block;
            margin-right: 10px;
        }
        
        .breadcrumbs li:after {
            content: "›";
            margin-left: 10px;
            color: #fdfdfd;
        }
        
        .breadcrumbs li:last-child:after {
            content: "";
            margin-left: 0;
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

<?php
// Подключаем навбар
include('template/allnavbar.php');
?>

<div class="relative page-wrap">
    <div class="content-wrap relative">
        <section class="land-see-hero-container mx-auto mb3 relative overflow-hidden">
            <div class="land-see-hero-main mx-auto"></div>
        </section>
        
        <div class="container mt-4">
            <div class="rounded border border-grey bg-white alpha-90 clearfix">
                <div class="clearfix">
                    <div class="col-12 p-2">
                        <div class="module-wrap schedule-container">
                            <?php
                            $result = $mysqli->query("SELECT scedule.id_scedule, scedule.titlescedule, scedule.imagescedule, scedule.sstatus, scedule.id_uprofile, uprofile.ulastname, uprofile.ufirstname, uprofile.upatronymic 
                            FROM `scedule` 
                            INNER JOIN `uprofile` ON scedule.id_uprofile = uprofile.id_uprofile WHERE 1=1 AND scedule.sstatus = 'active'");
                            $count = $result->num_rows;
                            if($count > 0){
                            while($row = $result->fetch_array()){
                                    ?>
                            <ul class="list-reset breadcrumbs">
                                            <li class="inline-block mr1">
                                                            <a href="index.php">
                                        
                                            Главная
                                                            </a>
                                                    </li>
                                            <li class="inline-block mr1">
                                                            <a href="scedule.php">
                                        
                                            Расписание богослужений
                                                            </a>
                                                    </li>
                                            <li class="inline-block mr1">
                                        
                                            <?php echo($row['titlescedule'])?>
                                                    </li>
                                    </ul>
                                        <?php 
                                        //if($count > 0){?>
                                        <h1 class="text-center"><?php echo($row['titlescedule'])?></h1>
                                        <p class="text-center">Расписание показано для примера!!!</p>
            
                                        <div class="article-wrap text-center">
                                            <?php
                                            $img = base64_encode($row['imagescedule']);
                                            ?>
                                            <img src="data:image/jpeg; base64, <?=$img?>" class="img-fluid schedule-image" alt="Расписание богослужений">
                                        </div>
                                        <?php }?><!--Конец цикла-->
                                        <?php }else{//Если активного расписания нет, показываем сообщение пользователю?>
                                            <h2 class="text-center">Актуальное расписание будет чуть позже, мы уже работаем над этим.</h2>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center">
                                                    <button class="btn btn-primary" OnClick='location.href="index.php"'>Вернуться на главную</button>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                                            </div>
                                        <?php }?><!--Конец if-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="social-footer">
    <div class="container">
        <?php include('template/social-icons.php'); ?>
    </div>
</div>

<?php
include('template/footer2.php');
?>

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<script>
    // Исправление для мобильного меню - предотвращение закрытия при клике внутри подменю
    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>