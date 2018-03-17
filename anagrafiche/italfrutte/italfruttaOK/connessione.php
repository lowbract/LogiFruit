<?php
/*
 * Apertura connessione al db
 * e funzioni varie utili 
 */
include_once 'costanti.php';

/* connessione al database Italfrutta */
$db = mysql_connect(DB_HOST,DB_USER,DB_PASS)or die("Connessione non riuscita: ".mysql_error());
  // echo ("Connesso con successo");
mysql_select_db(DB_NAME, $db) or die("Errore nella selezione del database"); 
?>
