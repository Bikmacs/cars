<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить автомобиль</title>
    <link rel="stylesheet" href="style5.css">
</head>
<body>
    <div class="header">
        Добавить автомобиль
    </div>
    <div class="form-container">
        <form action="add_car_process.php" method="post">
            <h2>Добавить автомобиль</h2>
            <label for="car-name">Название:</label>
            <input type="text" id="car-name" name="name" required>
            <label for="car-description">Описание:</label>
            <textarea id="car-description" name="description" required></textarea>
            <label for="car-price">Цена:</label>
            <input type="text" id="car-price" name="money" required>
            <button type="submit">Добавить</button>
            <button type="button" onclick="window.location.href='2.php'">Отмена</button>
        </form>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
    </div>
</body>
</html>
