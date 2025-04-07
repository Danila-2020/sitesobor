<?php
require_once('bd.php');
session_start();//Тут идёт session_start(), он наверное должен быть в этом файле
ob_start();

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $poem_title = $mysqli->real_escape_string($_POST['poem_title']);
    $additional_text = $mysqli->real_escape_string($_POST['additional_text']);
    
    // Предполагаем, что id_uprofile передается из сессии или другого источника
    // Например, если вы используете сессии, вы можете сделать так:
    session_start();
    $id = $_SESSION['id']; // Замените на ваш способ получения ID пользователя

    // Обработка изображения
    if (isset($_FILES['uphoto']) && $_FILES['uphoto']['error'] == 0) {
        $image = $_FILES['uphoto']['tmp_name'];
        $imageData = file_get_contents($image);
        $base64 = base64_encode($imageData);
        
        // SQL-запрос для вставки данных
        $sql = "INSERT INTO poems (n_poems, textpoems, imgpoems, id_uprofile) VALUES ('$poem_title', '$additional_text', '$base64', '$id')";

        if ($mysqli->query($sql) === TRUE) {
            echo "<script>
            alert('Новый стих успешно добавлен!');
            setTimeout(function() {
                window.location.href = 'addpoems.php';
            }, 1000); // Задержка 1000 миллисекунд (1 секунда)
          </script>";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "Ошибка загрузки изображения.";
    }
}

$mysqli->close();
?>