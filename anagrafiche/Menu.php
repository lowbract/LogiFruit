<?php
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
session_cache_expire(1);
$cache_expire = session_cache_expire();
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 23 May 2000 01:00:00 GMT"); // Date in the past
include_once("costanti.php"); 
include_once("funzioni.php");

// QUI INTECETTO I MONITOR!!!
if (isset($_SESSION['Username']) && (
        $_SESSION['Username'] == 'pmelo' 
        || $_SESSION['Username'] == 'pcoco'
        || $_SESSION['Username'] == 'linea'
        || $_SESSION['Username'] == 'pleo')){
    header("location: OdL-operativa.php");
} elseif (isset($_SESSION['Username'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>ItalFrutta - LogiFruit - Menù principale</title>
<base target="_self">
<style type="text/css">
.style1 {
	text-align: center;
}
.TestoTitoli {
	font-family: Calibri;
	font-size: x-large;
	font-style: italic;
	font-weight: bold;
	font-variant: small-caps;
}
.Testo {
	font-family: Calibri;
	font-size: large;
	font-weight: bold;
	font-style: italic;
}
.style2 {
	border-collapse: collapse;
	border: 1px solid #000000;
}
.Menu {
	font-family: Calibri;
        /* text-align: center; */
}</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>
<body style="margin: 1px">
<? // PERCORSO -- menu del percorso
define ("POSIZIONE","Menu Principale");
define ("COLLEGAMENTO","Menu.php");
?>
<table style="width: 100%" class="style2">
	<tr>
		<td style="width: 324px"><img alt="logo italfrutta" src="./Risorse/ItalfruttaL2.jpg" /></td>
                <td class="style1"><span class="TestoTitoliGrande"><img width="200" alt="logo italfrutta" src="./Risorse/logo-logifruit-2.png" />Menu</span></td>
	</tr>
    <tr>
        <td colspan="2">
            <?php
                include_once 'percorso.php';
            ?>
        </td>
    </tr>	
        <tr>
            <td colspan="2" class="FondoImmagine">
                <br>
                <ul id=”nomeID” class="Menu">
                    <li>Gestione
                        <ul>
                            <li><a href="ordini.php">Gestione Ordine di Lavoro</a></li>
                            <li><a href="trasporto.php" accesskey="x">Associazione Trasporto ad Ordine di Lavoro <span style="color: red">(IN COSTRUZIONE)</span></a></li>
                            <!-- <li><a href="cancellazione.php">Cancellazione Prodotto da Ordine</a></li> -->
                            <!--
                            <li><a href="ricercaxdata.php">Ricerca per DATA</a></li>
                            <li><a href="modificaprodotto.php">Modifica Prodotto</a></li>
                            -->
                        </ul>
                    </li> </br>
                <li><a href="frame.php">Visualizzazione STATO ORDINI</a> <span style="color: #33CC33">NUOVO</span></li> 
                <li><a href="trasportoconbottone.php">Visualizzazione STATO TRASPORTO</a> </li> 
                <br></br>
                <li>Anagrafica
                    <ul> 
                    <li><a href="InserisciCliente.php">Cliente</a></li>
                    <li><a href="InserisciSP.php">Prodotto</a></li>
                    <li><a href="InserisciLavorazione.php">Lavorazione</a></li>
                    <li><a href="InserisciPezzatura.php">Pezzatura</a></li>
                    <li><a href="InserisciImballo.php">Imballo</a></li>
                    <li><a href="InserisciPallet.php">Pallet</a></li>
                    <li><a href="InserisciVettore.php">Vettore</a></li>
                    <li><a href="InserisciAutista.php">Autista</a></li>
                    </ul>
                </li>
                </ul>
            </td>
	</tr>		
    </table>

<?
include 'piede.php';
}
?>
</body>
</html>