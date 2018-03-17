<html>
		
<head>
<title>Inserimento Ordine</title>
</head>

<body>
    
<?php

/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","epass1+")or die("Connessione non riuscita: ".mysql_error());
 //echo ("Connesso con successo");
mysql_select_db("italfrutta", $db) or die("Errore nella selezione del database"); 


$sql = mysql_query("SELECT NomeCliente FROM cliente ORDER BY NomeCliente");

//if ($sql) echo "ok";
?>

<form method="post" action="datiPRODOTTO.php">
  Inserire N. Ordine: <input name="NumOrdine" type="text">
   <br>
   <br>Selezionare Cliente:   
     <?$sqlCliente = mysql_query("SELECT NomeCliente FROM cliente ORDER BY NomeCliente");?>
     <select name="Cliente">
     <?while ($riga =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC)){
         echo "<option value=\"".$riga['NomeCliente']."\">".$riga['NomeCliente']."</option>";
     } ?>
     </select>
   

<input name="ordine" type="Submit" value="Inserisci" />    
</form> 

  
</body>

</html>  
