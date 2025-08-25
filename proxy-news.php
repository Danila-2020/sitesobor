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
$html = preg_replace('/<div class="[^"]*w-100pc user-valid valid[^"]*"[\s\S]*?<\/div>/i', '', $html);

// --- УДАЛЯЕМ ВСЕ INPUT ЭЛЕМЕНТЫ ---
$html = preg_replace('/<input[^>]*>/i', '', $html);

// --- Дополнительно: удаляем формы, если они содержат только inputs
$html = preg_replace('/<form[^>]*>[\s\S]*?<\/form>/i', '', $html);

// --- Альтернативный вариант: скрыть inputs через CSS, если удаление не работает
$html = str_replace('</head>', '<style>input { display: none !important; }</style></head>', $html);

// Отправляем как HTML
header("Content-Type: text/html; charset=utf-8");
echo $html;
?>