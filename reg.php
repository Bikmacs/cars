<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $date_birth = $_POST['date_birth'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Проверка длины логина и пароля
    if (strlen($login) == 0 || strlen($password) <= 8) {
        header('Location: registr.php?error=Пароль должен содержать минимум 8 символов. Логин должен содержать минимум 1 символ.');
        exit;
    }

    // Проверка на уникальность логина
    $check_login = $conn->prepare("SELECT * FROM login WHERE login = ?");
    $check_login->bind_param("s", $login);
    $check_login->execute();
    $check_login->store_result();
    if ($check_login->num_rows > 0) {
        header('Location: registr.php?error=Логин уже занят.');
        exit;
    }

    // Проверка на уникальность электронной почты
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();
    if ($check_email->num_rows > 0) {
        header('Location: registr.php?error=Электронная почта уже занята.');
        exit;
    }

    // Вставка данных в таблицу пользователи
    $query_users = "INSERT INTO users (surname, name, date_birth, email) VALUES (?, ?, ?, ?)";
    $stmt_users = $conn->prepare($query_users);

    if ($stmt_users === false) {
        die('Ошибка подготовки запроса для таблицы пользователи: ' . $conn->error);
    }

    $stmt_users->bind_param("ssss", $surname, $name, $date_birth, $email);

    if ($stmt_users->execute()) {
        $user_id = $stmt_users->insert_id; 
        $stmt_users->close();

    
        $query_logins = "INSERT INTO login (id, login, password) VALUES (?, ?, ?)";
        $stmt_logins = $conn->prepare($query_logins);

        if ($stmt_logins === false) {
            die('Ошибка подготовки запроса для таблицы логины: ' . $conn->error);
        }

        $stmt_logins->bind_param("iss", $id, $login, $password);

        if ($stmt_logins->execute()) {
            header('Location: index.html');
            exit;
        } else {
            header('Location: registr.php?error=Ошибка регистрации: ' . urlencode($stmt_logins->error));
            exit;
        }

        $stmt_logins->close();
    } else {
        header('Location: registr.php?error=Ошибка регистрации: ' . urlencode($stmt_users->error));
        exit;
    }
}
?>
