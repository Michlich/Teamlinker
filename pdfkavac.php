<?php
require_once('tcpdf/tcpdf.php');
session_start();
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$str = $_SESSION['user'];
$pdf->SetAuthor($str);
$db_file = 'Myres_data.db';
$db = new SQLite3($db_file);
$query = "SELECT vacancy_title FROM Vacansy WHERE email = '$str'";
$result = $db->query($query);
$vacancy_title =  $result->fetchArray()[0];
$query = "SELECT vacancy_description FROM Vacansy WHERE email = '$str'";
$result = $db->query($query);
$vacancy_description =  $result->fetchArray()[0];
$query = "SELECT vacancy_duties FROM Vacansy WHERE email = '$str'";
$result = $db->query($query);
$vacancy_duties =  $result->fetchArray()[0];
$query = "SELECT vacancy_requirements FROM Vacansy WHERE email = '$str'";
$result = $db->query($query);
$vacancy_requirements =  $result->fetchArray()[0];
$query = "SELECT vacancy_skills FROM Vacansy WHERE email = '$str'";
$result = $db->query($query);
$vacancy_skills =  $result->fetchArray()[0];
$query = "SELECT vacancy_contacts FROM Vacansy WHERE email = '$str'";
$result = $db->query($query);
$vacancy_contacts =  $result->fetchArray()[0];
$pdf->SetTitle($title);
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->Write(5," $vacancy_title
 $vacancy_description
 ОБЯЗАННОСТИ:
 $vacancy_duties
 ТРЕБОВАНИЕ: 
 $vacancy_requirements 
 НАВЫКИ: 
 $vacancy_skills
 КОНТАКТЫ:
 $vacancy_contacts
 ");

$pdf->Output('output.pdf', 'D');
?>