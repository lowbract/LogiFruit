<?php
/** 
 * Funzioni utili
 */
/**
 * Restituisce le stringhe passate taggate da <pre> per una corretta comprensione 
 */
function preBeta ($varStampa){
    if (BETA2) {
        echo "\n<br><pre class='Beta2'>";
        print_r($varStampa);
        echo "</pre>";
    }
}
/**
 * funzione per calcolare le stive per ogni ordine
 */
function sommastive($dammiCodOrd){
    $istruzioneF = "SELECT SUM(Stive) FROM prodotto WHERE CodOrd = ".$dammiCodOrd;
    if (BETA2) echo "<pre>$istruzioneF</pre>\n";
    $risultatoF = mysql_query($istruzioneF);
    if (BETA2) echo "<pre>$risultatoF</pre>\n";
    $datiF = mysql_fetch_row($risultatoF);
    if (BETA2) { echo "<pre>"; print_r($datiF); echo "</pre>\n"; }
    return  $datiF[0];
}
/**
 * funzione per verificare l'esistenza di un ordine Italfrutta
 * prima verifica se esiste il solo Numero Ordine Italfrutta, poi gli altri requisiti
 * @param string interger
 * @return integer
 */
function verificaSeEsiste ($numOI, $oraPartenzaOI, $francoPartenzaOI, $idClienteOI){
    $oggi = date('Y-m-d');
    $ieri = date('Y-m-d',strtotime("-1 days"));
    if (BETA2) echo "<pre class='Beta2'>$ieri\n$oggi</pre>";
    $sqlSelect = "SELECT Codice FROM ordine WHERE Codice = {$numOI} AND data BETWEEN '{$ieri}' AND '{$oggi}'"; 
    preBeta($sqlSelect);
    $sqlVerOI = mysql_query($sqlSelect) or mysql_error();
    $nRowsOI_s1 = mysql_num_rows($sqlVerOI);
    preBeta("SELECT1: ".$nRowsOI_s1);
    if (!$nRowsOI_s1) {
        preBeta("BOO1:OK"); $booSeEsiste = 1; return $booSeEsiste;
    } else {
        $sqlSelect2 = "SELECT Codice, FP, data, OraPartenza FROM ordine WHERE Codice = {$numOI} AND FP = '{$francoPartenzaOI}' AND OraPartenza = '{$oraPartenzaOI}' AND data BETWEEN '{$ieri}' AND '{$oggi}'";
        preBeta($sqlSelect2);
        $sqlVerOI2 = mysql_query($sqlSelect2) or mysql_error();
        $nRowsOI_s2 = mysql_num_rows($sqlVerOI2);
        preBeta("SELECT2: ".$nRowsOI_s2);
        ($nRowsOI_s1 && $nRowsOI_s2)==1 ? $logicoVerifica=1 : $logicoVerifica=0; //comparazione logica, se sono verificate entrambe le condizioni è ok altrimenti no.
        preBeta("OP LOGICO: ".$logicoVerifica);
        if ($logicoVerifica) { preBeta("BOO2:OK"); $booSeEsiste = 2; return $booSeEsiste; } else { preBeta("BOO2:NOK"); $booSeEsiste = 0; return $booSeEsiste; }
    }
}
/**
 * funzione che stampa errori del programma con uno style predefinito
 * @param stringa
 */
function stampaErrore($varStampa){
    echo "Keep in mind, here you must print the error message, fuckin dumbass!";
}


?>
