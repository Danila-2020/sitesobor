<?php
require_once 'config.php';
checkAuth();

// Обработка выхода
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: signin.php');
    exit;
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

// Исправляем оператор ?? для старых версий PHP
$currentTable = isset($_GET['table']) ? $_GET['table'] : (isset($tables[0]) ? $tables[0] : '');

// Получение данных выбранной таблицы
$tableData = array();
$columns = array();
$blobColumns = array(); // Массив для хранения BLOB-колонок
$error = '';

if ($currentTable && in_array($currentTable, $tables)) {
    try {
        // Получаем колонки таблицы и их типы
        $stmt = $pdo->query("DESCRIBE $currentTable");
        $columns = array();
        $blobColumns = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $columns[] = $row['Field'];
            // Определяем BLOB-колонки по типу данных
            if (stripos($row['Type'], 'blob') !== false || 
                stripos($row['Type'], 'binary') !== false ||
                stripos($row['Type'], 'image') !== false) {
                $blobColumns[] = $row['Field'];
            }
        }
        
        // Получаем данные таблицы (первые 50 записей)
        $stmt = $pdo->query("SELECT * FROM $currentTable LIMIT 50");
        $tableData = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tableData[] = $row;
        }
    } catch (PDOException $e) {
        $error = "Ошибка загрузки данных: " . $e->getMessage();
    }
}

// Функция для безопасного вывода (УБРАНА ОБРЕЗКА ТЕКСТА)
function safeOutput($value) {
    if ($value === null) {
        return 'NULL';
    }
    return htmlspecialchars($value);
}

// Функция для проверки, является ли данные изображением
function isImageBlob($data) {
    if (empty($data)) return false;
    
    // Проверяем первые несколько байтов на сигнатуры изображений
    $signatures = [
        "\xFF\xD8\xFF", // JPEG
        "\x89\x50\x4E\x47", // PNG
        "\x47\x49\x46\x38", // GIF
        "\x52\x49\x46\x46", // WEBP
        "\x42\x4D", // BMP
    ];
    
    foreach ($signatures as $signature) {
        if (substr($data, 0, strlen($signature)) === $signature) {
            return true;
        }
    }
    
    return false;
}

// Функция для создания миниатюры из BLOB-данных
function createBlobThumbnail($blobData, $maxWidth = 100, $maxHeight = 100) {
    if (empty($blobData)) {
        return '<span style="color: #999; font-style: italic;">(пусто)</span>';
    }
    
    if (!isImageBlob($blobData)) {
        $size = strlen($blobData);
        return '<span style="color: #666; font-style: italic;">BLOB ('.formatBytes($size).')</span>';
    }
    
    try {
        $base64 = base64_encode($blobData);
        $mimeType = getImageMimeType($blobData);
        
        return '<img src="data:'.$mimeType.';base64,'.$base64.'" 
                 class="img-fluid" 
                 style="max-width: '.$maxWidth.'px; max-height: '.$maxHeight.'px; 
                        border: 1px solid #ddd; border-radius: 3px;"
                 alt="Миниатюра">';
    } catch (Exception $e) {
        return '<span style="color: #e74c3c; font-style: italic;">Ошибка изображения</span>';
    }
}

// Функция для определения MIME-типа изображения
function getImageMimeType($imageData) {
    $signatures = [
        "\xFF\xD8\xFF" => 'image/jpeg',
        "\x89\x50\x4E\x47" => 'image/png',
        "\x47\x49\x46\x38" => 'image/gif',
        "\x52\x49\x46\x46" => 'image/webp',
        "\x42\x4D" => 'image/bmp',
    ];
    
    foreach ($signatures as $signature => $mime) {
        if (substr($imageData, 0, strlen($signature)) === $signature) {
            return $mime;
        }
    }
    
    return 'application/octet-stream';
}

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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Админ-панель Собора</title>
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
        .btn-edit { background: #f39c12; padding: 0.3rem 0.6rem; }
        .btn-delete { background: #e74c3c; padding: 0.3rem 0.6rem; }
        .btn-add-iframe { background: #3498db; margin-left: 10px; }
        
        .logout-btn { 
            background: #e74c3c; margin-top: 2rem; display: block; text-align: center;
            width: 100%; padding: 0.75rem; font-size: 14px;
        }
        .logout-btn:hover { background: #c0392b; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; font-size: 14px; }
        th { background: #f8f9fa; font-weight: bold; }
        tr:nth-child(even) { background: #f8f9fa; }
        tr:hover { background: #e3f2fd; }
        .actions { white-space: nowrap; }
        
        .error { color: #ff4757; background: #ffe6e6; padding: 1rem; border-radius: 5px; margin: 1rem 0; }
        .welcome { text-align: center; padding: 3rem; color: #666; }
        
        .logout-form { margin-top: 2rem; }
        
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
        
        /* Стили для полного отображения содержимого */
        .data-table {
            table-layout: auto;
            width: 100%;
        }
        .data-table td {
            white-space: normal;
            word-wrap: break-word;
            max-width: 300px;
        }
        .data-table th {
            white-space: nowrap;
        }
        
        /* Стили для изображений */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        
        .blob-indicator {
            display: inline-block;
            padding: 2px 6px;
            background: #3498db;
            color: white;
            border-radius: 3px;
            font-size: 10px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Боковое меню с таблицами -->
        <div class="sidebar">
            <h3>Таблицы базы данных</h3>
            <ul>
                <?php foreach ($tables as $table): ?>
                    <?php if (isset($tableNames[$table])): ?>
                        <li <?php echo ($currentTable === $table) ? 'class="active"' : ''; ?>>
                            <a href="?table=<?php echo urlencode($table); ?>">
                                <?php echo htmlspecialchars($tableNames[$table]); ?>
                                <div class="table-name-en">(<?php echo htmlspecialchars($table); ?>)</div>
                            </a>
                        </li>
                    <?php else: ?>
                        <li <?php echo ($currentTable === $table) ? 'class="active"' : ''; ?>>
                            <a href="?table=<?php echo urlencode($table); ?>">
                                <?php echo htmlspecialchars($table); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
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
                <!-- НОВЫЕ КНОПКИ ДЛЯ ГАЛЕРЕИ -->
                <a href="add_gallery.php" class="btn" style="background: #3498db;">
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

            <?php if ($currentTable): ?>
                <div class="table-header">
                    <h2>
                        Таблица: 
                        <?php echo isset($tableNames[$currentTable]) ? 
                              htmlspecialchars($tableNames[$currentTable]) : 
                              htmlspecialchars($currentTable); ?>
                        <div class="table-name-en">(<?php echo htmlspecialchars($currentTable); ?>)</div>
                    </h2>
                    <div>
                        <span style="color: #666; margin-right: 1rem;">
                            Записей: <?php echo count($tableData); ?>
                        </span>
                        <a href="add.php?table=<?php echo urlencode($currentTable); ?>" class="btn btn-primary">+ Добавить запись</a>
                    </div>
                </div>

                <?php if ($error): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (!empty($tableData)): ?>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <?php foreach ($columns as $column): ?>
                                        <th>
                                            <?php echo htmlspecialchars($column); ?>
                                            <?php if (in_array($column, $blobColumns)): ?>
                                                <span class="blob-indicator" title="BLOB поле">BLOB</span>
                                            <?php endif; ?>
                                        </th>
                                    <?php endforeach; ?>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tableData as $row): ?>
                                    <tr>
                                        <?php foreach ($columns as $column): ?>
                                            <td>
                                                <?php if (in_array($column, $blobColumns) && isset($row[$column])): ?>
                                                    <!-- Отображаем BLOB-данные как миниатюру -->
                                                    <?php echo createBlobThumbnail($row[$column]); ?>
                                                <?php else: ?>
                                                    <!-- Обычное текстовое поле -->
                                                    <?php echo safeOutput(isset($row[$column]) ? $row[$column] : null); ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <td class="actions">
                                        <?php 
                                        // Пробуем определить первичный ключ
                                        $primaryKey = null;
                                        $possibleKeys = ['id', 'ID', 'Id', 'item_id', 'user_id', 'product_id', 'code'];
                                        
                                        foreach ($possibleKeys as $key) {
                                            if (isset($row[$key])) {
                                                $primaryKey = $key;
                                                $idValue = $row[$key];
                                                break;
                                            }
                                        }
                                        
                                        // Если не нашли, используем первый столбец
                                        if (!$primaryKey && !empty($row)) {
                                            $primaryKey = array_keys($row)[0];
                                            $idValue = $row[$primaryKey];
                                        }
                                        
                                        if ($primaryKey && $idValue): ?>
                                            <a href="edit.php?table=<?php echo urlencode($currentTable); ?>&id=<?php echo urlencode($idValue); ?>" 
                                            class="btn btn-edit">✏️</a>
                                            <a href="delete.php?table=<?php echo urlencode($currentTable); ?>&id=<?php echo urlencode($idValue); ?>" 
                                            class="btn btn-delete" 
                                            onclick="return confirm('Удалить запись?')">🗑️</a>
                                        <?php else: ?>
                                            <span style="color: #999;">—</span>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Таблица пуста</p>
                <?php endif; ?>
            <?php else: ?>
                <div class="welcome">
                    <h2>Добро пожаловать в админ-панель</h2>
                    <p>Выберите таблицу из меню слева для управления данными</p>
                    <p style="margin-top: 1rem; color: #888;">
                        Доступные таблицы: <?php echo count($tables); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Подключение Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>