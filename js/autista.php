<?php
// Refresh PRODOTTO
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=db-italfrutta', 'italfrutta', 'ipass2013+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM autista WHERE Cognome LIKE (:keyword) AND del = 0 ORDER BY Cognome, Nome ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nome = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['Cognome']);
        $nome .= " " . $rs['Nome'];
	// add new option
    echo '<p onclick="setta_autista(\'auti'.$_GET['id'].'\',\''.str_replace("'", "\'", $rs['Cognome']).'\',\''.str_replace("'", "\'", $rs['Nome']).'\',\''.str_replace("'", "\'", $rs['Telefono1']).'\',\''.str_replace("'", "\'", $rs['Telefono2']).'\',\''.$rs['CodAut'].'\')" class="lista">'.$nome.'</p>';
}
