<?php
// Получаем данные из формы
$vacancy_title = $_POST['vacancy-title'];
$vacancy_description = $_POST['vacancy-description'];
$vacancy_duties = $_POST['vacancy-duties'];
$vacancy_requirements = $_POST['vacancy-requirements'];
$vacancy_skills = $_POST['vacancy-skills'];
$vacancy_contacts = $_POST['vacancy-contacts'];
session_start();
if(isset($_SESSION['user'])) {
    $mail = $_SESSION['user'];
	$db_file = 'Myres_data.db';
	$db = new SQLite3($db_file);
	$query = "SELECT count(0) FROM Vacansy WHERE email = '$mail'";
	$result = $db->query($query);
	if ($result->fetchArray()[0] != '0') {
		$query = "DELETE FROM Vacansy WHERE email = '$mail'";
		$db->exec('BEGIN TRANSACTION');
		$result = $db->exec($query);
		$db->exec('COMMIT');
	}
	$query = "INSERT INTO Vacansy (email, vacancy_title, vacancy_description, vacancy_duties, vacancy_requirements, vacancy_skills, vacancy_contacts ) Values ('$mail', '$vacancy_title', '$vacancy_description', '$vacancy_duties', '$vacancy_requirements', '$vacancy_skills', '$vacancy_contacts')";
	$db->exec('BEGIN TRANSACTION');
	$result = $db->exec($query);
	$db->exec('COMMIT');
    header("Location: index.html");
} else {
    header("Location: signup.html");
}



$db->close();
?>