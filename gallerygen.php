<?php
//Фотогалерея (Пользователь General)
session_start();
require_once('bd.php');
ob_start();
include('template/scedulehead.php');
include('template/barber.php');

// Выводим стили
echo getStyles();
?>
   <body>
   <?php
    include('template/generalheader.php');
    ?>
       <div class="container mt-5">
           <h1 class="text-center">Фотогалерея</h1>
           <div class="row">
           <div class="row" id="gallery">
        <?php
        require_once('bd.php');
        $query = ("SELECT * FROM uphotogallery WHERE id_ugallery = 1 ORDER BY id_uphotogallery ASC");
        $result = $mysqli->query($query);
        while($row = $result->fetch_assoc()): ?>
            <?php
                $show_img = base64_encode($row['uphotogal']);
                $desc = htmlspecialchars($row['udescphoto']);
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="data:image/jpeg;base64,<?=$show_img?>"
                         class="card-img-top gallery-img"
                         alt="<?=$desc?>"
                         data-toggle="modal"
                         data-target="#imageModal"
                         data-img="data:image/jpeg;base64,<?=$show_img?>"
                         data-desc="<?=$desc?>">
                    <div class="card-body">
                        <p class="card-text"><?=$desc?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <!-- Пагинация -->
    <?php if (isset($total_pages) && $total_pages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if (isset($current_page) && $current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?=($current_page - 1)?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php 
            if (isset($current_page) && isset($total_pages)) {
                // Показываем ограниченное количество страниц вокруг текущей
                $start_page = max(1, $current_page - 2);
                $end_page = min($total_pages, $current_page + 2);
                
                if ($start_page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                    if ($start_page > 2) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                }
                
                for ($i = $start_page; $i <= $end_page; $i++): ?>
                    <li class="page-item <?=($i == $current_page) ? 'active' : ''?>">
                        <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                    </li>
                <?php endfor; 
                
                if ($end_page < $total_pages) {
                    if ($end_page < $total_pages - 1) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                    echo '<li class="page-item"><a class="page-link" href="?page='.$total_pages.'">'.$total_pages.'</a></li>';
                }
            }
            ?>
            
            <?php if (isset($current_page) && isset($total_pages) && $current_page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?=($current_page + 1)?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>
    <!-- Модальное окно для просмотра изображений -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Просмотр изображения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="img-fluid">
                <p id="modalDesc" class="mt-3"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!-- Подключаем только одну версию jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Обработчик для модального окна
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imgSrc = button.data('img');
        var imgDesc = button.data('desc');
        
        var modal = $(this);
        modal.find('#modalImage').attr('src', imgSrc);
        modal.find('#modalDesc').text(imgDesc);
    });
});
</script>
           </div>
       </div>

       <div class="social">
            <div class="container">
                <?php include('template/social-icons.php'); ?>
            </div>
        </div>

        <div class="jumbotron text-center">
            <b><i>&copy; Колодочкин Алексей<br>
            Дробилко Данила</i></b>
        </div>
        <div class="relative">
            <amp-img class="" src="img/mountains-no-sky-sharpened.png" width="1600" height="254" layout="responsive"></amp-img>
        </div>
</div>
   </body>
   </html>