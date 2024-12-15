<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $money = $_POST['money'];

    if (empty($name) || empty($description) || empty($money)) {
        header('Location: add_car.php?serror=Все поля обязательны для заполнения');
        exit;
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        header('Location: add_car.php?error=Название должно содержать только английские буквы');
        exit;
    }

    if (!is_numeric($money) || $money <= 0) {
        header('Location: add_car.php?error=Цена должна быть положительным числом');
        exit;
    }

    $query = "INSERT INTO cars (name, description, money) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Ошибка подготовки запроса: ' . $conn->error);
    }

    $stmt->bind_param("ssd", $name, $description, $money);

    if ($stmt->execute()) {
        header('Location: 2.php');
        exit;
    } else {
        header('Location: add_car.php?error=Ошибка добавления автомобиля');
        exit;
    }

    $stmt->close();
} else {
    header('Location: add_car.php?error=Неверный метод запроса');
    exit;
}
?>
