<html>
    <body>
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
 <?
 include ("ricercaCod.php");
 include("connessione.php");
 
  if (isset($_POST['Ricerca']))
                            {
                              if (isset($_POST['CodProd'])) $ModProd=$_POST['CodProd'];
                              $sqlMod=mysql_query("SELECT ordine.CodOrd, ordine.Codice, ordine.FP, cliente.NomeCliente, nomeprod.NomeProd, 
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
                        
                        <? while ($rigaSP =  mysql_fetch_array($sqlMod,MYSQL_ASSOC)){   ?> 
                        
                        <tr class="<?=$rigaSP['Colore']?>" >
                              
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
                        
                        <tr>
<!cella per la SELECT del nome ORDINE------------------>    
<form method="post">
<td>
    
    <? 
    echo "<input name='Ordine' type='number'>\n";
    $CodOrd_FromSelect=$rigaSP['CodOrd']; 
    $CodProd_FromSelect=$rigaSP['CodProd'];
    echo "<input name='CodOrd_FromSelect' type='hidden' value=$CodOrd_FromSelect>\n";
    echo "<input name='CodProd_FromSelect' type='hidden' value=$CodProd_FromSelect>\n";
    
    ?>

</td>

<!cella per la SELECT del nome FRANCO PARTENZA---------->
<td>
     
   <?
   
   echo "<input name='FP' type='text' style='width: 30px'?>";?>
     
 </td>

<!cella per la SELECT del nome CLIENTE------------------>
<td style="width: 75px">
   
     <? 
            $sqlCliente = mysql_query("SELECT CodCliente,NomeCliente FROM cliente ORDER BY NomeCliente");?>
            <select name="Cliente" style="width: 150px">
            <option value=""></option>
            <? 
            echo "<option value=\"".$rigaCliente['CodCliente']."\">".$rigaCliente['NomeCliente']."</option>";
            while ($rigaCliente =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC)){
                 echo "<option value=\"".$rigaCliente['CodCliente']."\">".$rigaCliente['NomeCliente']."</option>";
            }?>
            </select>
     
   
</td>


<!cella per la SELECT del nome PRODOTTO----------------->
<td>   
    
<?$sqlSP = mysql_query("SELECT CodNP,NomeProd FROM nomeprod ORDER BY NomeProd");?>
    <select name="Prodotto" style="width: 150px">
    <option value=""></option>
    <? while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaSP['CodNP']."\">".$rigaSP['NomeProd']."</option>";
    }?>
    </select>
     
</td>


<!cella per la SELECT del nome PEZZATURA----------------->
<td>    
    <?$sqlPezzatura = mysql_query("SELECT CodPez,TipoPez FROM pezzatura ORDER BY TipoPez");?>
    <select name="Pezzatura" style="width: 75px">
        <option value=""></option>
    <? while ($rigaPez =  mysql_fetch_array($sqlPezzatura,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaPez['CodPez']."\">".$rigaPez['TipoPez']."</option>";
    }?>
    </select>
</td>

<!cella per la SELECT del nome LAVORAZIONE---------------->
<td 'width: 100px' style="width: 61px">
<?$sqlLavorazione = mysql_query("SELECT CodLav,TipoLav FROM lavorazione ORDER BY TipoLav");?>
   <select name="Lavorazione" style="width: 75px">
       <option value=""></option>
    <? while ($rigaLav =  mysql_fetch_array($sqlLavorazione,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaLav['CodLav']."\">".$rigaLav['TipoLav']."</option>";
    }?>
   </select>
 </td>
 
 <!cella per la SELECT del nome COMMENTI---------------->
<td>   
    
    <input name="Commento" type="text">
    
</td>

<!cella per la SELECT del nome PALLET------------------->
<td>
<?$sqlPallet = mysql_query("SELECT CodPallet,TipoPallet FROM pallet ORDER BY TipoPallet");?>
   <select name="Pallet" style="width: 75px">
      <option value=""></option>
    <? while ($rigaPallet =  mysql_fetch_array($sqlPallet,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaPallet['CodPallet']."\">".$rigaPallet['TipoPallet']."</option>";
    }?>
   </select>
 </td>
 
 <!cella per la SELECT del nome IMBALLO------------------->
 <td>
  <?$sqlImballo = mysql_query("SELECT CodImb,TipoImballo FROM imballo ORDER BY TipoImballo");?>
   <select name="Imballo" style="width: 100px">
    <option value=""></option> 
    <? while ($rigaImballo =  mysql_fetch_array($sqlImballo,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaImballo['CodImb']."\">".$rigaImballo['TipoImballo']."</option>";
    }?>
   </select>   
 </td>
 
 <!cella per la SELECT del nome COLLI------------------->
 <td>
     
   <input name="Colli" type="text" style="width: 50px">
     
 </td>
 
 
 <!cella per la SELECT del nome STIVE------------------->
 <td>
     
   <input name="Stive" type="text" style="width: 50px">
     
 </td>
 
  <!cella per la SELECT del nome ORA PARTENZA------------------->
 <td>
   
   <select name="OraP" style="width: 75px">
               <option value=""></option>
           <option value="00:00">00:00</option>
           <option value="00:30">00:30</option>
           <option value="01:00">01:00</option>
           <option value="01:30">01:30</option>
           <option value="02:00">02:00</option>
           <option value="02:30">02:30</option>
           <option value="03:00">03:00</option>
           <option value="03:30">03:30</option>
           <option value="04:00">04:00</option>
           <option value="04:30">04:30</option>
           <option value="05:00">05:00</option>
           <option value="05:30">05:30</option>
           <option value="06:00">06:00</option>
           <option value="06:30">06:30</option>
           <option value="07:00">07:00</option>
           <option value="07:30">07:30</option>
           <option value="08:00">08:00</option>
           <option value="08:30">08:30</option>
           <option value="09:00">09:00</option>
           <option value="09:30">09:30</option>
           <option value="10:00">10:00</option>
           <option value="10:30">10:30</option>
           <option value="11:00">11:00</option>
           <option value="11:30">11:30</option>
           <option value="12:00">12:00</option>
           <option value="12:30">12:30</option>
           <option value="13:00">13:00</option>
           <option value="13:30">13:30</option>
           <option value="14:00">14:00</option>
           <option value="14:30">14:30</option>
           <option value="15:00">15:00</option>
           <option value="15:30">15:30</option>
           <option value="16:00">16:00</option>
           <option value="16:30">16:30</option>
           <option value="17:00">17:00</option>
           <option value="17:30">17:30</option>
           <option value="18:00">18:00</option>
           <option value="18:30">18:30</option>
           <option value="19:00">19:00</option>
           <option value="19:30">19:30</option>
           <option value="20:00">20:00</option>
           <option value="20:30">20:30</option>
           <option value="21:00">21:00</option>
           <option value="21:30">21:30</option>
           <option value="22:00">22:00</option>
           <option value="22:30">22:30</option>
           <option value="23:00">23:00</option>
           <option value="23:30">23:30</option>
           <option value="24:00">24:00</option>
           <option value="24:30">24:30</option>
</select> 
     
 </td>
 
 </tr>
</table>
  
<input name="Modifica" type="Submit" value="Modifica" /></form>  
                            <?}}?>
		
                             
                            
                   <?
                   
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

   
    $data= date("Y-m-d");
    
    $sqlUpdateOrd= mysql_query("UPDATE ordine SET Codice=$CodOrdine , FP='$FP', data='$data', OraPartenza='$OraP', CodCliente=$CodCliente WHERE CodOrd=$CodOrd_FromSelect");
            
    $sqlUpdateProd =mysql_query("UPDATE prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$CodOrdine, Colore='$FondoRiga' WHERE CodProd=$CodProd_FromSelect");
      
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
        ORDER BY ordine.OraPartenza,ordine.Codice DESC");?>

</br></br>
<table style="width: 100%" class="style2">
	<tr>
		<td style="width: 324px">&nbsp;</td>
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
                                <td class="TabelleOrdini"><font size="4"><b>Prodotto da Modificare</b></font></td>
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
                                <td class="TabelleOrdini"><font size="6"><b><?echo $rigaSP['CodProd'];?></b></font></td>
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
