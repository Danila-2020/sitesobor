<?php
// Страница Духовенства(Все пользователи).

ob_start();
// Стартуем сессию ДО подключения шаблонов
session_start();

// Подключаем модуль базы данных
require_once('bd.php');

// Подключаем шаблоны
// include('template/clergyhead.php');
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
    </div>

    <!-- Социальные иконки внизу -->
    <div class="social-footer">
        <div class="container">
            <ul class="social-share">
                <li><a href="#"><i class="fab fa-telegram"></i></a></li>
                <li><a href="#"><i class="fab fa-vk"></i></a></li>
                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-skype"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Футер -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Контакты</h5>
                <p>Адрес: г. Минеральные Воды, ул. Пятигорская 35</p>
                <p>Телефон: +7 (879) 225-24-16</p>
                <p>Email: info@sobor.ru</p>
            </div>
            <div class="col-md-4">
                <h5>Быстрые ссылки</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="allunews.php">Новости</a></li>
                    <li><a href="photogallery.php">Галерея</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Время работы</h5>
                <p>Пн-Пт: 8:00 - 18:00</p>
                <p>Сб-Вс: 7:00 - 20:00</p>
            </div>
        </div>
        <hr style="border-color: rgba(253, 253, 253, 0.2);">
        <div class="text-center">
            <p>&copy; <b><i>Дробилко Данила<br>
                            Колодочкин Алексей</i></b></p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>