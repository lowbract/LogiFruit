<?php
/**
 * LogiPear 4 Ital-Frutta sac (2014)
 * 
 * @author Intermediae srl <info@intermediae.it>
 * @version 1.0
 * @package Gestione_Ordini
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Ordini</title>
    <link href="Style.css" rel="stylesheet" type="text/css" />
</head>
<?
include_once("costanti.php"); 
include_once("funzioni.php");
if (BETA2) {
    if (isset($_POST['percorso'])) echo "<pre class='Beta2'>Percorso origine (percorso): <b>".$_POST['percorso']."</b>\n</pre>";
    if (isset($_POST['NumOrdine'])) echo "<pre class='Beta2'>\nNumero Ordine Italfrutta (NumOrdine): <b>".$_POST['NumOrdine']."</b> (univoco nel giorno/ma non in assoluto)\n</pre>";
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
            <td class="style1"><span class="TestoTitoli"><img width="200" alt="logo italfrutta" src="./Risorse/logipear_logo.png" />Gestione Ordini</span></td>
	</tr>
        <tr>
            <td colspan="2">
<?php
    include_once 'percorso.php';
?>
            </td>
        </tr>
        <? if ($percorso == 'nuovo') { ?>
        <tr>
            <td colspan="2"><? include("ordini-insert.php"); ?></td>
        </tr> 
        <? } elseif ($percorso == 'insertORDINE' || $percorso == 'datiPRODOTTO') { ?>
	<tr>
            <td colspan="2"><? include("ordini-datiPRODOTTO.php"); ?></td>
	</tr>
        <? } ?>
	<tr>
            <td colspan="2"><? include("ordini-lavorazione.php"); ?></td>
	</tr>
    </table>
</body>
</html>
