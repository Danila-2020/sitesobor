<?php
// Редактирование Публикации(Пользователь User)

session_start();
require_once('bd.php');
$id = $_POST['id'];
$_SESSION['id'] = $id;

$query = ("");

include('template/head.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>
<div class="container">


<div class="container">
    <h2>Редактирование публикации</h2>

    <?php
    
    // // Получение id публикации из GET-запроса
    // $id_upublic = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Обработка формы при отправке
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $naim = $mysqli->real_escape_string($_POST['naim']);
        $uptext = $mysqli->real_escape_string($_POST['uptext']);
        $statusupublic = 'active'; // Устанавливаем статус по умолчанию

        // Выполнение запроса UPDATE
        $query = "UPDATE `upublic` SET `naim` = '$naim', `uptext` = '$uptext', `statusupublic` = '$statusupublic' WHERE `id_upublic` = $id";

        if ($mysqli->query($query) === TRUE) {
            echo "<div class='alert alert-success'>Запись успешно обновлена!</div>";
        } else {
            echo "<div class='alert alert-danger'>Ошибка: " . $mysqli->error . "</div>";
        }
    }

    // Получение текущих данных публикации для заполнения формы
    $result = $mysqli->query("SELECT `naim`, `uptext` FROM `upublic` WHERE `id_upublic` = $id_upublic");
    $row = $result->fetch_assoc();
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="naim">Название:</label>
            <input type="text" class="form-control" id="naim" name="naim" value="<?php echo htmlspecialchars($row['naim']); ?>" required>
        </div>
        <div class="form-group">
            <label for="uptext">Текст:</label>
            <textarea class="form-control" id="uptext" name="uptext" rows="5" required><?php echo htmlspecialchars($row['uptext']); ?></textarea>
        </div>
        <input type="hidden" name="statusupublic" value="active">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <form action="allupublic.php" method="post" class="mt-3">
        <button type="submit" name="submit" class="btn btn-secondary">Вернуться назад</button>
    </form>
</div>

<!-- Перенести в template footer -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</div>