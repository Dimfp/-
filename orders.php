<?php
session_start();
include 'db.php';

// защита
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

// добавление заказа
if (isset($_POST["add"])) {
    $date = date("Y-m-d");
    $status = "новый";
    $waiter_id = $_SESSION["user_id"];
    $table_id = $_POST["table_id"];

    $conn->query("INSERT INTO заказы (date, status, waiter_id, table_id)
                  VALUES ('$date', '$status', '$waiter_id', '$table_id')");
}

$result = $conn->query("SELECT * FROM заказы");
?>

<!DOCTYPE html>
<html>
<head>
<title>Заказы</title>

<style>
body {
    font-family: Arial;
    background: #fdf6ec;
    margin: 0;
    padding: 0;
}

/* контейнер */
.container {
    max-width: 800px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

/* заголовок */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
}

/* кнопка выхода */
.logout {
    text-decoration: none;
    background: #ff6b6b;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
}

/* форма */
form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

input {
    flex: 1;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    padding: 10px 15px;
    background: #87CEEB;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #6bb6d6;
}

/* таблица */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th {
    background: #87CEEB;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

/* строки */
tr:hover {
    background: #f9f9f9;
}
</style>

</head>

<body>

<div class="container">

<div class="header">
    <h2>Заказы (<?= $_SESSION["user_name"] ?>)</h2>
    <a href="logout.php" class="logout">Выйти</a>
</div>

<form method="POST">
    <input name="table_id" placeholder="ID стола">
    <button name="add">Создать заказ</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Дата</th>
    <th>Статус</th>
    <th>Стол</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row["id"] ?></td>
    <td><?= $row["date"] ?></td>
    <td><?= $row["status"] ?></td>
    <td><?= $row["table_id"] ?></td>
</tr>
<?php endwhile; ?>

</table>

</div>

</body>
</html>