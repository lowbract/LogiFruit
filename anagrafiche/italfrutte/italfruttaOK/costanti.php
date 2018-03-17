<?php

/*
 * Qui si mettono i valori che potrebbero cambiare per
 * adeguarsi ai cambiamenti dell'ambiente host.
 * Inoltre sono state aggiunte qui alcune comodità che non sapevo dov'altro mettere
 */

// flag debug - valore logico se sì 1 no 0 
define ("BETA","1"); // si riferisce alle variabili ambientali e a buona parte delle query
define ("BETA2","1"); // si riferisce a variabili e query all'interno di funzioni ed inoltre di tabelle ed elementi grafici vincolanti  

// Parametri MySQL
define ("DB_HOST","localhost");
define ("DB_NAME","db-italfrutta");
define ("DB_USER","root");
define ("DB_PASS","lpass2013+");

// comodità varie
$data= date("Y-m-d");
$ieri = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1,   date("Y")));

//questo in beta stampa in ogni pagina i dati passati per $_POST e $_GET
if (BETA) { echo "<pre class='Beta'>--DEBUG BETA--\n</pre>"; echo "<pre class='Beta'>_POST:\n"; print_r($_POST); echo "</pre>"; echo "<pre class='Beta'>_GET:\n"; print_r($_GET); echo "</pre>";}
if (BETA2) echo "<pre class='Beta2'>**DEBUG BETA2**\n</pre>";
?>