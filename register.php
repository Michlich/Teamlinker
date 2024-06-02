<?php
// Получаем данные из формы
$vuz = $_POST['vuz'];
$mail = $_POST['mail'];
$pas1 = $_POST['pas1'];
$pas2 = $_POST['pas2'];

// Подключаемся к базе данных и сохраняем данные
// (здесь можно использовать MySQL, SQLite или другую СУБД)
//$pdo = new PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');
//$statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
//$statement->execute([$username, $password]);
$db_file = 'login_data.db';
$db = new SQLite3($db_file);
$query = "SELECT count(0) FROM Users WHERE email = '$mail'";
$result = $db->query($query);

if (($result->fetchArray()[0] == '0') and $pas1 == $pas2) {
    $db->exec('BEGIN TRANSACTION');
    $result = $db->exec("INSERT INTO Users (email, password) Values ('$mail', '$pas1')");
    $db->exec('COMMIT');
    header("Location: login.html");
}
else {
    header("Location: signup.html");
}
$db->close();

// Опционально: выводим сообщение об успешной регистрации
?>