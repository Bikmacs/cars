<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Проверка логина и пароля
    $query = "SELECT * FROM login WHERE login = ? AND password = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Ошибка подготовки запроса: ' . $conn->error);
    }

    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['login'] = $login;

        // Проверка, является ли пользователь администратором
        if ($login === 'admin' && $password === '987654321') {
            header('Location: admin_panel.php');
        } else {
            header('Location: 2.php');
        }
        exit;
    } else {
        header('Location: index.html?error=Неверный логин или пароль');
        exit;
    }

    $stmt->close();
}
?>
