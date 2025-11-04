<?php
// Включение вывода ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
checkAuth();

// Обработка выхода
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: signin.php');
    exit;
}

// Обработка загрузки изображения
$uploadMessage = '';
$uploadSuccess = false;

if (isset($_POST['upload_gallery'])) {
    if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['gallery_image'];
        
        // Проверка типа файла
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = $file['type'];
        
        // Альтернативная проверка MIME типа
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($fileType, $allowedTypes)) {
            $uploadMessage = 'Ошибка: Допустимы только изображения в форматах JPG, PNG, GIF, WebP. Получен: ' . $fileType;
        } 
        // Проверка размера файла (максимум 5MB)
        elseif ($file['size'] > 5 * 1024 * 1024) {
            $uploadMessage = 'Ошибка: Размер файла не должен превышать 5MB.';
        } else {
            // Создаем директорию gallery, если она не существует
            $galleryDir = 'gallery/';
            if (!is_dir($galleryDir)) {
                if (!mkdir($galleryDir, 0755, true)) {
                    $uploadMessage = 'Ошибка: Не удалось создать директорию для загрузки.';
                }
            }
            
            // Проверяем права на запись в директорию
            if (!is_writable($galleryDir)) {
                $uploadMessage = 'Ошибка: Нет прав на запись в директорию gallery/.';
            } else {
                // Генерируем уникальное имя файла
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $fileName = uniqid() . '_' . time() . '.' . $fileExtension;
                $filePath = $galleryDir . $fileName;
                
                // Пытаемся загрузить файл
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $uploadSuccess = true;
                    $uploadMessage = 'Изображение успешно загружено в галерею!';
                } else {
                    $uploadMessage = 'Ошибка: Не удалось загрузить файл на сервер. Проверьте права доступа.';
                }
            }
        }
    } else {
        $uploadError = $_FILES['gallery_image']['error'] ?? 'Unknown error';
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'Размер файла превышает разрешенный директивой upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'Размер файла превышает разрешенный значением MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'Файл был загружен только частично',
            UPLOAD_ERR_NO_FILE => 'Файл не был загружен',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
            UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла'
        ];
        $uploadMessage = 'Ошибка загрузки: ' . ($errorMessages[$uploadError] ?? 'Неизвестная ошибка');
    }
}

// Безопасное получение списка таблиц
try {
    $tables = getTableNames($pdo);
} catch (Exception $e) {
    $tables = [];
    error_log("Ошибка получения таблиц: " . $e->getMessage());
}

// Словарь для перевода названий таблиц на русский
$tableNames = [
    'activity' => 'Деятельность',
    'iframes' => 'Фреймы',
    'clergy' => 'Духовенство',
    'events' => 'Мероприятия',
    'imgactivity' => 'Изображения деятельности',
    'imgpainting' => 'Изображения росписи',
    'imgstory' => 'Изображения истории',
    'otdel' => 'Отделы',
    'painting' => 'Роспись',
    'poems' => 'Стихи',
    'scedule' => 'Расписание',
    'story' => 'Истории',
    'ugallery' => 'Галерея пользователей',
    'unews' => 'Новости пользователей',
    'uphoto' => 'Фото пользователей',
    'uphotoevent' => 'Фото событий пользователей',
    'uphotogallery' => 'Фото галереи пользователей',
    'uphotonews' => 'Фото новостей пользователей',
    'uphotootdel' => 'Фото отделов пользователей',
    'uprofile' => 'Профили пользователей',
    'upublic' => 'Публикации'
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Добавить фото в галерею - Админ-панель Собора</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        
        .admin-container { display: flex; min-height: 100vh; }
        
        .sidebar {
            width: 250px; background: #2c3e50; color: white; padding: 1rem;
        }
        .sidebar h3 { margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #34495e; }
        .sidebar ul { list-style: none; }
        .sidebar li { margin: 0.5rem 0; }
        .sidebar a {
            color: #ecf0f1; text-decoration: none; display: block; padding: 0.5rem;
            border-radius: 3px; transition: background 0.3s;
        }
        .sidebar a:hover { background: #34495e; }
        .sidebar li.active a { background: #34495e; }
        
        .main-content { flex: 1; padding: 2rem; background: white; }
        .table-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #eee;
        }
        
        .btn {
            display: inline-block; padding: 0.5rem 1rem; color: white; text-decoration: none;
            border-radius: 3px; border: none; cursor: pointer; margin: 0.2rem;
            font-size: 14px;
        }
        .btn-primary { background: #27ae60; }
        .btn-secondary { background: #3498db; }
        .btn-edit { background: #f39c12; padding: 0.3rem 0.6rem; }
        .btn-delete { background: #e74c3c; padding: 0.3rem 0.6rem; }
        .btn-add-iframe { background: #3498db; margin-left: 10px; }
        
        .logout-btn { 
            background: #e74c3c; margin-top: 2rem; display: block; text-align: center;
            width: 100%; padding: 0.75rem; font-size: 14px;
        }
        .logout-btn:hover { background: #c0392b; }
        
        .upload-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-control-file {
            padding: 0.5rem 0;
            border: 2px dashed #ddd;
            border-radius: 4px;
            background: white;
            padding: 1rem;
            width: 100%;
        }
        
        .form-control-file:focus {
            border-color: #3498db;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-text {
            font-size: 12px;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        .table-name-en {
            font-size: 12px; color: #888; font-style: italic; margin-top: 2px;
        }
        
        .admin-actions {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .preview-container {
            margin-top: 1rem;
            text-align: center;
        }
        
        .image-preview {
            max-width: 300px;
            max-height: 200px;
            border: 2px solid #ddd;
            border-radius: 4px;
            display: none;
        }
        
        .file-info {
            background: #e8f4fd;
            padding: 0.75rem;
            border-radius: 4px;
            margin-top: 0.5rem;
            font-size: 14px;
        }
        
        .debug-info {
            background: #fff3cd;
            padding: 0.5rem;
            border-radius: 4px;
            margin-top: 1rem;
            font-size: 12px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Боковое меню с таблицами -->
        <div class="sidebar">
            <h3>Таблицы базы данных</h3>
            <ul>
                <?php if (!empty($tables)): ?>
                    <?php foreach ($tables as $table): ?>
                        <?php if (isset($tableNames[$table])): ?>
                            <li>
                                <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>">
                                    <?php echo htmlspecialchars($tableNames[$table]); ?>
                                    <div class="table-name-en">(<?php echo htmlspecialchars($table); ?>)</div>
                                </a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>">
                                    <?php echo htmlspecialchars($table); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li style="color: #bbb; font-style: italic;">Таблицы не найдены</li>
                <?php endif; ?>
            </ul>
            
            <!-- Кнопка для добавления iframe -->
            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #34495e;">
                <a href="add_iframes.php" class="btn btn-add-iframe" style="display: block; text-align: center;">
                    <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить iframe
                </a>
            </div>
            
            <!-- Форма для выхода -->
            <form method="POST" class="logout-form">
                <button type="submit" name="logout" class="btn logout-btn">Выйти</button>
            </form>
        </div>

        <!-- Основной контент -->
        <div class="main-content">
            <!-- Панель быстрых действий -->
            <div class="admin-actions">
                <h3>Быстрые действия</h3>
                <div>
                    <a href="add_iframes.php" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить iframe
                    </a>
                    <a href="my_iframes.php" class="btn" style="background: #9b59b6;">
                        <i class="fas fa-list" style="margin-right: 5px;"></i> Мои iframe
                    </a>
                    <a href="add_gallery.php" class="btn btn-secondary">
                        <i class="fas fa-image" style="margin-right: 5px;"></i> Добавить фото в галерею
                    </a>
                    <a href="view_gallery.php" class="btn" style="background: #e67e22;">
                        <i class="fas fa-eye" style="margin-right: 5px;"></i> Просмотреть галерею
                    </a>
                    <a href="index.php" class="btn" style="background: #7f8c8d;">
                        <i class="fas fa-home" style="margin-right: 5px;"></i> На главную
                    </a>
                </div>
            </div>

            <div class="table-header">
                <h2>Добавить фото в галерею</h2>
                <div>
                    <a href="view_gallery.php" class="btn" style="background: #e67e22;">
                        <i class="fas fa-eye" style="margin-right: 5px;"></i> Просмотреть галерею
                    </a>
                </div>
            </div>

            <!-- Форма загрузки изображения -->
            <div class="upload-container">
                <?php if ($uploadMessage): ?>
                    <div class="alert <?php echo $uploadSuccess ? 'alert-success' : 'alert-error'; ?>">
                        <?php echo htmlspecialchars($uploadMessage); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" id="uploadForm">
                    <div class="form-group">
                        <label for="gallery_image">Выберите изображение:</label>
                        <input type="file" class="form-control-file" id="gallery_image" name="gallery_image" 
                               accept=".jpg,.jpeg,.png,.gif,.webp" required
                               onchange="previewImage(this)">
                        <small class="form-text">
                            Допустимые форматы: JPG, PNG, GIF, WebP. Максимальный размер: 5MB.
                        </small>
                        
                        <div id="fileInfo" class="file-info" style="display: none;">
                            <strong>Информация о файле:</strong>
                            <div id="fileName"></div>
                            <div id="fileSize"></div>
                            <div id="fileType"></div>
                        </div>
                    </div>
                    
                    <div class="preview-container">
                        <img id="imagePreview" class="image-preview" alt="Предпросмотр">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="upload_gallery">
                        <i class="fas fa-upload" style="margin-right: 5px;"></i> Загрузить в галерею
                    </button>
                    
                    <a href="view_gallery.php" class="btn" style="background: #95a5a6;">
                        <i class="fas fa-eye" style="margin-right: 5px;"></i> К галерее
                    </a>
                </form>
                
                <!-- Отладочная информация -->
                <div class="debug-info">
                    <strong>Отладочная информация:</strong><br>
                    PHP Version: <?php echo phpversion(); ?><br>
                    Max Upload Size: <?php echo ini_get('upload_max_filesize'); ?><br>
                    Gallery Directory: <?php echo is_dir('gallery/') ? 'Exists' : 'Not exists'; ?><br>
                    Writable: <?php echo is_writable('gallery/') ? 'Yes' : 'No'; ?>
                </div>
            </div>

            <div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-bottom: 1rem;">Инструкция по загрузке:</h3>
                <ul style="color: #555; line-height: 1.6;">
                    <li>Выберите изображение в формате JPG, PNG, GIF или WebP</li>
                    <li>Размер файла не должен превышать 5MB</li>
                    <li>Изображения сохраняются в директорию <code>gallery/</code> на сервере</li>
                    <li>Имена файлов генерируются автоматически для избежания конфликтов</li>
                    <li>Для просмотра всех загруженных изображений нажмите "Просмотреть галерею"</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JavaScript для предпросмотра изображения -->
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const fileType = document.getElementById('fileType');
            const file = input.files[0];
            
            if (file) {
                // Показываем информацию о файле
                fileName.textContent = 'Имя: ' + file.name;
                fileSize.textContent = 'Размер: ' + formatBytes(file.size);
                fileType.textContent = 'Тип: ' + file.type;
                fileInfo.style.display = 'block';
                
                // Показываем превью
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                fileInfo.style.display = 'none';
            }
        }
        
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }
    </script>

    <!-- Подключение Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>