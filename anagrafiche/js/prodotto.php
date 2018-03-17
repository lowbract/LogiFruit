<?php
// Refresh PRODOTTO
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=db-italfrutta', 'italfrutta', 'ipass2013+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM nomeprod WHERE NomeProd LIKE (:keyword) AND del = 0 ORDER BY NomeProd ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nome = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['NomeProd']);
	// add new option
    echo '<p onclick="set_item(\'prod'.$_GET['id'].'\',\''.str_replace("'", "\'", $rs['NomeProd']).'\',\''.$rs['CodNP'].'\')" class="lista">'.$nome.'</p>';
}
