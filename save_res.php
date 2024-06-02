<?php
// Получаем данные из формы
$title = $_POST['title'];
$description = $_POST['description'];
$experience = $_POST['experience'];
$skills = $_POST['skills'];
$contacts = $_POST['contacts'];
session_start();
if(isset($_SESSION['user'])) {
    $mail = $_SESSION['user'];
	$db_file = 'Myres_data.db';
	$db = new SQLite3($db_file);
	$query = "SELECT count(0) FROM Resume WHERE email = '$mail'";
	$result = $db->query($query);
	if ($result->fetchArray()[0] != '0') {
		$query = "DELETE FROM Resume WHERE email = '$mail'";
		$db->exec('BEGIN TRANSACTION');
		$result = $db->exec($query);
		$db->exec('COMMIT');
	}
	$query = "INSERT INTO Resume (email, title, description, experience, skills, contacts) Values ('$mail', '$title', '$description', '$experience', '$skills', '$contacts')";
	$db->exec('BEGIN TRANSACTION');
	$result = $db->exec($query);
	$db->exec('COMMIT');
    header("Location: index.html");
} else {
    header("Location: signup.html");
}



$db->close();
?>