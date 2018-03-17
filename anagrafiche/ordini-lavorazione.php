<?php
/**
 * LogiFruit 4 Ital-Frutta sac (2014)
 * 
 * @author Intermediae srl <info@intermediae.it>
 * @version 1.0
 * @package Gestione_Ordini-lavorazione
 */

session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Ital-Frutta sac - Login</title>
<style type="text/css">
.style4 {
	border: 1px solid #000000;
	font-family: Calibri;
		font-size: large;
		font-weight: bold;
		font-style: italic;
		text-align: center;
}
.style5 {
	border: 1px solid #000000;
}
.style6 {
	text-align: center;
	border-collapse: collapse;
	border: 1px solid #000000;
}
</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>

<pre>
<b>LAVORAZIONE:</b>
visualizza lo stato delle lavorazioni di oggi 
</pre>
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
if (isset($_POST['NumOrdine'])) { $NumOrdine=$_POST['NumOrdine'];   if (BETA2) echo "\nNumOrdine: $NumOrdine<br>"; } //NumOrdine è il numero di ordine creato da operatori italfrutta non l'id univoco
if (isset($_POST['FP'])) { $FP=$_POST['FP'];                        if (BETA2) echo "\nFP: $FP"; }
if (isset($_POST['Cliente'])) $CodCliente=$_POST['Cliente']; 
if (isset($_POST['Prodotto'])) $Prodotto=$_POST['Prodotto'];
if (isset($_POST['Pezzatura'])) $Pezzatura=$_POST['Pezzatura'];
if (isset($_POST['Lavorazione'])) $Lavorazione= $_POST['Lavorazione'];
if (isset($_POST['Commento'])) $Commento=$_POST['Commento'];
if (isset($_POST['Pallet'])) $Pallet=$_POST['Pallet'];
if (isset($_POST['Imballo'])) $Imballo=$_POST['Imballo'];
if (isset($_POST['Colli'])) $Colli=$_POST['Colli'];
if (isset($_POST['Stive'])) $Stive=  str_replace (",", ".", $_POST['Stive']);
if (isset($_POST['OraP'])) { $OraP=$_POST['OraP']; 
    $esistenzaOI = verificaSeEsiste($NumOrdine, $OraP, $FP, $CodCliente);  // la funzione di verifica esistenza codice Italfrutta è qui (se è settato il valore OraP gli altri che servono sono settati sicuramente
    preBeta("<b>EsistenzaOI: </b>".$esistenzaOI);
}
if (isset($_POST['IDRiga'])) $IDRiga=$_POST['IDRiga']; 
$FondoRiga= 'TabelleOrdini';

/* $data e $ieri messi nel file costanti.php
$data= date("Y-m-d");
$ierigiorno = date("d")-1; 
$ieri = date("Y")."-".date("m")."-".$ierigiorno;
*/

if (is_numeric($Colli) && is_numeric($Stive)) {
    $esistenzaNumeri = TRUE;
} else { $esistenzaNumeri = FALSE; echo "<p class=\"ErroreGrave\" color=\"red\">Colli o Stive contengono valori non numerici</p>"; }

 /*----modifica colore prodotto------- */  
// le righe prodotto variano autonomamente colori, i colori dei prodotti di un ordine sono diversi fino a diventare
// tutti verdi.
if (isset($_POST['bottone'])) {
        $colore= $_POST['bottone'];
        $sqlColoreIstr = "UPDATE prodotto SET Colore='$colore' WHERE CodProd=$IDRiga";
        if (BETA2) echo "<pre class='Beta2'>$sqlColoreIstr\n</pre>";
        $sqlColore=mysql_query($sqlColoreIstr); 
} 

/*----Inserimento in ordine e prodotto------- */    
if (isset($_POST['Inserimento']) && (($esistenzaOI==1)||($esistenzaOI==2)) && $esistenzaNumeri) { 
    /*
     * la SELECT seguente serve a verificare se l'ordine con stesso 'Codice' 'data' e 'OraPartenza' esiste, se esiste prende CodOrd come id
     * e lo utilizzerà per fare l'INSERT nella tabella 'prodotto' CodOrd<->CodOrd 
     */
    $sqlsql = "SELECT ordine.CodOrd, ordine.Codice, ordine.data, ordine.OraPartenza FROM ordine WHERE ordine.Codice = '$NumOrdine' AND ordine.data BETWEEN '$ieri' AND '$data'";
    $sqlOrd = mysql_query($sqlsql);
    if (BETA2) echo "<pre class='Beta2'>\n$sqlsql\n</pre>";
    $i = 0; if (BETA2) echo "<pre class='Beta2'>\nimposto indice: $i\n</pre>";
    while ($rigaOrd =  mysql_fetch_array($sqlOrd,MYSQL_ASSOC)){  
        // in questo ciclo verifico che vi sia l'occorenza dell'ordine che si sta andando ad inserire, se vi è allora non lo creo, altrimenti si.
        if (BETA2) { 
            echo "<pre class='Beta2'>"; print_r($rigaOrd); echo "</pre><br>";
            if ($rigaOrd['Codice']==$NumOrdine) echo "NumOrdine TROVATO<br>\n";
            if ($rigaOrd['OraPartenza']==$OraP) echo "OraP TROVATO<br>\n";
            if ($rigaOrd['data']==$data)        echo "data TROVATO<br>\n";
        }
        if ($rigaOrd['Codice']==$NumOrdine && $rigaOrd['OraPartenza']==$OraP && $rigaOrd['data']==$data) { $i=1; $idOrd=$rigaOrd['CodOrd']; }// oggi
        if ($rigaOrd['Codice']==$NumOrdine && $rigaOrd['OraPartenza']==$OraP && $rigaOrd['data']==$ieri) { $i=2; $idOrd=$rigaOrd['CodOrd']; }// ieri
        if (BETA2) echo "<pre class='Beta2'>indice di stato ordine prodotto: $i</pre><br>\n";
    }
    if ($i==1) {
        if (BETA2) echo "<pre class='Beta2'>Ordine esistente - Inserisco Prodotto</pre>";
        $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive='$Stive', Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$idOrd, Colore='$FondoRiga'"; 
        $queryProd = mysql_query($insertProdotto);
        if (BETA2) echo "<pre class='Beta2'>$insertProdotto\n</pre>";
    } elseif ($i==0) {
        if (BETA2) echo "<pre class='Beta2'>Ordine non esistente - Inserisco Ordine e Prodotto</pre>";
        $insertOrdine = "INSERT ordine SET Codice=$NumOrdine, FP='$FP', data='$data', OraPartenza='$OraP', CodCliente=$CodCliente";
        if (BETA2) echo "<pre class='Beta2'>$insertOrdine\n</pre>";
        $queryOrd = mysql_query($insertOrdine);
        //echo $queryOrd;
        $idOrd= mysql_insert_id();
        $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive='$Stive', Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$idOrd, Colore='$FondoRiga'";
        if (BETA2) echo "<pre class='Beta2'>$insertProdotto\n</pre>";
        $queryProd = mysql_query($insertProdotto);
     } elseif ($i==2) {
        if (BETA2) echo "<pre class='Beta2'>Ordine esistente ma di ieri - Sposto Ordine e Inserisco Prodotto</pre>";
        $insertOrdine = "UPDATE ordine SET data='$data' WHERE ordine.CodOrd = $idOrd";
        if (BETA2) echo "<pre>$insertOrdine\n</pre>";
        $queryOrd = mysql_query($insertOrdine);
        //echo $queryOrd;
        $idOrd= mysql_insert_id();
        $insertProdotto = "INSERT prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive='$Stive', Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$idOrd, Colore='$FondoRiga'";
        if (BETA2) echo "<pre class='Beta2'>$insertProdotto\n</pre>";
        $queryProd = mysql_query($insertProdotto);
    }
}
    $sqlSP = mysql_query("
      SELECT DISTINCT ordine.CodOrd, ordine.Codice, ordine.FP, ordine.data, cliente.NomeCliente, nomeprod.NomeProd, 
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
          AND ordine.data BETWEEN '$ieri' AND '$data'
      ORDER BY ordine.data, ordine.OraPartenza, ordine.Codice DESC"); 
?>
<table style="width: 100%" class="style2">
    <tr>
        <td class="style1"><span class="TestoTitoli">Tabella ordini lavorazione</span></td>
    </tr>
    <tr>
        <td colspan="2">		
        <table cellspacing="1" class="TabelleOrdini" style="width: 100%">
                <tr class="TestoPiccolo">
                        <? if (BETA) {
                            echo "<td class=\"TabelleOrdini\">CodOrd</td>";
                            echo "<td class=\"TabelleOrdini\">CodProd</td>";
                            echo "<td class=\"TabelleOrdini\">Data</td>";
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
                <?       
               
                while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){                             
                    $IDProd=$rigaSP['CodProd'];
                ?>
                <form method='post'>
                    <input type="hidden" name="percorso" value="datiOrdine">
                <tr class="<?=$rigaSP['Colore']?>" >
                    <? if (BETA) {
                        echo "<td class=\"".$rigaSP['Colore']."\" rowspan=\"2\">".$rigaSP['CodOrd']."</td>";
                        echo "<td class=\"".$rigaSP['Colore']."\" rowspan=\"2\">".$rigaSP['CodProd']."</td>";
                        echo "<td class=\"".$rigaSP['Colore']."\" rowspan=\"2\">".$rigaSP['data']."</td>";
                    }?>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['Codice']; ?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['FP'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['NomeCliente'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['NomeProd']; if (BETA) { echo " [".$rigaSP['CodProd']."]"; } ?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['TipoPez'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['TipoLav'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['Commenti'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['TipoPallet'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['TipoImballo'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['Colli'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo str_replace (".", ",", $rigaSP['Stive']); ?></td>
                    <td class="<?=$rigaSP['Colore']?>" rowspan="2"><?echo $rigaSP['OraPartenza'];?></td>
                    <td class="<?=$rigaSP['Colore']?>" width="50" height="26">
                     <input name="IDRiga" type="hidden" value='<?=$IDProd?>'>
                    <button type=”button” name="bottone" value='FondoArancio'>
                        <img alt="Presa in Carico" height="26" src="Arancio.jpg" width="50" />
                    </button>   
                    </td>
                    <td class="<?=$rigaSP['Colore']?>" width="50" height="26">
                        <button type=”button” name="bottone" value='FondoArancio'>    
                            <img alt="Presa Visione" height="26" src="Arancio-Rosso.jpg" width="50" />
                        </button>   
                    </td>
                </tr>
                <tr class="<?=$rigaSP['Colore']?>" >
                    <td class="<?=$rigaSP['Colore']?>">
                        <button type=”button” name="bottone" value='FondoGiallo'>        
                            <img alt="Completato" height="26" src="Giallo.jpg" width="50" />
                        </button>   
                    </td>
                    <td class="<?=$rigaSP['Colore']?>">
                        <button type=”button” name="bottone" value='FondoVerde'>     
                            <img alt="Associato" height="26" src="Verde.jpg" width="50" />
                        </button>   
                    </td>
                </tr>
        </form>
        <? } ?>
        </table>
        </td>
    </tr>
</table>