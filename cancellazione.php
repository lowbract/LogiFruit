<html>
<title>Cancellazione Prodotto</title>
<?
    include_once("costanti.php"); 
?>
    <body style="margin: 0">
<style type="text/css">
.style1 {
	text-align: center;
}
.style3 {
	font-family: Calibri;
	font-size: x-large;
	font-style: italic;
	font-weight: bold;
	font-variant: small-caps;
	text-align: center;
}
</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
<? // PERCORSO -- menu del percorso
define ("POSIZIONE","Cancellazione");
define ("COLLEGAMENTO","cancellazione.php");
include_once 'percorso.php'; ?>
<table style="width: 100%">
	<tr>
		<td style="width: 324px; height: 123px;"><img src="Risorse/ItalfruttaL2.jpg" /></td>
		<td class="style1" style="height: 123px" colspan="2"><span class="TestoTitoli">ItalFrutta <br/>Cancellazione</span></td>
	</tr>
</table>
<?
 include("connessione.php");
 
if (isset($_POST['cancellazione']))
    {
    if (isset($_POST['CodProd_Canc'])) $CancProd=$_POST['CodProd_Canc'];
    $sqlCanc="UPDATE prodotto SET Cancellazione=1 WHERE CodProd=$CancProd";
    $sqlCancEsec=mysql_query($sqlCanc);
    }    
if (isset($_GET['idProdotto']))
{
    $prodid=$_GET['idProdotto'];
    $selectCP="SELECT ordine.CodOrd, ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
        prodotto.Commenti, prodotto.Colli, prodotto.Stive, pezzatura.TipoPez, lavorazione.TipoLav, prodotto.Colore,
        ordine.OraPartenza, pallet.TipoPallet,imballo.TipoImballo, prodotto.CodProd, prodotto.Cancellazione 
      FROM ordine,cliente,nomeprod,prodotto,pezzatura,lavorazione,pallet,imballo
        WHERE ordine.CodCliente=cliente.codCliente
            AND prodotto.CodProd=$prodid
            AND prodotto.CodOrd=ordine.CodOrd
            AND prodotto.CodNP=nomeprod.CodNP
            AND prodotto.CodPez=pezzatura.CodPez 
            AND prodotto.CodLav=lavorazione.CodLav
            AND prodotto.CodPallet=pallet.CodPallet 
            AND prodotto.CodImb=imballo.CodImb";
    $sqlCP = mysql_query($selectCP);
    $rigaCP =  mysql_fetch_array($sqlCP,MYSQL_ASSOC);?>
<br>  <br>
     <table cellspacing="1" class="TabelleOrdini" style="width: 100%"> 
        <tr class="<?=$rigaCP['Colore']?>" >
                <td class="TabelleOrdini"><?echo $rigaCP['Codice'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['FP'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['NomeCliente'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['NomeProd'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['TipoPez'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['TipoLav'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['Commenti'];?></td>
                <td class="TabelleOrdini"><?echo $rigaCP['TipoPallet'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['TipoImballo'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['Colli'];?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['Stive']; ?></td>
		<td class="TabelleOrdini"><?echo $rigaCP['OraPartenza'];?></td>
	</tr>
      </table>      
<?$prodCanc=$rigaCP['CodProd'];?>
<br>
<form method="POST" action="cancellazione.php">
    <input name="CodProd_Canc" type="hidden" value="<?=$prodCanc?>"/>
    <input name="cancellazione" type="Submit" value="Conferma Cancellazione" />
</form>
<?
}
include("cancellazionevisualtabella.php");
?>



