<?php
session_start();
require_once('bd.php');
include('template/head.php');
?>
<body>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4"></div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4">
            <form action="" method="post">
                <label for="utitle" >Название</label>
                <input type="text" name="utitle" value="" class="form-control" required /><br>
            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-xl-4"></div>
    </div>
<!--Это ниже в Футере-->
</body>
</html>