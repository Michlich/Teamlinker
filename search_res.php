<?php
$zapros = $_POST['search'];
$vid = $_POST['course'];
$db_file = 'Myres_data.db';
$db = new SQLite3($db_file);
if ($vid == '1'){
	$query = "SELECT count(0) FROM Resume";
	$result = $db->query($query);
	$countdb =  $result->fetchArray()[0];
	$ardb = array();
	for ($i = 1; $i <= $countdb; $i++) {
		$query = "SELECT title FROM Resume WHERE id = $i";
		$result = $db->query($query);
		$title =  $result->fetchArray()[0];
		$query = "SELECT description FROM Resume WHERE id = $i";
		$result = $db->query($query);
		$description =  $result->fetchArray()[0];
		$query = "SELECT experience FROM Resume WHERE id = $i";
		$result = $db->query($query);
		$experience =  $result->fetchArray()[0];
		$query = "SELECT skills FROM Resume WHERE id = $i";
		$result = $db->query($query);
		$skills =  $result->fetchArray()[0];
		$query = "SELECT contacts FROM Resume WHERE id = $i";
		$result = $db->query($query);
		$contacts =  $result->fetchArray()[0];
		if ((gettype(strripos($title, $zapros)) === 'integer') or (gettype(strripos($description, $zapros)) === 'integer') or (gettype(strripos($experience, $zapros)) === 'integer') or (gettype(strripos($skills, $zapros)) === 'integer') or (gettype(strripos($contacts, $zapros)) === 'integer')){
			array_push($ardb, array($title, $description, $experience, $skills, $contacts));
		}
	}
	$vivod = "
	<!DOCTYPE html>
	<html lang='ru'>
	<head>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<title>TeamLinker</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
		
		<nav class='navbar'>
			<!-- Ваша навигационная панель остаётся без изменений -->
			<a href='index.html' class='nav-logo' class='nav-logo'>
				<img src='web-svgrepo-com.svg' alt='TeamLinker Logo' class='logo-img'>
				<h3>TeamLinker</h3>
			</a>
			<div class='nav-links'>
				<a href='myads.php'>Мои объявления</a>
				<a href='ads.html'>Объявления</a>
				<a href='contact.html'>Связаться с нами</a>
			</div>
			<div class='nav-auth'>
				<a href='login.html' class='auth-link'>Вход</a>
				<a href='signup.html' class='auth-button'>Регистрация</a>
			</div>
		</nav>

		<main>
			<div class='grid-container'>
				<form class='search-panel' action='search_res.php' method='post'>
					<input type='search' name='search' placeholder='Поиск...'>
					<input type='radio' name='course' value='1' />соискатели <br>
					<input type='radio' name='course' value='2' />команды <br>
					<button action='search_res.php'>Поиск</button>
				</form>
	";
	for ($i = 0; $i < count($ardb); $i++) {
		$vivod = $vivod . "<h3>" . $ardb[$i][0] . "</h3> \n" . "<p>" . $ardb[$i][1] . "</p> \n" . "<p> Опыт работы: \n" . $ardb[$i][2] . "</p> \n" . "<p> Навыки: \n" . $ardb[$i][3] . "</p> \n" . "<p> Контакты: \n" . $ardb[$i][4] . "</p> \n";
	}
	$vivod = $vivod . "        </div>
		</main>

		<script>
			document.getElementById('searchTeam').addEventListener('click', function(event) {
				event.preventDefault(); 
				var popup = document.getElementById('teamPopup');
				popup.classList.toggle('show');
			});
		</script>
	</body>
	</html>
	";
	echo $vivod;
}
else if ($vid == '2'){
	$query = "SELECT count(0) FROM Vacansy";
	$result = $db->query($query);
	$countdb =  $result->fetchArray()[0];
	$ardb = array();
	for ($i = 1; $i <= $countdb; $i++) {
		$query = "SELECT vacancy_title FROM Vacansy WHERE id = $i";
		$result = $db->query($query);
		$vacancy_title =  $result->fetchArray()[0];
		$query = "SELECT vacancy_description FROM Vacansy WHERE id = $i";
		$result = $db->query($query);
		$vacancy_description =  $result->fetchArray()[0];
		$query = "SELECT vacancy_duties FROM Vacansy WHERE id = $i";
		$result = $db->query($query);
		$vacancy_duties =  $result->fetchArray()[0];
		$query = "SELECT vacancy_requirements FROM Vacansy WHERE id = $i";
		$result = $db->query($query);
		$vacancy_requirements =  $result->fetchArray()[0];
		$query = "SELECT vacancy_skills FROM Vacansy WHERE id = $i";
		$result = $db->query($query);
		$vacancy_skills =  $result->fetchArray()[0];
		$query = "SELECT vacancy_contacts FROM Vacansy WHERE id = $i";
		$result = $db->query($query);
		$vacancy_contacts =  $result->fetchArray()[0];
		if ((gettype(strripos($vacancy_title, $zapros)) === 'integer') or (gettype(strripos($vacancy_description, $zapros)) === 'integer') or (gettype(strripos($vacancy_duties, $zapros)) === 'integer') or (gettype(strripos($vacancy_requirements, $zapros)) === 'integer') or (gettype(strripos($vacancy_skills, $zapros)) === 'integer') or (gettype(strripos($vacancy_contacts, $zapros)) === 'integer')){
			array_push($ardb, array($vacancy_title, $vacancy_description, $vacancy_duties, $vacancy_requirements, $vacancy_skills, $vacancy_contacts));
		}
	}
	$vivod = "
	<!DOCTYPE html>
	<html lang='ru'>
	<head>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<title>TeamLinker</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
		
		<nav class='navbar'>
			<!-- Ваша навигационная панель остаётся без изменений -->
			<a href='index.html' class='nav-logo' class='nav-logo'>
				<img src='web-svgrepo-com.svg' alt='TeamLinker Logo' class='logo-img'>
				<h3>TeamLinker</h3>
			</a>
			<div class='nav-links'>
				<a href='myads.php'>Мои объявления</a>
				<a href='ads.html'>Объявления</a>
				<a href='contact.html'>Связаться с нами</a>
			</div>
			<div class='nav-auth'>
				<a href='login.html' class='auth-link'>Вход</a>
				<a href='signup.html' class='auth-button'>Регистрация</a>
			</div>
		</nav>

		<main>
			<div class='grid-container'>
				<form class='search-panel' action='search_res.php' method='post'>
					<input type='search' name='search' placeholder='Поиск...'>
					<input type='radio' name='course' value='1' />соискатели <br>
					<input type='radio' name='course' value='2' />команды <br>
					<button action='search_res.php'>Поиск</button>
				</form>
	";
	for ($i = 0; $i < count($ardb); $i++) {
		$vivod = $vivod . "<h3>" . $ardb[$i][0] . "</h3> \n" . "<p>" . $ardb[$i][1] . "</p> \n" . "<p> Обязанности: \n" . $ardb[$i][2] . "</p> \n" . "<p> Требования: \n" . $ardb[$i][3] . "<p> Ключевые навыки: \n" . $ardb[$i][4] . "</p> \n" . "<p> Контакты: \n" . $ardb[$i][5] . "</p> \n";
	}
	$vivod = $vivod . "        </div>
		</main>

		<script>
			document.getElementById('searchTeam').addEventListener('click', function(event) {
				event.preventDefault(); 
				var popup = document.getElementById('teamPopup');
				popup.classList.toggle('show');
			});
		</script>
	</body>
	</html>
	";
	echo $vivod;
}
else{
	header("Location: ads.html");
}
?>
