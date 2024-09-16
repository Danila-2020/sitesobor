<?php
session_start();

include('template/head.php');
require_once('bd.php');

?>
<link rel="stylesheet" href="css/style2.css">
<body>
    <form action="" method="post">
    <div class="frame">
        <div class="center">
            <div class="title">
                <h1>Теперь линкуем CSS и живём спокойно с Юлькой</h1>
            </div>
    
            <div class="dropzone">
                <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
                <input type="file" class="upload-input" />
            </div>
    
            <button type="button" class="btn" name="uploadbutton">Upload file</button>
    
        </div>
    </div>
        </form>
</body>
</html>
<?php
//include('template/footer.php');
?>