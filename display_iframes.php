<?php
/**
 * Функция для отображения iframe на страницах
 * @param string $page_name Название страницы
 * @param int|null $sub_id ID подраздела (например, ID новости)
 * @param mysqli|null $mysqli_obj Объект подключения к БД (опционально)
 */
function displayIframes($page_name, $sub_id = null, $mysqli_obj = null) {
    // Если объект подключения не передан, создаем новое подключение
    if ($mysqli_obj === null) {
        require_once('bd.php');
        // Используем глобальную переменную $mysqli из bd.php
        global $mysqli;
        
        // Проверяем подключение
        if ($mysqli->connect_error) {
            error_log("Ошибка подключения к БД в display_iframes: " . $mysqli->connect_error);
            return;
        }
    } else {
        $mysqli = $mysqli_obj;
    }
    
    // Экранируем параметры для безопасности
    $page_name_escaped = $mysqli->real_escape_string($page_name);
    $sub_id_escaped = $sub_id !== null ? $mysqli->real_escape_string($sub_id) : '';
    
    // Формируем SQL запрос в зависимости от наличия sub_id
    if ($sub_id !== null && $sub_id !== '') {
        // Для страницы новостей с конкретной новостью
        $sql = "SELECT utitle, url, description 
                FROM iframes 
                WHERE page_iframes = '$page_name_escaped' AND sub_id = '$sub_id_escaped' AND status = 'active'
                ORDER BY id_iframes DESC";
    } else {
        // Для обычных страниц
        $sql = "SELECT utitle, url, description 
                FROM iframes 
                WHERE page_iframes = '$page_name_escaped' AND (sub_id IS NULL OR sub_id = 0) AND status = 'active'
                ORDER BY id_iframes DESC";
    }
    
    // Выполняем запрос
    $result = $mysqli->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo '<div class="iframes-container">';
        echo '<h3 class="text-center mb-4">Дополнительные материалы</h3>';
        
        echo '<div class="iframes-scroll-container">';
        echo '<div class="iframes-inner-container">';
        
        while ($iframe = $result->fetch_assoc()) {
            echo '<div class="iframe-scroll-item">';
            echo '<div class="iframe-content">';
            
            if (!empty($iframe['utitle'])) {
                echo '<h4>' . htmlspecialchars($iframe['utitle']) . '</h4>';
            }
            
            if (!empty($iframe['description'])) {
                echo '<div class="iframe-description">' . htmlspecialchars($iframe['description']) . '</div>';
            }
            
            // Проверяем, является ли URL iframe кодом Rutube
            if (preg_match('/rutube\.ru\/play\/embed\/([a-zA-Z0-9]+)/', $iframe['url'], $matches)) {
                $video_id = $matches[1];
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo '<iframe src="https://rutube.ru/play/embed/' . $video_id . '" ';
                echo 'frameborder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen style="background: white;"></iframe>';
                echo '</div>';
            } else {
                // Обычный iframe с белым фоном
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo '<iframe src="' . htmlspecialchars($iframe['url']) . '" ';
                echo 'frameborder="0" allowfullscreen style="background: white;"></iframe>';
                echo '</div>';
            }
            
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Добавляем индикатор скролла для мобильных
        echo '<div class="scroll-indicator text-center mt-2 d-md-none">';
        echo '<small><i class="fa fa-arrows-h"></i> Прокрутите в сторону для просмотра всех материалов</small>';
        echo '</div>';
        
    } else {
        // Логируем информацию для отладки
        error_log("No iframes found for page: $page_name, sub_id: $sub_id");
        if (!$result) {
            error_log("Ошибка выполнения запроса в display_iframes: " . $mysqli->error);
        }
    }
    
    // Освобождаем результат
    if ($result) {
        $result->free();
    }
}

/**
 * Функция для получения iframe данных (для использования в unews.php)
 */
function getPageIframes($page_name, $sub_id = null, $mysqli_obj = null) {
    // Если объект подключения не передан, создаем новое подключение
    if ($mysqli_obj === null) {
        require_once('bd.php');
        global $mysqli;
        
        if ($mysqli->connect_error) {
            error_log("Ошибка подключения к БД в getPageIframes: " . $mysqli->connect_error);
            return [];
        }
    } else {
        $mysqli = $mysqli_obj;
    }
    
    $page_name_escaped = $mysqli->real_escape_string($page_name);
    $sub_id_escaped = $sub_id !== null ? $mysqli->real_escape_string($sub_id) : '';
    
    if ($sub_id !== null && $sub_id !== '') {
        $sql = "SELECT utitle, url, description 
                FROM iframes 
                WHERE page_iframes = '$page_name_escaped' AND sub_id = '$sub_id_escaped' AND status = 'active'
                ORDER BY id_iframes DESC";
    } else {
        $sql = "SELECT utitle, url, description 
                FROM iframes 
                WHERE page_iframes = '$page_name_escaped' AND (sub_id IS NULL OR sub_id = 0) AND status = 'active'
                ORDER BY id_iframes DESC";
    }
    
    $result = $mysqli->query($sql);
    $iframes = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $iframes[] = $row;
        }
    }
    
    if ($result) {
        $result->free();
    }
    
    return $iframes;
}
?>