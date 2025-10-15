<?php
// Включаем буферизацию вывода
ob_start();

// Устанавливаем уровень обработки ошибок
error_reporting(E_ALL);
ini_set('display_errors', 0); // На продакшене лучше отключить вывод ошибок
ini_set('log_errors', 1);

// Базовые проверки перед подключением config.php
if (!file_exists('config.php')) {
    die("Файл config.php не найден. Проверьте путь к файлу.");
}

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
    error_log("Ошибка: Переменная \$pdo не инициализирована в config.php");
    die("Ошибка подключения к базе данных. Пожалуйста, обратитесь к администратору.");
}

// Проверяем соединение с базой данных
try {
    $pdo->query("SELECT 1");
} catch (PDOException $e) {
    error_log("Ошибка подключения к БД: " . $e->getMessage());
    die("Ошибка подключения к базе данных. Пожалуйста, попробуйте позже.");
}

// Генерируем CSRF-токен если его нет
if (!isset($_SESSION['csrf_token'])) {
    if (function_exists('random_bytes')) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } else {
        // Fallback для старых версий PHP
        $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
    }
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
    // Удаляем лишние пробелы
    $url = trim($url);
    
    // Проверяем, является ли ссылка RuTube iframe
    if (preg_match('/^<iframe[^>]*src="(https?:\/\/rutube\.ru\/play\/embed\/[^"]+)"[^>]*><\/iframe>$/i', $url, $matches)) {
        return $matches[1]; // Возвращаем только URL
    }
    
    // Проверяем, является ли обычным URL
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    }
    
    // Если это не валидный URL, возвращаем как есть (для дальнейшей обработки)
    return $url;
}

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_iframe'])) {
    // Проверка CSRF-токена
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header('Location: add_iframes.php?error=csrf');
        exit;
    }
    
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    $page = isset($_POST['page']) ? trim($_POST['page']) : '';
    
    // Обрабатываем URL перед валидацией
    $processedUrl = processUrl($url);
    
    // Валидация
    $errors = [];
    
    if (empty($title)) {
        $errors[] = 'empty_title';
    }
    
    if (empty($processedUrl)) {
        $errors[] = 'invalid_url';
    }
    
    if (empty($page)) {
        $errors[] = 'empty_page';
    }
    
    // Если ошибок нет, сохраняем в базу
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO iframes (utitle, url, description, id_uprofile, page_iframes) 
                    VALUES (:title, :url, :description, :user_id, :page)";
            
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':title' => $title,
                ':url' => $processedUrl,
                ':description' => $description,
                ':user_id' => $_SESSION['id'],
                ':page' => $page
            ]);
            
            if ($result) {
                header('Location: add_iframes.php?success=1');
                exit;
            } else {
                throw new PDOException("Не удалось выполнить запрос INSERT");
            }
            
        } catch (PDOException $e) {
            error_log("Database error in add_iframes.php: " . $e->getMessage());
            header('Location: add_iframes.php?error=save_failed');
            exit;
        }
    } else {
        // Перенаправляем с ошибками
        header('Location: add_iframes.php?error=' . implode(',', $errors));
        exit;
    }
}

// Получаем список доступных страниц
$available_pages = [
    'unews.php' => 'Новости',
    'clergy.php' => 'Духовенство', 
    'tour.php' => 'Виртуальный тур',
    'blagochiniya-info.php' => 'Благочиния - Общие сведения',
    'blagochiniya-temples.php' => 'Благочиния - Храмы',
    'blagochiniya-clergy.php' => 'Благочиния - Духовенство'
];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f5f5f5; 
            line-height: 1.6;
        }
        
        .admin-container { 
            display: flex; 
            min-height: 100vh; 
        }
        
        .sidebar {
            width: 250px; 
            background: #2c3e50; 
            color: white; 
            padding: 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar h3 { 
            margin-bottom: 1rem; 
            padding-bottom: 0.5rem; 
            border-bottom: 1px solid #34495e; 
            color: #ecf0f1;
        }
        
        .sidebar ul { 
            list-style: none; 
        }
        
        .sidebar li { 
            margin: 0.5rem 0; 
        }
        
        .sidebar a {
            color: #ecf0f1; 
            text-decoration: none; 
            display: block; 
            padding: 0.5rem;
            border-radius: 3px; 
            transition: background 0.3s;
        }
        
        .sidebar a:hover { 
            background: #34495e; 
        }
        
        .sidebar li.active a { 
            background: #34495e; 
        }
        
        .main-content { 
            flex: 1; 
            padding: 2rem; 
            background: white;
            margin-left: 250px;
            min-height: 100vh;
        }
        
        .btn {
            display: inline-block; 
            padding: 0.5rem 1rem; 
            color: white; 
            text-decoration: none;
            border-radius: 3px; 
            border: none; 
            cursor: pointer; 
            margin: 0.2rem;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .btn-primary { 
            background: #27ae60; 
        }
        
        .btn-primary:hover {
            background: #219653;
        }
        
        .btn-secondary { 
            background: #7f8c8d; 
        }
        
        .btn-secondary:hover {
            background: #6c7b7d;
        }
        
        .logout-btn { 
            background: #e74c3c; 
            margin-top: 2rem; 
            display: block; 
            text-align: center;
            width: 100%; 
            padding: 0.75rem; 
            font-size: 14px;
        }
        
        .logout-btn:hover { 
            background: #c0392b; 
        }
        
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
            color: #2c3e50;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
            font-family: Arial, sans-serif;
        }
        
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
            border: 1px solid transparent;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        .admin-actions {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .admin-actions h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 46px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 44px;
            padding-left: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px;
        }

        /* Адаптивность для мобильных устройств */
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
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
                <button type="submit" name="logout" class="btn logout-btn">
                    <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>Выйти
                </button>
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

            <h2 style="margin-bottom: 1.5rem; color: #2c3e50;">Добавить новый iframe</h2>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
                    Iframe успешно добавлен!
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>
                    <?php 
                    $errorMessages = [
                        'csrf' => 'Ошибка безопасности. Попробуйте еще раз.',
                        'empty_title' => 'Пожалуйста, укажите заголовок.',
                        'invalid_url' => 'Пожалуйста, укажите корректный URL.',
                        'empty_page' => 'Пожалуйста, выберите страницу.',
                        'save_failed' => 'Произошла ошибка при сохранении. Попробуйте еще раз.'
                    ];
                    
                    // Обработка множественных ошибок
                    $errors = explode(',', $error);
                    foreach ($errors as $err) {
                        if (isset($errorMessages[$err])) {
                            echo '<div>' . $errorMessages[$err] . '</div>';
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <div class="form-container">
                <form method="POST" action="">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                    
                    <div class="form-group">
                        <label for="title">Заголовок *</label>
                        <input type="text" id="title" name="title" required 
                               value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>"
                               placeholder="Введите заголовок iframe">
                    </div>
                    
                    <div class="form-group">
                        <label for="url">URL *</label>
                        <input type="text" id="url" name="url" 
                               value="<?php echo isset($_POST['url']) ? htmlspecialchars($_POST['url']) : ''; ?>"
                               placeholder="https://example.com или полный iframe код для RuTube" required>
                        <small style="color: #666; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                            Для RuTube можно вставить полный код iframe - он будет автоматически обработан
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label for="page">Страница для отображения *</label>
                        <select id="page" name="page" required>
                            <option value="">Выберите страницу...</option>
                            <?php foreach ($available_pages as $page_file => $page_name): ?>
                                <option value="<?php echo htmlspecialchars($page_file); ?>" 
                                    <?php echo (isset($_POST['page']) && $_POST['page'] === $page_file) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($page_name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Описание (необязательно)</label>
                        <textarea id="description" name="description" 
                                  placeholder="Введите описание iframe (необязательно)"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" name="add_iframe" class="btn btn-primary" style="padding: 0.75rem 1.5rem; font-size: 1rem;">
                        <i class="fas fa-plus" style="margin-right: 8px;"></i> Добавить iframe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/ru.js"></script>
    <script>
        $(document).ready(function() {
            $('#page').select2({
                placeholder: "Выберите страницу...",
                allowClear: false,
                width: '100%',
                language: 'ru'
            });
            
            // Сохраняем значения формы при ошибках
            $('form').on('submit', function() {
                // Select2 уже сохраняет значение
            });
        });
    </script>
</body>
</html>