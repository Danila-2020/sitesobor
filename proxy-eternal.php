<?php
// proxy-eternal.php
$url = 'https://blago-kavkaz.ru/';

// Настройки cURL для получения контента
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($html !== false && $httpCode === 200) {
    // Создаем DOMDocument объект
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    // Находим блоки с классами bishops-word-wrapper и content-block-wrap
    $xpath = new DOMXPath($dom);
    
    // Ищем основной контентный блок
    $contentBlock = $xpath->query('//div[contains(@class, "bishops-word-wrapper")] | //div[contains(@class, "content-block-wrap")] | //div[contains(@class, "articles-list")] | //div[contains(@class, "news-list")]')->item(0);
    
    if ($contentBlock) {
        // Извлекаем HTML содержимое блока
        $contentHtml = $dom->saveHTML($contentBlock);
        
        // Удаляем все скрипты и стили из извлеченного контента
        $contentHtml = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $contentHtml);
        $contentHtml = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $contentHtml);
        
        // Добавляем базовые стили для корректного отображения
        echo '<!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    font-family: "CONSTANTIA", Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background: white;
                    color: #333;
                    font-size: 14px;
                    line-height: 1.6;
                }
                .bishops-word-wrapper {
                    width: 100%;
                    padding: 20px;
                    box-sizing: border-box;
                }
                .content-block-wrap {
                    background: #f8f9fa;
                    border-radius: 8px;
                    padding: 25px;
                    margin: 0;
                }
                .articles-list, .news-list {
                    display: flex;
                    flex-direction: column;
                    gap: 20px;
                }
                .article-item, .news-item {
                    background: white;
                    border-radius: 8px;
                    padding: 20px;
                    border-left: 4px solid #6096b8;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }
                .article-item:hover, .news-item:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
                }
                .article-title, .news-title {
                    font-size: 18px;
                    font-weight: bold;
                    color: #004571;
                    margin-bottom: 10px;
                    line-height: 1.3;
                }
                .article-date, .news-date {
                    color: #666;
                    font-size: 12px;
                    margin-bottom: 10px;
                    display: block;
                }
                .article-excerpt, .news-excerpt {
                    color: #555;
                    font-size: 14px;
                    line-height: 1.5;
                }
                .article-link, .news-link {
                    color: #004571;
                    text-decoration: none;
                    display: block;
                }
                .article-link:hover, .news-link:hover {
                    color: #0066cc;
                    text-decoration: underline;
                }
                .read-more {
                    display: inline-block;
                    margin-top: 10px;
                    color: #6096b8;
                    font-weight: bold;
                    text-decoration: none;
                }
                .read-more:hover {
                    color: #004571;
                    text-decoration: underline;
                }
                
                /* Адаптивность */
                @media (max-width: 768px) {
                    body {
                        padding: 0;
                    }
                    .bishops-word-wrapper {
                        padding: 15px;
                    }
                    .content-block-wrap {
                        padding: 20px;
                    }
                    .article-item, .news-item {
                        padding: 15px;
                    }
                    .article-title, .news-title {
                        font-size: 16px;
                    }
                }
                
                @media (max-width: 480px) {
                    .bishops-word-wrapper {
                        padding: 10px;
                    }
                    .content-block-wrap {
                        padding: 15px;
                    }
                    .article-item, .news-item {
                        padding: 12px;
                    }
                    .article-title, .news-title {
                        font-size: 15px;
                    }
                }
            </style>
        </head>
        <body>
            <div class="bishops-word-wrapper">
                <div class="content-block-wrap">
                    ' . $contentHtml . '
                </div>
            </div>
        </body>
        </html>';
    } else {
        showError('Блок с материалами "Пару минут о вечном" не найден на странице');
    }
} else {
    showError('Ошибка загрузки страницы blago-kavkaz.ru');
}

function showError($message) {
    echo '<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: "CONSTANTIA", Arial, sans-serif;
                margin: 0;
                padding: 0;
                background: white;
                color: #333;
            }
            .bishops-word-wrapper {
                width: 100%;
                padding: 40px 20px;
                box-sizing: border-box;
            }
            .content-block-wrap {
                background: #f8f9fa;
                border-radius: 8px;
                padding: 30px;
                text-align: center;
            }
            .error-message {
                color: #666;
            }
            .error-message h3 {
                color: #dc3545;
                margin-bottom: 15px;
            }
            .error-message a {
                color: #004571;
                text-decoration: none;
                font-weight: bold;
            }
            .error-message a:hover {
                color: #0066cc;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="bishops-word-wrapper">
            <div class="content-block-wrap">
                <div class="error-message">
                    <h3>Ошибка загрузки</h3>
                    <p>' . $message . '</p>
                    <p><a href="https://blago-kavkaz.ru/site/articles?catids%5B0%5D=2&title=Пару%20минут%20о%20вечном&link_id=eternal" target="_blank">Перейти на сайт епархии</a></p>
                </div>
            </div>
        </div>
    </body>
    </html>';
}
?>