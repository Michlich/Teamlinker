<?php
#mb_internal_encoding('UTF-8');
require_once('tcpdf/tcpdf.php');
session_start();
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$str = $_SESSION['user'];
$pdf->SetAuthor($str);
$db_file = 'Myres_data.db';
$db = new SQLite3($db_file);
$query = "SELECT title FROM Resume WHERE email = '$str'";
$result = $db->query($query);
$title =  $result->fetchArray()[0];
$query = "SELECT description FROM Resume WHERE email = '$str'";
$result = $db->query($query);
$description =  $result->fetchArray()[0];
$query = "SELECT experience FROM Resume WHERE email = '$str'";
$result = $db->query($query);
$experience =  $result->fetchArray()[0];
$query = "SELECT skills FROM Resume WHERE email = '$str'";
$result = $db->query($query);
$skills =  $result->fetchArray()[0];
$query = "SELECT contacts FROM Resume WHERE email = '$str'";
$result = $db->query($query);
$contacts =  $result->fetchArray()[0];
$pdf->SetTitle($title);
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 14, '', true);#$pdf->SetFont('helvetica', '', 12);
$pdf->Write(5," $title
 $description
 ОПЫТ РАБОТЫ:
 $experience 
 НАВЫКИ: 
 $skills 
 КОНТАКТЫ: 
 $contacts");

$pdf->Output('output.pdf', 'D');
?>