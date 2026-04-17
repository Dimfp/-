<?php
session_start();
include 'db.php';

$message = "";

if (isset($_POST["register"])) {
    $name = $_POST["user_name"];
    $login = $_POST["user_login"];
    $password = $_POST["user_password"];

    $sql = "INSERT INTO официанты (name, login, password) 
            VALUES ('$name', '$login', '$password')";

    if ($conn->query($sql)) {
        $message = "Регистрация успешна";
    } else {
        $message = "Ошибка";
    }
}

if (isset($_POST["login_btn"])) {
    $login = $_POST["login_field"];
    $password = $_POST["password_field"];

    $sql = "SELECT * FROM официанты 
            WHERE login='$login' AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];

        header("Location: orders.php");
        exit();
    } else {
        $message = "Неверный логин или пароль";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Ресторан</title>

<style>
body {
    font-family: Arial;
    background: #fdf6ec;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 35px;
    border-radius: 12px;
    width: 320px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 15px;
}

form {
    display: flex;
    flex-direction: column;
}

input {
    width: 100%;
    padding: 10px;
    margin: 6px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    outline: none;
}

input:-webkit-autofill {
    box-shadow: 0 0 0px 1000px white inset !important;
}

button {
    margin-top: 10px;
    padding: 10px;
    background: #87CEEB;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

button:hover {
    background: #6bb6d6;
}

.switch {
    text-align: center;
    margin-top: 12px;
    cursor: pointer;
    color: #5a8bb0;
    font-size: 14px;
}

.hidden {
    display: none;
}

.message {
    text-align: center;
    color: red;
    margin-bottom: 10px;
}
</style>

</head>

<body>

<div class="container">

<h2 id="title">Регистрация</h2>

<div class="message"><?php echo $message; ?></div>

<form method="POST" id="registerForm" autocomplete="off">
    
    <input type="text" style="display:none">
    <input type="password" style="display:none">

    <input type="text" name="user_name" placeholder="Имя" autocomplete="off">
    <input type="text" name="user_login" placeholder="Логин" autocomplete="off">
    <input type="password" name="user_password" placeholder="Пароль" autocomplete="new-password">

    <button name="register">Зарегистрироваться</button>
</form>

<form method="POST" id="loginForm" class="hidden" autocomplete="off">
   
    <input type="text" style="display:none">
    <input type="password" style="display:none">

    <input type="text" name="login_field" placeholder="Логин" autocomplete="off">
    <input type="password" name="password_field" placeholder="Пароль" autocomplete="new-password">

    <button name="login_btn">Войти</button>
</form>

<div class="switch" onclick="toggleForm()">
    Уже есть аккаунт? Войти
</div>

</div>

<script>
function toggleForm() {
    let reg = document.getElementById("registerForm");
    let log = document.getElementById("loginForm");
    let title = document.getElementById("title");
    let switchText = document.querySelector(".switch");

    if (reg.classList.contains("hidden")) {
        reg.classList.remove("hidden");
        log.classList.add("hidden");
        title.innerText = "Регистрация";
        switchText.innerText = "Уже есть аккаунт? Войти";
    } else {
        reg.classList.add("hidden");
        log.classList.remove("hidden");
        title.innerText = "Вход";
        switchText.innerText = "Нет аккаунта? Зарегистрироваться";
    }
}
</script>

</body>
</html>