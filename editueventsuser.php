<?php
// Редактирование мероприятия (Пользователь user)

session_start();
ob_start();
require_once('bd.php');

// if(isset($_POST['submit'])){
    
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_events = $_POST['id_events'];
    $caption = $_POST['caption'];
    $description = $_POST['description'];
    $datep = $_POST['datep'];
    $statusevents = $_POST['statusevents'];

    // Подключение к базе данных
    $conn = new mysqli('localhost', 'username', 'password', 'database');

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка соединения: " . $conn->connect_error);
    }

    // Экранирование данных для предотвращения SQL-инъекций
    $caption = $conn->real_escape_string($caption);
    $description = $conn->real_escape_string($description);
    $datep = $conn->real_escape_string($datep);
    $statusevents = $conn->real_escape_string($statusevents);

    // Формирование и выполнение SQL-запроса
    $sql = "UPDATE events SET caption='" . $caption . "', description='" . $description . "', datep='" . $datep . "', statusevents='" . $statusevents . "' WHERE id_events=" . $id_events;
    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно обновлена.";
    } else {
        echo "Ошибка: " . $conn->error;
    }

    $conn->close();
}
?>
</body>
</html>