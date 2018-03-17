<html>
		
<head>
<title>Inserimento Prodotto</title>
<link href="Style.css" rel="stylesheet" type="text/css">
</head>

<body>

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
	ul: ;
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
</head>

<?php

include("connessione.php");  
    
    if (isset($_POST['Ordine'])) $CodOrdine=$_POST['Ordine'];
    if (isset($_POST['FP'])) $FP=$_POST['FP'];
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
    
    
    function unixToMySQL($timestamp)
     {
    return date('Y-m-d', $timestamp);
     }
    
     $data= unixToMySQL($timestamp);
     echo $data;
    
    
    /*----Inserimento in ordine e prodotto------- */
     
    
    if (isset($_POST['Inserimento'])) { 
         $sqlOrd = mysql_query("SELECT ordine.CodOrd, ordine.Codice, ordine.data From ordine");
            while ($rigaOrd =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){ 
                if ($CodOrdine=$rigaOrd[Codice] && ($data=$rigaOrd[data]))
                {
                    $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$rigaOrd"; 
                    
                    $queryProd = mysql_query($insertProdotto);
                    echo ("<br>Risultato query PRODOTTO= ".$queryProd);
                     if($queryProd) 
                        echo("<br>Dato Inserimento Correttamente"); 
                        else
                        echo("<br>Inserimento fallito");                     
                }
                        
            else{
                 $insertOrdine = "INSERT ordine SET Codice=$CodOrdine, Commenti='$Commento', FP='$FP', data='$data', OraPartenza='$OraP', CodCliente=$CodCliente";
                 $queryOrd = mysql_query($insertOrdine);
                 echo ("<br>Risultato query ORDINE= ".$queryOrd);
                 if($queryOrd) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); 
                 
                 $idOrd= mysql_insert_id();
                 echo "<br>". $idOrd;
                 
                 $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$idOrd";
                  
                 $queryProd = mysql_query($insertProdotto);
                   echo ("<br>Risultato query PRODOTTO= ".$queryProd);
                 if($queryProd) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito");
                 }
                
                }
                
                } 
    $sqlSP = mysql_query("SELECT ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
        ordine.Commenti, prodotto.Colli, prodotto.Stive, pezzatura.TipoPez, lavorazione.TipoLav, 
        ordine.OraPartenza, pallet.TipoPallet,imballo.TipoImballo, prodotto.Colore, prodotto.CodProd  
      FROM ordine,cliente,nomeprod,prodotto,pezzatura,lavorazione,pallet,imballo
        WHERE ordine.CodCliente=cliente.codCliente
            AND prodotto.CodNP=nomeprod.CodNP
            AND prodotto.CodPez=pezzatura.CodPez 
            AND prodotto.CodLav=lavorazione.CodLav
            AND prodotto.CodPallet=pallet.CodPallet 
            AND prodotto.CodImb=imballo.CodImb         
        ORDER BY ordine.OraPartenza,ordine.Codice DESC");
 
?>
    
    
<body style="margin: 0">
<br><br><br><br>
 <?/* while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){ 
    print_r($rigaSP);
    echo "<br>";
 }*/?>

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
                        
                        <? while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){ 
                        
                         $IDProd=$rigaSP['CodProd'];
                         
                        
                        if (isset($_POST['bottone']) && $IDProd == $_POST['IDRiga']) {
                            $colore= $_POST['bottone'];
                         } else $colore = "TabellaOrdini"; ?>

			
                        <form method='post'>
                        
                        <tr class="<?=$colore?>" >
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['Codice']; ?></td>
                                <td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['FP'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['NomeCliente'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['NomeProd'];
                                                                          echo $rigaSP['CodProd'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['TipoPez'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['TipoLav'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['Commenti'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['TipoPallet'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['TipoImballo'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['Colli'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['Stive']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $rigaSP['OraPartenza'];?></td>
				<td class="TabelleOrdini" width="50" height="26">
                                  <input name="IDRiga" type="hidden" value='<?=$IDProd?>'>
                                  
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

                            <?}?>
		</table>
		
		</td>
	</tr>		
	</table>


</body>

</html>

