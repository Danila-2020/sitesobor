<?php
// Включаем буферизацию вывода
ob_start();

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

// Генерируем CSRF-токен если его нет
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Обработка выхода
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: signin.php');
    exit;
}

// Обработка сообщений об успехе/ошибке
$success = isset($_GET['success']) ? true : false;
$error = isset($_GET['error']) ? $_GET['error'] : '';

// Функция для обработки URL
function processUrl($url) {
    // Проверяем, является ли ссылка RuTube iframe
    if (preg_match('/^<iframe[^>]*src="(https?:\/\/rutube\.ru\/play\/embed\/[^"]+)"[^>]*><\/iframe>$/i', $url, $matches)) {
        return $matches[1]; // Возвращаем только URL
    }
    return $url; // Возвращаем исходный URL, если это не RuTube iframe
}

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_iframe'])) {
    // Проверка CSRF-токена
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header('Location: add_iframes.php?error=csrf');
        exit;
    }
    
    $title = trim($_POST['title'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    
    // Обрабатываем URL перед валидацией
    $processedUrl = processUrl($url);
    
    // Валидация
    $errors = [];
    
    if (empty($title)) {
        $errors[] = 'empty_title';
    }
    
    if (empty($processedUrl) || !filter_var($processedUrl, FILTER_VALIDATE_URL)) {
        $errors[] = 'invalid_url';
    }
    
    // Если ошибок нет, сохраняем в базу
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO iframes (utitle, url, description, id_uprofile) 
                    VALUES (:title, :url, :description, :user_id)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':url' => $processedUrl,
                ':description' => $description,
                ':user_id' => $_SESSION['id']
            ]);
            
            header('Location: add_iframes.php?success=1');
            exit;
            
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header('Location: add_iframes.php?error=save_failed');
            exit;
        }
    } else {
        // Перенаправляем с ошибками
        header('Location: add_iframes.php?error=' . implode(',', $errors));
        exit;
    }
}

// Очищаем буфер и начинаем вывод HTML
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить iframe - Админ-панель</title>
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
        
        .logout-btn { 
            background: #e74c3c; margin-top: 2rem; display: block; text-align: center;
            width: 100%; padding: 0.75rem; font-size: 14px;
        }
        .logout-btn:hover { background: #c0392b; }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
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
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Боковое меню -->
        <div class="sidebar">
            <h3>Админ-панель</h3>
            <ul>
                <li><a href="generalmajorprofile.php">Обзор таблиц</a></li>
                <li class="active"><a href="add_iframes.php">Добавить iframe</a></li>
                <li><a href="my_iframes.php">Мои iframe</a></li>
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
                    <a href="my_iframes.php" class="btn" style="background: #9b59b6;">
                        <i class="fas fa-list" style="margin-right: 5px;"></i> Мои iframe
                    </a>
                </div>
            </div>

            <h2>Добавить новый iframe</h2>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    Iframe успешно добавлен!
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <?php 
                    $errorMessages = [
                        'csrf' => 'Ошибка безопасности. Попробуйте еще раз.',
                        'empty_title' => 'Пожалуйста, укажите заголовок.',
                        'invalid_url' => 'Пожалуйста, укажите корректный URL.',
                        'save_failed' => 'Произошла ошибка при сохранении. Попробуйте еще раз.'
                    ];
                    
                    if (isset($errorMessages[$error])) {
                        echo $errorMessages[$error];
                    } else {
                        echo 'Произошла ошибка. Попробуйте еще раз.';
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <div class="form-container">
                <form method="POST" action="">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    
                    <div class="form-group">
                        <label for="title">Заголовок *</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="url">URL *</label>
                        <input type="url" id="url" name="url" placeholder="https://example.com или полный iframe код для RuTube" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Описание (необязательно)</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    
                    <button type="submit" name="add_iframe" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить iframe
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>