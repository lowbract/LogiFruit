<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- *Mancano tutti i controlli sulle date
     *Manca la SELECT COUNT per avere la somma del numero di stive dello stesso ordine (più prodotti ogniuno con la sua stiva)
     *?Bisogna fare un controllo per cui se ho un prodotto ancora pronto non posso mettere a "VERDE" il trasporto?
-->
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>ItalFrutta - Modulo Anagrafica</title>
<style type="text/css">
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

.style3 {
	border-right-width: 0;
	border-bottom-width: 0;
	border-left-color: #C0C0C0;
	border-left-width: 0;
	border-top-color: #C0C0C0;
	border-top-width: 0;
}

</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>
<body style="margin: 0">
<?php
//--------------INSERT IN traporto e UPDATE SU prodotto-----------
include("connessione.php");  
if (isset($_POST['Ordine'])) $CodOrdine=$_POST['NumOrdine'];
if (isset($_POST['Cliente'])) $CodCliente=$_POST['Cliente']; 
if (isset($_POST['Vettore'])) $Vettore=$_POST['Vettore'];
if (isset($_POST['Portata'])) $Portata=$_POST['Portata'];
if (isset($_POST['Autista'])) $Autista= $_POST['Autista'];
if (isset($_POST['Note'])) $Note=$_POST['Note'];
if (isset($_POST['Arrivato'])) $Arriv=$_POST['Arrivato'];
if (isset($_POST['Cronologia'])) $Cron=$_POST['Cronologia'];
$FondoRiga= 'TabelleOrdini';
$data= date("Y-m-d");
/*
*echo "Codice Ordine: " . $CodOrdine . "<br>";
*echo "Codice Cliente: " . $CodCliente . "<br>";
*echo "Codice Vettore: " . $Vettore . "<br>";
*echo "Codice Portata: " . $Portata . "<br>";
*echo "Codice Autista: " . $Autista . "<br>";
*echo "Codice Note: " . $Note . "<br>";
*echo "Codice Arrivato: " . $Arriv . "<br>";
*echo "Codice Cronologia: " . $Cron . "<br>";
*/
$misure=$_POST['Misura'];
$CodOrdini=$_POST['IdOrd'];
$CodProdotti=$_POST['IdProd'];
$i=0;
foreach ($misure as $misura){
    $prodotto=$CodProdotti[$i++];
    echo "<br>";
    echo $misura;  
    echo "<br>";
    echo $prodotto; 
    $sqlupdateprodmis="UPDATE prodotto SET Misura='$misura' WHERE CodProd=$prodotto";
    echo "sqlupdateproddotto: ".$sqlupdateprodmis. "<br>";
    $queryprodmis=mysql_query($sqlupdateprodmis);
    echo "<br>risultato query: ".$queryprodmis . "<br>";    
}
    echo "<br>Codice Ordine" . $CodOrdini. "<br>";
    $sqlinsertTrasp = "
        INSERT trasporto 
        SET CodVett=$Vettore, CodAut=$Autista, CodOrd=$CodOrdini,
            Note='$Note', Arrivato='$Arriv', 
            Cronologia='$Cron', Portata='$Portata', Colore='$FondoRiga'"; 
    
    //Settaggio della variabile per identificare che l'ordine è stato associato
    $sqlassord = "UPDATE ordine SET Assoc=1 WHERE CodOrd=$CodOrdini";
    echo "<br>sql insert trasp: ". $sqlinsertTrasp ."<br>";
    $queryTrasporto = mysql_query($sqlinsertTrasp);
    $queryAssocOrd = mysql_query($sqlassord);    
    echo "<br>Risultato query TRASPORTO: ". $queryTrasporto;
    if(BETA && $queryTrasporto) 
        echo "<br>Dato Inserimento Correttamente"; 
    else
        echo "<br>Inserimento fallito";
?>
</body>
</html> 