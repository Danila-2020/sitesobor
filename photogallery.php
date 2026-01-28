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
            max-width: 1400px; /* Увеличил ширину для 4 колонок */
            margin: 0 auto;
            padding: 20px;
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Фиксированные 4 колонки */
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

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0;
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
            background-color: rgba(0, 0, 0, 0.95);
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border: 4px solid white;
            border-radius: 8px;
            user-select: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .modal-close, .modal-prev, .modal-next {
            position: absolute;
            font-size: 30px;
            color: white;
            cursor: pointer;
            user-select: none;
            z-index: 10000;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover, .modal-prev:hover, .modal-next:hover {
            background-color: rgba(96, 150, 184, 0.8);
            transform: scale(1.1);
        }

        .modal-prev { 
            left: 20px; 
            top: 50%;
            transform: translateY(-50%);
        }
        
        .modal-next { 
            right: 20px; 
            top: 50%;
            transform: translateY(-50%);
        }
        
        .modal-close { 
            top: 20px; 
            right: 20px; 
            font-size: 24px; 
            transform: none;
        }

        .modal-close:hover {
            transform: rotate(90deg);
        }

        /* Стили пагинации */
        .pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 40px 0 30px;
        }

        .page-link {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px;
            font-size: 16px;
            color: #fff;
            background-color: rgba(96, 150, 184, 0.7);
            border: 1px solid #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            min-width: 40px;
            text-align: center;
        }

        .page-link:hover,
        .page-link:focus {
            background-color: rgba(96, 150, 184, 0.9);
            color: #fff;
            transform: translateY(-2px);
        }

        .page-link.active {
            background-color: #6096b8;
            font-weight: bold;
            color: #fff;
            border-color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .page-info {
            text-align: center;
            color: #fff;
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background-color: rgba(96, 150, 184, 0.2);
            border-radius: 6px;
            display: inline-block;
            margin: 10px auto;
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 24px;
            background-color: rgba(96, 150, 184, 0.7);
            border: 1px solid #fdfdfd;
            color: #fdfdfd;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 30px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: rgba(96, 150, 184, 1);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        /* Адаптивность */
        @media (max-width: 1200px) {
            .content-container {
                max-width: 1100px;
                padding: 15px;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 15px;
            }
        }

        @media (max-width: 992px) {
            .content-container {
                max-width: 900px;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr); /* 3 колонки на планшетах */
            }
            
            .modal-prev, .modal-next {
                width: 45px;
                height: 45px;
                font-size: 26px;
            }
        }

        @media (max-width: 768px) {
            .content-container {
                max-width: 700px;
                padding: 10px;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 колонки на мобильных */
                gap: 12px;
            }
            
            .gallery-item:hover {
                transform: translateY(-3px);
            }
            
            .modal-prev, .modal-next {
                width: 40px;
                height: 40px;
                font-size: 22px;
                left: 10px;
                right: 10px;
            }
            
            .modal-close {
                top: 15px;
                right: 15px;
                width: 35px;
                height: 35px;
                font-size: 20px;
            }
            
            .modal img {
                max-width: 95%;
                max-height: 85%;
            }
            
            .pagination {
                margin: 30px 0 20px;
            }
            
            .page-link {
                padding: 6px 12px;
                font-size: 14px;
                min-width: 35px;
            }
        }

        @media (max-width: 480px) {
            .content-container {
                max-width: 100%;
                padding: 8px;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
            
            .gallery-header h1 {
                font-size: 20px;
            }
            
            .pagination {
                flex-direction: column;
                align-items: center;
            }
            
            .page-link {
                margin: 3px;
                width: 100%;
                max-width: 150px;
            }
            
            .btn-primary {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        @media (max-width: 360px) {
            .gallery-grid {
                grid-template-columns: 1fr; /* 1 колонка на очень маленьких экранах */
            }
            
            .modal-prev, .modal-next {
                width: 35px;
                height: 35px;
                font-size: 18px;
            }
        }

        /* Анимация появления изображений */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .gallery-item {
            animation: fadeIn 0.5s ease forwards;
        }

        .gallery-item:nth-child(1) { animation-delay: 0.1s; }
        .gallery-item:nth-child(2) { animation-delay: 0.2s; }
        .gallery-item:nth-child(3) { animation-delay: 0.3s; }
        .gallery-item:nth-child(4) { animation-delay: 0.4s; }
        .gallery-item:nth-child(5) { animation-delay: 0.5s; }
        .gallery-item:nth-child(6) { animation-delay: 0.6s; }
        .gallery-item:nth-child(7) { animation-delay: 0.7s; }
        .gallery-item:nth-child(8) { animation-delay: 0.8s; }
        .gallery-item:nth-child(9) { animation-delay: 0.9s; }
        .gallery-item:nth-child(10) { animation-delay: 1.0s; }
        .gallery-item:nth-child(11) { animation-delay: 1.1s; }
        .gallery-item:nth-child(12) { animation-delay: 1.2s; }

        /* Плавная прокрутка для модального окна */
        .modal img {
            transition: opacity 0.3s ease;
        }

        .modal img.fading {
            opacity: 0;
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
        $imagesPerPage = 12; // Делится на 4 для ровных рядов
        $galleryDir = 'gallery/';

        // Получаем все изображения
        $images = glob($galleryDir . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);

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
            echo '<p style="text-align: center; font-size: 18px; padding: 40px;">В галерее пока нет фотографий.</p>';
        } else {
            echo '<div class="gallery-grid" id="gallery">';
            foreach ($currentImages as $index => $image) {
                $imageName = basename($image);
                $thumbPath = 'gallery/thumbs/' . $imageName;
                
                // Создаем миниатюру, если ее нет
                if (!file_exists($thumbPath)) {
                    createThumbnail($image, $thumbPath, 400); // Увеличил размер миниатюр для лучшего качества
                }
                
                // Получаем размер файла
                $fileSize = file_exists($image) ? filesize($image) : 0;
                $sizeFormatted = $fileSize > 0 ? round($fileSize / 1024, 1) . ' KB' : '';
                
                echo '
                <div class="gallery-item" onclick="openModal(this)" data-index="' . $index . '">
                    <img 
                        class="lazyload" 
                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                        data-src="'.$thumbPath.'" 
                        data-full="'.$image.'" 
                        alt="Фото ' . ($startIndex + $index + 1) . ' - ' . htmlspecialchars($imageName) . '" 
                        title="' . htmlspecialchars($imageName) . ' (' . $sizeFormatted . ')"
                        loading="lazy"
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
                    if ($startPage > 2) echo '<span class="page-link" style="background: transparent; border: none;">...</span>';
                }

                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = $i == $currentPage ? 'active' : '';
                    echo "<a href='?page=$i' class='page-link $active'>$i</a>";
                }

                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="page-link" style="background: transparent; border: none;">...</span>';
                    echo "<a href='?page=$totalPages' class='page-link'>$totalPages</a>";
                }

                // Кнопка "Вперед"
                if ($currentPage < $totalPages) {
                    echo '<a href="?page='.($currentPage + 1).'" class="page-link">Вперед &raquo;</a>';
                }

                echo '</nav>';

                // Информация о страницах
                echo '<div style="text-align: center; margin: 15px 0;">';
                echo '<span class="page-info">';
                echo 'Страница '.$currentPage.' из '.$totalPages.' (всего '.count($images).' фото)';
                echo '</span>';
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
                case 'image/webp':
                    $image = imagecreatefromwebp($source);
                    break;
                default:
                    return false;
            }
            
            $srcWidth = imagesx($image);
            $srcHeight = imagesy($image);
            
            // Сохраняем пропорции
            $height = (int) (($width / $srcWidth) * $srcHeight);
            
            $thumb = imagecreatetruecolor($width, $height);
            
            // Сохраняем прозрачность для PNG, GIF и WebP
            if ($mime == 'image/png' || $mime == 'image/gif' || $mime == 'image/webp') {
                imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
            }
            
            imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
            
            switch ($mime) {
                case 'image/jpeg':
                    imagejpeg($thumb, $destination, 85); // Лучшее качество
                    break;
                case 'image/png':
                    imagepng($thumb, $destination, 8);
                    break;
                case 'image/gif':
                    imagegif($thumb, $destination);
                    break;
                case 'image/webp':
                    imagewebp($thumb, $destination, 85);
                    break;
            }
            
            imagedestroy($image);
            imagedestroy($thumb);
            
            return true;
        }
        ?>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php" class="btn-primary">Вернуться на главную</a>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal" id="modal" onclick="closeModal(event)">
        <div class="modal-close" onclick="closeModal()">&#10006;</div>
        <div class="modal-prev" onclick="prevImage(event)">&#10094;</div>
        <div class="modal-next" onclick="nextImage(event)">&#10095;</div>
        <img id="modal-img" src="" />
    </div>

    <script>
        let modalImages = [];
        let currentIndex = 0;

        function openModal(element) {
            const galleryItems = document.querySelectorAll('.gallery-item');
            modalImages = Array.from(galleryItems).map(item => item.querySelector('img').dataset.full);
            
            // Получаем индекс из атрибута data-index
            const itemIndex = parseInt(element.getAttribute('data-index'));
            currentIndex = itemIndex !== undefined ? itemIndex : 0;
            
            // Предзагрузка соседних изображений
            preloadAdjacentImages(currentIndex);
            
            const modalImg = document.getElementById('modal-img');
            modalImg.classList.remove('fading');
            modalImg.src = modalImages[currentIndex];
            
            // Показываем информацию о текущем изображении в заголовке
            document.title = 'Фото ' + (currentIndex + 1) + ' из ' + modalImages.length + ' - Фотогалерея';
            
            document.getElementById('modal').style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Блокируем скролл страницы
        }

        function closeModal(e) {
            // Закрываем только если кликнули на фон или на кнопку закрытия
            if (!e || e.target.classList.contains('modal') || e.target.classList.contains('modal-close')) {
                document.getElementById('modal').style.display = 'none';
                document.body.style.overflow = 'auto'; // Восстанавливаем скролл
                document.title = 'Фотогалерея'; // Восстанавливаем заголовок
            }
        }

        function prevImage(e) {
            e.stopPropagation(); // Предотвращаем закрытие модального окна
            currentIndex = (currentIndex - 1 + modalImages.length) % modalImages.length;
            changeModalImage();
        }

        function nextImage(e) {
            e.stopPropagation(); // Предотвращаем закрытие модального окна
            currentIndex = (currentIndex + 1) % modalImages.length;
            changeModalImage();
        }

        function changeModalImage() {
            const modalImg = document.getElementById('modal-img');
            
            // Эффект перехода
            modalImg.classList.add('fading');
            
            setTimeout(() => {
                modalImg.src = modalImages[currentIndex];
                modalImg.classList.remove('fading');
                
                // Обновляем информацию о текущем изображении в заголовке
                document.title = 'Фото ' + (currentIndex + 1) + ' из ' + modalImages.length + ' - Фотогалерея';
                
                // Предзагрузка соседних изображений при навигации
                preloadAdjacentImages(currentIndex);
            }, 300);
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
            const modal = document.getElementById('modal');
            if (modal.style.display === 'flex') {
                if (e.key === 'Escape') closeModal();
                if (e.key === 'ArrowLeft') prevImage({ stopPropagation: () => {} });
                if (e.key === 'ArrowRight') nextImage({ stopPropagation: () => {} });
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
            
            // Добавляем задержку для анимации появления
            setTimeout(() => {
                document.querySelectorAll('.gallery-item').forEach(item => {
                    item.style.opacity = '1';
                });
            }, 100);
        });

        // Предзагрузка изображений текущей страницы при загрузке страницы
        window.addEventListener('load', function() {
            const currentPageImages = document.querySelectorAll('.gallery-item img[data-src]');
            currentPageImages.forEach(img => {
                const preloadImg = new Image();
                preloadImg.src = img.dataset.src;
            });
        });
    </script>
</body>
</html>