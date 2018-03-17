<?php
/*
 * Qui si mettono i valori che potrebbero cambiare per
 * adeguarsi ai cambiamenti dell'ambiente host.
 * Inoltre sono state aggiunte qui alcune comodità che non sapevo dov'altro mettere
 */
// flag debug - valore logico se sì 1 no 0 
if ($_SESSION['Username']=='leonardo' || $_SESSION['Username']=='pleo') {
    define ("BETA","1"); // si riferisce alle variabili ambientali (e a buona parte delle query)
    define ("BETA2","1"); // si riferisce a variabili e query all'interno di funzioni ed inoltre di tabelle ed elementi grafici vincolanti  
    define ("BETA3","1"); // si riferisce a print_r
} else {
    define ("BETA","0"); // si riferisce alle variabili ambientali (e a buona parte delle query)
    define ("BETA2","0"); // si riferisce a variabili e query all'interno di funzioni ed inoltre di tabelle ed elementi grafici vincolanti  
    define ("BETA3","0"); // si riferisce a print_r
}
// trasporto
if ($_SESSION['Username']=='leonardo' || $_SESSION['Username']=='pleo' || $_SESSION['Username']=='trasporto') {
    define ("TRASPORTO","1"); // trasporto
} else {
    define ("TRASPORTO","0"); // si riferisce alle variabili ambientali (e a buona parte delle query)
}

// messaggi errore attivi solo se BETA2 is ON
if (BETA2) error_reporting(E_ERROR);
if (BETA2) ini_set('display_errors', '1');
if (BETA2) ini_set('ini.session.use-trans-sid', '1');

// Parametri MySQL
define ("DB_HOST","localhost");
define ("DB_NAME","db-italfrutta");
define ("DB_USER","italfrutta");
define ("DB_PASS","ipass2013+");

// comodità varie
$data = date("Y-m-d");
$datatempo = date("Y-m-d H:i:s");
$utente = $_SESSION['Username'];
$ieri = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1,   date("Y")));
$datario = date("Y.z");
$anno = date("Y");
$giornan = date("z");
$arOP = array(
    "0" => "scegli",
    "1" => "00:00",
    "2" => "00:30",
    "3" => "01:00",
    "4" => "01:30",
    "5" => "02:00",
    "6" => "02:30",
    "7" => "03:00",
    "8" => "03:30",
    "9" => "04:00",
    "10" => "04:30",
    "11" => "05:00",
    "12" => "05:30",
    "13" => "06:00",
    "14" => "06:30",
    "15" => "07:00",
    "16" => "07:30",
    "17" => "08:00",
    "18" => "08:30",
    "19" => "09:00",
    "20" => "09:30",
    "21" => "10:00",
    "22" => "10:30",
    "23" => "11:00",
    "24" => "11:30",
    "25" => "12:00",
    "26" => "12:30",
    "27" => "13:00",
    "28" => "13:30",
    "29" => "14:00",
    "30" => "14:30",
    "31" => "15:00",
    "32" => "15:30",
    "33" => "16:00",
    "34" => "16:30",
    "35" => "17:00",
    "36" => "17:30",
    "37" => "18:00",
    "38" => "18:30",
    "39" => "19:00",
    "40" => "19:30",
    "41" => "20:00",
    "42" => "20:30",
    "43" => "21:00",
    "44" => "21:30",
    "45" => "22:00",
    "46" => "22:30",
    "47" => "23:00",
    "48" => "23:30",
    "49" => "24:00",
    "50" => "24:30",
);

//questo in beta stampa in ogni pagina i dati passati per $_POST e $_GET
if (BETA) { 
    echo "<pre class='Beta'>--DEBUG BETA--\n</pre>"; 
    echo "<pre class='Beta'>_POST:\n"; print_r($_POST); echo "</pre>"; 
    echo "<pre class='Beta'>_GET:\n"; print_r($_GET); echo "</pre>";
    echo "<pre class='Beta'>_SESSION:\n"; print_r($_SESSION); echo "</pre>";
}
if (BETA2) echo "<pre class='Beta2'>**DEBUG BETA2**\n</pre>";
if (BETA3) echo "<pre class='Beta3'>!!DEBUG BETA3!!\n</pre>";
if (BETA) { echo "<pre class='Beta'>---costanti.php---\n</pre>"; }