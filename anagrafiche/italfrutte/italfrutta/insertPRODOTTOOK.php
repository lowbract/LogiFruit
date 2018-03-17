  <?$sqlSP = mysql_query("SELECT ordine.Codice,cliente.NomeCliente FROM ordine,cliente");
    
    while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){
    echo $rigaSP['ordine.Codice'];
    echo $rigaSP['cliente.NomeCliente'];
        }
    ?>		


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
    
    function unixToMySQL($timestamp)
     {
    return date('Y-m-d', $timestamp);
     }
    
     $data= unixToMySQL($timestamp);
     echo $data;
    
    /*** example usage 
     $time = time();
     echo unixToMySQL($time);*/
    
    
    /*----Inserimento in ordine e prodotto------- */
     
    
    if (isset($_POST['Inserimento'])) { 
                 
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
                      
   
 
?>
    
    
<body style="margin: 0">
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
			<tr>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Ordine'];?></td>
                                <td class="TabelleOrdini" rowspan="2"><?echo $_POST['FP'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Cliente'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Prodotto'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Pezzatura'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Lavorazione'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Commento'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Pallet'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Imballo'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Colli'];?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['Stive']; ?></td>
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['OraP'];?></td>
				<td class="TabelleOrdini" width="50" height="26">
				<img alt="Presa in Carico" height="26" src="Arancio.jpg" width="50" /></td>
				<td class="TabelleOrdini" width="50" height="26">
				<img alt="Presa Visione" height="26" src="Arancio-Rosso.jpg" width="50" /></td>
			</tr>
			<tr>
				<td class="TabelleOrdini">
				<img alt="Completato" height="26" src="Giallo.jpg" width="50" /></td>
				<td class="TabelleOrdini">
				<img alt="Associato" height="26" src="Verde.jpg" width="50" /></td>
			</tr>
		</table>
		
		</td>
	</tr>		
	</table>


</body>

</html>

