<?php
// Страница Духовенства(Пользователь general).

session_start();

include('template/scedulehead.php');//Обычная голова не работает, т.к. на ней есть своя структура.
include('template/barber.php');
require_once('bd.php');

// Выводим стили
echo getStyles();


// Получаем данные из базы данных
$query = "SELECT `id_clergy`, `titleclergy`, `imagesclergy`, `textclergy`, `datesclergy`, `educlergy`, 
`awardsclergy`,`statusclergy` FROM `clergy` WHERE 1=1";
$result = $mysqli->query($query);

if (!$result) {
    die("Ошибка запроса: " . $mysqli->error);
}

?>
<body>
    <style>
        .clergy-card {
            margin-bottom: 20px;
        }

        .overflow-container {
        overflow-x: auto; /* Включаем горизонтальную прокрутку */
        /* white-space: nowrap; Запрещаем перенос строк */
    }
    </style>
<?php
    include('template/generalheader.php');
?>

          <div class="social">
            <ul class="social-share">
              <li><a href="#"><i class="fa fa-telegram"></i></a></li>
              <li><a href="#"><i class="fa fa-vk"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>
          </div>

<div class="container mt-5">
<div class="overflow-container">
        <div class="row flex-nowrap">
            <?php while ($clergy = $result->fetch_assoc()): 
                $img = base64_encode($clergy['imagesclergy']); ?>
                <div class="col-md-4">
                    
                    <div class="card clergy-card">
                        <img src="data:image/jpeg;base64,<?=$img?>" class="card-img-top" alt="<?php echo $clergy['titleclergy']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $clergy['titleclergy']; ?></h5>
                            <p class="card-text">Дата: <?php echo $clergy['datesclergy']; ?></p>
                            <p class="card-text">Образование: <?php echo $clergy['educlergy']; ?></p>
                            <p class="card-text">Награды: <?php echo $clergy['awardsclergy']; ?></p>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#clergyModal<?php echo $clergy['id_clergy']; ?>" style="margin-bottom:5%;">
                                Подробнее
                            </button>
                            <?php
                            if($clergy['statusclergy'] == 'active'){
                                ?>
                                <form action="editclergygen.php" method="post">
                                <input type="hidden" name="hiddenid" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submit" class="btn btn-primary">Редактировать</button>
                                </form>
                                <form action="deleteclergygen.php" method="post" style="margin-top: 5%;">
                                <input type="hidden" name="hidden" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submitdel" class="btn btn-success">Удалить</button>
                                </form>
                                <form action="fulldeleteclergygen.php" method="post" style="margin-top: 5%;">
                                <input type="hidden" name="hidden" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submitfulldel" class="btn btn-danger">Полное удаление</button>
                                </form>
                                <?php
                            }
                            if($clergy['statusclergy'] == 'deleted'){
                                ?>
                                <form action="recoveryclergygen.php" method="post" style="margin-top: 5%;">
                                <input type="hidden" name="hidden" value="<?php echo($clergy['id_clergy']);?>"></input><!--Тут не видит ID-->
                                <button type="submit" name="submitrec" class="btn btn-success">Восстановить</button>
                                </form>
                                <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                    
                </div>

                <!-- Модальное окно для подробной информации -->
                <div class="modal fade" id="clergyModal<?php echo $clergy['id_clergy']; ?>" tabindex="-1" role="dialog" aria-labelledby="clergyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="clergyModalLabel"><?php echo $clergy['titleclergy']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo $clergy['textclergy']; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>