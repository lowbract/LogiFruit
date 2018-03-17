<?php
// Refresh PEZZATURA
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=db-italfrutta', 'italfrutta', 'ipass2013+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdoimba = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM imballo WHERE TipoImballo LIKE (:keyword) ORDER BY TipoImballo ASC LIMIT 0, 10";
$query = $pdoimba->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nome = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['TipoImballo']);
	// add new option
    echo '<p onclick="set_item(\'imba'.$_GET['id'].'\',\''.str_replace("'", "\'", $rs['TipoImballo']).'\',\''.$rs['CodImb'].'\')" class="lista">'.$nome.'</p>';
}
