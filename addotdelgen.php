<?php
// Добавление отдела (Пользователь General)

session_start();
require_once('bd.php'); // Убедитесь, что путь к файлу правильный
include('template/scedulehead.php'); // Проверьте название файла - возможно опечатка в "scedulehead" (должно быть schedulehead)
include('template/barber.php');

if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        Отдел успешно добавлен!
    </div>
<?php endif; 

// Проверка авторизации пользователя (добавлено для безопасности)
if (!isset($_SESSION['id'])) {
    header('Location: signin.php');
    exit();
}

// Выводим стили
echo getStyles(); // Убедитесь, что эта функция определена в одном из подключаемых файлов
include('template/generalheader.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Добавление нового отдела</h4>
                </div>
                <div class="card-body">
                    <form id="addDepartmentForm" action="submitaddotdelgen.php" method="POST">
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

<?php
include('template/footer.php');
?>