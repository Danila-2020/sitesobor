<?php
require_once 'config.php';
checkAuth();

// Обработка выхода
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: signin.php');
    exit;
}

// Обработка удаления изображения
if (isset($_GET['delete'])) {
    $fileName = $_GET['delete'];
    $filePath = 'gallery/' . $fileName;
    
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            $deleteMessage = 'Изображение успешно удалено!';
            $deleteSuccess = true;
        } else {
            $deleteMessage = 'Ошибка: Не удалось удалить файл.';
            $deleteSuccess = false;
        }
    } else {
        $deleteMessage = 'Ошибка: Файл не найден.';
        $deleteSuccess = false;
    }
}

// Получаем все изображения из галереи
$galleryDir = 'gallery/';
$galleryImages = [];

if (is_dir($galleryDir)) {
    $files = scandir($galleryDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $filePath = $galleryDir . $file;
            if (is_file($filePath) && getimagesize($filePath)) {
                $galleryImages[] = [
                    'name' => $file,
                    'path' => $filePath,
                    'size' => filesize($filePath),
                    'modified' => filemtime($filePath)
                ];
            }
        }
    }
    
    // Сортируем по дате изменения (новые сначала)
    usort($galleryImages, function($a, $b) {
        return $b['modified'] - $a['modified'];
    });
}

$tables = getTableNames($pdo);

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
<html>
<head>
    <meta charset="utf-8">
    <title>Галерея - Админ-панель Собора</title>
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
        }
        .btn-primary { background: #27ae60; }
        .btn-secondary { background: #3498db; }
        .btn-danger { background: #e74c3c; }
        .btn-edit { background: #f39c12; padding: 0.3rem 0.6rem; }
        .btn-delete { background: #e74c3c; padding: 0.3rem 0.6rem; }
        
        .logout-btn { 
            background: #e74c3c; margin-top: 2rem; display: block; text-align: center;
            width: 100%; padding: 0.75rem; font-size: 14px;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .gallery-item {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .gallery-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .gallery-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 4px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
        }
        
        .image-info {
            font-size: 12px;
            color: #666;
            margin-bottom: 0.5rem;
            text-align: left;
        }
        
        .image-actions {
            margin-top: 0.5rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
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
        
        .empty-gallery {
            text-align: center;
            padding: 3rem;
            color: #666;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #ddd;
        }
        
        .admin-actions {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .gallery-stats {
            background: #e8f4fd;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .table-name-en {
            font-size: 12px; 
            color: #888; 
            font-style: italic; 
            margin-top: 2px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Боковое меню -->
        <div class="sidebar">
            <h3>Таблицы базы данных</h3>
            <ul>
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
            </ul>
            
            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #34495e;">
                <a href="add_gallery.php" class="btn btn-secondary" style="display: block; text-align: center;">
                    <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить фото
                </a>
            </div>
            
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
                    <a href="add_gallery.php" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить фото в галерею
                    </a>
                    <a href="generalmajorprofile.php" class="btn" style="background: #9b59b6;">
                        <i class="fas fa-table" style="margin-right: 5px;"></i> Админ-панель
                    </a>
                    <a href="index.php" class="btn" style="background: #7f8c8d;">
                        <i class="fas fa-home" style="margin-right: 5px;"></i> На главную
                    </a>
                </div>
            </div>

            <div class="table-header">
                <h2>Галерея изображений</h2>
                <div>
                    <span style="color: #666; margin-right: 1rem;">
                        Изображений: <?php echo count($galleryImages); ?>
                    </span>
                    <a href="add_gallery.php" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить фото
                    </a>
                </div>
            </div>

            <?php if (isset($deleteMessage)): ?>
                <div class="alert <?php echo $deleteSuccess ? 'alert-success' : 'alert-error'; ?>">
                    <?php echo htmlspecialchars($deleteMessage); ?>
                </div>
            <?php endif; ?>

            <?php if (empty($galleryImages)): ?>
                <div class="empty-gallery">
                    <h3><i class="fas fa-image" style="font-size: 3rem; color: #bbb; margin-bottom: 1rem;"></i></h3>
                    <h3>Галерея пуста</h3>
                    <p>Пока нет загруженных изображений.</p>
                    <a href="add_gallery.php" class="btn btn-primary" style="margin-top: 1rem;">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить первое фото
                    </a>
                </div>
            <?php else: ?>
                <div class="gallery-stats">
                    <strong>Всего изображений:</strong> <?php echo count($galleryImages); ?> | 
                    <strong>Директория:</strong> gallery/ | 
                    <strong>Размер галереи:</strong> <?php echo formatBytes(array_sum(array_column($galleryImages, 'size'))); ?>
                </div>

                <div class="gallery-grid">
                    <?php foreach ($galleryImages as $image): ?>
                        <div class="gallery-item">
                            <img src="<?php echo htmlspecialchars($image['path']); ?>" 
                                 alt="<?php echo htmlspecialchars($image['name']); ?>" 
                                 class="gallery-image"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPsOXIMrw7+Dr/Ofg7e7i4O3u4jwvdGV4dD48L3N2Zz4='">
                            
                            <div class="image-info">
                                <div><strong>Имя файла:</strong> <?php echo htmlspecialchars($image['name']); ?></div>
                                <div><strong>Размер:</strong> <?php echo formatBytes($image['size']); ?></div>
                                <div><strong>Загружено:</strong> <?php echo date('d.m.Y H:i', $image['modified']); ?></div>
                            </div>
                            
                            <div class="image-actions">
                                <a href="<?php echo htmlspecialchars($image['path']); ?>" 
                                   target="_blank" 
                                   class="btn" 
                                   style="background: #3498db; padding: 0.5rem 1rem;"
                                   title="Открыть в новой вкладке">
                                    <i class="fas fa-external-link-alt"></i> Открыть
                                </a>
                                <a href="view_gallery.php?delete=<?php echo urlencode($image['name']); ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Удалить изображение \"<?php echo addslashes($image['name']); ?>\"?')"
                                   style="padding: 0.5rem 1rem;"
                                   title="Удалить изображение">
                                    <i class="fas fa-trash"></i> Удалить
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Подключение Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>

<?php
// Функция для форматирования размера в байтах
function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    
    $bytes /= pow(1024, $pow);
    
    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>