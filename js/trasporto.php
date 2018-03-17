<?php
// Refresh PRODOTTO
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=db-italfrutta', 'italfrutta', 'ipass2013+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$data = date("Y-m-d");
$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM tra_testata WHERE idsgTRA LIKE (:keyword) AND data = '{$data}' AND Cancellazione Is Null ORDER BY idsgTRA ASC LIMIT 0, 10";
//print_r($sql);
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nome = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['idsgTRA']);
	// add new option
    echo '<p onclick="set_item(\'astr'.$_GET['id'].'\',\''.str_replace("'", "\'", $rs['idsgTRA']).'\',\''.$rs['idTra'].'\')" class="lista">'.$nome.'</p>';
}
