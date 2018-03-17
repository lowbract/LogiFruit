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
<?
include("connessione.php");
$sqlSP = mysql_query("SELECT ordine.CodOrd, ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
        prodotto.Commenti, prodotto.Colli, prodotto.Stive, pezzatura.TipoPez, lavorazione.TipoLav, prodotto.Colore,
        ordine.OraPartenza, pallet.TipoPallet,imballo.TipoImballo, prodotto.CodProd, prodotto.Cancellazione 
      FROM ordine,cliente,nomeprod,prodotto,pezzatura,lavorazione,pallet,imballo
        WHERE ordine.CodCliente=cliente.codCliente
            AND prodotto.CodOrd=ordine.CodOrd
            AND prodotto.CodNP=nomeprod.CodNP
            AND prodotto.CodPez=pezzatura.CodPez 
            AND prodotto.CodLav=lavorazione.CodLav
            AND prodotto.CodPallet=pallet.CodPallet 
            AND prodotto.CodImb=imballo.CodImb  
            AND prodotto.Cancellazione < 001
            AND ordine.Assoc < 1
            AND ordine.data BETWEEN '$ieri' AND '$data'
        ORDER BY ordine.OraPartenza,ordine.Codice DESC");?>
<table style="width: 100%" class="style2">
	<tr>
		<td colspan="2" class="style1"><span class="TestoTitoli">Tabella ordini lavorazione</span></td>
	</tr>
	<tr>
		<td colspan="2">		
                <table cellspacing="1" class="TabelleOrdini" style="width: 100%">
			<tr class="TestoPiccolo">
				<td class="TabelleOrdini">N. Ordine</td>
                                <td class="TabelleOrdini">F.P.</td>
				<td class="TabelleOrdini">Cliente</td>
				<td class="TabelleOrdini">Prodotto</td>
				<td class="TabelleOrdini">Pez.</td>
				<td class="TabelleOrdini">Lavorazione</td>
				<td class="TabelleOrdini">Commenti</td>
				<td class="TabelleOrdini">T. Pallet</td>
				<td class="TabelleOrdini">Imballo</td>
				<td class="TabelleOrdini">Colli</td>
				<td class="TabelleOrdini">Stive</td>
				<td class="TabelleOrdini">Ora Part.</td>
			</tr>
                        <? while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){   ?> 
                        <tr class="<?=$rigaSP['Colore']?>" >
                                <td class="TabelleOrdini">
                                    <font size="6"><b>
                                    <a href="trasporto.php?coditalf=<?=$rigaSP['CodOrd']?>">
                                        <?echo $rigaSP['Codice'];?>
                                    </a>
                                    </b></font>
                                </td>
				<td class="TabelleOrdini"><?echo $rigaSP['FP'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['NomeCliente'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['NomeProd'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['TipoPez'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['TipoLav'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['Commenti'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['TipoPallet'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['TipoImballo'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['Colli'];?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['Stive']; ?></td>
				<td class="TabelleOrdini"><?echo $rigaSP['OraPartenza'];?></td>
			</tr>
                           <?}?>
		</table>
		
		</td>
	</tr>		
	</table>
