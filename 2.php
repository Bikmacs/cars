<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АвтоПлюс</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="header">
        АвтоПлюс
        <button class="add-button" onclick="window.location.href='index.html'">Назад</button>
    </div>
    <div class="container">
        <?php
        include 'connect.php';

        $query = "SELECT * FROM cars";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="card">
                    <div class="card-header">
                        <h2>' . htmlspecialchars($row['name']) . '</h2>
                        <p>' . htmlspecialchars($row['description']) . '</p>
                        <p>Цена: ' . htmlspecialchars($row['money']) . ' руб.</p>
                    </div>
                    <div class="card-footer">
                        <button class="card-button">Подробнее</button>
                    </div>
                </div>';
            }
        } else {
            echo '<p>Нет доступных автомобилей.</p>';
        }
        ?>
    </div>
    <div class="add-button-container">
        <button class="add-button" onclick="window.location.href='add_car.php'">Добавить автомобиль</button>
    </div>
</body>
</html>
