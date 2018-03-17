<?php
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
session_cache_expire(1);
$cache_expire = session_cache_expire();
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 23 May 2000 01:00:00 GMT"); // Date in the past
include_once "costanti.php"; 
include_once "funzioni.php";
include_once "connessione.php";
include_once "OdL-funzioni.php";
include_once "OdL-funzioni-operative.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE" />
    <META HTTP-EQUIV="refresh" CONTENT="60" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Ordini</title>
    <link href="StyleOP.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="jquery/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript" src="js/script2.js"></script>
</head>
<?php
    $sodlval = str_pad(dammi_maxSodl($anno, $giornan), 3, "0", STR_PAD_LEFT);
    $dataform = $data;
    if (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && (isset($_POST['btPVIS']) && ($_SESSION['Username'] == 'linea' || $_SESSION['Username'] == 'pleo'))) {
        reset_lampeggia_plus($_POST);        
    } elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && (isset($_POST['btPVIS']) || isset($_POST['btPLIN']) || isset($_POST['btASPE']) || isset($_POST['btCARI']))) {
        reset_lampeggia($_POST);
    }
?>
<table class="tblibera" style="width:100%">
<tr>
    <!-- <th>Seq.</th> -->
    <th>N.Ordine</th>
    <!--<th>F.P.</th>-->
    <th>Cliente</th>
    <!-- <th>S</th> -->
    <th>Prod.</th>
    <th>Pez.</th>
    <th>Lavorazione</th>
    <th>Commenti</th>
    <th>T.Pallet</th>
    <th>Imballo</th>
    <th>Colli</th>
    <th>Stive</th>
    <th>Misura</th>
    <th>Ora Part.</th>
    <!--<th>OP</th>-->
</tr>
<?
if ($sodlval > 1) {
    sodl_operativa($dataform);
}
?>
</table>
<center>ultimo aggiornamento: <?=$datatempo?></center>
    