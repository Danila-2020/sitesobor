<?php
// proxy-news.php
// Скрипт для подгрузки новостей без футера, мобильного меню и radio-icon-wrap

// URL с новостями
$url = "https://blago-kavkaz.ru/site/articles?catids%5B0%5D=1&title=Новости&link_id=news";

// Загружаем страницу
$context = stream_context_create([
    "http" => [
        "header" => "User-Agent: Mozilla/5.0 (compatible; ProxyNews/1.0)\r\n"
    ]
]);

$html = file_get_contents($url, false, $context);

if ($html === false || trim($html) === '') {
    echo "<p style='color:red;text-align:center;'>Новости временно недоступны</p>";
    exit;
}

// --- Удаляем футер по id="footer"
$html = preg_replace('/<div id="footer"[\s\S]*?<\/div>/i', '', $html);

// --- Удаляем блок с id="mobile-menu-content"
$html = preg_replace('/<div id="mobile-menu-content"[\s\S]*?<\/div>/i', '', $html);

// --- Удаляем блок с классом "radio-icon-wrap md-hide sm-hide xs-hide"
$html = preg_replace('/<div class="[^"]*radio-icon-wrap[^"]*"[\s\S]*?<\/div>/i', '', $html);

// ⚡ Дополнительно можно убрать верхнее меню/хедер, если нужно:
// $html = preg_replace('/<header[\s\S]*?<\/header>/i', '', $html);

// Отправляем как HTML
header("Content-Type: text/html; charset=utf-8");
echo $html;
