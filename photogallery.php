<?php
ob_start();
session_start();
require_once('bd.php');
include('template/scedulehead.php');
include('template/barber.php');
echo getStyles();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фотогалерея</title>
    
    <!-- Подключение Intersection Observer для ленивой загрузки -->
    <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.0/intersection-observer.js"></script>
    
    <!-- Подключение Lazysizes для оптимизированной ленивой загрузки -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>

    <!-- Подключение шрифтов -->
    <style>
        @font-face {
            font-family: 'Russian Land Cyrillic';
            src: url('fonts/russianlandcyrillic.ttf') format('truetype');
            font-display: swap;
        }

        h1,h2,h3,h4,h5 {
            font-family: 'Russian Land Cyrillic', Arial, sans-serif;
            font-size: 24px;
            color: #fdfdfd;
        }

        body {
            font-family: 'CONSTANTIA', Arial, sans-serif;
            background: linear-gradient(135deg, #004571 0%, #6096b8 50%, #004571 100%);
            background-attachment: fixed;
            color: #fdfdfd;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            aspect-ratio: 1 / 1;
            cursor: pointer;
            background-color: rgba(96, 150, 184, 0.2);
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item img.lazyloaded {
            opacity: 1;
        }

        /* Модальное окно */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border: 4px solid white;
            user-select: none;
        }

        .modal-close, .modal-prev, .modal-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 30px;
            color: white;
            cursor: pointer;
            user-select: none;
            z-index: 10000;
        }

        .modal-prev { left: 20px; }
        .modal-next { right: 20px; }
        .modal-close { top: 20px; right: 30px; font-size: 24px; }

        /* Стили пагинации */
        .pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 30px 0;
        }

        .page-link {
            display: inline-block;
            padding: 8px 14px;
            margin: 4px;
            font-size: 16px;
            color: #fff;
            background-color: rgba(96, 150, 184, 0.7);
            border: 1px solid #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover,
        .page-link:focus {
            background-color: rgba(96, 150, 184, 0.9);
            color: #fff;
        }

        .page-link.active {
            background-color: #6096b8;
            font-weight: bold;
            color: #fff;
            border-color: #fff;
        }

        .page-info {
            text-align: center;
            color: #fff;
            font-size: 14px;
            margin-top: 10px;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            background-color: rgba(96, 150, 184, 0.7);
            border: 1px solid #fdfdfd;
            color: #fdfdfd;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        .btn-primary:hover {
            background-color: rgba(96, 150, 184, 1);
        }

        /* Прелоадер для изображений */
        .gallery-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(96,150,184,0.1) 0%, rgba(96,150,184,0.3) 50%, rgba(96,150,184,0.1) 100%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            z-index: 1;
        }

        .gallery-item img.lazyloaded ~ ::before {
            display: none;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body>
    <div class="content-container">
        <div class="gallery-header">
            <h1>Фотогалерея</h1>
        </div>

        <?php
        // Настройки пагинации
        $imagesPerPage = 12;
        $galleryDir = 'gallery/';

        // Получаем все изображения
        $images = glob($galleryDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        // Сортируем по дате изменения (новые сначала)
        if (!empty($images)) {
            usort($images, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });
        }

        // Текущая страница
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;

        // Общее количество страниц
        $totalPages = !empty($images) ? ceil(count($images) / $imagesPerPage) : 1;

        // Проверяем, чтобы текущая страница не превышала общее количество
        if ($currentPage > $totalPages) $currentPage = $totalPages;

        // Получаем изображения для текущей страницы
        $startIndex = ($currentPage - 1) * $imagesPerPage;
        $currentImages = array_slice($images, $startIndex, $imagesPerPage);

        // Выводим галерею
        if (empty($images)) {
            echo '<p>В галерее пока нет фотографий.</p>';
        } else {
            echo '<div class="gallery-grid" id="gallery">';
            foreach ($currentImages as $image) {
                $imageName = basename($image);
                $thumbPath = 'gallery/thumbs/' . $imageName;
                
                // Создаем миниатюру, если ее нет
                if (!file_exists($thumbPath)) {
                    createThumbnail($image, $thumbPath, 300);
                }
                
                echo '
                <div class="gallery-item" onclick="openModal(this)">
                    <img 
                        class="lazyload" 
                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                        data-src="'.$thumbPath.'" 
                        data-full="'.$image.'" 
                        alt="'.$imageName.'" 
                    />
                </div>';
            }
            echo '</div>';

            // Пагинация
            if ($totalPages > 1) {
                echo '<nav class="pagination">';
                // Кнопка "Назад"
                if ($currentPage > 1) {
                    echo '<a href="?page='.($currentPage - 1).'" class="page-link">&laquo; Назад</a>';
                }

                // Диапазон страниц
                $startPage = max(1, min($currentPage - 2, $totalPages - 4));
                $endPage = min($totalPages, max($currentPage + 2, 5));

                if ($startPage > 1) {
                    echo '<a href="?page=1" class="page-link">1</a>';
                    if ($startPage > 2) echo '<span class="page-link">...</span>';
                }

                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = $i == $currentPage ? 'active' : '';
                    echo "<a href='?page=$i' class='page-link $active'>$i</a>";
                }

                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="page-link">...</span>';
                    echo "<a href='?page=$totalPages' class='page-link'>$totalPages</a>";
                }

                // Кнопка "Вперед"
                if ($currentPage < $totalPages) {
                    echo '<a href="?page='.($currentPage + 1).'" class="page-link">Вперед &raquo;</a>';
                }

                echo '</nav>';

                // Информация о страницах
                echo '<div class="page-info">';
                echo 'Страница '.$currentPage.' из '.$totalPages.' (всего '.count($images).' фото)';
                echo '</div>';
            }
        }
        
        // Функция создания миниатюр
        function createThumbnail($source, $destination, $width) {
            $dir = dirname($destination);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            
            $info = getimagesize($source);
            $mime = $info['mime'];
            
            switch ($mime) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    return false;
            }
            
            $srcWidth = imagesx($image);
            $srcHeight = imagesy($image);
            
            $height = (int) (($width / $srcWidth) * $srcHeight);
            
            $thumb = imagecreatetruecolor($width, $height);
            
            // Сохраняем прозрачность для PNG и GIF
            if ($mime == 'image/png' || $mime == 'image/gif') {
                imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
            }
            
            imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
            
            switch ($mime) {
                case 'image/jpeg':
                    imagejpeg($thumb, $destination, 80);
                    break;
                case 'image/png':
                    imagepng($thumb, $destination, 8);
                    break;
                case 'image/gif':
                    imagegif($thumb, $destination);
                    break;
            }
            
            imagedestroy($image);
            imagedestroy($thumb);
            
            return true;
        }
        ?>
        
        <div style="text-align: center;">
            <a href="index.php" class="btn-primary">Вернуться на главную</a>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal" id="modal">
        <div class="modal-close" onclick="closeModal()">&#10006;</div>
        <div class="modal-prev" onclick="prevImage()">&#10094;</div>
        <div class="modal-next" onclick="nextImage()">&#10095;</div>
        <img id="modal-img" src="" />
    </div>

    <script>
        let modalImages = [];
        let currentIndex = 0;

        function openModal(element) {
            const galleryItems = document.querySelectorAll('.gallery-item');
            modalImages = Array.from(galleryItems).map(item => item.querySelector('img').dataset.full);
            currentIndex = modalImages.indexOf(element.querySelector('img').dataset.full);
            
            // Предзагрузка соседних изображений
            preloadAdjacentImages(currentIndex);
            
            document.getElementById('modal-img').src = modalImages[currentIndex];
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + modalImages.length) % modalImages.length;
            document.getElementById('modal-img').src = modalImages[currentIndex];
            
            // Предзагрузка соседних изображений при навигации
            preloadAdjacentImages(currentIndex);
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % modalImages.length;
            document.getElementById('modal-img').src = modalImages[currentIndex];
            
            // Предзагрузка соседних изображений при навигации
            preloadAdjacentImages(currentIndex);
        }

        // Функция предзагрузки соседних изображений
        function preloadAdjacentImages(currentIdx) {
            const preloadIndices = [
                (currentIdx - 1 + modalImages.length) % modalImages.length,
                (currentIdx + 1) % modalImages.length
            ];
            
            preloadIndices.forEach(idx => {
                const img = new Image();
                img.src = modalImages[idx];
            });
        }

        document.addEventListener('keydown', function(e) {
            if (document.getElementById('modal').style.display === 'flex') {
                if (e.key === 'Escape') closeModal();
                if (e.key === 'ArrowLeft') prevImage();
                if (e.key === 'ArrowRight') nextImage();
            }
        });

        // Инициализация Intersection Observer для более точной ленивой загрузки
        document.addEventListener('DOMContentLoaded', function() {
            if ('IntersectionObserver' in window) {
                const lazyImages = document.querySelectorAll('.gallery-item img.lazyload');
                
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.add('lazyloaded');
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '200px 0px', // Начинаем загружать заранее
                    threshold: 0.01
                });

                lazyImages.forEach(img => {
                    imageObserver.observe(img);
                });
            }
        });
    </script>
</body>
</html>