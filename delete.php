<?php
require_once 'config.php';
checkAuth();

// Устанавливаем кодировку
header('Content-Type: text/html; charset=utf-8');

$table = isset($_GET['table']) ? $_GET['table'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!$table || !$id) {
    header('Location: generalmajorprofile.php');
    exit;
}

// Проверяем, существует ли таблица
$tables = getTableNames($pdo);
if (!in_array($table, $tables)) {
    die("Таблица не найдена");
}

// Получаем имя первичного ключа для таблицы
$primaryKey = getPrimaryKey($pdo, $table);
if (!$primaryKey) {
    die("Не удалось определить первичный ключ для таблицы");
}

// Получаем данные записи перед удалением (для подтверждения)
$stmt = $pdo->prepare("SELECT * FROM $table WHERE $primaryKey = ?");
$stmt->execute([$id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    die("Запись не найдена");
}

// Обработка подтверждения удаления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        try {
            $stmt = $pdo->prepare("DELETE FROM $table WHERE $primaryKey = ?");
            $stmt->execute([$id]);
            
            header("Location: generalmajorprofile.php?table=" . urlencode($table) . "&deleted=1");
            exit;
            
        } catch (PDOException $e) {
            $error = "Ошибка при удалении: " . $e->getMessage();
        }
    } else {
        header("Location: generalmajorprofile.php?table=" . urlencode($table));
        exit;
    }
}

$error = '';

// Функция для получения имени первичного ключа таблицы
function getPrimaryKey($pdo, $table) {
    try {
        // Для MySQL
        $stmt = $pdo->prepare("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result && isset($result['Column_name'])) {
            return $result['Column_name'];
        }
        
        // Альтернативный способ для других СУБД или если первый не сработал
        $stmt = $pdo->query("SELECT * FROM $table LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            // Пробуем найти common primary key names
            $commonKeys = ['id', $table . '_id', $table . 'ID', 'ID'];
            foreach ($commonKeys as $key) {
                if (isset($row[$key])) {
                    return $key;
                }
            }
            
            // Если не нашли common keys, берем первый столбец
            $columns = array_keys($row);
            return $columns[0];
        }
        
        return false;
        
    } catch (Exception $e) {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Удалить запись - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        h2 { margin-bottom: 20px; color: #e74c3c; }
        
        .warning { 
            background: #ffe6e6; border: 2px solid #e74c3c; border-radius: 5px; 
            padding: 15px; margin-bottom: 20px; 
        }
        
        .record-info { 
            background: #f8f9fa; border: 1px solid #ddd; border-radius: 5px; 
            padding: 15px; margin-bottom: 20px; 
        }
        
        .btn { 
            padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; 
            text-decoration: none; display: inline-block; margin-right: 10px;
        }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.9; }
        
        .error { color: #e74c3c; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        
        .field-row { margin-bottom: 8px; }
        .field-name { font-weight: bold; color: #555; }
        .field-value { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>⚠️ Удаление записи</h2>
        
        <div class="warning">
            <strong>Внимание!</strong> Вы собираетесь удалить запись из таблицы 
            <strong><?php echo htmlspecialchars($table); ?></strong>. Это действие нельзя отменить.
        </div>
        
        <div class="record-info">
            <h3>Данные записи:</h3>
            <?php foreach ($record as $field => $value): ?>
                <div class="field-row">
                    <span class="field-name"><?php echo htmlspecialchars($field); ?>:</span>
                    <span class="field-value">
                        <?php 
                        if ($value === null) {
                            echo '<em style="color: #999;">NULL</em>';
                        } elseif (is_string($value) && strlen($value) > 100) {
                            echo htmlspecialchars(substr($value, 0, 100)) . '...';
                        } else {
                            echo htmlspecialchars($value);
                        }
                        ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <p><strong>Вы уверены, что хотите удалить эту запись?</strong></p>
            
            <input type="hidden" name="confirm" value="yes">
            
            <button type="submit" class="btn btn-danger">Да, удалить</button>
            <a href="generalmajorprofile.php?table=<?php echo urlencode($table); ?>" class="btn btn-secondary">Нет, отмена</a>
        </form>
    </div>
</body>
</html>