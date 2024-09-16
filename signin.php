<?php
session_start();
require_once('bd.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
    <title>Сайт</title>
    <style>
        .bg-image-vertical {
position: relative;
overflow: hidden;
background-repeat: no-repeat;
background-position: right center;
background-size: auto 100%;
}

@media (min-width: 1025px) {
.h-custom-2 {
height: 100%;
}
}
    </style>
</head>
<body>
  <?php
  include('template/nav.php');
  ?>
    <section class="vh-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 text-black">
      
              <div class="px-5 ms-xl-4">
                <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                <span class="h1 fw-bold mb-0">Добро пожаловать</span>
              </div>
      
              <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
      
                <form method="post" action="submitsign.php" style="width: 23rem;">
      
                  <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Вход в систему</h3>
      
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form2Example18" name="ulogin" class="form-control form-control-lg" required />
                    <label class="form-label" for="form2Example18">Логин</label>
                  </div>
      
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="form2Example28" name="upassword" class="form-control form-control-lg" required />
                    <label class="form-label" for="form2Example28">Пароль</label>
                  </div>
      
                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit" name="submit">Войти</button>
                  </div>
                </form>
      
              </div>
      
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
              <img src="img/sobor-001 (1).jpg"
                alt="Login image" class="img-fluid" style="height: 150%;width:auto;object-fit: cover; object-position: left;"><!--w-100 vh-100-->
            </div>
          </div>
        </div>
      </section>
</body>
</html>
