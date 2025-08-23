<?php
// Включаем буферизацию вывода
ob_start();

// Подключаем конфигурацию
require_once 'config.php';

// Если функция checkAuth не определена, создаем её
if (!function_exists('checkAuth')) {
    function checkAuth() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['id'])) {
            header('Location: signin.php');
            exit;
        }
    }
}

// Проверяем авторизацию
checkAuth();

// Проверяем, что $pdo существует и инициализирован
if (!isset($pdo) || $pdo === null) {
    die("Ошибка подключения к базе данных. Переменная \$pdo не инициализирована.");
}

// Проверяем и обновляем структуру таблицы iframes при необходимости
try {
    // Проверяем, существует ли таблица
    $tableCheck = $pdo->query("SHOW TABLES LIKE 'iframes'");
    if ($tableCheck->rowCount() === 0) {
        // Создаем таблицу, если она не существует
        $pdo->exec("
            CREATE TABLE iframes (
                id_iframes INT AUTO_INCREMENT PRIMARY KEY,
                utitle VARCHAR(255) NOT NULL,
                url VARCHAR(500) NOT NULL,
                description TEXT NULL,
                id_uprofile INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
    } else {
        // Проверяем структуру существующей таблицы
        $stmt = $pdo->query("DESCRIBE iframes");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Добавляем отсутствующие столбцы
        if (!in_array('id_iframes', $columns)) {
            // Сначала проверяем, есть ли первичный ключ
            $keyCheck = $pdo->query("SHOW KEYS FROM iframes WHERE Key_name = 'PRIMARY'");
            if ($keyCheck->rowCount() > 0) {
                // Если есть первичный ключ, удаляем его
                $pdo->exec("ALTER TABLE iframes DROP PRIMARY KEY");
            }
            
            // Добавляем столбец id_iframes как первичный ключ
            $pdo->exec("ALTER TABLE iframes ADD COLUMN id_iframes INT AUTO_INCREMENT PRIMARY KEY FIRST");
        }
        
        if (!in_array('created_at', $columns)) {
            $pdo->exec("ALTER TABLE iframes ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        }
        
        if (!in_array('updated_at', $columns)) {
            $pdo->exec("ALTER TABLE iframes ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        }
    }
} catch (PDOException $e) {
    // Более детальная обработка ошибки
    $error_message = $e->getMessage();
    
    // Если ошибка связана с дублированием автоинкрементного поля
    if (strpos($error_message, 'auto column') !== false) {
        // Пытаемся исправить структуру таблицы
        try {
            // Удаляем все автоинкрементные поля кроме одного
            $stmt = $pdo->query("DESCRIBE iframes");
            $columns = $stmt->fetchAll();
            
            $auto_increment_columns = [];
            foreach ($columns as $column) {
                if ($column['Extra'] === 'auto_increment') {
                    $auto_increment_columns[] = $column['Field'];
                }
            }
            
            // Если найдено более одного автоинкрементного поля
            if (count($auto_increment_columns) > 1) {
                for ($i = 1; $i < count($auto_increment_columns); $i++) {
                    $col_name = $auto_increment_columns[$i];
                    $pdo->exec("ALTER TABLE iframes MODIFY COLUMN $col_name INT NOT NULL");
                }
            }
            
            // Проверяем наличие первичного ключа
            $keyCheck = $pdo->query("SHOW KEYS FROM iframes WHERE Key_name = 'PRIMARY'");
            if ($keyCheck->rowCount() === 0) {
                // Если нет первичного ключа, устанавливаем первый автоинкрементный столбец как первичный ключ
                if (!empty($auto_increment_columns)) {
                    $primary_col = $auto_increment_columns[0];
                    $pdo->exec("ALTER TABLE iframes ADD PRIMARY KEY ($primary_col)");
                } else {
                    // Если нет автоинкрементных столбцов, добавляем id_iframes
                    $pdo->exec("ALTER TABLE iframes ADD COLUMN id_iframes INT AUTO_INCREMENT PRIMARY KEY FIRST");
                }
            }
            
        } catch (PDOException $e2) {
            die("Критическая ошибка структуры таблицы: " . $e2->getMessage());
        }
    } else {
        die("Ошибка работы с таблицей iframes: " . $error_message);
    }
}

// Обработка выхода
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: signin.php');
    exit;
}

// Получаем iframe текущего пользователя
$iframes = [];
try {
    // Используем правильное имя столбца для идентификатора
    $stmt = $pdo->prepare("SELECT * FROM iframes WHERE id_uprofile = :user_id ORDER BY created_at DESC");
    $stmt->execute([':user_id' => $_SESSION['id']]);
    $iframes = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Ошибка загрузки iframe: " . $e->getMessage();
}

// Обработка удаления iframe
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Проверяем, принадлежит ли iframe текущему пользователю
    $stmt = $pdo->prepare("SELECT id_iframes FROM iframes WHERE id_iframes = :id AND id_uprofile = :user_id");
    $stmt->execute([':id' => $id, ':user_id' => $_SESSION['id']]);
    
    if ($stmt->fetch()) {
        try {
            $stmt = $pdo->prepare("DELETE FROM iframes WHERE id_iframes = :id");
            $stmt->execute([':id' => $id]);
            header('Location: my_iframes.php?deleted=1');
            exit;
        } catch (PDOException $e) {
            $error = "Ошибка удаления: " . $e->getMessage();
        }
    } else {
        $error = "У вас нет прав для удаления этого iframe";
    }
}

// Сообщения об успехе
$deleted = isset($_GET['deleted']) ? true : false;

// Очищаем буфер и начинаем вывод HTML
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои iframe - Админ-панель</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        
        .btn {
            display: inline-block; padding: 0.5rem 1rem; color: white; text-decoration: none;
            border-radius: 3px; border: none; cursor: pointer; margin: 0.2rem;
        }
        .btn-primary { background: #27ae60; }
        .btn-secondary { background: #7f8c8d; }
        .btn-danger { background: #e74c3c; }
        
        .logout-btn { 
            background: #e74c3c; margin-top: 2rem; display: block; text-align: center;
            width: 100%; padding: 0.75rem; font-size: 14px;
        }
        .logout-btn:hover { background: #c0392b; }
        
        .iframe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .iframe-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .iframe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .iframe-preview {
            height: 200px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #ddd;
        }
        
        .iframe-preview iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .iframe-info {
            padding: 1rem;
        }
        
        .iframe-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .iframe-url {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            word-break: break-all;
        }
        
        .iframe-description {
            margin-bottom: 1rem;
            color: #444;
        }
        
        .iframe-actions {
            display: flex;
            justify-content: space-between;
        }
        
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .admin-actions {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }
        
        .debug-info {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Боковое меню -->
        <div class="sidebar">
            <h3>Админ-панель</h3>
            <ul>
                <li><a href="generalmajorprofile.php">Обзор таблиц</a></li>
                <li><a href="add_iframes.php">Добавить iframe</a></li>
                <li class="active"><a href="my_iframes.php">Мои iframe</a></li>
            </ul>
            
            <!-- Форма для выхода -->
            <form method="POST" class="logout-form">
                <button type="submit" name="logout" class="btn logout-btn">Выйти</button>
            </form>
        </div>

        <!-- Основной контент -->
        <div class="main-content">
            <div class="admin-actions">
                <h3>Быстрые действия</h3>
                <div>
                    <a href="generalmajorprofile.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Назад к таблицам
                    </a>
                    <a href="add_iframes.php" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить iframe
                    </a>
                </div>
            </div>

            <h2>Мои iframe</h2>
            
            <?php if ($deleted): ?>
                <div class="alert alert-success">
                    Iframe успешно удален!
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (empty($iframes)): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>У вас пока нет iframe</h3>
                    <p>Добавьте свой первый iframe, чтобы он отобразился здесь</p>
                    <a href="add_iframes.php" class="btn btn-primary" style="margin-top: 1rem;">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить iframe
                    </a>
                </div>
            <?php else: ?>
                <div class="iframe-grid">
                    <?php foreach ($iframes as $iframe): ?>
                        <div class="iframe-card">
                            <div class="iframe-preview">
                                <iframe src="<?php echo htmlspecialchars($iframe['url']); ?>" 
                                        title="<?php echo htmlspecialchars($iframe['utitle']); ?>"
                                        sandbox="allow-same-origin allow-scripts">
                                </iframe>
                            </div>
                            <div class="iframe-info">
                                <div class="iframe-title"><?php echo htmlspecialchars($iframe['utitle']); ?></div>
                                <div class="iframe-url"><?php echo htmlspecialchars($iframe['url']); ?></div>
                                <?php if (!empty($iframe['description'])): ?>
                                    <div class="iframe-description"><?php echo htmlspecialchars($iframe['description']); ?></div>
                                <?php endif; ?>
                                <div class="iframe-actions">
                                    <a href="<?php echo htmlspecialchars($iframe['url']); ?>" 
                                       target="_blank" class="btn" style="background: #3498db;">
                                        <i class="fas fa-external-link-alt"></i> Открыть
                                    </a>
                                    <a href="my_iframes.php?delete=<?php echo $iframe['id_iframes']; ?>" 
                                       class="btn btn-danger"
                                       onclick="return confirm('Вы уверены, что хотите удалить этот iframe?')">
                                        <i class="fas fa-trash"></i> Удалить
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>