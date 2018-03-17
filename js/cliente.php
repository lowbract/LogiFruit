<?php
// Refresh CLIENTE
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=db-italfrutta', 'italfrutta', 'ipass2013+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM cliente WHERE NomeCliente LIKE (:keyword) AND del = 0 ORDER BY NomeCliente ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$clie_nome = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['NomeCliente']);
	// add new option
    echo '<p onclick="set_item(\'clie'.$_GET['id'].'\',\''.str_replace("'", "\'", $rs['NomeCliente']).'\',\''.$rs['CodCliente'].'\')" class="lista">'.$clie_nome.'</p>';
}
