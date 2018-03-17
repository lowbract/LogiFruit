<html>
<title>Modifica Ordine</title>
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
<body>
<? // PERCORSO -- menu del percorso
define ("POSIZIONE","Modifica prodotto");
define ("COLLEGAMENTO","modificaprodotto.php");
include_once 'percorso.php';
include ("ricercaCod.php");
include("connessione.php");
if (isset($_POST['Ricerca']) || isset($_GET['CodProd']))
    {
      if (isset($_POST['CodProd'])) $ModProd=$_POST['CodProd'];
      if (isset($_GET['CodProd'])) $ModProd=$_GET['CodProd'];
      $sqlMod=mysql_query("SELECT ordine.CodOrd, ordine.Codice, ordine.FP, ordine.CodCliente, cliente.NomeCliente, nomeprod.CodNP, nomeprod.NomeProd, 
            prodotto.Commenti, prodotto.Colli, prodotto.Stive, pezzatura.CodPez, pezzatura.TipoPez, lavorazione.CodLav, lavorazione.TipoLav, prodotto.Colore,
            ordine.OraPartenza, pallet.CodPallet, pallet.TipoPallet, imballo.CodImb, imballo.TipoImballo, prodotto.CodProd, prodotto.Cancellazione
            FROM ordine,cliente,nomeprod,prodotto,pezzatura,lavorazione,pallet,imballo
                WHERE ordine.CodCliente=cliente.codCliente
                     AND prodotto.CodOrd=ordine.CodOrd
                     AND prodotto.CodNP=nomeprod.CodNP
                     AND prodotto.CodPez=pezzatura.CodPez 
                     AND prodotto.CodLav=lavorazione.CodLav
                     AND prodotto.CodPallet=pallet.CodPallet 
                     AND prodotto.CodImb=imballo.CodImb  
                     AND prodotto.Cancellazione < 001
                     AND prodotto.CodProd=$ModProd
                 ORDER BY ordine.OraPartenza,ordine.Codice DESC");?>
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
    <? 
    while ($rigaSP =  mysql_fetch_array($sqlMod,MYSQL_ASSOC)) {   
    ?> 
    <tr class="<?=$rigaSP['Colore']?>">
            <td class="TabelleOrdini"><?echo $rigaSP['Codice'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['FP'];
                                         //$MODFP=$rigaSP['FP'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['NomeCliente']; 
                                          //$ModCliente=$rigaSP['NomeCliente'];
                                          //$ModCodCliente=$rigaSP['CodCliente']?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['NomeProd'];
                                          //$ModNomeProd=$rigaSP['NomeProd'];
                                          //$ModCodProd=$rigaSP['CodProd'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['TipoPez'];
                                          //$ModNomePez=$rigaSP['TipoPez'];
                                          //if (isset($rigaSP['CodPez'])) $ModCodPez=$rigaSP['CodPez'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['TipoLav'];
                                          //$ModNomeLav=$rigaSP['TipoLav'];
                                          if (isset($rigaSP['CodLav'])) $ModCodLav=$rigaSP['CodLav'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['Commenti'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['TipoPallet'];
                                          //$ModNomePallet=$rigaSP['TipoPallet'];
                                          //if (isset($rigaSP['CodPallet'])) $ModCodPallet=$rigaSP['CodPallet']; ?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['TipoImballo'];
                                          //$ModNomeImballo=$rigaSP['TipoImballo'];
                                          //if (isset($rigaSP['CodImballo'])) $ModCodImballo=$rigaSP['CodImballo']; ?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['Colli'];?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['Stive']; ?></td>
            <td class="TabelleOrdini"><?echo $rigaSP['OraPartenza'];
                                           //$ModOraP=$rigaSP['OraPartenza'];?></td>
    </tr>                      
    <tr class="<?=$rigaSP['Colore']?>">
<!cella per la SELECT del nome ORDINE------------------>    
    <form method="post">
    <td>
<?
        echo "<input type='number' name='Ordine' style='width: 70' value='".$rigaSP['Codice']."'>\n";
        $CodOrd_FromSelect=$rigaSP['CodOrd']; 
        $CodProd_FromSelect=$rigaSP['CodProd'];
        echo "<input name='CodOrd_FromSelect' type='hidden' value=$CodOrd_FromSelect>\n";
        echo "<input name='CodProd_FromSelect' type='hidden' value=$CodProd_FromSelect>\n";
?>
    </td>
<!cella per la SELECT del nome FRANCO PARTENZA---------->
    <td>
<?
    echo "\t\t<input name='FP' type='text' size=\"1\" maxlength=\"1\" value=\"".$rigaSP['FP']."\">";
?>
    </td>
<!cella per la SELECT del nome CLIENTE------------------>
    <td> 
<? 
        $sqlCliente = mysql_query("SELECT CodCliente,NomeCliente FROM cliente ORDER BY NomeCliente");
?>
        <select name="Cliente">
<? 
        while ($rigaCliente =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC)) {
            $selezionato = "";
            if ($rigaCliente['CodCliente']==$rigaSP['CodCliente']) { $selezionato = "selected"; }
            echo "\t<option value=\"".$rigaCliente['CodCliente']."\" $selezionato>".$rigaCliente['NomeCliente']."</option>\n";
        }
?>
        </select>
    </td>
<!cella per la SELECT del nome PRODOTTO----------------->
    <td>   
<?
    $sqlProd = mysql_query("SELECT CodNP,NomeProd FROM nomeprod ORDER BY NomeProd");
?>
        <select name="Prodotto">
<? 
        while ($rigaProd =  mysql_fetch_array($sqlProd,MYSQL_ASSOC)){
            $selezionato = "";
            if ($rigaProd['CodNP']==$rigaSP['CodNP']) { $selezionato = "selected"; }
            echo "<option value=\"".$rigaProd['CodNP']."\" $selezionato>".$rigaProd['NomeProd']."</option>";
        }
?>
        </select>   
    </td>
<!cella per la SELECT del nome PEZZATURA----------------->
    <td>    
<?
        $sqlPezzatura = mysql_query("SELECT CodPez,TipoPez FROM pezzatura ORDER BY TipoPez");
?>
        <select name="Pezzatura">
<? 
        while ($rigaPez =  mysql_fetch_array($sqlPezzatura,MYSQL_ASSOC)){
            $selezionato = "";
            if ($rigaPez['CodPez']==$rigaSP['CodPez']) { $selezionato = "selected"; }
            echo "<option value=\"".$rigaPez['CodPez']."\" $selezionato>".$rigaPez['TipoPez']."</option>\n";
        }
?>
        </select>
    </td>
<!cella per la SELECT del nome LAVORAZIONE---------------->
    <td>
<?
    $sqlLavorazione = mysql_query("SELECT CodLav,TipoLav FROM lavorazione ORDER BY TipoLav");
?>
        <select name="Lavorazione">
<? 
        while ($rigaLav =  mysql_fetch_array($sqlLavorazione,MYSQL_ASSOC)){
            $selezionato = "";
            if ($rigaLav['CodLav']==$rigaSP['CodLav']) { $selezionato = "selected"; }
            echo "<option value=\"".$rigaLav['CodLav']."\" $selezionato>".$rigaLav['TipoLav']."</option>\n";
        }
?>
       </select>
    </td>
<!cella per la SELECT del nome COMMENTI---------------->
    <td>   
        <input name="Commento" type="text" value="<?=$rigaSP['Commenti']?>">
    </td>
<!cella per la SELECT del nome PALLET------------------->
    <td>
<?
    $sqlPallet = mysql_query("SELECT CodPallet,TipoPallet FROM pallet ORDER BY TipoPallet");
?>
       <select name="Pallet">
<? 
        while ($rigaPallet =  mysql_fetch_array($sqlPallet,MYSQL_ASSOC)){
            $selezionato = "";
            if ($rigaPallet['CodPallet']==$rigaSP['CodPallet']) { $selezionato = "selected"; }
            echo "<option value=\"".$rigaPallet['CodPallet']."\" $selezionato>".$rigaPallet['TipoPallet']."</option>\n";
        }
?>
       </select>
    </td>
<!cella per la SELECT del nome IMBALLO------------------->
    <td>
      <?$sqlImballo = mysql_query("SELECT CodImb,TipoImballo FROM imballo ORDER BY TipoImballo");?>
       <select name="Imballo">
        <? 
        while ($rigaImballo =  mysql_fetch_array($sqlImballo,MYSQL_ASSOC)){
            $selezionato = "";
            if ($rigaImballo['CodImb']==$rigaSP['CodImb']) { $selezionato = "selected"; }
            echo "<option value=\"".$rigaImballo['CodImb']."\" $selezionato>".$rigaImballo['TipoImballo']."</option>";
        }?>
       </select>   
    </td>
<!cella per la SELECT del nome COLLI------------------->
    <td>
       <input name="Colli" type="text" value="<?=$rigaSP['Colli']?>" style='width: 30'>
    </td>
<!cella per la SELECT del nome STIVE------------------->
    <td>
       <input name="Stive" type="text" value="<?=$rigaSP['Stive']?>" style='width: 30'>
    </td>
<!cella per la SELECT del nome ORA PARTENZA------------------->
    <td>
       <select name="OraP">
<?
            $selezionato = "";
?>
            <option value="00:00" <? if ($rigaSP['OraPartenza']=="00:00") echo "selected"; ?>>00:00</option>
            <option value="00:30" <? if ($rigaSP['OraPartenza']=="00:30") echo "selected"; ?>>00:30</option>
            <option value="01:00" <? if ($rigaSP['OraPartenza']=="01:00") echo "selected"; ?>>01:00</option>
            <option value="01:30" <? if ($rigaSP['OraPartenza']=="01:30") echo "selected"; ?>>01:30</option>
            <option value="02:00" <? if ($rigaSP['OraPartenza']=="02:00") echo "selected"; ?>>02:00</option>
            <option value="02:30" <? if ($rigaSP['OraPartenza']=="02:30") echo "selected"; ?>>02:30</option>
            <option value="03:00" <? if ($rigaSP['OraPartenza']=="03:00") echo "selected"; ?>>03:00</option>
            <option value="03:30" <? if ($rigaSP['OraPartenza']=="03:30") echo "selected"; ?>>03:30</option>
            <option value="04:00" <? if ($rigaSP['OraPartenza']=="04:00") echo "selected"; ?>>04:00</option>
            <option value="04:30" <? if ($rigaSP['OraPartenza']=="04:30") echo "selected"; ?>>04:30</option>
            <option value="05:00" <? if ($rigaSP['OraPartenza']=="05:00") echo "selected"; ?>>05:00</option>
            <option value="05:30" <? if ($rigaSP['OraPartenza']=="05:30") echo "selected"; ?>>05:30</option>
            <option value="06:00" <? if ($rigaSP['OraPartenza']=="06:00") echo "selected"; ?>>06:00</option>
            <option value="06:30" <? if ($rigaSP['OraPartenza']=="06:30") echo "selected"; ?>>06:30</option>
            <option value="07:00" <? if ($rigaSP['OraPartenza']=="07:00") echo "selected"; ?>>07:00</option>
            <option value="07:30" <? if ($rigaSP['OraPartenza']=="07:30") echo "selected"; ?>>07:30</option>
            <option value="08:00" <? if ($rigaSP['OraPartenza']=="08:00") echo "selected"; ?>>08:00</option>
            <option value="08:30" <? if ($rigaSP['OraPartenza']=="08:30") echo "selected"; ?>>08:30</option>
            <option value="09:00" <? if ($rigaSP['OraPartenza']=="09:00") echo "selected"; ?>>09:00</option>
            <option value="09:30" <? if ($rigaSP['OraPartenza']=="09:30") echo "selected"; ?>>09:30</option>
            <option value="10:00" <? if ($rigaSP['OraPartenza']=="10:00") echo "selected"; ?>>10:00</option>
            <option value="10:30" <? if ($rigaSP['OraPartenza']=="10:30") echo "selected"; ?>>10:30</option>
            <option value="11:00" <? if ($rigaSP['OraPartenza']=="11:00") echo "selected"; ?>>11:00</option>
            <option value="11:30" <? if ($rigaSP['OraPartenza']=="11:30") echo "selected"; ?>>11:30</option>
            <option value="12:00" <? if ($rigaSP['OraPartenza']=="12:00") echo "selected"; ?>>12:00</option>
            <option value="12:30" <? if ($rigaSP['OraPartenza']=="12:30") echo "selected"; ?>>12:30</option>
            <option value="13:00" <? if ($rigaSP['OraPartenza']=="13:00") echo "selected"; ?>>13:00</option>
            <option value="13:30" <? if ($rigaSP['OraPartenza']=="13:30") echo "selected"; ?>>13:30</option>
            <option value="14:00" <? if ($rigaSP['OraPartenza']=="14:00") echo "selected"; ?>>14:00</option>
            <option value="14:30" <? if ($rigaSP['OraPartenza']=="14:30") echo "selected"; ?>>14:30</option>
            <option value="15:00" <? if ($rigaSP['OraPartenza']=="15:00") echo "selected"; ?>>15:00</option>
            <option value="15:30" <? if ($rigaSP['OraPartenza']=="15:30") echo "selected"; ?>>15:30</option>
            <option value="16:00" <? if ($rigaSP['OraPartenza']=="16:00") echo "selected"; ?>>16:00</option>
            <option value="16:30" <? if ($rigaSP['OraPartenza']=="16:30") echo "selected"; ?>>16:30</option>
            <option value="17:00" <? if ($rigaSP['OraPartenza']=="17:00") echo "selected"; ?>>17:00</option>
            <option value="17:30" <? if ($rigaSP['OraPartenza']=="17:30") echo "selected"; ?>>17:30</option>
            <option value="18:00" <? if ($rigaSP['OraPartenza']=="18:00") echo "selected"; ?>>18:00</option>
            <option value="18:30" <? if ($rigaSP['OraPartenza']=="18:30") echo "selected"; ?>>18:30</option>
            <option value="19:00" <? if ($rigaSP['OraPartenza']=="19:00") echo "selected"; ?>>19:00</option>
            <option value="19:30" <? if ($rigaSP['OraPartenza']=="19:30") echo "selected"; ?>>19:30</option>
            <option value="20:00" <? if ($rigaSP['OraPartenza']=="20:00") echo "selected"; ?>>20:00</option>
            <option value="20:30" <? if ($rigaSP['OraPartenza']=="20:30") echo "selected"; ?>>20:30</option>
            <option value="21:00" <? if ($rigaSP['OraPartenza']=="21:00") echo "selected"; ?>>21:00</option>
            <option value="21:30" <? if ($rigaSP['OraPartenza']=="21:30") echo "selected"; ?>>21:30</option>
            <option value="22:00" <? if ($rigaSP['OraPartenza']=="22:00") echo "selected"; ?>>22:00</option>
            <option value="22:30" <? if ($rigaSP['OraPartenza']=="22:30") echo "selected"; ?>>22:30</option>
            <option value="23:00" <? if ($rigaSP['OraPartenza']=="23:00") echo "selected"; ?>>23:00</option>
            <option value="23:30" <? if ($rigaSP['OraPartenza']=="23:30") echo "selected"; ?>>23:30</option>
            <option value="24:00" <? if ($rigaSP['OraPartenza']=="24:00") echo "selected"; ?>>24:00</option>
            <option value="24:30" <? if ($rigaSP['OraPartenza']=="24:30") echo "selected"; ?>>24:30</option>
    </select> 
    </td>
    <td><input name="Modifica" type="Submit" value="Modifica" /></td>
        </form>
       </tr>
</table>
<?
                }                          
        }                   
if (isset($_POST['Modifica']))   {     
    if (isset($_POST['CodOrd_FromSelect'])) $CodOrd_FromSelect=$_POST['CodOrd_FromSelect'];
    if (isset($_POST['CodProd_FromSelect'])) $CodProd_FromSelect=$_POST['CodProd_FromSelect'];
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
    $FondoRiga='FondoRosso';
    $aggiornOrd = "UPDATE ordine SET Codice=$CodOrdine , FP='$FP', data='$data', OraPartenza='$OraP',
            CodCliente=$CodCliente WHERE CodOrd=$CodOrd_FromSelect";
    $aggiornProd = "UPDATE prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive='$Stive', Commenti='$Commento',
            CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$CodOrd_FromSelect, Colore='$FondoRiga'
            WHERE CodProd=$CodProd_FromSelect";
    if (BETA) { echo "<pre>$aggiornOrd</pre>\n"; echo "<pre>$aggiornProd</pre>\n"; }
    $sqlUpdateOrd = mysql_query($aggiornOrd);
    $sqlUpdateProd = mysql_query($aggiornProd);
    //if ($sqlUpdateOrd) echo "ok Update Ordine!";
    //if ($sqlUpdateProd) echo "ok Update Prodotto!"; 
    } 
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
            AND ordine.data BETWEEN '$ieri' AND '$data'
        ORDER BY ordine.OraPartenza,ordine.Codice DESC");?>
</br></br>
<table style="width: 100%" class="style2">
	<tr>
		<td>&nbsp;</td>
		<td class="style1"><span class="TestoTitoli">ItalFrutta - Tabella ordini 
		lavorazione</span></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">		
                <table cellspacing="1" class="TabelleOrdini" style="width: 100%">
                    <tr class="TestoPiccolo">
                            <td class="TabelleOrdini"><font size="4"><b>Prodotto <br>da Modificare</b></font></td>
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
                            <td class="TabelleOrdini"><a href="modificaprodotto.php?CodProd=<?=$rigaSP['CodProd']?>"><font size="6"><b><?echo $rigaSP['CodProd'];?></b></font></a></td>
				<td class="TabelleOrdini"><?echo $rigaSP['Codice'];?></td>
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
</body>
</html>
