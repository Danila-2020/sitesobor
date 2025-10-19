<?php
// Включаем буферизацию вывода
ob_start();

// Подключаем конфигурацию
require_once 'bd.php';

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

// Проверяем, что $mysqli существует и инициализирован
if (!isset($mysqli) || $mysqli === null) {
    die("Ошибка подключения к базе данных. Переменная \$mysqli не инициализирована.");
}

// Проверяем и обновляем структуру таблицы iframes при необходимости
try {
    // Проверяем, существует ли таблица
    $tableCheck = $mysqli->query("SHOW TABLES LIKE 'iframes'");
    if ($tableCheck->num_rows === 0) {
        // Создаем таблицу, если она не существует
        $mysqli->query("
            CREATE TABLE iframes (
                id_iframes INT AUTO_INCREMENT PRIMARY KEY,
                utitle VARCHAR(255) NOT NULL,
                url VARCHAR(500) NOT NULL,
                page_iframes VARCHAR(255) NOT NULL,
                description TEXT NULL,
                id_uprofile INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
    } else {
        // Проверяем структуру существующей таблицы
        $result = $mysqli->query("DESCRIBE iframes");
        $columns = [];
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        
        // Добавляем отсутствующие столбцы
        if (!in_array('id_iframes', $columns)) {
            // Сначала проверяем, есть ли первичный ключ
            $keyCheck = $mysqli->query("SHOW KEYS FROM iframes WHERE Key_name = 'PRIMARY'");
            if ($keyCheck->num_rows > 0) {
                // Если есть первичный ключ, удаляем его
                $mysqli->query("ALTER TABLE iframes DROP PRIMARY KEY");
            }
            
            // Добавляем столбец id_iframes как первичный ключ
            $mysqli->query("ALTER TABLE iframes ADD COLUMN id_iframes INT AUTO_INCREMENT PRIMARY KEY FIRST");
        }
        
        // Добавляем поле page_iframes если его нет
        if (!in_array('page_iframes', $columns)) {
            $mysqli->query("ALTER TABLE iframes ADD COLUMN page_iframes VARCHAR(255) NOT NULL DEFAULT 'general' AFTER url");
        }
        
        if (!in_array('created_at', $columns)) {
            $mysqli->query("ALTER TABLE iframes ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        }
        
        if (!in_array('updated_at', $columns)) {
            $mysqli->query("ALTER TABLE iframes ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        }
    }
} catch (Exception $e) {
    die("Ошибка работы с таблицей iframes: " . $e->getMessage());
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
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM iframes WHERE id_uprofile = '$user_id' ORDER BY created_at DESC";
    $result = $mysqli->query($query);
    if ($result) {
        $iframes = $result->fetch_all(MYSQLI_ASSOC);
    }
} catch (Exception $e) {
    $error = "Ошибка загрузки iframe: " . $e->getMessage();
}

// Обработка удаления iframe
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $user_id = $_SESSION['id'];
    
    // Проверяем, принадлежит ли iframe текущему пользователю
    $check_query = "SELECT id_iframes FROM iframes WHERE id_iframes = '$id' AND id_uprofile = '$user_id'";
    $check_result = $mysqli->query($check_query);
    
    if ($check_result && $check_result->fetch_assoc()) {
        try {
            $delete_query = "DELETE FROM iframes WHERE id_iframes = '$id'";
            if ($mysqli->query($delete_query)) {
                header('Location: my_iframes.php?deleted=1');
                exit;
            } else {
                $error = "Ошибка удаления: " . $mysqli->error;
            }
        } catch (Exception $e) {
            $error = "Ошибка удаления: " . $e->getMessage();
        }
    } else {
        $error = "У вас нет прав для удаления этого iframe";
    }
}

// Обработка редактирования iframe - сохраняем ID в сессию
if (isset($_POST['edit_iframe'])) {
    $iframe_id = (int)$_POST['iframe_id'];
    if ($iframe_id > 0) {
        $_SESSION['edit_iframe_id'] = $iframe_id;
        header('Location: edit_iframe.php');
        exit;
    } else {
        $error = "Неверный ID iframe для редактирования";
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
        .btn-info { background: #3498db; }
        .btn-warning { background: #f39c12; }

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
            color: #2c3e50;
        }

        .iframe-url {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            word-break: break-all;
        }

        .iframe-page {
            display: inline-block;
            background: #e8f4fd;
            color: #2980b9;
            padding: 0.3rem 0.6rem;
            border-radius: 3px;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            border: 1px solid #bee5eb;
        }

        .iframe-description {
            margin-bottom: 1rem;
            color: #444;
            line-height: 1.4;
        }

        .iframe-meta {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 1rem;
            padding-top: 0.5rem;
            border-top: 1px solid #eee;
        }

        .iframe-actions {
            display: flex;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .iframe-actions .btn {
            flex: 1;
            text-align: center;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
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

        .page-badge {
            display: inline-flex;
            align-items: center;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            color: #6c757d;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .page-badge i {
            margin-right: 0.25rem;
        }

        .card-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .card-header .iframe-title {
            flex: 1;
            margin-right: 0.5rem;
        }

        .stats-info {
            background: #e8f4fd;
            border: 1px solid #bee5eb;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .stats-info h4 {
            margin-bottom: 0.5rem;
            color: #2980b9;
        }

        .edit-form {
            display: inline;
            margin: 0;
            padding: 0;
        }

        .edit-form .btn {
            margin: 0;
            width: 100%;
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
            <?php
            // Отладочная информация
            echo "<!-- Отладка: ID пользователя: " . $_SESSION['id'] . " -->";
            echo "<!-- Отладка: Количество iframes: " . count($iframes) . " -->";
            foreach ($iframes as $iframe) {
                echo "<!-- Отладка: Iframe ID: " . $iframe['id_iframes'] . " -->";
            }
            ?>
            <!-- Статистика -->
            <?php if (!empty($iframes)): ?>
            <div class="stats-info">
                <h4><i class="fas fa-chart-bar"></i> Статистика</h4>
                <p>Всего iframe: <strong><?php echo count($iframes); ?></strong></p>
            </div>
            <?php endif; ?>
            
            <?php if ($deleted): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> Iframe успешно удален!
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
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
                                <div class="card-header">
                                    <div class="iframe-title"><?php echo htmlspecialchars($iframe['utitle']); ?></div>
                                </div>
                                
                                <div class="iframe-url">
                                    <i class="fas fa-link" style="margin-right: 5px; color: #999;"></i>
                                    <?php echo htmlspecialchars($iframe['url']); ?>
                                </div>
                                
                                <?php if (!empty($iframe['page_iframes'])): ?>
                                    <div class="page-badge">
                                        <i class="fas fa-file-alt"></i>
                                        Страница: <?php echo htmlspecialchars($iframe['page_iframes']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($iframe['description'])): ?>
                                    <div class="iframe-description">
                                        <i class="fas fa-align-left" style="margin-right: 5px; color: #999;"></i>
                                        <?php echo htmlspecialchars($iframe['description']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="iframe-meta">
                                    <i class="fas fa-calendar" style="margin-right: 5px;"></i>
                                    Добавлен: <?php echo date('d.m.Y H:i', strtotime($iframe['created_at'])); ?>
                                    <?php if ($iframe['created_at'] != $iframe['updated_at']): ?>
                                        <br><i class="fas fa-sync-alt" style="margin-right: 5px;"></i>
                                        Обновлен: <?php echo date('d.m.Y H:i', strtotime($iframe['updated_at'])); ?>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="iframe-actions">
                                    <a href="<?php echo htmlspecialchars($iframe['url']); ?>" 
                                       target="_blank" class="btn btn-info">
                                        <i class="fas fa-external-link-alt"></i> Открыть
                                    </a>
                                    
                                    <!-- Форма для редактирования через сессию -->
                                    <form method="POST" action="" class="edit-form">
                                        <input type="hidden" name="iframe_id" value="<?php echo $iframe['id_iframes']; ?>">
                                        <button type="submit" name="edit_iframe" class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i> Редактировать
                                        </button>
                                    </form>
                                    
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