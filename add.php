<?php
require_once 'config.php';
checkAuth();

$table = isset($_GET['table']) ? $_GET['table'] : '';
if (!$table) {
    header('Location: generalmajorprofile.php');
    exit;
}

// Получаем структуру таблицы
$stmt = $pdo->query("DESCRIBE $table");
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Определяем первичный ключ
$primaryKey = '';
foreach ($columns as $column) {
    if ($column['Key'] === 'PRI') {
        $primaryKey = $column['Field'];
        break;
    }
}

// Если не нашли PRIMARY KEY, ищем возможные варианты
if (!$primaryKey) {
    $possibleKeys = ['id', 'id_' . $table, $table . '_id', 'ID'];
    foreach ($columns as $column) {
        if (in_array($column['Field'], $possibleKeys)) {
            $primaryKey = $column['Field'];
            break;
        }
    }
}

$error = '';
$success = '';

// Обработка формы добавления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = array();
        $placeholders = array();
        
        // Добавляем ID профиля из сессии, если в таблице есть поле id_uprofile
        $hasIdUprofile = false;
        foreach ($columns as $column) {
            if ($column['Field'] === 'id_uprofile') {
                $hasIdUprofile = true;
                break;
            }
        }
        
        if ($hasIdUprofile && isset($_SESSION['id'])) {
            $data['id_uprofile'] = $_SESSION['id'];
            $placeholders[] = "?";
        }
        
        foreach ($columns as $column) {
            $field = $column['Field'];
            
            // Пропускаем auto_increment поля, первичный ключ и id_uprofile (уже обработали)
            if ($column['Extra'] === 'auto_increment' || $field === $primaryKey || $field === 'id_uprofile') {
                continue;
            }
            
            // Обрабатываем разные типы данных
            if (isset($_POST[$field])) {
                $value = $_POST[$field];
                
                // Для чекбоксов
                if ($column['Type'] === 'tinyint(1)' || strpos($column['Type'], 'tinyint') !== false) {
                    $data[$field] = $value ? 1 : 0;
                }
                // Для чисел
                elseif (strpos($column['Type'], 'int') !== false || strpos($column['Type'], 'float') !== false) {
                    $data[$field] = is_numeric($value) ? $value : null;
                }
                // Для дат
                elseif (strpos($column['Type'], 'date') !== false || strpos($column['Type'], 'time') !== false) {
                    $data[$field] = !empty($value) ? $value : null;
                }
                // Для текста
                else {
                    $data[$field] = $value;
                }
                
                $placeholders[] = "?";
            } else {
                // Для чекбоксов, которые не отмечены
                if ($column['Type'] === 'tinyint(1)' || strpos($column['Type'], 'tinyint') !== false) {
                    $data[$field] = 0;
                    $placeholders[] = "?";
                }
                // Устанавливаем NULL для необязательных полей
                elseif ($column['Null'] === 'YES') {
                    $data[$field] = null;
                    $placeholders[] = "?";
                }
            }
        }
        
        // Обработка файлов для BLOB полей
        foreach ($columns as $column) {
            $field = $column['Field'];
            $fieldType = strtolower($column['Type']);
            
            // Пропускаем служебные поля
            if ($column['Extra'] === 'auto_increment' || $field === $primaryKey || $field === 'id_uprofile') {
                continue;
            }
            
            // Проверяем, является ли поле BLOB типом
            if (strpos($fieldType, 'blob') !== false) {
                // Проверяем, был ли загружен файл для этого поля
                if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES[$field]['tmp_name'];
                    $fileName = $_FILES[$field]['name'];
                    $fileSize = $_FILES[$field]['size'];
                    $fileType = $_FILES[$field]['type'];
                    
                    // Читаем содержимое файла
                    $fileContent = file_get_contents($fileTmpPath);
                    
                    // Добавляем в данные для вставки
                    $data[$field] = $fileContent;
                    $placeholders[] = "?";
                    
                    // Сохраняем информацию о файле для отображения
                    $_SESSION['uploaded_file_info'][$field] = [
                        'name' => $fileName,
                        'size' => $fileSize,
                        'type' => $fileType
                    ];
                } elseif ($column['Null'] === 'YES') {
                    // Если поле необязательное и файл не загружен, устанавливаем NULL
                    $data[$field] = null;
                    $placeholders[] = "?";
                }
            }
        }
        
        if (!empty($data)) {
            $fields = implode(', ', array_keys($data));
            $values = implode(', ', $placeholders);
            
            $sql = "INSERT INTO $table ($fields) VALUES ($values)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($data));
            
            $success = "Запись успешно добавлена! ID: " . $pdo->lastInsertId();
            
            // Показываем информацию о загруженных файлах
            if (isset($_SESSION['uploaded_file_info']) && !empty($_SESSION['uploaded_file_info'])) {
                $success .= "<br>Загруженные файлы:";
                foreach ($_SESSION['uploaded_file_info'] as $field => $fileInfo) {
                    $success .= "<br>- {$field}: {$fileInfo['name']} ({$fileInfo['size']} bytes, {$fileInfo['type']})";
                }
                // Очищаем информацию о файлах после отображения
                unset($_SESSION['uploaded_file_info']);
            }
        }
        
    } catch (PDOException $e) {
        $error = "Ошибка при добавлении: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавить запись - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        h2 { margin-bottom: 20px; color: #333; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="number"], input[type="date"], input[type="datetime"], 
        textarea, select, input[type="file"] {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;
        }
        textarea { min-height: 100px; resize: vertical; }
        
        .checkbox-group { display: flex; align-items: center; }
        .checkbox-group input[type="checkbox"] { margin-right: 10px; }
        
        .btn { 
            padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; 
            text-decoration: none; display: inline-block; margin-right: 10px;
        }
        .btn-primary { background: #27ae60; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-info { background: #3498db; color: white; }
        .btn:hover { opacity: 0.9; }
        
        .error { color: #e74c3c; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .success { color: #27ae60; background: #e6ffe6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        
        .field-info { font-size: 12px; color: #777; margin-top: 3px; }
        
        .status-controls { display: flex; align-items: center; gap: 10px; margin-top: 5px; }
        .clear-status-btn { padding: 5px 10px; font-size: 12px; }
        
        .primary-key-info { 
            background: #e6f7ff; border: 1px solid #91d5ff; border-radius: 4px; 
            padding: 10px; margin-bottom: 15px; 
        }
        
        .session-info { 
            background: #f0ffe6; border: 1px solid #7bed9f; border-radius: 4px; 
            padding: 10px; margin-bottom: 15px; 
        }
        
        .blob-field-info { 
            background: #fff3e6; border: 1px solid #ffb366; border-radius: 4px; 
            padding: 10px; margin-top: 5px; 
        }
        
        .file-preview { 
            margin-top: 10px; padding: 10px; background: #f9f9f9; border: 1px dashed #ddd; 
            border-radius: 4px; display: none;
        }
        
        .file-info { font-size: 12px; color: #666; margin-top: 5px; }
        
        .max-size-info { color: #e67e22; font-weight: bold; }
    </style>
    <script>
        function clearStatusField(fieldName) {
            document.getElementById(fieldName).value = '';
            return false; // Prevent default action
        }
        
        function setDefaultStatus(fieldName, defaultValue) {
            document.getElementById(fieldName).value = defaultValue;
            return false; // Prevent default action
        }
        
        function showFilePreview(input, fieldName) {
            const file = input.files[0];
            const preview = document.getElementById('preview-' + fieldName);
            const fileInfo = document.getElementById('file-info-' + fieldName);
            
            if (file) {
                preview.style.display = 'block';
                fileInfo.innerHTML = `
                    <strong>Имя файла:</strong> ${file.name}<br>
                    <strong>Размер:</strong> ${(file.size / 1024).toFixed(2)} KB<br>
                    <strong>Тип:</strong> ${file.type}
                `;
                
                // Показываем превью для изображений
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = '<strong>Превью:</strong><br><img src="' + e.target.result + '" style="max-width: 200px; max-height: 150px; margin-top: 5px;">';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = '<strong>Файл:</strong> ' + file.name;
                }
            } else {
                preview.style.display = 'none';
                fileInfo.innerHTML = '';
            }
        }
        
        function clearFileField(fieldName) {
            const input = document.getElementById(fieldName);
            const preview = document.getElementById('preview-' + fieldName);
            const fileInfo = document.getElementById('file-info-' + fieldName);
            
            input.value = '';
            preview.style.display = 'none';
            fileInfo.innerHTML = '';
            
            return false; // Prevent default action
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Добавить запись в таблицу: <?php echo htmlspecialchars($table); ?></h2>
        
        <?php if ($primaryKey): ?>
            <div class="primary-key-info">
                <strong>Первичный ключ:</strong> <?php echo htmlspecialchars($primaryKey); ?> 
                (будет автоматически сгенерирован)
            </div>
        <?php endif; ?>
        
        <?php 
        // Проверяем наличие поля id_uprofile в таблице
        $hasIdUprofile = false;
        foreach ($columns as $column) {
            if ($column['Field'] === 'id_uprofile') {
                $hasIdUprofile = true;
                break;
            }
        }
        
        if ($hasIdUprofile && isset($_SESSION['id'])): ?>
            <div class="session-info">
                <strong>ID профиля из сессии:</strong> <?php echo htmlspecialchars($_SESSION['id']); ?> 
                (будет автоматически добавлен в поле id_uprofile)
            </div>
        <?php endif; ?>
        
        <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>" class="btn btn-secondary">← Назад</a>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
            <?php foreach ($columns as $column): ?>
                <?php 
                // Пропускаем auto_increment поля, первичный ключ и id_uprofile
                $skipField = (
                    $column['Extra'] === 'auto_increment' || 
                    $column['Field'] === $primaryKey || 
                    $column['Field'] === 'id_uprofile'
                );
                
                if (!$skipField): 
                    $fieldType = strtolower($column['Type']);
                    $isBlobField = strpos($fieldType, 'blob') !== false;
                ?>
                    <div class="form-group">
                        <label for="<?php echo $column['Field']; ?>">
                            <?php echo htmlspecialchars($column['Field']); ?>
                        </label>
                        
                        <?php
                        $isRequired = $column['Null'] === 'NO' && $column['Default'] === null;
                        $isStatusField = $column['Field'] === 'sstatus';
                        $defaultValue = $isStatusField ? 'active' : '';
                        ?>
                        
                        <div class="field-info">
                            Тип: <?php echo $column['Type']; ?> | 
                            <?php echo $isRequired ? 'Обязательное' : 'Необязательное'; ?>
                            <?php if ($column['Default'] !== null): ?>
                                | По умолчанию: <?php echo $column['Default']; ?>
                            <?php endif; ?>
                            <?php if ($isStatusField): ?>
                                | Статус по умолчанию: active
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($isBlobField): ?>
                            <!-- Обработка BLOB полей -->
                            <div class="blob-field-info">
                                <strong>BLOB поле</strong> - загрузите файл
                            </div>
                            
                            <input 
                                type="file" 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                <?php echo $isRequired ? 'required' : ''; ?>
                                onchange="showFilePreview(this, '<?php echo $column['Field']; ?>')"
                                accept="<?php 
                                    // Устанавливаем рекомендуемые типы файлов в зависимости от имени поля
                                    $fieldName = strtolower($column['Field']);
                                    if (strpos($fieldName, 'image') !== false || strpos($fieldName, 'img') !== false) {
                                        echo 'image/*';
                                    } elseif (strpos($fieldName, 'pdf') !== false) {
                                        echo '.pdf';
                                    } elseif (strpos($fieldName, 'doc') !== false) {
                                        echo '.doc,.docx';
                                    } else {
                                        echo '*/*';
                                    }
                                ?>"
                            >
                            
                            <div class="file-controls" style="margin-top: 10px;">
                                <button type="button" class="btn btn-info" 
                                    onclick="clearFileField('<?php echo $column['Field']; ?>')">
                                    Очистить файл
                                </button>
                            </div>
                            
                            <div id="preview-<?php echo $column['Field']; ?>" class="file-preview"></div>
                            <div id="file-info-<?php echo $column['Field']; ?>" class="file-info"></div>
                            
                            <div class="max-size-info">
                                <?php
                                // Определяем максимальный размер в зависимости от типа BLOB
                                if (strpos($fieldType, 'longblob') !== false) {
                                    echo "Максимальный размер: 4GB (LONGBLOB)";
                                } elseif (strpos($fieldType, 'mediumblob') !== false) {
                                    echo "Максимальный размер: 16MB (MEDIUMBLOB)";
                                } else {
                                    echo "Максимальный размер: 64KB (BLOB)";
                                }
                                ?>
                            </div>
                        
                        <?php elseif ($isStatusField): ?>
                            <!-- Специальная обработка для поля sstatus -->
                            <input 
                                type="text" 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                value="active"
                                placeholder="Введите статус..."
                            >
                            <div class="status-controls">
                                <button type="button" class="btn btn-primary clear-status-btn" 
                                    onclick="setDefaultStatus('<?php echo $column['Field']; ?>', 'active')">
                                    Установить "active"
                                </button>
                                <button type="button" class="btn btn-danger clear-status-btn" 
                                    onclick="clearStatusField('<?php echo $column['Field']; ?>')">
                                    Очистить поле
                                </button>
                            </div>
                        
                        <?php elseif (strpos($fieldType, 'text') !== false || strpos($fieldType, 'varchar') !== false && strpos($fieldType, '255') !== false): ?>
                            <textarea 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                <?php echo $isRequired ? 'required' : ''; ?>
                                placeholder="Введите текст..."
                            ></textarea>
                        
                        <?php elseif (strpos($fieldType, 'int') !== false || strpos($fieldType, 'float') !== false || strpos($fieldType, 'decimal') !== false): ?>
                            <input 
                                type="number" 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                <?php echo $isRequired ? 'required' : ''; ?>
                                step="<?php echo strpos($fieldType, 'int') !== false ? '1' : '0.01'; ?>"
                            >
                        
                        <?php elseif (strpos($fieldType, 'date') !== false): ?>
                            <input 
                                type="date" 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                <?php echo $isRequired ? 'required' : ''; ?>
                            >
                        
                        <?php elseif (strpos($fieldType, 'datetime') !== false || strpos($fieldType, 'timestamp') !== false): ?>
                            <input 
                                type="datetime-local" 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                <?php echo $isRequired ? 'required' : ''; ?>
                            >
                        
                        <?php elseif ($fieldType === 'tinyint(1)' || (strpos($fieldType, 'tinyint') !== false && strpos($fieldType, '1') !== false)): ?>
                            <div class="checkbox-group">
                                <input 
                                    type="checkbox" 
                                    id="<?php echo $column['Field']; ?>" 
                                    name="<?php echo $column['Field']; ?>" 
                                    value="1"
                                >
                                <label for="<?php echo $column['Field']; ?>" style="font-weight: normal;">Да</label>
                            </div>
                        
                        <?php else: ?>
                            <input 
                                type="text" 
                                id="<?php echo $column['Field']; ?>" 
                                name="<?php echo $column['Field']; ?>" 
                                <?php echo $isRequired ? 'required' : ''; ?>
                            >
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Добавить запись</button>
                <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>