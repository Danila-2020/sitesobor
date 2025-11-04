<?php
// Навбар сайта
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <amp-img src="img/mestologo.png" width="50" height="50" layout="fixed"></amp-img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="scedule.php">Расписание</a>
                </li>
                
                <!-- Пункт "О Соборе" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="handleDropdownClick(this)">
                        О Соборе
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item" href="clergy.php">Духовенство</a>
                        <a class="dropdown-item" href="history.php">История</a>
                        <a class="dropdown-item" href="feodosiy.php">Прп. Феодосий Кавказский</a>
                        <a class="dropdown-item" href="tour.php">Виртуальный тур</a>
                    </div>
                </li>
                
                <!-- Пункт "Благочиние" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blagochiniyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="handleDropdownClick(this)">
                        Благочиние
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blagochiniyaDropdown">
                        <a class="dropdown-item" href="blagochiniya-info.php">Общие сведения</a>
                        <a class="dropdown-item" href="blagochiniya-temples.php">Храмы</a>
                        <a class="dropdown-item" href="blagochiniya-clergy.php">Духовенство</a>
                    </div>
                </li>
                
                <!-- Пункт "Деятельность" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="activityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="handleDropdownClick(this)">
                        Деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="activityDropdown">
                        <a class="dropdown-item" href="sunday-school.php">Воскресная школа</a>
                        <a class="dropdown-item" href="youth-center.php">Молодёжный центр</a>
                        <a class="dropdown-item" href="tea-room.php">Чайный дворик</a>
                        <a class="dropdown-item" href="social-activity.php">Социальная деятельность</a>
                    </div>
                </li>

                <!-- Пункт "Таинства" с подменю -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sacramentsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="handleDropdownClick(this)">
                        Таинства
                    </a>
                    <div class="dropdown-menu" aria-labelledby="sacramentsDropdown">
                        <a class="dropdown-item" href="christening.php">Крещение</a>
                        <a class="dropdown-item" href="wedding.php">Венчание</a>
                        <a class="dropdown-item" href="confession.php">Исповедь</a>
                        <a class="dropdown-item" href="eucharist.php">Причастие</a>
                        <a class="dropdown-item" href="unction.php">Соборование</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="allunews.php">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photogallery.php">Галерея</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Контакты</a>
                </li>
                
                <!-- Кнопка "Вход" -->
                <li class="nav-item">
                    <a class="btn btn-outline-primary ml-2" href="signin.php">Вход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Стили для выпадающих меню в навбаре */
.navbar .dropdown-menu {
    background-color: rgba(0, 69, 113, 0.95) !important;
    border: 1px solid rgba(253, 253, 253, 0.2);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.navbar .dropdown-item {
    color: #fdfdfd !important;
    padding: 8px 20px;
    transition: all 0.3s ease;
}

.navbar .dropdown-item:hover {
    background-color: rgba(96, 150, 184, 0.5);
    color: #fdfdfd !important;
}

/* Стили для мобильных устройств */
@media (max-width: 992px) {
    .navbar-collapse {
        background-color: rgba(0, 69, 113, 0.98);
        padding: 1rem;
        border-radius: 0 0 8px 8px;
        margin-top: 8px;
        border: 1px solid rgba(253, 253, 253, 0.2);
        border-top: none;
    }
    
    .nav-link {
        margin: 0.2rem 0;
        text-align: center;
        padding: 0.75rem 1rem;
    }

    .nav-item {
        margin-bottom: 5px;
    }

    .nav-item:last-child {
        margin-bottom: 0;
    }

    /* Выпадающие меню в мобильной версии */
    .dropdown-menu {
        background-color: rgba(0, 69, 113, 0.8) !important;
        border: 1px solid rgba(253, 253, 253, 0.2);
        text-align: center;
        margin: 10px 0;
        padding: 0;
        position: static !important;
        float: none !important;
        border: none !important;
        box-shadow: none !important;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(253, 253, 253, 0.1);
        text-align: center;
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    /* Стрелка для dropdown в мобильной версии */
    .dropdown-toggle::after {
        float: right;
        margin-top: 0.5em;
    }

    /* Специальные стили для активного dropdown */
    .nav-item.dropdown.show .dropdown-menu {
        display: block !important;
        animation: fadeIn 0.3s ease;
    }
    
    /* Кнопка Вход в мобильной версии */
    .btn-outline-primary {
        margin: 10px 15px;
        width: calc(100% - 30px);
        text-align: center;
    }
}

/* Анимация для плавного появления */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Стили для десктопной версии */
@media (min-width: 993px) {
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    .dropdown-menu {
        min-width: 200px;
    }
}
</style>

<script>
// Функция для обработки кликов на dropdown в мобильной версии
function handleDropdownClick(element) {
    if (window.innerWidth < 993) {
        // Для мобильных устройств - предотвращаем стандартное поведение
        event.preventDefault();
        event.stopPropagation();
        
        const dropdown = element.closest('.dropdown');
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        const isShowing = dropdownMenu.style.display === 'block';
        
        // Закрываем все другие dropdown
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu !== dropdownMenu) {
                menu.style.display = 'none';
            }
        });
        
        // Переключаем текущий dropdown
        if (isShowing) {
            dropdownMenu.style.display = 'none';
        } else {
            dropdownMenu.style.display = 'block';
        }
    }
    // На десктопе Bootstrap сам всё обработает
}

// Закрытие dropdown при клике вне меню
document.addEventListener('click', function(event) {
    if (window.innerWidth < 993) {
        const isClickInsideNavbar = event.target.closest('.navbar-collapse');
        if (!isClickInsideNavbar) {
            // Закрываем все dropdown меню
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    }
});

// Обработка изменения размера окна
window.addEventListener('resize', function() {
    if (window.innerWidth >= 993) {
        // На десктопе показываем все dropdown меню стандартным способом
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = '';
        });
    } else {
        // На мобильных скрываем все dropdown меню
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth < 993) {
        // На мобильных устройствах изначально скрываем все dropdown
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});

// Дополнительный скрипт для корректной работы с Bootstrap
$(document).ready(function() {
    // Для мобильных устройств
    if ($(window).width() < 993) {
        // Закрытие основного меню при клике на обычные ссылки
        $('.navbar-nav .nav-link:not(.dropdown-toggle)').on('click', function() {
            $('.navbar-collapse').collapse('hide');
        });
        
        // Закрытие основного меню при клике на dropdown-item
        $('.dropdown-item').on('click', function() {
            $('.navbar-collapse').collapse('hide');
        });
        
        // Предотвращение закрытия основного меню при клике на dropdown-toggle
        $('.dropdown-toggle').on('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Закрытие меню при клике вне его области
    $(document).on('click', function(event) {
        if ($(window).width() < 993) {
            var clickover = $(event.target);
            var navbar = $(".navbar");
            var _opened = $(".navbar-collapse").hasClass("show");
            
            if (_opened === true && !navbar.is(clickover) && navbar.has(clickover).length === 0) {
                $(".navbar-collapse").collapse('hide');
                // Закрываем все dropdown
                $('.dropdown-menu').hide();
            }
        }
    });
});
</script>