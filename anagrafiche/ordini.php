<?php
/**
 * LogiFruit 4 Ital-Frutta sac (2014-2015)
 * 
 * @author Intermediae srl <info@intermediae.it>
 * @version 2.0
 * @package Gestione_Ordini_di_Lavorazione
 */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
session_cache_expire(1);
$cache_expire = session_cache_expire();
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 23 May 2000 01:00:00 GMT"); // Date in the past
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Ordini</title>
    <link href="Style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="jquery/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript" src="js/script2.js"></script>
</head>
<?
include_once("connessione.php"); 
include_once("funzioni.php");
if (BETA2) {
    if (isset($_POST['percorso'])) echo "<pre class='Beta2'>Percorso origine (percorso): <b>".$_POST['percorso']."</b>\n</pre>";
    if (isset($_POST['NumOrdine'])) echo "<pre class='Beta2'>\nNumero Ordine Italfrutta (NumOrdine): <b>".$_POST['NumOrdine']."</b>"
            . " (univoco nel giorno/ma non in assoluto)\n</pre>";
}
if (isset($_POST['percorso'])) {
    $percorso=$_POST['percorso'];
} else { 
    $percorso = 'nuovo'; 
}
?>
<body style="margin: 0">
<? // PERCORSO -- menu del percorso
    define ("POSIZIONE","Ordini");
    define ("COLLEGAMENTO","ordini.php");
?>
    <table style="width: 100%" class="style2">
        <tr>
            <td style="width: 324px"><img src="Risorse/ItalfruttaL2.jpg" /></td>
            <td class="style1"><span class="TestoTitoli">Gestione Ordini di Lavorazione</span><br>BIANCO: Ordine in caricamento non confermato // BLU: Ordine confermato: prendere visione linea<br>ROSSO - In caso di variazione (sblocca PVIS) // GIALLO - Presa visione linea: mettere in lavorazione<br>ARANCIONE - Fatto linea: prendere pesa // VERDE - Preso pesa: associare a trasporto<br>LILLA - Fatto pesa: caricato</td>
	</tr>
        <tr>
            <td colspan="2">
<?php
    include_once 'percorso.php';
?>
            </td>
        </tr>
        <tr>
<?php
include ("OdL-main.php");
?>
        </tr>
    </table>
</body>
</html>
<?
include 'piede.php';
?>