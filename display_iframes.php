<?php
function displayIframes($page_file, $db_connection) {
    try {
        // Определяем тип подключения (PDO или mysqli)
        $is_pdo = $db_connection instanceof PDO;
        $is_mysqli = $db_connection instanceof mysqli;
        
        if (!$is_pdo && !$is_mysqli) {
            throw new Exception("Неверный тип подключения к базе данных");
        }
        
        if ($is_pdo) {
            // Для PDO
            $sql = "SELECT utitle, url, description FROM iframes WHERE page_iframes = :page AND status = 'active' ORDER BY created_at DESC";
            $stmt = $db_connection->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Ошибка подготовки PDO запроса");
            }
            
            $stmt->execute([':page' => $page_file]);
            $iframes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Для mysqli
            $sql = "SELECT utitle, url, description FROM iframes WHERE page_iframes = ? AND status = 'active' ORDER BY created_at DESC";
            $stmt = $db_connection->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Ошибка подготовки mysqli запроса: " . $db_connection->error);
            }
            
            $stmt->bind_param('s', $page_file);
            $stmt->execute();
            $result = $stmt->get_result();
            $iframes = $result->fetch_all(MYSQLI_ASSOC);
        }
        
        if (!empty($iframes)) {
            echo '<div class="iframes-container mt-4">';
            echo '<h3 class="text-center mb-4">Дополнительные материалы</h3>';
            
            foreach ($iframes as $iframe) {
                echo '<div class="iframe-item mb-4">';
                echo '<h4>' . htmlspecialchars($iframe['utitle']) . '</h4>';
                if (!empty($iframe['description'])) {
                    echo '<p class="iframe-description">' . htmlspecialchars($iframe['description']) . '</p>';
                }
                
                // Проверяем, является ли URL уже iframe или нужно обернуть
                if (strpos($iframe['url'], '<iframe') === 0) {
                    echo $iframe['url'];
                } else {
                    echo '<div class="embed-responsive embed-responsive-16by9">';
                    echo '<iframe class="embed-responsive-item" src="' . htmlspecialchars($iframe['url']) . '" allowfullscreen></iframe>';
                    echo '</div>';
                }
                
                echo '</div>';
            }
            echo '</div>';
        } else {
            // Для отладки - можно закомментировать эту строку после тестирования
            echo '<!-- Нет iframe для страницы: ' . htmlspecialchars($page_file) . ' -->';
        }
    } catch (Exception $e) {
        error_log("Error displaying iframes: " . $e->getMessage());
        // Для отладки - можно закомментировать эту строку после тестирования
        echo '<!-- Ошибка при загрузке iframe: ' . htmlspecialchars($e->getMessage()) . ' -->';
    }
}
?>