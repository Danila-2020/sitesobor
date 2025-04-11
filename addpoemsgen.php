<?php
// Страница добавления стиха(Пользователь General)
session_start();
include('template/uphotohead.php');
require_once('bd.php');
$id = $_SESSION['id'];

// Выводим стили
echo getStyles();
?>
<body>
    <div class="container">
        <div class="container py-5">
            <div class="row py-4">
              <div class="col-lg-6 mx-auto">
                <h1>Добавить стих</h1>
                <!-- Upload image input-->
            
                <form action="submitaddpoemsgen.php" method="post" enctype="multipart/form-data">
      <h4>Добавление</h4>
      <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
          <input id="upload" type="file" name="uphoto" onchange="readURL(this);" class="form-control border-0" required />
          <label id="upload-label" for="upload" class="font-weight-light text-muted">Выберите файл</label>
          <div class="input-group-append">
              <label for="upload" class="btn btn-warning m-0 rounded-pill px-4">
                  <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                  <small class="text-uppercase font-weight-bold text-muted">Выбрать</small>
              </label>
          </div>
          <button type="submit" name="submit" class="btn btn-outline-dark" style="margin-left: 10px;">Загрузить</button>
      </div>

      <!-- Поле для названия стиха -->
      <div class="form-group">
          <input type="text" class="form-control" name="poem_title" placeholder="Название стиха" required>
      </div>

      <!-- Текстовая область для дополнительного текста -->
      <div class="form-group">
          <textarea class="form-control" name="additional_text" placeholder="Дополнительный текст" rows="4"></textarea>
      </div>
  </form>

                <!-- Uploaded image area-->
                <!--<p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>-->
                <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
              </div>
            </div>
          </div>
          <button type="submit" onclick="location.href='generalprofile.php'" class="btn btn-outline-dark">Вернуться назад</button>
    </div>
<?php
include('template/uphotofooter.php');
?>