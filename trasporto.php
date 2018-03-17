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

include_once("connessione.php"); 
include_once("funzioni.php");
include_once("costanti.php");
include_once("OdL-funzioni.php");
include_once("OdL-funzioni-operative.php") ;
include_once("Tra-funzioni.php");

if (isset($_POST['cercagiorno']) && $_POST['cercagiorno']=='Y') {
    $cercanno = date('Y', strtotime($_POST['data']));
    $cercgiornanno = date('z', strtotime($_POST['data']));
    $cercgiornanno = str_pad($cercgiornanno, 3, "0", STR_PAD_LEFT);
    if (BETA) { echo "<pre class='Beta2'>"; echo $cercanno.".".$cercgiornanno; echo "</pre>"; }
    $sodlval = dammi_maxStra($cercanno, $cercgiornanno); // based
    $dataform = $_POST['data'];
    $flagcercagiorno = 1;
} else {
    $sodlval = str_pad(dammi_maxStra($anno, $giornan), 3, "0", STR_PAD_LEFT);
    $dataform = $data;
}
if (isset($_POST['bt']) && $_POST['bt'] == 'N') { // primo insert nuovo S-OdL
    insert_newTra($_POST['valori']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Associazione Trasporto-Ordine</title>
    <link href="Style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="jquery/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript" src="js/script2.js"></script>
</head>

<body style="margin: 0">

<table style="width: 100%" class="style2">
    <tr>
        <td style="width: 324px"><img src="Risorse/ItalfruttaL2.jpg" /></td>
        <td class="style1"><span class="TestoTitoli">Associazione Trasporto-Ordine</span></td>
    </tr>
    <tr>
        <td colspan="2"><?
            define ("POSIZIONE","Associazione Ordine-Trasporto");
            define ("COLLEGAMENTO","trasporto.php");
            include_once ("percorso.php"); ?>
        </td>
    </tr>
</table>
   
<!-- selezione giorno crea oppure crea nuovo trasporto. -->
<table class="style1" style="width:100%">
    <tr>
        <td class="menu">
            <form method="POST"><input type="hidden" name="cercagiorno" value="Y">
                (<?=$datario?>) Data: <input type="date" name="data" value="<?=$dataform?>" class="super">&nbsp;<input type="submit" name="cerca" value="cerca">
            </form>
        </td>
        <td class="menu">
            <form method="POST" action="#mr"><input type="hidden" name="valori[]" value="<?=$sodlval?>" class="super">
                <button type="submit" name="bt" value="N">Nuovo Trasporto</button> <!--  -->
            </form>
        </td>
    </tr>
</table>

<!-- Qui inizia la parte operativa -->
<a name="mr"></a>
<? include ("Tra-main.php"); ?>
</body>
</html>

