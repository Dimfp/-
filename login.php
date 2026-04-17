<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM официанты 
            WHERE login='$login' AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Вход выполнен";
    } else {
        echo "Неверный логин или пароль";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
</head>
<body>

<h2>Вход</h2>

<form method="POST">
    Логин: <input type="text" name="login"><br><br>
    Пароль: <input type="text" name="password"><br><br>
    <button type="submit">Войти</button>
</form>

</body>
</html>