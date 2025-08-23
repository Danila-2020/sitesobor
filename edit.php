<?php
require_once 'config.php';
checkAuth();

if (!isset($_GET['table']) || !isset($_GET['id'])) {
    header('Location: generalmajorprofile.php');
    exit;
}

$table = $_GET['table'];
$id = $_GET['id'];

// Проверяем, что таблица существует
$tables = getTableNames($pdo);
if (!in_array($table, $tables)) {
    die("Таблица не существует");
}

// Получаем структуру таблицы и определяем первичный ключ
try {
    $stmt = $pdo->query("DESCRIBE $table");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Определяем первичный ключ
    $primaryKey = null;
    foreach ($columns as $column) {
        if ($column['Key'] === 'PRI') {
            $primaryKey = $column['Field'];
            break;
        }
    }
    
    // Если не нашли PRIMARY KEY, используем первый столбец
    if (!$primaryKey && !empty($columns)) {
        $primaryKey = $columns[0]['Field'];
    }
    
    if (!$primaryKey) {
        die("Не удалось определить первичный ключ для таблицы");
    }

    // Получаем данные записи
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $primaryKey = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("Запись не найдена");
    }

} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $updateFields = [];
        $updateValues = [];
        
        foreach ($columns as $column) {
            $field = $column['Field'];
            if ($field === $primaryKey) continue;
            
            // Обрабатываем BLOB поля отдельно
            if (isBlobType($column['Type'])) {
                // Обработка загруженного файла
                if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                    // Читаем содержимое файла и кодируем в base64
                    $fileContent = file_get_contents($_FILES[$field]['tmp_name']);
                    $value = base64_encode($fileContent);
                } elseif (isset($_POST["{$field}_keep_current"]) && $_POST["{$field}_keep_current"] === '1') {
                    // Сохраняем текущее значение
                    $value = $row[$field];
                } else {
                    // Если файл не загружен и не выбрано сохранение текущего, устанавливаем NULL
                    $value = null;
                }
            } else {
                // Обрабатываем обычные поля
                if (!isset($_POST[$field])) {
                    $value = null;
                } else {
                    $value = $_POST[$field];
                    if ($value === '') $value = null;
                    
                    // Преобразуем числа
                    if (strpos($column['Type'], 'int') !== false || strpos($column['Type'], 'decimal') !== false) {
                        $value = $value !== null ? floatval($value) : null;
                    }
                }
            }
            
            $updateFields[] = "$field = ?";
            $updateValues[] = $value;
        }
        
        $updateValues[] = $id;
        
        $sql = "UPDATE $table SET " . implode(', ', $updateFields) . " WHERE $primaryKey = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($updateValues);
        
        header("Location: generalmajorprofile.php?table=" . urlencode($table));
        exit;
        
    } catch (PDOException $e) {
        $error = "Ошибка обновления: " . $e->getMessage();
    }
}

// Функция для определения типа BLOB
function isBlobType($columnType) {
    $type = strtolower($columnType);
    return strpos($type, 'blob') !== false;
}

// Функция для определения типа input
function getInputType($columnType) {
    $type = strtolower($columnType);
    
    if (isBlobType($type)) {
        return 'file';
    } elseif (strpos($type, 'int') !== false || strpos($type, 'decimal') !== false || strpos($type, 'float') !== false) {
        return 'number';
    } elseif (strpos($type, 'date') !== false && strpos($type, 'datetime') === false) {
        return 'date';
    } elseif (strpos($type, 'datetime') !== false || strpos($type, 'timestamp') !== false) {
        return 'datetime-local';
    } elseif (strpos($type, 'time') !== false) {
        return 'time';
    } else {
        return 'text';
    }
}

// Функция для получения информации о BLOB данных
function getBlobInfo($data) {
    if (!$data) {
        return 'Нет данных';
    }
    
    $size = strlen($data);
    $formattedSize = formatBytes($size);
    
    // Попробуем определить тип содержимого
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_buffer($finfo, $data);
    finfo_close($finfo);
    
    return "Размер: $formattedSize, Тип: $mimeType";
}

// Функция для форматирования размера в байтах
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
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
    <title>Редактирование записи</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 2rem; }
        
        .container {
            max-width: 800px; margin: 0 auto; background: white;
            padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h2 { margin-bottom: 1.5rem; color: #2c3e50; }
        
        .form-group { margin-bottom: 1rem; }
        label { 
            display: block; margin-bottom: 0.5rem; font-weight: bold;
            color: #34495e; 
        }
        
        input, textarea, select {
            width: 100%; padding: 0.75rem; border: 1px solid #ddd;
            border-radius: 4px; font-size: 14px;
        }
        
        textarea { height: 120px; resize: vertical; }
        
        .btn { 
            padding: 0.75rem 1.5rem; border: none; border-radius: 4px;
            cursor: pointer; font-size: 14px; margin-right: 1rem;
        }
        
        .btn-primary { background: #27ae60; color: white; }
        .btn-cancel { background: #95a5a6; color: white; text-decoration: none; display: inline-block; }
        
        .error { 
            color: #e74c3c; background: #ffe6e6; padding: 1rem;
            border-radius: 4px; margin-bottom: 1rem; border: 1px solid #ff4757;
        }
        
        .field-info {
            font-size: 12px; color: #7f8c8d; margin-top: 0.25rem;
        }
        
        .primary-key-info {
            background: #f8f9fa; padding: 1rem; border-radius: 4px;
            margin-bottom: 1rem; border-left: 4px solid #3498db;
        }
        
        .readonly-field {
            background-color: #f8f9fa !important;
            cursor: not-allowed;
        }
        
        .blob-info {
            background: #e8f4fd; padding: 0.75rem; border-radius: 4px;
            margin-bottom: 0.5rem; border-left: 4px solid #3498db;
        }
        
        .keep-current-checkbox {
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Редактирование записи в таблице: <?php echo htmlspecialchars($table); ?></h2>
        
        <div class="primary-key-info">
            <strong>Первичный ключ:</strong> <?php echo $primaryKey; ?><br>
            <strong>ID записи:</strong> <?php echo $id; ?>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <?php foreach ($columns as $column): ?>
                <?php 
                $field = $column['Field'];
                $value = isset($row[$field]) ? $row[$field] : '';
                $inputType = getInputType($column['Type']);
                $isRequired = $column['Null'] === 'NO' && $column['Default'] === null;
                $isPrimaryKey = $field === $primaryKey;
                $isIdUprofile = $field === 'id_uprofile';
                $isReadonly = $isPrimaryKey || $isIdUprofile;
                $isBlob = isBlobType($column['Type']);
                ?>
                
                <div class="form-group">
                    <label for="<?php echo $field; ?>">
                        <?php echo htmlspecialchars($field); ?>
                        <?php if ($isPrimaryKey): ?>
                            <span style="color: #3498db;">(Первичный ключ)</span>
                        <?php elseif ($isIdUprofile): ?>
                            <span style="color: #e67e22;">(ID профиля - только чтение)</span>
                        <?php elseif ($isRequired): ?>
                            <span style="color: red;">*</span>
                        <?php endif; ?>
                    </label>
                    
                    <?php if ($isReadonly): ?>
                        <!-- Поля только для чтения: первичный ключ и id_uprofile -->
                        <input 
                            type="text"
                            id="<?php echo $field; ?>"
                            value="<?php echo htmlspecialchars($value); ?>"
                            readonly
                            class="readonly-field"
                        >
                        <input type="hidden" name="<?php echo $field; ?>" value="<?php echo htmlspecialchars($value); ?>">
                    
                    <?php elseif ($isBlob): ?>
                        <!-- Поля типа BLOB - input type="file" -->
                        <?php if ($value): ?>
                            <div class="blob-info">
                                <strong>Текущий файл:</strong> <?php echo getBlobInfo($value); ?>
                            </div>
                            <div class="keep-current-checkbox">
                                <label>
                                    <input type="checkbox" name="<?php echo $field; ?>_keep_current" value="1" checked>
                                    Сохранить текущий файл
                                </label>
                            </div>
                        <?php endif; ?>
                        
                        <input 
                            type="file"
                            id="<?php echo $field; ?>"
                            name="<?php echo $field; ?>"
                            <?php if ($isRequired && !$value) echo 'required'; ?>
                            accept="*/*"
                        >
                        <div class="field-info">
                            Максимальный размер файла: <?php echo formatBytes(min(
                                return_bytes(ini_get('upload_max_filesize')),
                                return_bytes(ini_get('post_max_size'))
                            )); ?>
                        </div>
                    
                    <?php elseif (stripos($column['Type'], 'text') !== false): ?>
                        <textarea 
                            id="<?php echo $field; ?>"
                            name="<?php echo $field; ?>"
                            <?php if ($isRequired) echo 'required'; ?>
                        ><?php echo htmlspecialchars($value); ?></textarea>
                    
                    <?php elseif (stripos($column['Type'], 'enum') !== false): ?>
                        <?php
                        // Парсим ENUM значения
                        preg_match_all("/'([^']+)'/", $column['Type'], $matches);
                        $enumValues = isset($matches[1]) ? $matches[1] : array();
                        ?>
                        <select 
                            id="<?php echo $field; ?>"
                            name="<?php echo $field; ?>"
                            <?php if ($isRequired) echo 'required'; ?>
                        >
                            <option value="">-- Выберите --</option>
                            <?php foreach ($enumValues as $enumValue): ?>
                                <option value="<?php echo $enumValue; ?>" 
                                    <?php if ($value == $enumValue) echo 'selected'; ?>>
                                    <?php echo $enumValue; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    
                    <?php else: ?>
                        <input 
                            type="<?php echo $inputType; ?>"
                            id="<?php echo $field; ?>"
                            name="<?php echo $field; ?>"
                            value="<?php echo htmlspecialchars($value); ?>"
                            <?php if ($isRequired) echo 'required'; ?>
                            <?php if ($inputType === 'number') echo 'step="any"'; ?>
                        >
                    <?php endif; ?>
                    
                    <div class="field-info">
                        Тип: <?php echo $column['Type']; ?> 
                        <?php if ($column['Key'] === 'PRI'): ?> | Первичный ключ <?php endif; ?>
                        <?php if ($column['Default']): ?> | По умолчанию: <?php echo $column['Default']; ?> <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>" class="btn btn-cancel">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// Вспомогательная функция для преобразования размера из php.ini в байты
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = (int)$val;
    
    switch($last) {
        case 'g': $val *= 1024;
        case 'm': $val *= 1024;
        case 'k': $val *= 1024;
    }
    
    return $val;
}
?>