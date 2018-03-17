<html>
		
<head>
<title>Inserimento Prodotto</title>
<link href="Style.css" rel="stylesheet" type="text/css">
</head>

<body>



<?php

/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","epass1+")or die("Connessione non riuscita: ".mysql_error());
 //echo ("Connesso con successo");
mysql_select_db("italfrutta", $db) or die("Errore nella selezione del database"); 



if (isset($_POST['insertProdotto'])){
    echo ("N. Ordine:");
    echo $_POST['ordine'];
    echo ("<br> CodCliente:");
    echo $_POST['Cliente']; 
    echo ("<br> Prodotto:");
    echo $_POST['Prodotto'];
    echo ("<br> Pezzatura:");
    echo $_POST['Pezzatura'];
    echo ("<br> Lavorazione:");
    echo $_POST['Lavorazione'];
    echo ("<br> Commento:");
    echo $_POST['Commento'];
    echo ("<br> Pallet:");
    echo $_POST['Pallet'];
    echo ("<br> Imballo:");
    echo $_POST['Imballo'];
    echo ("<br> Colli:");
    echo $_POST['Colli'];
    echo ("<br> Stive:");
    echo $_POST['Stive'];    
    echo "<br>Orario:";
    echo $_POST['OraP'];   
    echo "<br>time()";
    
    $CodOrdine=$_POST['ordine'];
    $CodCliente=$_POST['cliente']; 
    $Prodotto=$_POST['Prodotto'];
    $Pezzatura=$_POST['Pezzatura'];
    $Lavorazione= $_POST['Lavorazione'];
    $Commento=$_POST['Commento'];
    $Pallet=$_POST['Pallet'];
    $Imballo=$_POST['Imballo'];
    $Colli=$_POST['Colli'];
    $Stive=$_POST['Stive'];
    $OraP=$_POST['OraP'];
     }

    
    
    function unixToMySQL($timestamp)
     {
    return date('Y-m-d', $timestamp);
     }


     /*** example usage 
     $time = time();
     echo unixToMySQL($time);*/
     
 ?>    

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
				<td class="TabelleOrdini" rowspan="2"><?echo $_POST['ordine'];?></td>
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
    
<?    
 /*  

    $insertOrd= "INSERT INTO `ordine`(`CodOrd`, `Commenti`, `data`, `OraPartenza`, `CodCliente`) VALUES ($CodOrdine, $Commento,$data, $OraP, $CodCliente)";
    $insertProd= "INSERT INTO `prodotto`(`NomeProd`, `Colli`, `Stive`, `CodLav`, `CodPez`, `CodImb`, `CodPallet`, `CodOrd`) VALUES ($Prodotto, $Colli, $Stive, $Lavorazione,$Pezzatura,$Imballo,$Pallet, $CodOrdine)";
    
  /*$inser = "INSERT INTO prodotto (NomeCliente) VALUES ('$DatoForm')";

            if (isset($_POST['Button1'])) { 
                echo("<br>isset su inserisci ok!");
                 //$query = mysql_query($insertProd);
                 echo ("<br>Risultato query= ".$query);
                 //if($query) 
                   echo("<br>Inserimento riuscito"); 
                 else
                 echo("<br>Inserimento fallito"); }     

    }
*/   
?>
