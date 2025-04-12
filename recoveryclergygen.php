<?php
// Обработчик частичного удаления Духовенства (Пользователь general)

session_start();
ob_start();
require_once('bd.php');
include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();

// Проверяем, была ли отправлена форма
if (isset($_POST['submitrec'])) {
    $id = $_POST['hidden'];

    // Проверяем, что идентификатор не пустой
    if (!empty($id)) {
        // Экранируем идентификатор для безопасности
        $id = $mysqli->real_escape_string($id);

        // Обновляем статус священника в таблице clergy
        $sql = "UPDATE `clergy` SET `statusclergy`='active' WHERE `id_clergy` = $id";

        // Выполняем запрос
        $result = $mysqli->query($sql);
        
        // Проверяем результат выполнения запроса
        if ($result) {
            echo("<script>alert('Информация о священнике успешно восстановлена!!!');</script>");
            // Перенаправляем пользователя на страницу genclergy.php
            ?>
            <div class="container" style="margin-top:2%;">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <button OnClick='location.href = "genclergy.php";' class="btn btn-primary form-control">Вернуться к списку священников</button>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                </div>
            </div>
            <?php
            exit(); // Завершаем выполнение скрипта после перенаправления
        } else {
            echo 'Ошибка обновления: ' . htmlspecialchars($mysqli->error);
        }
    } else {
        echo 'Ошибка: идентификатор священника не задан.';
    }
}
?>