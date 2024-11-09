<?php
include('template/weddinghead.php');
?>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.php">Главная</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="scedule.php">Расписание богослужений</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    О соборе
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="clergy.php">Духовенство</a>
                    <a class="dropdown-item" href="#">История</a>
                    <a class="dropdown-item" href="#">Роспись</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Таинства
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="christening.php">Крещение</a>
                    <a class="dropdown-item" href="wedding.php">Венчание</a>
                    <a class="dropdown-item" href="confession.php">Исповедь</a>
                    <a class="dropdown-item" href="eucharist.php">Причастие</a>
                    <a class="dropdown-item" href="unction.php">Соборование</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Контакты</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="article-title">Таинство Венчания</h1>
    
    <div class="article-content">
        <p>Венчание — это одно из важнейших таинств в христианской традиции, которое символизирует союз между мужчиной и женщиной перед Богом. Это священное действие не только объединяет пару, но и освящает их любовь и отношения.</p>
        
        <img src="img/wedding-001.jpg" alt="Свадебная церемония" class="img-fluid">
        
        <h2 class="section-title">История Венчания</h2>
        <p>Исторически, венчание имеет глубокие корни, уходящие в древние времена. Оно связано с библейскими традициями и обычаями, которые подчеркивают важность брака как священного союза.</p>
        
        <img src="img/wedding-002.jpg" alt="Исторические обряды" class="img-fluid">
        
        <h2 class="section-title">Символика Венчания</h2>
        <p>Во время венчания используются различные символы, такие как:</p>
        <ul>
            <li><strong>Обручальные кольца</strong> — символ вечной любви и верности.</li>
            <li><strong>Венцы</strong> — символы славы и достоинства, которые одеваются на головы жениха и невесты.</li>
            <li><strong>Свечи</strong> — символ света, который освещает путь новой семьи.</li>
        </ul>
        
        <img src="img/wedding-003.jpg" alt="Обручальные кольца" class="img-fluid">
        
        <h2 class="section-title">Подготовка к Венчанию</h2>
        <p>Подготовка к венчанию включает в себя:</p>
        <ol>
            <li>Выбор даты и места проведения церемонии.</li>
            <li>Согласование с духовным лицом.</li>
            <li>Подготовка необходимых документов.</li>
            <li>Духовная подготовка и исповедь.</li>
        </ol>
        
        <img src="img/wedding-004.jpg" alt="Подготовка к венчанию" class="img-fluid">
        
        <h2 class="section-title">Процесс Венчания</h2>
        <p>Церемония венчания обычно включает в себя следующие этапы:</p>
        <ul>
            <li>Молитва и благословение священника.</li>
            <li>Обмен обручальными кольцами.</li>
            <li>Надевание венцов.</li>
            <li>Совершение молитвы и освящение семьи.</li>
        </ul>
        
        <img src="img/wedding-005.jpg" alt="Процесс венчания" class="img-fluid">
        
        <h2 class="section-title">Заключение</h2>
        <p>Венчание — это не только формальность, но и глубокий духовный процесс, который требует осознания и уважения. Это начало новой жизни для супругов, основанной на любви, верности и взаимопонимании.</p>
    </div>
</div>
<footer>
    <p><b><i>&copy; Колодочкин Алексей<br>
    Дробилко Данила</i></b></p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>