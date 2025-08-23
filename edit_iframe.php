<?php
session_start();

// Включение отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

require_once('bd.php');

// Получаем ID iframe из GET-параметра
$iframe_id = (int)($_GET['id'] ?? 0);
$user_id = (int)$_SESSION['user_id'];

// Получаем данные iframe
$sql = "SELECT * FROM iframes WHERE id_iframes = $iframe_id AND id_uprofile = $user_id";
$result = $mysqli->query($sql);

if (!$result || $result->num_rows === 0) {
    header('Location: my_iframes.php?error=not_found');
    exit();
}

$iframe = $result->fetch_assoc();

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utitle = trim($_POST['utitle'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $description = !empty($_POST['description']) ? trim($_POST['description']) : null;
    
    // Валидация данных
    if (empty($utitle)) {
        header("Location: edit_iframe.php?id=$iframe_id&error=empty_title");
        exit();
    }
    
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: edit_iframe.php?id=$iframe_id&error=invalid_url");
        exit();
    }
    
    // Экранирование данных
    $utitle = $mysqli->real_escape_string($utitle);
    $url = $mysqli->real_escape_string($url);
    $description = $description ? "'" . $mysqli->real_escape_string($description) . "'" : "NULL";
    
    // Обновление записи
    $update_sql = "UPDATE iframes SET 
                  utitle = '$utitle',
                  url = '$url', 
                  description = $description 
                  WHERE id_iframes = $iframe_id AND id_uprofile = $user_id";
    
    if ($mysqli->query($update_sql)) {
        header("Location: my_iframes.php?success=updated&id=$iframe_id");
    } else {
        header("Location: edit_iframe.php?id=$iframe_id&error=save_failed&db_error=" . urlencode($mysqli->error));
    }
    exit();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать iframe | iframedb</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --light-color: #ecf0f1;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--secondary-color) !important;
        }
        
        .edit-form {
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        
        .edit-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--secondary-color);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 25px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .preview-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
            min-height: 200px;
        }
        
        .url-preview {
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
            word-break: break-all;
        }
        
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 30px 0 15px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Навигация -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-database mr-2"></i>iframedb
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_iframes.php">Добавить iframe</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="my_iframes.php">Мои iframe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Контакты</a>
                    </li>
                    <li class="nav-item dropdown ml-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <i class="fas fa-user-circle mr-1"></i><?php echo htmlspecialchars($_SESSION['user_login'] ?? 'Профиль'); ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="uprofile.php"><i class="fas fa-user-edit mr-2"></i>Редактировать профиль</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Выход</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <div class="container">
        <!-- Сообщения об ошибках -->
        <?php if (isset($_GET['error'])): ?>
            <?php if ($_GET['error'] === 'empty_title'): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    Пожалуйста, укажите название для iframe
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            <?php elseif ($_GET['error'] === 'invalid_url'): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    Пожалуйста, введите корректный URL (начинается с http:// или https://)
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            <?php elseif ($_GET['error'] === 'save_failed'): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    Ошибка при сохранении изменений. <?php echo isset($_GET['db_error']) ? htmlspecialchars($_GET['db_error']) : ''; ?>
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <div class="edit-form">
            <h2><i class="fas fa-edit mr-2"></i>Редактировать iframe</h2>
            
            <form action="edit_iframe.php?id=<?php echo $iframe_id; ?>" method="POST" id="editForm">
                <!-- Добавленное поле для названия -->
                <div class="form-group">
                    <label for="title">Название iframe</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div>
                        <input type="text" class="form-control" id="utitle" name="utitle" 
                               value="<?php echo htmlspecialchars($iframe['utitle']); ?>" required>
                    </div>
                    <small class="form-text text-muted">Укажите название для вашего iframe</small>
                </div>
                
                <div class="form-group">
                    <label for="url">URL iframe</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                        </div>
                        <input type="url" class="form-control" id="url" name="url" 
                               value="<?php echo htmlspecialchars($iframe['url']); ?>" required>
                    </div>
                    <small class="form-text text-muted">Введите полный URL (начинается с http:// или https://)</small>
                </div>
                
                <div class="form-group">
                    <label>Предпросмотр:</label>
                    <div class="preview-container">
                        <div id="iframePreview">
                            <iframe src="<?php echo htmlspecialchars($iframe['url']); ?>" style="width:100%; height:300px; border:none;"></iframe>
                        </div>
                        <div id="urlPreview" class="url-preview"><?php echo htmlspecialchars($iframe['url']); ?></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="2" placeholder="Краткое описание iframe"><?php echo htmlspecialchars($iframe['description'] ?? ''); ?></textarea>
                </div>
                
                <div class="text-right mt-4">
                    <a href="my_iframes.php" class="btn btn-outline-secondary mr-2">Отмена</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Подвал -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-database mr-2"></i>iframedb</h5>
                    <p>Современное решение для управления iframe. Простота, надежность, производительность.</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>&copy; <?php echo date('Y'); ?> iframedb. Все права защищены.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 4 JS и зависимости -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Обновление предпросмотра iframe
        $('#url').on('input', function() {
            const url = $(this).val().trim();
            const preview = $('#iframePreview');
            const urlPreview = $('#urlPreview');
            
            if (url === '') {
                preview.html('<div class="text-center text-muted">Здесь будет отображаться предпросмотр вашего iframe</div>');
                urlPreview.text('');
                return;
            }
            
            // Проверка валидности URL
            try {
                new URL(url);
                preview.html(`<iframe src="${encodeURI(url)}" style="width:100%; height:300px; border:none;"></iframe>`);
                urlPreview.text(url);
            } catch (e) {
                preview.html('<div class="text-center text-danger">Некорректный URL</div>');
                urlPreview.text('');
            }
        });
        
        // Валидация формы перед отправкой
        $('#editForm').on('submit', function(e) {
            const url = $('#url').val().trim();
            const title = $('#title').val().trim();
            
            if (!title) {
                e.preventDefault();
                alert('Пожалуйста, укажите название для iframe');
                $('#title').focus();
                return false;
            }
            
            try {
                new URL(url);
            } catch (e) {
                e.preventDefault();
                alert('Пожалуйста, введите корректный URL (начинается с http:// или https://)');
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>