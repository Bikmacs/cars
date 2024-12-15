<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="auth">
        <h2>Регистрация</h2>
        <?php
        if (isset($_GET['error'])) {
            echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
        <form action="reg.php" method="post">
            <input type="text" name="surname" placeholder="Фамилия" required>
            <input type="text" name="name" placeholder="Имя" required>
            <input type="date" name="date_birth" placeholder="Дата рождения" required>
            <input type="email" name="email" placeholder="Почта" required>
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <a href="index.html">Назад</a>
    </div>
</body>
</html>
