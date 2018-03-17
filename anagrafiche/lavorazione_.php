<h1>(3) ordini-lavorazione.php</h1>
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

}
.TabelleOrdini {
	border-left: 1px solid #C0C0C0;
	border-right-style: solid;
	border-right-width: 1px;
	border-top: 1px solid #C0C0C0;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
.TitoliTab {
	font-family: Calibri;
	font-size: medium;
	font-weight: bold;
	font-style: italic;
	text-decoration: underline;
	text-align: center;
	font-variant: small-caps;
}
</style>
<?php
include("connessione.php");  
if (isset($_POST['NumOrdine'])) { $NumOrdine=$_POST['NumOrdine'];   if (BETA) echo "\nNumOrdine: $NumOrdine<br>";} //NumOrdine è il numero di ordine creato da operatori italfrutta non l'id univoco
if (isset($_POST['FP'])) { $FP=$_POST['FP'];                        if (BETA) echo "\nFP: $FP";}
if (isset($_POST['Cliente'])) $CodCliente=$_POST['Cliente']; 
if (isset($_POST['Prodotto'])) $Prodotto=$_POST['Prodotto'];
if (isset($_POST['Pezzatura'])) $Pezzatura=$_POST['Pezzatura'];
if (isset($_POST['Lavorazione'])) $Lavorazione= $_POST['Lavorazione'];
if (isset($_POST['Commento'])) $Commento=$_POST['Commento'];
if (isset($_POST['Pallet'])) $Pallet=$_POST['Pallet'];
if (isset($_POST['Imballo'])) $Imballo=$_POST['Imballo'];
if (isset($_POST['Colli'])) $Colli=$_POST['Colli'];
if (isset($_POST['Stive'])) $Stive=$_POST['Stive'];
if (isset($_POST['OraP'])) $OraP=$_POST['OraP'];
$FondoRiga= 'TabelleOrdini';
$data= date("Y-m-d");
/*----modifica colore prodotto------- */  
// le righe prodotto variano autonomamente colori, i colori dei prodotti di un ordine sono diversi fino a diventare
// tutti verdi.
$IDProd=$rigaSP['CodProd'];
if (isset($_POST['bottone']) && ($IDProd == $_POST['IDRiga'])) {
    $colore= $_POST['bottone'];
    $sqlColore=mysql_query("UPDATE prodotto SET Colore='$colore' WHERE CodProd=$IDProd");   
};
/*----Inserimento in ordine e prodotto------- */    
if (isset($_POST['Inserimento'])) { 
    /*
     * la SELECT seguente serve a verificare se l'ordine con stesso 'Codice' 'data' e 'OraPartenza' esiste, se esiste prende CodOrd come id
     * e lo utilizzerà per fare l'INSERT nella tabella 'prodotto' CodOrd<->CodOrd 
     */
    $sqlOrd = mysql_query("SELECT ordine.CodOrd, ordine.Codice, ordine.data, ordine.OraPartenza FROM ordine WHERE ordine.Codice = '$NumOrdine'");
    $i = 0; if (BETA) echo "<pre>\nimposto indice: $i\n</pre>";
    while ($rigaOrd =  mysql_fetch_array($sqlOrd,MYSQL_ASSOC)){  
        // in questo ciclo verifico che vi sia l'occorenza dell'ordine che si sta andando ad inserire, se vi è allora non lo creo, altrimenti si.
        if (BETA) { 
            echo "<pre>"; print_r($rigaOrd); echo "</pre><br>";
            if ($rigaOrd['Codice']==$NumOrdine) echo "NumOrdine TROVATO<br>\n";
            if ($rigaOrd['OraPartenza']==$OraP) echo "OraP TROVATO<br>\n";
            if ($rigaOrd['data']==$data)        echo "data TROVATO<br>\n";
        }
        $ieri = mktime(0, 0, 0, date("Y"), date("m"), date("d")-1);
        if ($rigaOrd['Codice']==$NumOrdine && $rigaOrd['OraPartenza']==$OraP && $rigaOrd['data']==$data) $i=1;
        if ($rigaOrd['Codice']==$NumOrdine && $rigaOrd['OraPartenza']==$OraP && $rigaOrd['data']==$ieri) $i=2;
        if (BETA) echo "indice: $i<br>\n";
    }
    if ($i==1) {
        if (BETA) echo "<pre>Ordine esistente - Inserisco Prodotto</pre>";
        $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$rigaOrd[CodOrd], Colore='$FondoRiga'"; 
        $queryProd = mysql_query($insertProdotto);
        if (BETA) echo "<pre>$insertProdotto\n</pre>";
        // break;
    } elseif ($i==0) {
        if (BETA) echo "<pre>Ordine non esistente - Inserisco Ordine e Prodotto</pre>";
        $insertOrdine = "INSERT ordine SET Codice=$NumOrdine, FP='$FP', data='$data', OraPartenza='$OraP', CodCliente=$CodCliente";
        if (BETA) echo "<pre>$insertOrdine\n</pre>";
        $queryOrd = mysql_query($insertOrdine);
        //echo $queryOrd;
        $idOrd= mysql_insert_id();
        $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$idOrd, Colore='$FondoRiga'";
        $queryProd = mysql_query($insertProdotto);
        if (BETA) echo "<pre>$queryProd\n</pre>";
        // break;*/
    }
    $sqlSP = mysql_query("SELECT DISTINCT ordine.CodOrd, ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
        prodotto.Commenti, prodotto.Colli, prodotto.Stive, pezzatura.TipoPez, lavorazione.TipoLav, 
        ordine.OraPartenza, pallet.TipoPallet,imballo.TipoImballo, prodotto.Colore, prodotto.CodProd  
      FROM ordine,cliente,nomeprod,prodotto,pezzatura,lavorazione,pallet,imballo
        WHERE ordine.CodCliente=cliente.codCliente
            AND prodotto.CodOrd=ordine.CodOrd
            AND prodotto.CodNP=nomeprod.CodNP
            AND prodotto.CodPez=pezzatura.CodPez 
            AND prodotto.CodLav=lavorazione.CodLav
            AND prodotto.CodPallet=pallet.CodPallet 
            AND prodotto.CodImb=imballo.CodImb    
            AND prodotto.Cancellazione < 001
        ORDER BY ordine.OraPartenza,ordine.Codice DESC"); 
?>
<br><br><br><br>
<table style="width: 100%" class="style2">
	<tr>
		<td style="width: 324px">&nbsp;</td>
		<td class="style1"><span class="TestoTitoli">ItalFrutta - tabella ordini 
		lavorazione</span></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td> 
	</tr>
	<tr>
		<td colspan="2">		
                <table cellspacing="1" class="TabelleOrdini" style="width: 100%">
			<tr class="TestoPiccolo">
                                <?php if (BETA) {
                                    echo "<td class=\"TabelleOrdini\">CodOrd</td>";
                                    echo "<td class=\"TabelleOrdini\">CodProd</td>";
                                }?>
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
				<td class="TabelleOrdini" colspan="2">Stato</td>
			</tr>
                        <?php
                        while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){ 
                        ?>
                        <form method='post'>
                            <input type="hidden" name="percorso" value="datiOrdine">
                        <tr class="<?php echo $rigaSP['Colore']; ?>" >
                                <?php if (BETA) {
                                    echo "<td class=\"TabelleOrdini\" rowspan=\"2\">CodOrd</td>";
                                    echo "<td class=\"TabelleOrdini\" rowspan=\"2\">CodProd</td>";
                                }?>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['Codice']; ?></td>
                                <td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['FP']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['NomeCliente']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['NomeProd']; echo $rigaSP['CodProd']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['TipoPez']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['TipoLav']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['Commenti']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['TipoPallet']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['TipoImballo']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['Colli']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['Stive']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?php echo $rigaSP['OraPartenza']; ?></td>
				<td class="TabelleOrdini" width="50" height="26">
                                  <input name="IDRiga" type="hidden" value='<?php echo $IDProd; ?>'> 
                                <button type=”button” name="bottone" value='FondoArancio'>
                                    <img alt="Presa in Carico" height="26" src="Arancio.jpg" width="50" />
                                </button>   
				</td>
				<td class="TabelleOrdini" width="50" height="26">
                                    
                                 <button type=”button” name="bottone" value='FondoArancio'>    
				<img alt="Presa Visione" height="26" src="Arancio-Rosso.jpg" width="50" />
                                </button>   
                                </td>
			</tr>
			<tr>
				<td class="TabelleOrdini">
                                <button type=”button” name="bottone" value='FondoGiallo'>        
				<img alt="Completato" height="26" src="Giallo.jpg" width="50" />
                                </button>   
                                </td>
				<td class="TabelleOrdini">
                                 <button type=”button” name="bottone" value='FondoVerde'>     
				<img alt="Associato" height="26" src="Verde.jpg" width="50" />
                                  </button>   
                                 </td>
                        </tr></form>
                <?php } ?>
		</table>
		</td>
	</tr>
</table>
<?php } ?>
