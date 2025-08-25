<?php
// Форма обратной связи

ob_start();
session_start();
require_once('bd.php');

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
    <title>Контакты</title>
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
        
        .contact-container {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .contact-form .form-control {
            background-color: rgba(253, 253, 253, 0.1);
            border: 1px solid rgba(253, 253, 253, 0.3);
            color: #fdfdfd;
        }
        
        .contact-form .form-control:focus {
            background-color: rgba(253, 253, 253, 0.2);
            border-color: #d4a76a;
        }
        
        .btn-contact {
            background-color: #d4a76a;
            border: none;
            color: #004571;
            font-weight: bold;
            padding: 10px 30px;
        }
        
        .btn-contact:hover {
            background-color: #c0955f;
        }
        
        .contact-icon {
            color: #d4a76a;
            font-size: 1.5rem;
            margin-right: 10px;
        }
        
        .social-share {
            list-style: none;
            padding: 0;
            text-align: center;
        }
        
        .social-share li {
            display: inline-block;
            margin: 0 10px;
        }
        
        .social-share li a i {
            color: #fdfdfd;
            font-size: 24px;
            transition: all 0.3s;
        }
        
        .social-share li a i:hover {
            color: #d4a76a;
            transform: scale(1.2);
        }
        
        .map-container {
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px 0;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .contact-container {
                padding: 20px;
            }
            
            .map-container {
                height: 300px;
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
                
                <li class="nav-item">
                    <a class="nav-link" href="allunews.php">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photogallery.php">Галерея</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contacts.php">Контакты</a>
                </li>
                
                <li class="nav-item">
                    <a class="btn btn-outline-primary ml-2" href="signin.php">Вход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="contact-container">
        <h1 class="text-center mb-4">Контакты</h1>
        
        <div class="row">
            <div class="col-md-6">
                <h3><i class="fa fa-map-marker contact-icon"></i> Адрес</h3>
                <p>г. Минеральные Воды, ул. Ленина, 123</p>
                
                <h3 class="mt-4"><i class="fa fa-phone contact-icon"></i> Телефоны</h3>
                <p>+7 (123) 456-78-90 - канцелярия</p>
                <p>+7 (123) 456-78-91 - свечная лавка</p>
                
                <h3 class="mt-4"><i class="fa fa-envelope contact-icon"></i> Email</h3>
                <p>sobor@example.com</p>
                
                <h3 class="mt-4"><i class="fa fa-clock-o contact-icon"></i> Часы работы</h3>
                <p>Пн-Пт: 8:00 - 19:00</p>
                <p>Сб-Вс: 7:00 - 20:00</p>
                
                <div class="social mt-4">
                    <h3>Мы в соцсетях</h3>
                    <div class="container">
                        <?php include('template/social-icons.php'); ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="map-container">
                    <!-- Здесь будет карта -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2819.123456789012!2d43.12345678901234!3d44.12345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDTCsDA3JzI0LjQiTiA0M8KwMDcnMjQuNCJF!5e0!3m2!1sru!2sru!4v1234567890123!5m2!1sru!2sru" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                
                <h3 class="text-center mt-4">Форма обратной связи</h3>
                <form method="post" action="" class="contact-form mt-3">
                    <div class="form-group">
                        <label>Ваше имя:</label>
                        <input type="text" class="form-control" name="uname" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="uemail" required>
                    </div>
                    <div class="form-group">
                        <label>Сообщение:</label>
                        <textarea class="form-control" name="umessage" rows="4" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-contact">Отправить</button>
                    </div>
                </form>
                
                <?php
                if(isset($_POST['submit'])){
                    $uname = $_POST['uname'];
                    $uemail = $_POST['uemail'];
                    $umessage = "Имя: " . $uname . "<br>" . 
                                "Сообщение: " . nl2br(htmlspecialchars($_POST['umessage'])) . "<br>" . 
                                "E-Mail для обратной связи: " . $uemail;
                
                    $to = "sobor.noreply@mail.ru";
                    $subject = "Новое обращение с сайта";
                    $headers = "Content-type: text/html; charset=utf-8 \r\n";
                    $headers .= "From: robot.sobor@mail.ru";
                
                    if(mail($to, $subject, $umessage, $headers)) {
                        echo '<div class="alert alert-success mt-3">Ваше сообщение успешно отправлено!</div>';
                    } else {
                        echo '<div class="alert alert-danger mt-3">Ошибка при отправке сообщения. Пожалуйста, попробуйте позже.</div>';
                    }
                }                            
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include('template/footer2.php');
?>

<!-- Подключение jQuery, Popper.js и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>