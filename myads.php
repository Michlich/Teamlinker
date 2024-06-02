<?php
session_start();
if(isset($_SESSION['user'])) {
    $mail = $_SESSION['user'];
	$title = '';
	$description = '';
	$experience = '';
	$skills = '';
	$contacts = '';
    $vacancy_title = '';
    $vacancy_description = '';
    $vacancy_duties = '';
    $vacancy_requirements = '';
    $vacancy_skills = '';
    $vacancy_contacts = '';
	$db_file = 'Myres_data.db';
	$db = new SQLite3($db_file);
	$query = "SELECT count(0) FROM Resume WHERE email = '$mail'";
	$result = $db->query($query);
	if ($result->fetchArray()[0] != '0') {
		$query = "SELECT title FROM Resume WHERE email = '$mail'";
		$result = $db->query($query);
		$title = $result->fetchArray()[0];
		$query = "SELECT description FROM Resume WHERE email = '$mail'";
		$result = $db->query($query);
		$description = $result->fetchArray()[0];
		$query = "SELECT experience FROM Resume WHERE email = '$mail'";
		$result = $db->query($query);
		$experience = $result->fetchArray()[0];
		$query = "SELECT skills FROM Resume WHERE email = '$mail'";
		$result = $db->query($query);
		$skills = $result->fetchArray()[0];
		$query = "SELECT contacts FROM Resume WHERE email = '$mail'";
		$result = $db->query($query);
		$contacts = $result->fetchArray()[0];
	}
    $query = "SELECT count(0) FROM Vacansy WHERE email = '$mail'";
	$result = $db->query($query);
	if ($result->fetchArray()[0] != '0') {
		$query = "SELECT vacancy_title FROM Vacansy WHERE email = '$mail'";
		$result = $db->query($query);
		$vacancy_title = $result->fetchArray()[0];
		$query = "SELECT vacancy_description FROM Vacansy WHERE email = '$mail'";
		$result = $db->query($query);
		$vacancy_description = $result->fetchArray()[0];
		$query = "SELECT vacancy_duties FROM Vacansy WHERE email = '$mail'";
		$result = $db->query($query);
		$vacancy_duties = $result->fetchArray()[0];
		$query = "SELECT vacancy_requirements FROM Vacansy WHERE email = '$mail'";
		$result = $db->query($query);
		$vacancy_requirements = $result->fetchArray()[0];
		$query = "SELECT vacancy_skills FROM Vacansy WHERE email = '$mail'";
		$result = $db->query($query);
		$vacancy_skills = $result->fetchArray()[0];
        $query = "SELECT vacancy_contacts FROM Vacansy WHERE email = '$mail'";
		$result = $db->query($query);
		$vacancy_contacts = $result->fetchArray()[0];
	}
	echo $mail;
	print "
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
        <a href='index.html' class='nav-logo'>
            <img src='web-svgrepo-com.svg' alt='TeamLinker Logo' class='logo-img'>
            <h3>TeamLinker</h3>
        </a>
        <div class='nav-links'>
            <a href='myads.html'>Мои объявления</a>
            <a href='ads.html'>Объявления</a>
            <a href='contact.html'>Связаться с нами</a>
        </div>
        <div class='nav-auth'>
            <a href='login.html' class='auth-link'>Вход</a>
            <a href='signup.html' class='auth-button registration-button'>Регистрация</a>
        </div>
    </nav>
    <main class='main-container'>
        <section class='resume-section'>
            <h2>Ваше резюме</h2>
            <form id='resumeForm' action='save_res.php' method='post'>
                <label for='title'>Заголовок:</label>
                <input type='text' id='title' name='title' value='$title' placeholder='Введите заголовок'>
				
                <label for='description'>Описание:</label>
                <input type='text' id='description' name='description'  value='$description' placeholder='Краткое описание вашего опыта'>
				
                <label for='experience'>Опыт:</label>
                <input type='text' id='experience' name='experience' value='$experience' placeholder='Опишите ваш опыт работы'>
    
                <label for='skills'>Навыки:</label>
                <input type='text'  id='skills' name='skills' placeholder='Перечислите ваши ключевые навыки' value='$skills'>
    
                <label for='contacts'>Контакты:</label>
                <input type='text' id='contacts' name='contacts' placeholder='Контактная информация' value='$contacts'>
    
                <button type='submit' action='save_res.php'>Сохранить</button>
            </form>
			<form id='pdfForm' action='pdfka.php' method='post'>
				<button type='submit' action='pdfka.php'>PDF</button>
            </form>
        </section>
    
        <section class='vacancy-section'>
            <h2>Вакансия, которую вы хотите предложить другим</h2>
            <form id='vacancyForm' action='save_vac.php' method='post'>
                <label for='vacancy-title'>Название:</label>
                <input type='text' id='vacancy-title' name='vacancy-title' value='$vacancy_title' placeholder='Введите название вакансии'>
                <label for='vacancy-description'>Описание:</label>
                <input type='text' id='vacancy-description' name='vacancy-description' value='$vacancy_description' placeholder='Краткое описание вакансии'></textarea>
        
                <label for='vacancy-duties'>Обязанности:</label>
                <input type='text' id='vacancy-duties' name='vacancy-duties' value='$vacancy_duties' placeholder='Основные обязанности'></textarea>
        
                <label for='vacancy-requirements'>Требования:</label>
                <input type='text' id='vacancy-requirements' name='vacancy-requirements' value='$vacancy_requirements' placeholder='Требования к команде'></textarea>
        
                <label for='vacancy-skills'>Ключевые навыки:</label>
                <input type='text' id='vacancy-skills' name='vacancy-skills' value='$vacancy_skills' placeholder='Ваши навыки'></textarea>
        
                <label for='vacancy-contacts'>Контакты:</label>
                <input type='text' id='vacancy-contacts' name='vacancy-contacts' value='$vacancy_contacts' placeholder='Контактная информация'>
        
                <button type='submit' action='save_vac.php'>Сохранить</button>
            </form>
			<form id='pdfForm2' action='pdfkavac.php' method='post'>
				<button type='submit' action='pdfkavac.php'>PDF</button>
            </form>
        </section>
        
        
    </main>
<!--    <script>
        document.getElementById('resumeForm').addEventListener('submit', function(event) {
            event.preventDefault();  // Предотвратить стандартную отправку формы
            const formData = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                experience: document.getElementById('experience').value,
                skills: document.getElementById('skills').value,
                contacts: document.getElementById('contacts').value
            };
            console.log('Данные для сохранения:', formData);
            // Здесь код для отправки данных на сервер, например, через fetch API
        });
        </script>
    <script src='script.js'></script>-->
</body>
</html>

	";
}
else{
	header("Location: signup.html");
}
?>