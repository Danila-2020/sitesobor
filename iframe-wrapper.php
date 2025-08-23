<?php
// iframe-wrapper.php - простой прокси для обхода ограничений
header('X-Frame-Options: SAMEORIGIN');
header('Content-Security-Policy: frame-ancestors *.yourdomain.com');
?>
<!DOCTYPE html>
<html>
<head>
    <base target="_parent">
    <style>body { margin: 0; padding: 0; }</style>
</head>
<body>
    <iframe 
        src="https://blago-kavkaz.ru/site/articles?catids%5B0%5D=1&title=%D0%9D%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D0%B8&link_id=news" 
        style="width:100%; height:100vh; border:none;"
        sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-presentation"
    ></iframe>
</body>
</html>