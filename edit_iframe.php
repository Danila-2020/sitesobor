<?php
// Включаем буферизацию вывода
ob_start();

// Подключаем конфигурацию базы данных
require_once('bd.php');

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

// Определяем список страниц
$pages = [
    'unews.php' => 'Новости',
    'clergy.php' => 'Духовенство', 
    'tour.php' => 'Виртуальный тур',
    'blagochiniya-info.php' => 'Благочиния - Общие сведения',
    'blagochiniya-temples.php' => 'Благочиния - Храмы',
    'blagochiniya-clergy.php' => 'Благочиния - Духовенство',
    'index.php' => 'Главная страница',
];

// Получаем список новостей для выпадающего списка
$news_list = [];
try {
    $news_query = "SELECT `id_unews`, `utitle`, `udescription`, `textunews`, `statusunews`, `dateunews`, `id_uprofile` FROM `unews` WHERE 1=1 ORDER BY id_unews DESC";
    $news_result = $mysqli->query($news_query);
    if ($news_result) {
        while ($news = $news_result->fetch_assoc()) {
            $news_list[$news['id_unews']] = $news['utitle'] . ' (ID: ' . $news['id_unews'] . ')';
        }
    }
} catch (Exception $e) {
    // Если таблица news не существует, игнорируем ошибку
}

// Инициализируем переменные
$iframe = null;
$error = '';
$success = '';

// Получаем ID iframe для редактирования
$iframe_id = isset($_SESSION['edit_iframe_id']) ? (int)$_SESSION['edit_iframe_id'] : 0;
if(!empty($iframe_id)){
    $_SESSION['edit_iframe_id'] = $iframe_id;
}

// Если ID не установлен в сессии, проверяем GET-параметр
if ($iframe_id === 0 && isset($_GET['id'])) {
    $iframe_id = (int)$_GET['id'];
}

// Если ID невалидный, возвращаем на страницу моих iframe
if ($iframe_id <= 0) {
    header('Location: my_iframes.php');
    exit;
}

// Получаем данные iframe из базы данных
try {
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM iframes WHERE id_iframes = '$iframe_id' AND id_uprofile = '$user_id'";
    $result = $mysqli->query($query);
    
    if ($result && $result->num_rows > 0) {
        $iframe = $result->fetch_assoc();
    } else {
        $error = "Iframe не найден или у вас нет прав для его редактирования";
        unset($_SESSION['edit_iframe_id']);
    }
} catch (Exception $e) {
    $error = "Ошибка загрузки данных iframe: " . $e->getMessage();
}

// Обработка формы сохранения изменений
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_iframe'])) {
    // Получаем и валидируем данные из формы
    $utitle = trim($_POST['utitle']);
    $url = trim($_POST['url']);
    $description = trim($_POST['description']);
    $page_iframes = trim($_POST['page_iframes']);
    $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;
    $sub_id = 0;
    
    // Если выбрана страница новостей, получаем ID новости
    if ($page_iframes === 'unews.php' && isset($_POST['news_id']) && !empty($_POST['news_id'])) {
        $sub_id = (int)$_POST['news_id'];
    }
    
    // Валидация обязательных полей
    if (empty($utitle)) {
        $error = "Название обязательно для заполнения";
    } elseif (empty($url)) {
        $error = "URL обязательно для заполнения";
    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
        $error = "Введите корректный URL";
    } elseif (!array_key_exists($page_iframes, $pages) && $page_iframes !== '') {
        $error = "Выбрана недопустимая страница";
    } elseif ($page_iframes === 'unews.php' && $sub_id <= 0) {
        $error = "Для страницы новостей необходимо выбрать новость";
    } else {
        try {
            // Подготавливаем данные для обновления
            $utitle = $mysqli->real_escape_string($utitle);
            $url = $mysqli->real_escape_string($url);
            $description = $mysqli->real_escape_string($description);
            $page_iframes = $mysqli->real_escape_string($page_iframes);
            
            // SQL запрос для обновления
            $update_query = "UPDATE iframes SET 
                            utitle = '$utitle', 
                            url = '$url', 
                            description = '$description', 
                            page_iframes = '$page_iframes', 
                            sub_id = '$sub_id',
                            status = '$status',
                            updated_at = CURRENT_TIMESTAMP 
                            WHERE id_iframes = '$iframe_id' AND id_uprofile = '$user_id'";
            
            if ($mysqli->query($update_query)) {
                $success = "Iframe успешно обновлен!";
                // Обновляем данные в переменной $iframe
                $iframe['utitle'] = $_POST['utitle'];
                $iframe['url'] = $_POST['url'];
                $iframe['description'] = $_POST['description'];
                $iframe['page_iframes'] = $_POST['page_iframes'];
                $iframe['sub_id'] = $sub_id;
                $iframe['status'] = $status;
            } else {
                $error = "Ошибка обновления iframe: " . $mysqli->error;
            }
        } catch (Exception $e) {
            $error = "Ошибка обновления iframe: " . $e->getMessage();
        }
    }
}

// Обработка отмены редактирования
if (isset($_POST['cancel'])) {
    unset($_SESSION['edit_iframe_id']);
    header('Location: my_iframes.php');
    exit;
}

// Обработка выхода
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: signin.php');
    exit;
}

// Очищаем буфер и начинаем вывод HTML
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать iframe - Админ-панель</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
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

        .form-container {
            max-width: 800px;
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

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-start;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .form-actions .btn {
            min-width: 120px;
        }

        .preview-section {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .preview-section h4 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .preview-iframe {
            width: 100%;
            height: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
        }

        .admin-actions {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        /* Стили для Select2 */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 46px;
            padding: 0.75rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
            padding-left: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3498db;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5rem;
        }

        .page-select-wrapper, .news-select-wrapper {
            position: relative;
        }

        .page-select-wrapper .select2, .news-select-wrapper .select2 {
            width: 100% !important;
        }

        .conditional-field {
            display: none;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .news-info {
            background: #e8f4fd;
            border: 1px solid #bee5eb;
            border-radius: 4px;
            padding: 0.75rem;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #2980b9;
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
                <li><a href="my_iframes.php">Мои iframe</a></li>
                <li class="active"><a href="edit_iframe.php?id=<?php echo $iframe_id; ?>">Редактировать iframe</a></li>
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
                    <a href="my_iframes.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Назад к моим iframe
                    </a>
                    <a href="add_iframes.php" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Добавить iframe
                    </a>
                </div>
            </div>

            <h2>Редактировать iframe</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($iframe): ?>
            <div class="form-container">
                <form method="POST" action="" id="iframeForm">
                    <div class="form-group">
                        <label for="utitle" class="required">Название iframe</label>
                        <input type="text" 
                               id="utitle" 
                               name="utitle" 
                               class="form-control" 
                               value="<?php echo htmlspecialchars($iframe['utitle']); ?>" 
                               required
                               placeholder="Введите название iframe">
                        <div class="form-text">Название будет отображаться в списке ваших iframe</div>
                    </div>

                    <div class="form-group">
                        <label for="url" class="required">URL iframe</label>
                        <input type="url" 
                               id="url" 
                               name="url" 
                               class="form-control" 
                               value="<?php echo htmlspecialchars($iframe['url']); ?>" 
                               required
                               placeholder="https://example.com">
                        <div class="form-text">Введите полный URL адрес для iframe</div>
                    </div>

                    <div class="form-group">
                        <label for="page_iframes" class="required">Страница назначения</label>
                        <div class="page-select-wrapper">
                            <select id="page_iframes" name="page_iframes" class="form-control page-select" required>
                                <option value="">-- Выберите страницу --</option>
                                <?php foreach ($pages as $key => $value): ?>
                                    <option value="<?php echo htmlspecialchars($key); ?>" 
                                        <?php echo ($iframe['page_iframes'] == $key) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($value); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-text">Выберите страницу, на которой должен отображаться этот iframe</div>
                    </div>

                    <!-- Поле для выбора новости (отображается только при выборе страницы новостей) -->
                    <div class="form-group conditional-field" id="newsField">
                        <label for="news_id" class="required">Выберите новость</label>
                        <div class="news-select-wrapper">
                            <select id="news_id" name="news_id" class="form-control news-select">
                                <option value="">-- Выберите новость --</option>
                                <?php if (!empty($news_list)): ?>
                                    <?php foreach ($news_list as $id => $title): ?>
                                        <option value="<?php echo htmlspecialchars($id); ?>" 
                                            <?php echo ($iframe['sub_id'] == $id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($title); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-text">Выберите новость, к которой будет привязан этот iframe</div>
                        <?php if (empty($news_list)): ?>
                            <div class="news-info">
                                <i class="fas fa-info-circle"></i> 
                                В базе данных не найдено ни одной новости. Сначала добавьте новости в систему.
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-control" 
                                  rows="4"
                                  placeholder="Введите описание iframe (необязательно)"><?php echo htmlspecialchars($iframe['description']); ?></textarea>
                        <div class="form-text">Дополнительное описание iframe</div>
                    </div>

                    <div class="form-group">
                        <label>Статус</label>
                        <div class="checkbox-group">
                            <input type="checkbox" 
                                   id="status" 
                                   name="status" 
                                   value="1" 
                                   <?php echo ($iframe['status'] == 1) ? 'checked' : ''; ?>>
                            <label for="status" style="font-weight: normal;">Активный</label>
                        </div>
                        <div class="form-text">Если снята галочка, iframe будет неактивен</div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update_iframe" class="btn btn-primary">
                            <i class="fas fa-save" style="margin-right: 5px;"></i> Сохранить изменения
                        </button>
                        <button type="submit" name="cancel" class="btn btn-secondary">
                            <i class="fas fa-times" style="margin-right: 5px;"></i> Отмена
                        </button>
                        <a href="my_iframes.php?delete=<?php echo $iframe['id_iframes']; ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Вы уверены, что хотите удалить этот iframe?')">
                            <i class="fas fa-trash" style="margin-right: 5px;"></i> Удалить
                        </a>
                    </div>
                </form>

                <!-- Предпросмотр iframe -->
                <div class="preview-section">
                    <h4><i class="fas fa-eye" style="margin-right: 5px;"></i> Предпросмотр</h4>
                    <iframe src="<?php echo htmlspecialchars($iframe['url']); ?>" 
                            class="preview-iframe"
                            title="Предпросмотр: <?php echo htmlspecialchars($iframe['utitle']); ?>"
                            sandbox="allow-same-origin allow-scripts">
                    </iframe>
                    <div class="form-text" style="margin-top: 0.5rem;">
                        Предпросмотр может не работать для некоторых сайтов из-за политики безопасности (X-Frame-Options)
                    </div>
                </div>
            </div>
            <?php else: ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i> Iframe не найден или у вас нет прав для его редактирования.
                </div>
                <a href="my_iframes.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Вернуться к моим iframe
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Подключаем jQuery и Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/ru.js"></script>

    <script>
        // Инициализация Select2 с поиском
        $(document).ready(function() {
            $('.page-select').select2({
                placeholder: "Выберите страницу",
                allowClear: false,
                language: "ru",
                width: '100%',
                theme: 'default'
            });

            $('.news-select').select2({
                placeholder: "Выберите новость",
                allowClear: false,
                language: "ru",
                width: '100%',
                theme: 'default'
            });

            // Функция для показа/скрытия поля выбора новости
            function toggleNewsField() {
                const selectedPage = $('#page_iframes').val();
                const newsField = $('#newsField');
                
                if (selectedPage === 'unews.php') {
                    newsField.slideDown(300);
                    $('#news_id').prop('required', true);
                } else {
                    newsField.slideUp(300);
                    $('#news_id').prop('required', false);
                }
            }

            // Инициализация при загрузке страницы
            toggleNewsField();

            // Обработчик изменения выбора страницы
            $('#page_iframes').on('change', function() {
                toggleNewsField();
            });

            // Обновление предпросмотра при изменении URL
            document.getElementById('url').addEventListener('input', function() {
                const preview = document.querySelector('.preview-iframe');
                preview.src = this.value;
            });

            // Подтверждение перед уходом со страницы при несохраненных изменениях
            let formChanged = false;
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    formChanged = true;
                });
                input.addEventListener('change', () => {
                    formChanged = true;
                });
            });

            form.addEventListener('submit', () => {
                formChanged = false;
            });

            window.addEventListener('beforeunload', (e) => {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = 'У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?';
                }
            });

            // Валидация формы
            $('#iframeForm').on('submit', function(e) {
                const selectedPage = $('#page_iframes').val();
                const newsId = $('#news_id').val();
                
                if (selectedPage === 'unews.php' && (!newsId || newsId === '')) {
                    e.preventDefault();
                    alert('Для страницы новостей необходимо выбрать новость');
                    $('#news_id').focus();
                    return false;
                }
            });
        });
    </script>
</body>
</html>