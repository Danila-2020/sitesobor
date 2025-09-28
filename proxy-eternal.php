<?php
// proxy-eternal.php
// Прокси для загрузки только bishops-word-wrapper content-block-wrap с сайта blago-kavkaz.ru

// URL целевого сайта
$targetUrl = 'https://blago-kavkaz.ru/site/articles?catids%5B0%5D=2&title=Пару%20минут%20о%20вечном&link_id=eternal';

// Получаем содержимое страницы
$html = file_get_contents($targetUrl);

if ($html !== false) {
    // Создаем DOMDocument объект
    $dom = new DOMDocument();
    @$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    // Находим элемент с классом bishops-word-wrapper или content-block-wrap
    $xpath = new DOMXPath($dom);
    $contentBlock = $xpath->query('//div[contains(@class, "bishops-word-wrapper")] | //div[contains(@class, "content-block-wrap")]')->item(0);
    
    if ($contentBlock) {
        // Извлекаем HTML содержимое блока
        $contentHtml = $dom->saveHTML($contentBlock);
        
        // Удаляем все скрипты и стили из извлеченного контента
        $contentHtml = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $contentHtml);
        $contentHtml = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $contentHtml);
        
        // Добавляем базовые стили для корректного отображения
        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <base target="_blank"> <!-- Открываем ссылки в новом окне -->
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: white !important;
                    margin: 0;
                    padding: 20px;
                    color: #333;
                }
                .bishops-word-wrapper, .content-block-wrap {
                    max-width: 100%;
                    margin: 0 auto;
                }
                .eternal-item, .article-item {
                    margin-bottom: 20px;
                    padding: 15px;
                    background: #f8f9fa;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                .eternal-title, .article-title {
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 10px;
                    color: #004571;
                }
                .eternal-date, .article-date {
                    color: #666;
                    font-size: 14px;
                    margin-bottom: 10px;
                }
                .eternal-content, .article-content {
                    font-size: 16px;
                    line-height: 1.5;
                }
                a {
                    color: #004571;
                    text-decoration: none;
                }
                a:hover {
                    text-decoration: underline;
                    color: #0066cc;
                }
                img {
                    max-width: 100%;
                    height: auto;
                }
            </style>
        </head>
        <body>
            <div class="content-container">' . $contentHtml . '</div>
        </body>
        </html>';
    } else {
        echo '<div style="padding: 20px; text-align: center; color: #333;">
                <p>Не удалось загрузить контент "Пару минут о вечном" с сайта blago-kavkaz.ru</p>
                <p><a href="https://blago-kavkaz.ru/site/articles?catids%5B0%5D=2&title=Пару%20минут%20о%20вечном&link_id=eternal" 
                      target="_blank" style="color: #6096b8;">Перейти на сайт</a></p>
              </div>';
    }
} else {
    echo '<div style="padding: 20px; text-align: center; color: #333;">
            <p>Ошибка при загрузке контента "Пару минут о вечном" с сайта blago-kavkaz.ru</p>
            <p><a href="https://blago-kavkaz.ru/site/articles?catids%5B0%5D=2&title=Пару%20минут%20о%20вечном&link_id=eternal" 
                  target="_blank" style="color: #6096b8;">Перейти на сайт</a></p>
          </div>';
}
?>