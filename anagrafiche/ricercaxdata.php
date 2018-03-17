<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Ricerca per DATA</title>
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
</head>

<body>
<? // PERCORSO -- menu del percorso
define ("POSIZIONE","Ricerca per data");
define ("COLLEGAMENTO","ricercaxdata.php");
include_once 'percorso.php'; ?>
<?
     include("connessione.php");
?>
<table style="width: 100%">
	<tr>
		<td style="width: 324px; height: 123px;"><img src="Risorse/ItalfruttaL2.jpg" /></td>
		<td class="style1"><span class="TestoTitoli">Ricerca per DATA
		</span></td>
	</tr>

	<tr class="TestoTitoli">
		<td colspan="2" class="style1">Inserisci la Data da Ricercare<br/><br/></td>
	</tr>
</table>
<table style="width: 25%" border='1' color='BLACK'>
	<tr><form method="post">
		<tr>
                    <td class="TestoTitoli">Giorno</td>
                    <td class="TestoTitoli">Mese</td>
                    <td class="TestoTitoli">Anno</td>    
                <tr>
                <tr>
                    <td>
                         <select name="Giorno">
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                         </select> 
                    </td>
                    <td>
                         <select name="Mese">
                            <option value="01">Gennaio</option>
                            <option value="02">Febbraio</option>
                            <option value="03">Marzo</option>
                            <option value="04">Aprile</option>
                            <option value="05">Maggio</option>
                            <option value="06">Giugno</option>
                            <option value="07">Luglio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Settembre</option>
                            <option value="10">Ottobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Dicembre</option>
                        </select>
                    </td>    
                    <td>
                        <input name="Anno" type="number" />
                    </td>
                    <td class="style1" colspan="2">
                        <input name="Ricerca" type="Submit" value="Ricerca" />
                    </td>
                </form>      
       </tr>
</table>
</center>
<?
$controllox = "";
if (isset($_POST['Ricerca']))
                            {
                              if (isset($_POST['Giorno']) && isset($_POST['Mese']) && isset($_POST['Anno']) && $_POST['Anno']!='' && $_POST['Anno']!='tutti')
                              {
                                  $dataRicerca=$_POST['Anno'].-$_POST['Mese'].-$_POST['Giorno'];
                                  //echo $dataRicerca;
                                  //                                                  
                                  
                                  $qRic = "SELECT ordine.CodOrd, ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
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
                                                  AND ordine.data='$dataRicerca'
                                              ORDER BY ordine.data, ordine.OraPartenza, ordine.Codice DESC";
                                  $controllox = "OKBELLO";
                              }
                              elseif (isset($_POST['Giorno']) && isset($_POST['Mese']) && isset($_POST['Anno']) && $_POST['Anno']=='tutti')
                              {                                  
                                  $qRic = "SELECT ordine.CodOrd, ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
                                      prodotto.Commenti, prodotto.Colli, prodotto.Stive, pezzatura.TipoPez, lavorazione.TipoLav, prodotto.Colore,
                                         ordine.data, ordine.OraPartenza, pallet.TipoPallet,imballo.TipoImballo, prodotto.CodProd, prodotto.Cancellazione 
                                         FROM ordine,cliente,nomeprod,prodotto,pezzatura,lavorazione,pallet,imballo
                                            WHERE ordine.CodCliente=cliente.codCliente
                                                  AND prodotto.CodOrd=ordine.CodOrd
                                                  AND prodotto.CodNP=nomeprod.CodNP
                                                  AND prodotto.CodPez=pezzatura.CodPez 
                                                  AND prodotto.CodLav=lavorazione.CodLav
                                                  AND prodotto.CodPallet=pallet.CodPallet 
                                                  AND prodotto.CodImb=imballo.CodImb  
                                                  AND prodotto.Cancellazione < 001
                                              ORDER BY ordine.data, ordine.OraPartenza, ordine.Codice DESC";
                                  $controllox = "OKBELLO";  
                              }
                              if ($controllox == "OKBELLO") {
                                  if (BETA2) { echo "<pre>".$qRic."</pre>\n"; }
                                  $sqlRic= mysql_query($qRic);
                                  if (mysql_num_rows($sqlRic)>0) 
                                  {?>
                                      </br></br>
                                      <table style="width: 100%" class="style2">
                                	<tr>
                                            <td style="width: 324px">&nbsp;</td>
                                            <td class="style1"><span class="TestoTitoli">Ordini trovati con la Ricerca</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">		
        
                                      <table cellspacing="1" class="TabelleOrdini" style="width: 100%">
			<tr class="TestoPiccolo">
                                <td class="TabelleOrdini">BETA</td>
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
                        
                        <? while ($rigaSP =  mysql_fetch_array($sqlRic,MYSQL_ASSOC)){   ?> 
                        
                        <tr class="<?=$rigaSP['Colore']?>" >
                                <td class="<?=$rigaSP['Colore']?>"><font size="6"><b><?echo $rigaSP['CodProd'];?></b></font>:<?echo $rigaSP['data'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Codice'];?></td>
                                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['FP'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['NomeCliente'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['NomeProd'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['TipoPez'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['TipoLav'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Commenti'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['TipoPallet'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['TipoImballo'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Colli'];?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Stive']; ?></td>
				<td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['OraPartenza'];?></td>
				
			</tr>
                            <?}?>
		</table>
		
		</td>
	</tr>		
	</table>
                                      
                                 <? }
                                 else echo "</br></br><b>La data non è presente nell'elenco degli ordini.</b>";
                     
                              }
                              else echo "</br></br><b>La data non è stata inserita correttamente.</b>";
                            }
                                  ?>
                                  
</body>    

</html>
