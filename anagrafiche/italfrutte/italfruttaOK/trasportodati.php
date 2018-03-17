<?   
include_once("connessione.php");  
?>    
<table border='1' color='BLACK'>
<tr class="TestoPiccolo">
    <td>
        CodOrd
    </td> 
    <td>
        N.Ordine
    </td> 
    <td>
        Cliente
    </td> 
    <td>
        CodProd
    </td> 
    <td>
        Prodotto
    </td>
    <td>
        Imballo
    </td>
    <td>
        Misura
    </td>   
</tr>
<? 
//  $sqlCliente = mysql_query("SELECT ordine.Codice,cliente.NomeCliente,imballo.TipoImballo
//  FROM ordine,cliente,imballo,prodotto 
//  WHERE ordine.CodCliente=cliente.CodCliente 
//  AND prodotto.CodImb=imballo.CodImb 
//  AND ordine.Codice=$NumOrdine
//  AND ordine.data='".date("Y-m-d").'");

$CodItalfrutta=$_GET['coditalf']; //attenzione il codice non è quello di italfrutta che ha omonimie ma CodOrd
//echo "codice passato dal GET" . $CodItalfrutta;
 
$sqlLavOrd = mysql_query("
    SELECT cliente.NomeCliente, imballo.TipoImballo, 
        ordine.Codice, ordine.CodOrd, prodotto.CodProd, prodotto.Colore,
        ordine.data, nomeprod.NomeProd
    FROM ordine, imballo, prodotto, cliente, nomeprod
    WHERE ordine.CodOrd = $CodItalfrutta
        AND ordine.CodOrd = prodotto.CodOrd
        AND cliente.CodCliente = ordine.CodCliente
        AND imballo.CodImb = prodotto.CodImb
        AND prodotto.CodNP = nomeprod.CodNP
        AND ordine.data BETWEEN '$ieri' AND '$data'");    
//RICORDASI DI AGGIUNGERE LA CONDIZIONE SULLA DATA ODIERNA!!!!!!!
   // $i=0;
?>
<form method="post" action="trasporto.php">
<?
while ($rigaOrdini=mysql_fetch_array($sqlLavOrd,MYSQL_ASSOC)) {
    //$i++;echo $i;
    ?>
<tr class="<?=$rigaOrdini['Colore']?>" >
<!cella per la SELECT del nome ORDINE------------------>    
<td><?=$rigaOrdini['CodOrd']?></td>
<td>
    <?echo $rigaOrdini['Codice'];?>
    <input type=hidden name=IdOrd value=<?=$rigaOrdini['CodOrd']?>>
    <input name=NumOrdine type=hidden value=<?=$CodItalfrutta?>>
</td>

<!cella per la SELECT del nome Cliente------------------->
<td>
<? //$sqlCliente = mysql_query("SELECT ordine.Codice,cliente.NomeCliente FROM ordine,cliente WHERE ordine.CodCliente=cliente.CodCliente AND ordine.CodOrd=$NumOrdine");?>
   
   <? //$rigaCliente =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC);
    echo $rigaOrdini['NomeCliente'];
    $Cliente=$rigaOrdini['NomeCliente'];
    echo "<input name=NumOrdine type=hidden value=$Cliente>\n";
   ?>
</td>
<td>
    <?=$rigaOrdini['CodProd']?>
</td>
<td>
    <?=$rigaOrdini['NomeProd']?>
</td>
<!cella per le Imballo------>
    <td>    
      <?
        //$query="SELECT imballo.TipoImballo FROM imballo,prodotto WHERE prodotto.CodImb=imballo.CodImb AND prodotto.CodOrd=$NumOrdine";
        //print_r($query);
        //$sqlImballo = mysql_query($query);
        //$rigaImballo =  mysql_fetch_array($sqlImballo,MYSQL_ASSOC);
        echo $rigaOrdini['TipoImballo'];
        $Imballo=$rigaOrdini['TipoImballo'];
        echo "<input name=NumOrdine type=hidden value=$Imballo>\n";
       ?>
    </td>
    <td>
        <input type=hidden name=IdProd[] value=<?=$rigaOrdini['CodProd']?>>
        <input name=Misura[] type='text'>
    </td>
</tr> 
<?}?>
<!--</table>
<table border='1' color='BLACK'>-->
<tr bgcolor="lightgray" class="TestoPiccolo">
  <td>
       Vettore
    </td>    
    <td width="10%">
       Portata
    </td> 
    <td>
       Nome e Cognome
    </td> 
    <td>
        Note
    </td>
    <td width="5%">
        Arrivato
    </td>    
    <td width="5%">
       Cronologia
    </td> 
    <td></td>
</tr>
<tr bgcolor="lightgray">
    <!cella per la SELECT del VETTORE---------->
<td> 
 <?
    $sqlVett = mysql_query("SELECT CodVett,NomeVettore FROM vettore ORDER BY NomeVettore");?>
    <select name="Vettore" style="width: 150px">
    <option value=""></option>
    <? while ($rigaSP =  mysql_fetch_array($sqlVett,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaSP['CodVett']."\">".$rigaSP['NomeVettore']."</option>";
    }?>
    </select> 
 </td>
<!cella per l'INSERIMENTO della Portata------------------>
<td width="10%">
    <input name='Portata' type='number'>
</td>
<!cella per la SELECT del NOME E COGNOME dell'autista----------------->
<td>   
<?
    $sqlAut = mysql_query("SELECT CodAut,Nome,Cognome FROM autista ORDER BY Nome, Cognome");?>
    <select name="Autista" style="width: 150px">
    <option value=""></option>
    <? while ($rigaSP =  mysql_fetch_array($sqlAut,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaSP['CodAut']."\">".$rigaSP['Nome'].$rigaSP['Cognome']."</option>";
    }?>
    </select>  
</td>
<!cella per le NOTE------>
<td>    
   
    <input name='Note' type='text'>
</td>

<!cella per ARRIVATO---------------->
<td width="10%">
    <input name='Arrivato' type='text'>
 </td>
 
 <!cella per la CRONOLOGIA---------------->
<td width="10%">   
    
    <input name="Cronologia" type="text">
    
</td>
<td>
    <input name="trasp-dati" type="Submit" value="Inserisci Misura e Dati Vettore" />
</td>
</tr>    
</table>
</form>
