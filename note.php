<?php
// Страница Подать записку

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
    <title>Подать записку</title>
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
        
        .note-container {
            background-color: rgba(0, 69, 113, 0.6);
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
            border: 1px solid rgba(253, 253, 253, 0.2);
        }
        
        .note-form .form-control {
            background-color: rgba(253, 253, 253, 0.1);
            border: 1px solid rgba(253, 253, 253, 0.3);
            color: #fdfdfd;
        }
        
        .note-form .form-control:focus {
            background-color: rgba(253, 253, 253, 0.2);
            border-color: #d4a76a;
        }
        
        .btn-note {
            background-color: #d4a76a;
            border: none;
            color: #004571;
            font-weight: bold;
            padding: 10px 30px;
        }
        
        .btn-note:hover {
            background-color: #c0955f;
        }
        
        .radio-label {
            display: block;
            padding: 8px 0;
            cursor: pointer;
        }
        
        .radio-label input[type="radio"] {
            margin-right: 10px;
        }
        
        .qr-container {
            background-color: rgba(0, 69, 113, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 300px;
            text-align: center;
        }
        
        .qr-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        
        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .note-container {
                padding: 20px;
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
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Контакты</a>
                </li>
                
                <li class="nav-item active">
                    <a class="btn btn-outline-primary ml-2" href="note.php">Подать записку</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="note-container">
        <h1 class="text-center mb-4">Подать записку</h1>
        
        <p class="mb-4">
            В этом разделе сайта Вы можете заказать поминовение о здравии и упокоении православных христиан сроком на 1, 40 дней, полгода или год. Поданные Вами записки будут читаться при совершении Божественной Литургии.
        </p>
        
        <form method="post" action="" class="note-form">
            <div class="form-group">
                <h4>Поминовение:</h4>
                <label class="radio-label">
                    <input type="radio" name="type" value="О здравии" checked> О здравии
                </label>
                <label class="radio-label">
                    <input type="radio" name="type" value="Об упокоении"> Об упокоении
                </label>
            </div>
            
            <div class="form-group">
                <h4>Длительность поминовения:</h4>
                <label class="radio-label">
                    <input type="radio" name="period" value="Единоразово"> Единоразово (вынимание частиц на проскомидии)
                </label>
                <label class="radio-label">
                    <input type="radio" name="period" value="40 дней" checked> 40 дней - 300 руб. / за 1 имя (ориентировочное пожертвование)
                </label>
                <label class="radio-label">
                    <input type="radio" name="period" value="Полгода"> Полгода - 1000 руб. / за 1 имя (ориентировочное пожертвование)
                </label>
                <label class="radio-label">
                    <input type="radio" name="period" value="Год"> Год - 1500 руб. / за 1 имя (ориентировочное пожертвование)
                </label>
            </div>
            
            <div class="form-group">
                <h4>Поминовение во время:</h4>
                <label class="radio-label">
                    <input type="radio" name="time" value="Божественной литургии" checked> Божественной литургии в Соборе
                </label>
            </div>
            
            <div class="form-group">
                <h4>Имена для поминовения:</h4>
                <p>Укажите имена православных христиан (данные при Святом Крещении) в родительном падеже через запятую:</p>
                <textarea class="form-control" name="targetNames" rows="6" required></textarea>
                <small class="form-text">Пример: Михаила, Анастасии, Антония, Фотинии, Петра</small>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" name="submit" class="btn btn-note">Заказать поминовение</button>
            </div>
            
            <div class="qr-container">
                <h4>Пожертвование</h4>
                <amp-img src="img/Qr.png" width="300" height="300" layout="responsive" class="qr-image"></amp-img>
                <p>Для внесения пожертвования отсканируйте QR-код через приложение вашего банка</p>
            </div>
        </form>
        
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

            $to = "sobor.noreply@mail.ru";
            $subject = "Новая записка";
            $headers = "Content-type: text/html; charset=utf-8 \r\n";
            $headers .= "From: robot.sobor@mail.ru";

            if(mail($to, $subject, $message, $headers)) {
                echo '<div class="alert alert-success mt-3">Ваша записка успешно отправлена!</div>';
            } else {
                echo '<div class="alert alert-danger mt-3">Ошибка при отправке записки. Пожалуйста, попробуйте позже.</div>';
            }
        }
        ?>
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