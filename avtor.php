<?php
// Получаем данные из формы
$mail = $_POST['mail'];
$pas = $_POST['pas'];

// Подключаемся к базе данных и сохраняем данные
// (здесь можно использовать MySQL, SQLite или другую СУБД)
//$pdo = new PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');
//$statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
//$statement->execute([$username, $password]);
$db_file = 'login_data.db';
$db = new SQLite3($db_file);
$query = "SELECT count(0) FROM Users WHERE email = '$mail'";
$result = $db->query($query);
if ($result->fetchArray()[0] != '0') {
    $query = "SELECT password FROM Users WHERE email = '$mail'";
    $result = $db->query($query);
    if ($result->fetchArray()[0] == $pas) {
        session_start();
        $_SESSION['user'] = $mail;
        echo $_SESSION['user'];
        header("Location: index.html");
    } else {
        header("Location: login.html");
    }
} else {
    header("Location: signup.html");
}

$db->close();
// Опционально: выводим сообщение об успешной регистрации
echo 'Registration successful!';
?>