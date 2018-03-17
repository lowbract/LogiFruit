<!RICORDASI DI AGGIUNGERE LA CONDIZIONE SULLA DATA ODIERNA!!!!!!!>
<html>
		
<head>
<title>Inserimento Trasporto</title>
<style type="text/css">
</style>
</head>

<body>
<? 
    
include("connessione.php");  

?>
     
<link href="Style.css" rel="stylesheet" type="text/css" />

<form method="post" action="trasporto.php">
<table border='1' color='BLACK'>
<tr class="TestoPiccolo">
    <td>
        N.Ordine
    </td>    
    <td>
        Cliente
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

 $CodItalfrutta=$_GET['coditalf'];
$sqlLavOrd = mysql_query("SELECT cliente.NomeCliente, imballo.TipoImballo, ordine.Codice, ordine.CodOrd, prodotto.CodProd, prodotto.Colore
    WHERE ordine.Codice= $CodItalfrutta
        AND prodotto.CodOrd=ordine.CodOrd
        AND cliente.CodCliente = ordine.CodCliente
        AND imballo.CodImb=prodotto.CodImb");    
//RICORDASI DI AGGIUNGERE LA CONDIZIONE SULLA DATA ODIERNA!!!!!!!
   // $i=0;
while ($rigaOrdini=mysql_fetch_array($sqlLavOrd,MYSQL_ASSOC)) {
    //$i++;echo $i;
    ?>

<tr class="<?=$rigaOrdini['Colore']?>" >
<!cella per la SELECT del nome ORDINE------------------>    
<td>
    
<?
    echo $rigaOrdini['Codice']; 
    $CodOrdine= $rigaOrdini['CodOrd'];
    $CodProdotto= $rigaOrdini['CodProd'];
    
    echo "<input type=hidden name=IdOrd[] value=$CodOrdine>";
     echo "<input type=hidden name=IdProd[] value=$CodProdotto>";
    
    echo "<input name=NumOrdine type=hidden value= $CodItalfrutta>\n";
?>

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
   <? echo "<input name=Misura[] type='text'>"; ?>   
</td>


</tr> 

<?}?>
</table>

</br>     


<table border='1' color='BLACK'>
<tr>
  <td>
       Vettore
    </td>    
    <td style="width: 75px">
       Portata
    </td> 
    <td>
       Nome e Cognome
    </td> 
    <td>
        Note
    </td>
    <td style="width: 30px">
        Arr.
    </td>    
    <td style="width: 30px">
       Cron.
    </td>   
    
    
</tr>
<tr>
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
<td style="width: 75px">

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
<td 'width: 100px' style="width: 30px">
    <input name='Arrivato' type='text'>
 </td>
 
 <!cella per la CRONOLOGIA---------------->
<td style="width: 30px">   
    
    <input name="Cronologia" type="text">
    
</td>
  
</tr>    

</table>
    </br>    
<input name="InserOrdini" type="Submit" value="Inserisci Misura e Dati Vettore" />
</form>     
    
</body>

</html>  
  
  
 
