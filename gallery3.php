 <!DOCTYPE html>
   <html lang="ru">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
       <title>Фотогалерея</title>
   </head>
   <body>
       <div class="container mt-5">
           <h1 class="text-center">Фотогалерея</h1>
           <div class="row">
               <?php
               // Подключение к базе данных
               $servername = "localhost"; // ваш сервер
               $username = "root"; // ваше имя пользователя
               $password = ""; // ваш пароль
               $dbname = "sobor"; // ваша база данных

               // Создаем соединение
               $conn = new mysqli($servername, $username, $password, $dbname);

               // Проверяем соединение
               if ($conn->connect_error) {
                   die("Ошибка подключения: " . $conn->connect_error);
               }

               // SQL запрос для получения изображений
               
               $sql = "SELECT `uphoto`.`id_uphoto`, `uphoto`.`uphoto`, `uphoto`.`uphotostatus`, `uphoto`.`id_upublic`, `upublic`.`naim` FROM `uphoto` 
                    INNER JOIN `upublic` ON `upublic`.`id_upublic` = `uphoto`.`id_upublic`
                    WHERE 1=1";
               //SELECT image FROM images
               $result = $conn->query($sql);

               // Проверяем, есть ли результаты
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                        $img = base64_encode($row['uphoto']);
                       // Выводим каждое изображение
                       echo '<div class="col-md-4 mb-4">';
                       echo '<div class="card">';
                       echo '<form action="" method="post" enctype="multipart/form-data">';
                       echo '<img src="data:image/jpeg;base64,'.$img.'" class="card-img-top" alt="Изображение">';
                       echo '<div class="card-body">Content
                       <button type="submit" class="btn btn-primary" style="float: right;">Подробнее</button></div>';
                       echo '</form>';
                       echo '</div>';
                       echo '</div>';
                   }
               } else {
                   echo "Нет изображений";
               }

               // Закрываем соединение
               $conn->close();
               ?>
           </div>
       </div>

       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </body>
   </html>
