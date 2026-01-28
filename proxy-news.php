<?php
// proxy-news.php
// Скрипт для подгрузки новостей без футера, мобильного меню и radio-icon-wrap

// URL с новостями
$url = "https://blago-kavkaz.ru/site/articles?catids%5B0%5D=1&title=Новости&link_id=news";

// Загружаем страницу
$context = stream_context_create([
    "http" => [
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n" .
                    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8\r\n" .
                    "Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7\r\n" .
                    "Cache-Control: no-cache\r\n" .
                    "Pragma: no-cache\r\n"
    ],
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false
    ]
]);

$html = @file_get_contents($url, false, $context);

if ($html === false || trim($html) === '') {
    echo "<p style='color:red;text-align:center;padding:20px;'>Новости временно недоступны</p>";
    exit;
}

// --- Удаляем футер по id="footer"
$html = preg_replace('/<div id="footer"[\s\S]*?<\/div>/i', '', $html);

// --- Удаляем блок с id="mobile-menu-content"
$html = preg_replace('/<div id="mobile-menu-content"[\s\S]*?<\/div>/i', '', $html);

// --- Удаляем блок с классом "radio-icon-wrap md-hide sm-hide xs-hide"
$html = preg_replace('/<div class="[^"]*radio-icon-wrap[^"]*"[\s\S]*?<\/div>/i', '', $html);
$html = preg_replace('/<div class="[^"]*w-100pc user-valid valid[^"]*"[\s\S]*?<\/div>/i', '', $html);

// --- УДАЛЯЕМ ВСЕ INPUT ЭЛЕМЕНТЫ ---
$html = preg_replace('/<input[^>]*>/i', '', $html);

// --- Дополнительно: удаляем формы, если они содержат только inputs
$html = preg_replace('/<form[^>]*>[\s\S]*?<\/form>/i', '', $html);

// --- Исправляем относительные пути изображений ---
// Находим все изображения с относительными путями и делаем их абсолютными
$baseUrl = 'https://blago-kavkaz.ru';

// Функция для преобразования относительных путей в абсолютные
function makeAbsoluteUrls($content, $baseUrl) {
    // Исправляем src атрибуты у img, source
    $content = preg_replace_callback(
        '/<(img|source)[^>]+(src|srcset)="([^"]+)"[^>]*>/i',
        function($matches) use ($baseUrl) {
            $tag = $matches[1];
            $attr = $matches[2];
            $src = $matches[3];
            
            // Если путь уже абсолютный, оставляем как есть
            if (strpos($src, 'http') === 0 || strpos($src, '//') === 0) {
                return $matches[0];
            }
            
            // Добавляем базовый URL к относительным путям
            $absoluteSrc = $baseUrl . '/' . ltrim($src, '/');
            
            // Заменяем в исходном HTML
            return str_replace($src, $absoluteSrc, $matches[0]);
        },
        $content
    );
    
    // Исправляем CSS background-image
    $content = preg_replace_callback(
        '/background(-image)?\s*:\s*url\(([^)]+)\)/i',
        function($matches) use ($baseUrl) {
            $url = trim($matches[2], "'\" ");
            
            // Если путь уже абсолютный, оставляем как есть
            if (strpos($url, 'http') === 0 || strpos($url, '//') === 0) {
                return $matches[0];
            }
            
            // Добавляем базовый URL к относительным путям
            $absoluteUrl = $baseUrl . '/' . ltrim($url, '/');
            
            // Заменяем в исходном CSS
            return str_replace($url, $absoluteUrl, $matches[0]);
        },
        $content
    );
    
    // Исправляем ссылки на стили и скрипты
    $content = preg_replace_callback(
        '/(href|src)=["\']([^"\']+)["\']/i',
        function($matches) use ($baseUrl) {
            $attr = $matches[1];
            $url = $matches[2];
            
            // Если это внешний ресурс или уже абсолютный путь, оставляем как есть
            if (strpos($url, 'http') === 0 || strpos($url, '//') === 0 || 
                strpos($url, 'data:') === 0 || strpos($url, 'javascript:') === 0 ||
                strpos($url, '#') === 0 || strpos($url, '?') === 0) {
                return $matches[0];
            }
            
            // Если это CSS или JS файл, делаем абсолютным
            if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot)$/i', $url)) {
                $absoluteUrl = $baseUrl . '/' . ltrim($url, '/');
                return $attr . '="' . $absoluteUrl . '"';
            }
            
            return $matches[0];
        },
        $content
    );
    
    return $content;
}

// Применяем функцию исправления URL
$html = makeAbsoluteUrls($html, $baseUrl);

// --- Минимальные стили только для обеспечения видимости изображений ---
$customCSS = '
<style>
    /* Минимальные стили для изображений новостей */
    .news-item img, 
    .article-item img,
    .articles img,
    [class*="news"] img,
    [class*="article"] img {
        display: block !important;
        max-width: 100% !important;
        height: auto !important;
        margin: 0 auto 10px auto !important;
        border-radius: 4px !important;
    }
    
    /* Улучшение отображения картинок в карточках */
    img {
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    /* Скрываем input элементы */
    input {
        display: none !important;
    }
    
    /* Гарантируем загрузку фоновых изображений */
    [style*="background-image"] {
        background-repeat: no-repeat !important;
        background-size: cover !important;
        background-position: center !important;
    }
    
    /* Исправление для ленивой загрузки */
    img[data-src] {
        opacity: 0 !important;
        transition: opacity 0.3s ease !important;
    }
    
    img[data-src].loaded {
        opacity: 1 !important;
    }
</style>
';

// --- JavaScript для обработки изображений ---
$customJS = '
<script>
    // Функция для загрузки изображений из data-атрибутов
    function loadLazyImages() {
        // Обработка data-src
        document.querySelectorAll("img[data-src]").forEach(img => {
            if (img.getAttribute("data-src") && !img.src) {
                img.src = img.getAttribute("data-src");
                img.classList.add("loaded");
            }
        });
        
        // Обработка data-srcset
        document.querySelectorAll("img[data-srcset]").forEach(img => {
            if (img.getAttribute("data-srcset") && !img.srcset) {
                img.srcset = img.getAttribute("data-srcset");
                img.classList.add("loaded");
            }
        });
        
        // Обработка source элементов
        document.querySelectorAll("source[data-srcset]").forEach(source => {
            if (source.getAttribute("data-srcset") && !source.srcset) {
                source.srcset = source.getAttribute("data-srcset");
            }
        });
    }
    
    // Функция для исправления сломанных ссылок изображений
    function fixBrokenImages() {
        document.querySelectorAll("img").forEach(img => {
            // Если у изображения есть src, но оно не загрузилось
            if (img.src && img.naturalWidth === 0) {
                console.log("Broken image detected:", img.src);
                
                // Пробуем разные способы восстановления
                if (img.hasAttribute("data-src")) {
                    img.src = img.getAttribute("data-src");
                }
                
                // Пробуем загрузить с базового URL
                else if (img.src.indexOf("http") !== 0 && img.src.indexOf("//") !== 0) {
                    img.src = "' . $baseUrl . '/" + img.src;
                }
            }
        });
    }
    
    // Функция для обеспечения загрузки всех изображений
    function ensureImageLoading() {
        // Добавляем обработчики ошибок загрузки
        document.querySelectorAll("img").forEach(img => {
            // Убираем ленивую загрузку если она мешает
            img.loading = "eager";
            
            // Добавляем обработчик ошибок
            img.onerror = function() {
                console.log("Image failed to load:", this.src);
                // Пробуем загрузить через proxy если нужно
                this.style.display = "none";
            };
            
            // Принудительно загружаем изображения
            if (img.src && !img.complete) {
                const tempImg = new Image();
                tempImg.src = img.src;
            }
        });
    }
    
    // Функция для предзагрузки критических изображений
    function preloadCriticalImages() {
        // Находим изображения в видимой области
        const viewportImages = [];
        document.querySelectorAll("img").forEach(img => {
            const rect = img.getBoundingClientRect();
            if (rect.top < window.innerHeight * 2) {
                viewportImages.push(img.src);
            }
        });
        
        // Предзагружаем их
        viewportImages.forEach(src => {
            if (src) {
                const img = new Image();
                img.src = src;
            }
        });
    }
    
    // Инициализация при загрузке DOM
    document.addEventListener("DOMContentLoaded", function() {
        loadLazyImages();
        ensureImageLoading();
        preloadCriticalImages();
        
        // Повторная проверка через небольшую задержку
        setTimeout(() => {
            loadLazyImages();
            fixBrokenImages();
        }, 500);
        
        // Еще одна проверка после полной загрузки
        setTimeout(() => {
            loadLazyImages();
            fixBrokenImages();
        }, 2000);
    });
    
    // Также запускаем после полной загрузки страницы
    window.addEventListener("load", function() {
        loadLazyImages();
        fixBrokenImages();
        ensureImageLoading();
        
        // Финальная проверка
        setTimeout(fixBrokenImages, 1000);
    });
    
    // Обработчик для ошибок загрузки изображений
    window.addEventListener("error", function(e) {
        if (e.target.tagName === "IMG") {
            console.log("Image loading error:", e.target.src);
            // Можно попробовать загрузить fallback изображение
            e.target.onerror = null; // Предотвращаем бесконечный цикл
            e.target.style.opacity = "0";
        }
    }, true);
</script>
';

// --- Вставляем наши стили и скрипты в страницу ---
$html = str_replace('</head>', $customCSS . '</head>', $html);
$html = str_replace('</body>', $customJS . '</body>', $html);

// --- Дополнительная обработка для гарантии загрузки изображений ---
// Добавляем инлайновые стили для важных изображений
$inlineImageStyles = '
<style id="inline-image-fixes">
    /* Инлайновые исправления для конкретных элементов */
    .main-news-image,
    .featured-image,
    .article-image,
    .news-image {
        background-size: contain !important;
        background-repeat: no-repeat !important;
    }
    
    /* Гарантируем видимость */
    .hidden-image,
    [style*="display: none"] img,
    [style*="visibility: hidden"] img {
        display: block !important;
        visibility: visible !important;
    }
</style>
';

$html = str_replace('</head>', $customCSS . $inlineImageStyles . '</head>', $html);

// --- Исправление base href если он есть ---
if (strpos($html, '<base href=') === false) {
    // Добавляем base href для корректной загрузки ресурсов
    $baseTag = '<base href="' . $baseUrl . '/">';
    $html = str_replace('<head>', '<head>' . $baseTag, $html);
} else {
    // Исправляем существующий base href
    $html = preg_replace('/<base[^>]*href=["\'][^"\']*["\'][^>]*>/i', 
                         '<base href="' . $baseUrl . '/">', 
                         $html);
}

// --- Фикс для кодировки ---
// Убедимся, что кодировка UTF-8
$html = preg_replace('/<meta[^>]*charset=[^>]*>/i', 
                     '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">', 
                     $html);

// --- Финальный фикс для изображений ---
// Заменяем data-src на src для всех img элементов
$html = preg_replace_callback(
    '/<img([^>]*)data-src=["\']([^"\']+)["\']([^>]*)>/i',
    function($matches) {
        // Создаем тег img с src вместо data-src
        $before = $matches[1];
        $src = $matches[2];
        $after = $matches[3];
        
        // Удаляем data-src из атрибутов
        $before = str_replace('data-src', 'src', $before);
        $after = str_replace('data-src', 'src', $after);
        
        return '<img' . $before . 'src="' . $src . '"' . $after . '>';
    },
    $html
);

// Отправляем как HTML
header("Content-Type: text/html; charset=utf-8");
echo $html;
?>