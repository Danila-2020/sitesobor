<?php
// Страница Духовенства(Все пользователи).

ob_start();
// Стартуем сессию ДО подключения шаблонов
session_start();

// Подключаем модуль базы данных
require_once('bd.php');

// Подключаем шаблоны
include('template/clergyhead.php');
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

// Получаем данные из базы данных
$query = "SELECT `id_clergy`, `titleclergy`, `imagesclergy`, `textclergy`, `datesclergy`, `educlergy`,
 `awardsclergy`, `statusclergy`, `id_uprofile` 
FROM `clergy` 
WHERE 1=1 
AND `statusclergy` = 'active'";
$result = $mysqli->query($query);

if (!$result) {
    die("Ошибка запроса: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Духовенство</title>
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
            padding-top: 76px; /* Для фиксированного навбара */
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
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
            color: #fdfdfd !important;
        }

        .nav-link:hover {
            background-color: rgba(96, 150, 184, 0.5);
            color: #fdfdfd !important;
        }

        .nav-item.active .nav-link {
            background-color: rgba(96, 150, 184, 0.7);
        }

        /* Улучшенные стили для мобильного меню */
        .navbar-toggler {
            border: 1px solid rgba(253, 253, 253, 0.3);
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Стили для выпадающих меню */
        .dropdown-menu {
            background-color: rgba(0, 69, 113, 0.95);
            border: 1px solid rgba(253, 253, 253, 0.2);
        }

        .dropdown-item {
            color: #fdfdfd;
        }

        .dropdown-item:hover {
            background-color: rgba(96, 150, 184, 0.5);
            color: #fdfdfd;
        }

        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: rgba(0, 69, 113, 0.98);
                padding: 1rem;
                border-radius: 0 0 8px 8px;
                margin-top: 8px;
                border: 1px solid rgba(253, 253, 253, 0.2);
                border-top: none;
            }
            
            .nav-link {
                margin: 0.2rem 0;
                text-align: center;
                padding: 0.75rem 1rem;
            }

            .nav-item {
                margin-bottom: 5px;
            }

            .nav-item:last-child {
                margin-bottom: 0;
            }

            /* Исправление для корректного закрытия меню */
            .navbar-nav {
                width: 100%;
            }

            /* Выпадающие меню в мобильной версии */
            .dropdown-menu {
                background-color: transparent;
                border: none;
                text-align: center;
            }

            .dropdown-item {
                padding: 0.5rem 1rem;
            }
        }
        
        /* Стили для карточек духовенства */
        .clergy-card {
            background-color: rgba(0, 69, 113, 0.8);
            border: 1px solid rgba(253, 253, 253, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
            color: #fdfdfd;
        }
        
        .clergy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .card-img-top {
            border-radius: 8px 8px 0 0;
            height: 250px;
            object-fit: cover;
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
        
        /* Модальное окно */
        .modal-content {
            background-color: rgba(0, 69, 113, 0.95);
            color: #fdfdfd;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .close {
            color: #fdfdfd;
            opacity: 0.8;
        }
        
        .close:hover {
            color: #fdfdfd;
            opacity: 1;
        }
        
        .btn-danger {
            background-color: rgba(96, 150, 184, 0.7);
            border-color: #fdfdfd;
        }
        
        .btn-danger:hover {
            background-color: rgba(96, 150, 184, 1);
        }
        
        /* Стили для iframe контейнера */
        .iframes-container {
            background-color: rgba(0, 69, 113, 0.8);
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }

        .iframe-item {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .iframe-item h4 {
            color: #fdfdfd;
            margin-bottom: 10px;
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
        }

        .embed-responsive {
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .iframe-description {
            color: #fdfdfd;
            font-style: italic;
            margin-bottom: 10px;
        }
        
        /* Улучшенная адаптивность для мобильных */
        @media (max-width: 768px) {
            body {
                padding-top: 66px;
            }
            
            .social-share {
                gap: 10px;
            }
            
            .social-share li a {
                width: 35px;
                height: 35px;
                line-height: 35px;
            }
            
            .iframes-container {
                padding: 15px;
                margin-top: 20px;
            }
            
            .card-img-top {
                height: 200px;
            }
            
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        @media (max-width: 576px) {
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .card-img-top {
                height: 180px;
            }
            
            h5.card-title {
                font-size: 1.1rem;
            }
            
            .card-text {
                font-size: 0.9rem;
            }
        }

        /* Исправление для кликабельных элементов меню */
        .navbar-nav .nav-link {
            cursor: pointer;
        }

        /* Отключение закрытия меню при клике на dropdown-toggle */
        .dropdown-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
// Подключаем навбар
include('template/allnavbar.php');
?>

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="overflow-container">
            <div class="row">
                <?php while ($clergy = $result->fetch_assoc()): 
                    $img = base64_encode($clergy['imagesclergy']); ?>
                    <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                        <div class="card clergy-card">
                            <img src="data:image/jpeg;base64,<?=$img?>" class="card-img-top" alt="<?php echo htmlspecialchars($clergy['titleclergy']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($clergy['titleclergy']); ?></h5>
                                <p class="card-text">Дата: <?php echo htmlspecialchars($clergy['datesclergy']); ?></p>
                                <p class="card-text">Образование: <?php echo htmlspecialchars($clergy['educlergy']); ?></p>
                                <p class="card-text">Награды: <?php echo htmlspecialchars($clergy['awardsclergy']); ?></p>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#clergyModal<?php echo $clergy['id_clergy']; ?>">
                                    Подробнее
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Модальное окно для подробной информации -->
                    <div class="modal fade" id="clergyModal<?php echo $clergy['id_clergy']; ?>" tabindex="-1" role="dialog" aria-labelledby="clergyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clergyModalLabel"><?php echo htmlspecialchars($clergy['titleclergy']); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo nl2br(htmlspecialchars($clergy['textclergy'])); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Отображение iframe для этой страницы -->
        <?php
        // Подключаем функцию отображения iframe
        require_once 'display_iframes.php';
        
        // Исправленный вызов функции - передаем только имя страницы
        displayIframes('clergy.php');
        ?>
    </div>
    
    <div class="social">
        <div class="container">
            <?php include('template/social-icons.php'); ?>
        </div>
    </div>
</div>

<?php
include('template/footer2.php');
?>

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<!-- Важно: jQuery должен быть подключен ДО Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<script>
// Исправленный скрипт для работы мобильного меню
$(document).ready(function() {
    // Закрытие меню при клике на прямые ссылки (не dropdown)
    $('.navbar-nav .nav-link:not(.dropdown-toggle)').on('click', function() {
        // Проверяем, открыто ли меню на мобильном устройстве
        if ($(window).width() < 992) {
            $('.navbar-collapse').collapse('hide');
        }
    });
    
    // Предотвращаем закрытие меню при клике на dropdown-toggle
    $('.dropdown-toggle').on('click', function(e) {
        if ($(window).width() < 992) {
            e.stopPropagation();
            // Bootstrap сам обработает открытие/закрытие подменю
        }
    });

    // Закрытие меню при клике вне его области (только для мобильных)
    $(document).on('click', function(event) {
        if ($(window).width() < 992) {
            var clickover = $(event.target);
            var navbar = $(".navbar");
            var _opened = $(".navbar-collapse").hasClass("show");
            
            if (_opened === true && !navbar.is(clickover) && navbar.has(clickover).length === 0) {
                $(".navbar-collapse").collapse('hide');
            }
        }
    });

    // Обработчик для кнопки бургер-меню
    $('.navbar-toggler').on('click', function() {
        var navbarCollapse = $('.navbar-collapse');
        // Bootstrap автоматически переключит состояние
    });
});
</script>

<?php 
// Закрываем соединение с базой данных
$mysqli->close();
ob_end_flush(); 
?>
</body>
</html>