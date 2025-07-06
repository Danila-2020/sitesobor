<?php
// Подключение к базе данных
require_once('bd.php');

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['news_image'])) {
    $id_unews = isset($_POST['id_unews']) ? intval($_POST['id_unews']) : 0;
    
    // Проверка загруженного файла
    if ($_FILES['news_image']['error'] === UPLOAD_ERR_OK) {
        // Получаем содержимое файла и экранируем
        $imageData = $mysqli->real_escape_string(file_get_contents($_FILES['news_image']['tmp_name']));
        $id_unews = $mysqli->real_escape_string($id_unews);
        
        // Формируем SQL-запрос
        $sql = "INSERT INTO `uphotonews` (`id_uphotonews`, `id_unews`, `uphotonews`) 
                VALUES (NULL, '$id_unews', '$imageData')";
        
        // Выполняем запрос
        if ($mysqli->query($sql)) {
            $success = "Изображение успешно загружено!";
        } else {
            $error = "Ошибка при загрузке изображения: " . $mysqli->error;
        }
    } else {
        $error = "Ошибка загрузки файла: " . $_FILES['news_image']['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка изображения</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        .file-upload-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }
        .file-upload-label {
            display: block;
            padding: 0.375rem 0.75rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            font-size: 1;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Добавление изображения к новости</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?= $success ?>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= $error ?>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="id_unews">ID новости:</label>
                                <input type="number" class="form-control" id="id_unews" name="id_unews" 
                                       required min="1" placeholder="Введите ID новости">
                            </div>
                            
                            <div class="form-group">
                                <label>Изображение для загрузки:</label>
                                <div class="file-upload-wrapper">
                                    <label class="file-upload-label" id="file-label">
                                        <i class="fa fa-cloud-upload mr-2"></i>Выберите изображение...
                                    </label>
                                    <input type="file" class="file-upload-input" id="news_image" 
                                           name="news_image" accept="image/*" required>
                                </div>
                                <small class="form-text text-muted">
                                    Максимальный размер: 5MB. Допустимые форматы: JPG, PNG, GIF
                                </small>
                            </div>
                            
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fa fa-upload mr-2"></i>Загрузить изображение
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap 4 JS и зависимости -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Показываем имя выбранного файла
            $('#news_image').change(function() {
                var fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $('#file-label').html('<i class="fa fa-file-image-o mr-2"></i>' + fileName);
                }
            });
            
            // Валидация формы
            $('form').submit(function() {
                var fileInput = $('#news_image')[0];
                if (fileInput.files && fileInput.files[0]) {
                    if (fileInput.files[0].size > 5 * 1024 * 1024) {
                        alert('Файл слишком большой! Максимальный размер - 5MB.');
                        return false;
                    }
                }
                return true;
            });
        });
    </script>
</body>
</html>