<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Ordini</title>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>
<?
include_once("costanti.php"); 
if (BETA) {
    echo "<pre>"; print_r($_POST); echo "</pre>";
    echo "<pre>Percorso origine (percorso): <b>".$_POST['percorso']."</b>\n</pre>";
    echo "<pre>\nNumero Ordine Italfrutta (NumOrdine): <b>".$_POST['NumOrdine']."</b> (univoco nel giorno/ma non in assoluto)\n</pre>";
}
    if (isset($_POST['percorso'])) {
        $percorso=$_POST['percorso'];
    } else { 
        $percorso = 'nuovo'; 
    }
?>
<body style="margin: 0">
<table style="width: 100%" class="style2">
	<tr>
		<td style="width: 324px"><img src="Risorse/ItalfruttaL2.jpg" /></td>
		<td class="style1"><span class="TestoTitoli">ItalFrutta - tabella ordini</span></td>
	</tr>
	<tr>
		<td colspan="2"></td>
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
