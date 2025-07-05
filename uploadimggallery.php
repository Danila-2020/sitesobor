<?php
include('template/scedulehead.php');
include('template/generalheader.php');
include('template/barber.php');

// Обработка загрузки файла
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'gallery/';
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $file = $_FILES['image'];
    $response = ['success' => false, 'message' => ''];

    try {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Ошибка загрузки файла');
        }
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Только JPG/PNG файлы разрешены');
        }
        if ($file['size'] > $maxSize) {
            throw new Exception('Файл слишком большой (макс. 5MB)');
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $dateTime = date('d-m-Y_H-i-s');
        $fileName = 'file_' . $dateTime . '.' . $extension;
        $targetPath = $uploadDir . $fileName;

        if (file_exists($targetPath)) {
            throw new Exception('Файл с таким именем уже существует');
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $response = [
                'success' => true,
                'message' => 'Файл успешно загружен',
                'path' => $targetPath,
                'filename' => $fileName
            ];
        } else {
            throw new Exception('Ошибка при сохранении файла');
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

echo getStyles();
?>

<!-- Добавляем стили для toast-уведомления -->
<style>
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.toast {
    min-width: 300px;
    background-color: rgba(255, 255, 255, 0.95);
    border-left: 5px solid #28a745;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    animation: slideIn 0.5s forwards, fadeOut 0.5s 3.5s forwards;
}

.toast-header {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
    font-weight: bold;
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Загрузка изображения в галерею</h4>
                </div>
                <div class="card-body">
                    <div class="upload-area text-center p-4 border rounded" id="uploadArea"
                         style="border: 2px dashed #ccc; cursor: pointer;">
                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                        <h5>Перетащите изображение сюда</h5>
                        <p class="text-muted">или кликните для выбора файла</p>
                        <small class="text-muted">Поддерживаются JPG и PNG (макс. 5MB)</small>
                    </div>

                    <input type="file" id="imageUpload" accept="image/jpeg, image/png" class="d-none">

                    <div class="mt-3 text-center">
                        <img id="imagePreview" class="img-fluid rounded" style="max-height: 300px; display: none;">
                    </div>

                    <div class="progress mt-3" id="progressBar" style="display: none; height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             role="progressbar" style="width: 0%">0%</div>
                    </div>

                    <button id="uploadBtn" class="btn btn-primary btn-block mt-3" disabled>
                        <i class="fas fa-upload mr-2"></i> Загрузить изображение
                    </button>

                    <div id="statusMessage" class="alert mt-3 mb-0" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Контейнер для toast-уведомлений -->
<div id="toastContainer" class="toast-container"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const uploadArea = document.getElementById('uploadArea');
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    const uploadBtn = document.getElementById('uploadBtn');
    const progressBar = document.getElementById('progressBar');
    const progressBarInner = progressBar.querySelector('.progress-bar');
    const statusMessage = document.getElementById('statusMessage');
    const toastContainer = document.getElementById('toastContainer');

    uploadArea.addEventListener('click', function () {
        imageUpload.click();
    });

    ['dragenter', 'dragover'].forEach(event => {
        uploadArea.addEventListener(event, function (e) {
            e.preventDefault();
            this.style.borderColor = '#007bff';
            this.style.backgroundColor = '#f0f8ff';
        });
    });

    ['dragleave', 'drop'].forEach(event => {
        uploadArea.addEventListener(event, function (e) {
            e.preventDefault();
            this.style.borderColor = '#ccc';
            this.style.backgroundColor = '';
        });
    });

    uploadArea.addEventListener('drop', function (e) {
        if (e.dataTransfer.files.length) {
            imageUpload.files = e.dataTransfer.files;
            handleFileSelect(e.dataTransfer.files[0]);
        }
    });

    imageUpload.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            handleFileSelect(this.files[0]);
        }
    });

    function handleFileSelect(file) {
        if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
            showStatus('Пожалуйста, выберите файл в формате JPG или PNG.', 'danger');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            uploadBtn.disabled = false;

            uploadArea.querySelector('h5').textContent = 'Выбран файл:';
            uploadArea.querySelector('p').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }

    uploadBtn.addEventListener('click', function () {
        const file = imageUpload.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        progressBar.style.display = 'block';
        progressBarInner.style.width = '0%';
        progressBarInner.textContent = '0%';
        uploadBtn.disabled = true;
        statusMessage.style.display = 'none';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true);

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBarInner.style.width = percent + '%';
                progressBarInner.textContent = percent + '%';
            }
        };

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    showToast('Успешно!', 'Изображение успешно загружено в галерею.', 'success');
                    resetForm();
                } else {
                    showStatus(response.message, 'danger');
                    uploadBtn.disabled = false;
                }
            } else {
                showStatus('Ошибка соединения с сервером', 'danger');
                uploadBtn.disabled = false;
            }

            setTimeout(() => {
                progressBar.style.display = 'none';
            }, 500);
        };

        xhr.onerror = function () {
            showStatus('Ошибка при загрузке файла', 'danger');
            uploadBtn.disabled = false;
            progressBar.style.display = 'none';
        };

        xhr.send(formData);
    });

    function showStatus(message, type) {
        statusMessage.textContent = message;
        statusMessage.className = 'alert alert-' + type;
        statusMessage.style.display = 'block';
    }

    function showToast(title, message, type) {
        const toast = document.createElement('div');
        toast.className = 'toast mb-3';
        toast.innerHTML = `
            <div class="toast-header">
                <strong class="mr-auto">${title}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        // Автоматическое закрытие через 4 секунды
        setTimeout(() => {
            toast.remove();
        }, 4000);
        
        // Закрытие по клику на крестик
        toast.querySelector('.close').addEventListener('click', () => {
            toast.remove();
        });
    }

    function resetForm() {
        imageUpload.value = '';
        imagePreview.style.display = 'none';
        imagePreview.src = '';
        uploadBtn.disabled = true;
        uploadArea.querySelector('h5').textContent = 'Перетащите изображение сюда';
        uploadArea.querySelector('p').textContent = 'или кликните для выбора файла';
    }
});
</script>

<?php include('template/footer.php'); ?>