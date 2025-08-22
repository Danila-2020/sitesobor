<?php
// Обработчик загрузки изображения в фотоглалерею (Пользователь user)
ob_start();

// Проверяем, была ли отправлена форма
if (isset($_POST['upload'])) {
    $targetDir = "gallery/";
    
    // Проверяем существование директории
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $targetFile = $targetDir . basename($_FILES["galleryImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Проверяем, является ли файл изображением
    $check = getimagesize($_FILES["galleryImage"]["tmp_name"]);
    if ($check === false) {
        echo "<div class='alert alert-danger'>Файл не является изображением.</div>";
        $uploadOk = 0;
    }
    
    // Проверяем, существует ли файл
    if (file_exists($targetFile)) {
        echo "<div class='alert alert-danger'>Извините, файл с таким именем уже существует.</div>";
        $uploadOk = 0;
    }
    
    // Проверяем размер файла (максимум 5MB)
    if ($_FILES["galleryImage"]["size"] > 5000000) {
        echo "<div class='alert alert-danger'>Извините, ваш файл слишком большой.</div>";
        $uploadOk = 0;
    }
    
    // Разрешаем только определенные форматы
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "<div class='alert alert-danger'>Извините, разрешены только JPG, JPEG, PNG и GIF файлы.</div>";
        $uploadOk = 0;
    }
    
    // Если все проверки пройдены, загружаем файл
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["galleryImage"]["tmp_name"], $targetFile)) {
            echo "<div class='alert alert-success'>Файл ". htmlspecialchars(basename($_FILES["galleryImage"]["name"])). " был успешно загружен.</div>";
            
            // Перенаправляем обратно на страницу галереи
            header("Refresh: 2; URL=photogallery.php");
        } else {
            echo "<div class='alert alert-danger'>Произошла ошибка при загрузке файла.</div>";
        }
    }
}
?>