<?php
// Страница загрузки в Фотогалерею
session_start();
ob_start();
require_once('bd.php'); // Подключение к БД
include('template/scedulehead.php');
include('template/barber.php');

// Увеличиваем лимиты для загрузки
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '110M');
ini_set('max_execution_time', 300);
ini_set('max_input_time', 300);

// Пагинация
$items_per_page = 8;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;

// Получаем общее количество изображений
$total_items = $mysqli->query("SELECT COUNT(*) as total FROM uphotogallery WHERE id_ugallery = 1")->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

$offset = ($current_page - 1) * $items_per_page;

// Выводим стили
echo getStyles();
?>
    <!-- Стили остаются без изменений -->
    <style>
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .gallery-img:hover {
            transform: scale(1.03);
        }
        .modal-img {
            max-height: 80vh;
            width: auto;
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }
        .modal {
            z-index: 1060;
        }
        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin: 5px;
            border: 1px solid #ddd;
        }
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .progress {
            margin-top: 15px;
            display: none;
        }
        .file-error {
            color: #dc3545;
            font-size: 0.875em;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
        .page-link {
            color: #007bff;
        }
    </style>
</head>
<body>
<?php
include('template/generalheader.php');
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Фотогалерея</h1>
    
    <!-- Форма загрузки -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Добавить фото в галерею (до 100 фото за раз)</h5>
        </div>
        <div class="card-body">
        <form action="adduphotogallery.php" method="POST" enctype="multipart/form-data" id="uploadForm">
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="img_upload" name="img_upload[]" multiple required>
                <label class="custom-file-label" for="img_upload">Выберите изображения (можно несколько)</label>
            </div>
            <small class="form-text text-muted">Максимальный размер каждого файла: 25MB, общий размер загрузки не более 100MB</small>
            <div id="fileError" class="file-error"></div>
        </div>
        <div class="preview-container" id="previewContainer"></div>
        <div class="progress" id="uploadProgress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="desc_img" placeholder="Описание изображений (будет применено ко всем)" rows="3"></textarea>
        </div>
        <button type="submit" name="upload_gallery" class="btn btn-primary">Загрузить выбранные фото</button>
        
        <?php
        if(isset($_POST['upload_gallery'])) {
            // Проверяем, не превышен ли общий размер загрузки
            if ($_SERVER['CONTENT_LENGTH'] > 104857600) { // 100MB в байтах
                echo '<div class="alert alert-danger mt-3">Ошибка: Общий размер загружаемых файлов превышает 100MB. Пожалуйста, уменьшите количество или размер файлов.</div>';
            } else {
                $desc_img = $mysqli->real_escape_string($_POST['desc_img']);
                $id_gallery = 1;
                $img_size = 25*1024*1024; // 25MB
                $total_size = 0;
                $successCount = 0;
                $errorCount = 0;
                
                if(!empty($_FILES['img_upload']['tmp_name'][0])) {
                    // Проверяем общий размер файлов перед загрузкой
                    foreach($_FILES['img_upload']['size'] as $size) {
                        $total_size += $size;
                    }
                    
                    if($total_size > 100*1024*1024) { // 100MB
                        echo '<div class="alert alert-danger mt-3">Ошибка: Общий размер файлов ('.round($total_size/1024/1024, 2).'MB) превышает лимит в 100MB</div>';
                    } else {
                        foreach($_FILES['img_upload']['tmp_name'] as $key => $tmp_name) {
                            $img_type = substr($_FILES['img_upload']['type'][$key], 0, 5);
                            
                            if($img_type === 'image' && $_FILES['img_upload']['size'][$key] <= $img_size) {
                                $img = $mysqli->real_escape_string(file_get_contents($tmp_name));
                                
                                $sql = "INSERT INTO `uphotogallery` (`uphotogal`, `udescphoto`, `id_ugallery`) 
                                        VALUES ('$img', '$desc_img', '$id_gallery')";
                                
                                if($mysqli->query($sql)) {
                                    $successCount++;
                                } else {
                                    $errorCount++;
                                    error_log("Ошибка SQL при загрузке фото: " . $mysqli->error);
                                }
                            } else {
                                $errorCount++;
                            }
                        }
                        
                        if($successCount > 0) {
                            echo '<div class="alert alert-success mt-3">Успешно загружено '.$successCount.' фото!';
                            if($errorCount > 0) {
                                echo ' Не удалось загрузить '.$errorCount.' фото (неверный формат или размер > 25MB)';
                            }
                            echo '</div>';
                            
                            header("Refresh: 3; URL=adduphotogallery.php");
                            exit();
                        } else {
                            echo '<div class="alert alert-danger mt-3">Не удалось загрузить ни одного фото. Проверьте формат и размер файлов.</div>';
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger mt-3">Ошибка: не выбраны файлы или превышен максимальный размер</div>';
                }
            }
        }
        ?>
    </form>
        </div>
    </div>

    <!-- Галерея -->
    <div class="row" id="gallery">
        <?php
        $query = $mysqli->query("SELECT * FROM uphotogallery WHERE id_ugallery = 1 ORDER BY id_uphotogallery ASC LIMIT $offset, $items_per_page");
        while($row = $query->fetch_assoc()): ?>
            <?php
                $show_img = base64_encode($row['uphotogal']);
                $desc = htmlspecialchars($row['udescphoto']);
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="data:image/jpeg;base64,<?=$show_img?>"
                         class="card-img-top gallery-img"
                         alt="<?=$desc?>"
                         data-toggle="modal"
                         data-target="#imageModal"
                         data-img="data:image/jpeg;base64,<?=$show_img?>"
                         data-desc="<?=$desc?>">
                    <div class="card-body">
                        <p class="card-text"><?=$desc?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    
    <!-- Пагинация -->
    <?php if ($total_pages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?=($current_page - 1)?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php 
            // Показываем ограниченное количество страниц вокруг текущей
            $start_page = max(1, $current_page - 2);
            $end_page = min($total_pages, $current_page + 2);
            
            if ($start_page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                if ($start_page > 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }
            
            for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li class="page-item <?=($i == $current_page) ? 'active' : ''?>">
                    <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                </li>
            <?php endfor; 
            
            if ($end_page < $total_pages) {
                if ($end_page < $total_pages - 1) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                echo '<li class="page-item"><a class="page-link" href="?page='.$total_pages.'">'.$total_pages.'</a></li>';
            }
            ?>
            
            <?php if ($current_page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?=($current_page + 1)?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>
    
    <?php
    $mysqli->close();
    ?>
</div>

<!-- Модальное окно для просмотра изображений -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Просмотр изображения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="modal-img">
                <p id="modalDesc" class="mt-3"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Обработчик для модального окна
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imgSrc = button.data('img');
        var imgDesc = button.data('desc');
        
        var modal = $(this);
        modal.find('#modalImage').attr('src', imgSrc);
        modal.find('#modalDesc').text(imgDesc);
    });

    // Показывать имена выбранных файлов и превью
    $('.custom-file-input').on('change', function() {
        var files = this.files;
        var container = $('#previewContainer');
        var errorDiv = $('#fileError');
        container.empty();
        errorDiv.empty();
        
        var totalSize = 0;
        var hasErrors = false;
        
        // Проверяем каждый файл
        for(var i = 0; i < files.length; i++) {
            totalSize += files[i].size;
            
            if(files[i].size > 25*1024*1024) {
                hasErrors = true;
                errorDiv.append('<div>Файл "' + files[i].name + '" слишком большой (макс. 25MB)</div>');
            }
            
            if(!files[i].type.match('image.*')) {
                hasErrors = true;
                errorDiv.append('<div>Файл "' + files[i].name + '" не является изображением</div>');
            }
        }
        
        if(totalSize > 100*1024*1024) {
            hasErrors = true;
            errorDiv.append('<div>Общий размер файлов (' + (totalSize/1024/1024).toFixed(2) + 'MB) превышает лимит в 100MB</div>');
        }
        
        if(files.length > 100) {
            hasErrors = true;
            errorDiv.append('<div>Выбрано слишком много файлов (макс. 100)</div>');
        }
        
        if(hasErrors) {
            $('#uploadForm button[type="submit"]').prop('disabled', true);
        } else {
            $('#uploadForm button[type="submit"]').prop('disabled', false);
        }
        
        // Обновляем label
        if(files.length > 1) {
            $(this).next('.custom-file-label').addClass("selected").html('Выбрано ' + files.length + ' файлов (' + (totalSize/1024/1024).toFixed(2) + 'MB)');
        } else if(files.length == 1) {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName + ' (' + (files[0].size/1024/1024).toFixed(2) + 'MB)');
        }
        
        // Показываем превью (максимум 10)
        var maxPreview = 10;
        for(var i = 0; i < Math.min(files.length, maxPreview); i++) {
            var file = files[i];
            if(file.type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = (function(file) {
                    return function(e) {
                        container.append('<img src="' + e.target.result + '" class="preview-img" title="' + file.name + '">');
                    };
                })(file);
                reader.readAsDataURL(file);
            }
        }
        
        if(files.length > maxPreview) {
            container.append('<div class="w-100">+ ещё ' + (files.length - maxPreview) + ' фото</div>');
        }
    });
    
    // Показываем прогресс загрузки
    $('#uploadForm').on('submit', function() {
        $('#uploadProgress').show();
        var progressBar = $('.progress-bar');
        var width = 0;
        
        var interval = setInterval(function() {
            width += 5;
            if(width >= 95) {
                clearInterval(interval);
            }
            progressBar.css('width', width + '%');
        }, 200);
    });
});
</script>

</body>
</html>