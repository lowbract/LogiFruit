<html>
		
<head>
<title>HTML Test</title>
</head>

<body>

<?php

/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","epass1+")or die("Connessione non riuscita: ".mysql_error());
 echo ("Connesso con successo");
mysql_select_db("italfrutta", $db) or die("Errore nella selezione del database"); 


$sql = mysql_query("SELECT NomeCliente FROM cliente ORDER BY NomeCliente");

if (isset($_POST['ordine'])){
    
    
}
    
?>
     
<link href="Style.css" rel="stylesheet" type="text/css" />

<form method="post" action="pippo.php">
<table border='1' color='BLACK'>
<tr>
<td 'width: 200px'>
<? echo "ciao"; ?>
</td>

<!cella per la SELECT del nome Cliente------------------>
<td 'width: 500px'>
   
    <?$sqlCliente = mysql_query("SELECT CodCliente,NomeCliente FROM cliente ORDER BY NomeCliente");?>
    <select name="Cliente">
    <?while ($riga =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC)){
    echo "<option value=\"".$riga['CodCliente']."\">".$riga['NomeCliente']."</option>";
    } ?>
    </select>
   
</td>


<!cella per la SELECT del nome Pezzatura----------------->
<td 'width: 100px'>    
    <?$sqlPezzatura = mysql_query("SELECT CodPez,TipoPez FROM pezzatura ORDER BY TipoPez");?>
    <select name="Pezzatura">
    <? while ($riga =  mysql_fetch_array($sqlPezzatura,MYSQL_ASSOC)){
    echo "<option value=\"".$riga['CodPez']."\">".$riga['TipoPez']."</option>";
    }?>
    </select>
</td>

<!cella per la SELECT del nome Lavorazione---------------->
<td 'width: 100px'>
<?$sqlLavorazione = mysql_query("SELECT CodLav,TipoLav FROM lavorazione ORDER BY TipoLav");?>
   <select name="Lavorazione">
    <? while ($riga =  mysql_fetch_array($sqlLavorazione,MYSQL_ASSOC)){
    echo "<option value=\"".$riga['CodLav']."\">".$riga['TipoLav']."</option>";
    }?>
   </select>
 </td>";
   <td 'width: 100px'>
      <? echo "&nbsp;"; ?>
   </td>
 </tr>
</table>
<input name="ordine" type="Submit" value="Inserisci" />    
</form> 
?> 
  
</body>

</html>  
  
  
 

