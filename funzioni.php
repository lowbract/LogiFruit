<?php
/** 
 * Funzioni utili
 */
/**
 * Restituisce le stringhe passate taggate da <pre> per una corretta comprensione 
 */
if (BETA) { echo "<pre class='Beta'>---funzioni.php---\n</pre>"; }
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

function dammiCliente ($Fidclie) {
    $pdo3 = connetti();
    $sql3 = "SELECT NomeCliente AS nclie FROM cliente WHERE CodCliente = \"{$Fidclie}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiCliente</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiCliente</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['nclie']) {
        $valore = $list[0]['nclie'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiProdotto ($Fidprod) {
    $pdo3 = connetti();
    $sql3 = "SELECT NomeProd AS nprod FROM nomeprod WHERE CodNP = \"{$Fidprod}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiProdotto</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiProdotto</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['nprod']) {
        $valore = $list[0]['nprod'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiPezzatura ($Fid) {
    $pdo3 = connetti();
    $sql3 = "SELECT TipoPez AS npez FROM pezzatura WHERE CodPez = {$Fid}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiPezzatura</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiPezzatura</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['npez']) {
        $valore = $list[0]['npez'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiLavorazione ($Fid) {
    $pdo3 = connetti();
    $sql3 = "SELECT TipoLav AS nlav FROM lavorazione WHERE CodLav = {$Fid}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiLavorazione</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiLavorazione</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['nlav']) {
        $valore = $list[0]['nlav'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiPallet ($Fid) {
    $pdo3 = connetti();
    $sql3 = "SELECT TipoPallet AS ntpa FROM pallet WHERE CodPallet = {$Fid}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiPallet</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiPallet</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['ntpa']) {
        $valore = $list[0]['ntpa'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiImballo ($Fid) {
    $pdo3 = connetti();
    $sql3 = "SELECT TipoImballo AS nimba FROM imballo WHERE CodImb = \"{$Fid}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiImballo</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiImballo</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['nimba']) {
        $valore = $list[0]['nimba'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiVettore ($Fidvett) {
    $pdo3 = connetti();
    $sql3 = "SELECT NomeVettore AS nvett FROM vettore WHERE CodVett = \"{$Fidvett}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiVettore</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiVettore</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['nvett']) {
        $valore = $list[0]['nvett'];
        return $valore;        
    } else {
        return "";
    }
}
function dammiAutista ($Fidauti) {
    $pdo3 = connetti();
    $sql3 = "SELECT Nome, Cognome, Telefono1, Telefono2 FROM autista WHERE CodAut = \"{$Fidauti}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiAutista</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiAutista</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['Nome']) {
        $valore = $list[0];
        return $valore;        
    } else {
        return "";
    }
}
function dammiTrasporto ($Fidauti) { // da finire
    $pdo3 = connetti();
    $sql3 = "SELECT Nome, Cognome, Telefono1, Telefono2 FROM autista WHERE CodAut = \"{$Fidauti}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b>SQL: dammiAutista</b><br>\n"; print_r($sql3); echo "</pre>"; }
    $query3 = $pdo3->prepare($sql3);
    $query3->execute();
    $list = $query3->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammiAutista</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['Nome']) {
        $valore = $list[0];
        return $valore;        
    } else {
        return "";
    }
}