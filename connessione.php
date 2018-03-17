<?php
/*
 * Apertura connessione al db
 * e funzioni varie utili 
 */
//if (BETA) { echo "<pre class='Beta'>---connessione.php---\n</pre>"; }
include_once 'costanti.php';
/* connessione al database Italfrutta */
$db = mysql_connect(DB_HOST,DB_USER,DB_PASS)or die("Connessione non riuscita: ".mysql_error());
  // echo ("Connesso con successo");
mysql_select_db(DB_NAME, $db) or die("Errore nella selezione del database");

// PDO connessione a db Ital-Frutta
function connetti() {
    return new PDO('mysql:host=localhost;dbname=db-italfrutta', 'italfrutta', 'ipass2013+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

/* esempio di utilizzo del PDO
$sql = "SELECT * FROM cliente ORDER BY NomeCliente ASC";
$query = $pdo->prepare($sql);
$query->execute();
$list = $query->fetchAll(PDO::FETCH_ASSOC);

if (BETA3) {
echo '<pre class=Beta2>';
foreach ($list as $rs) {
    print_r($rs);
    foreach ($rs as $campo) {
        //print_r($campo);
    }
}
echo '</pre>';
}
 */
