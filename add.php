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

$error = '';
$success = '';

// Обработка формы добавления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = array();
        $placeholders = array();
        
        foreach ($columns as $column) {
            $field = $column['Field'];
            
            // Пропускаем auto_increment поля
            if ($column['Extra'] === 'auto_increment') {
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
        
        if (!empty($data)) {
            $fields = implode(', ', array_keys($data));
            $values = implode(', ', $placeholders);
            
            $sql = "INSERT INTO $table ($fields) VALUES ($values)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($data));
            
            $success = "Запись успешно добавлена!";
            // header("Location: generalmajorprofile.php?table=" . urlencode($table));
            // exit;
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
        textarea, select {
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
        .btn:hover { opacity: 0.9; }
        
        .error { color: #e74c3c; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .success { color: #27ae60; background: #e6ffe6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        
        .field-info { font-size: 12px; color: #777; margin-top: 3px; }
        
        .status-controls { display: flex; align-items: center; gap: 10px; margin-top: 5px; }
        .clear-status-btn { padding: 5px 10px; font-size: 12px; }
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
    </script>
</head>
<body>
    <div class="container">
        <h2>Добавить запись в таблицу: <?php echo htmlspecialchars($table); ?></h2>
        
        <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>" class="btn btn-secondary">← Назад</a>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST" style="margin-top: 20px;">
            <?php foreach ($columns as $column): ?>
                <?php if ($column['Extra'] !== 'auto_increment'): ?>
                    <div class="form-group">
                        <label for="<?php echo $column['Field']; ?>">
                            <?php echo htmlspecialchars($column['Field']); ?>
                        </label>
                        
                        <?php
                        $fieldType = strtolower($column['Type']);
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
                        
                        <?php if ($isStatusField): ?>
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