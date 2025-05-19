<?php
//Добавление отдела (Пользователь General)

session_start();
require_once('bd.php');
include('template/scedulehead.php');//Обычная бошка не подходит, надо будет переписать в нормальную.
include('template/barber.php');
// Выводим стили
echo getStyles();
include('template/generalheader.php')
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Добавление нового отдела</h4>
                </div>
                <div class="card-body">
                    <form id="addDepartmentForm" action="submitaddotdelgen.php" method="POST" enctype="multipart/form-data">
                        <!-- Название отдела -->
                        <div class="form-group">
                            <label for="departmentName">Название отдела *</label>
                            <input type="text" class="form-control" id="departmentName" name="departmentName" required>
                            <small class="form-text text-muted">Введите полное название отдела</small>
                        </div>

                        <!-- Описание отдела -->
                        <div class="form-group">
                            <label for="departmentDescription">Описание отдела *</label>
                            <textarea class="form-control" id="departmentDescription" name="departmentDescription" rows="5" required></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Сохранить отдел</button>
                            <a href="uotdel.php" class="btn btn-outline-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Скрипт для отображения названий выбранных файлов
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var files = e.target.files;
    var label = this.nextElementSibling;
    var previewArea = document.getElementById('previewArea');
    
    if (files.length > 0) {
        if (files.length === 1) {
            label.textContent = files[0].name;
        } else {
            label.textContent = files.length + ' файлов выбрано';
        }
        
        // Очищаем превью
        previewArea.innerHTML = '';
        
        // Ограничиваем количество превью до 5
        let maxFiles = Math.min(files.length, 5);
        
        // Создаем превью для каждого изображения
        for (let i = 0; i < maxFiles; i++) {
            if (files[i].type.match('image.*')) {
                let reader = new FileReader();
                
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail mr-2 mb-2';
                    img.style.maxHeight = '100px';
                    previewArea.appendChild(img);
                }
                
                reader.readAsDataURL(files[i]);
            }
        }
    } else {
        label.textContent = 'Выберите файлы';
        previewArea.innerHTML = '';
    }
});

// Валидация формы перед отправкой
document.getElementById('addDepartmentForm').addEventListener('submit', function(e) {
    let files = document.getElementById('departmentPhotos').files;
    
    if (files.length > 5) {
        alert('Можно загрузить не более 5 фотографий');
        e.preventDefault();
        return false;
    }
    
    return true;
});
</script>

<?php
include('template/footer.php');
?>