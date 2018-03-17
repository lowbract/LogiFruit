<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Inserisci Nuovo Cliente</title>
<style type="text/css">
.style1 {
	text-align: center;
}
</style>
</head>

<body>
<?$db = mysql_connect("localhost","root","")or die("Connessione non riuscita: " . mysql_error());
   print ("Connesso con successo");
mysql_select_db("Italfrutta", $db) or die("Errore nella selezione del database";
?>




<table style="width: 25%">
	<tr>
		<td colspan="3" class="style1">Inserisci Nuovo Cliente</td>
	</tr>
	<tr>
		<td class="style1">Cliente</td>
		<td class="style1">
		<form method="get">
			<input name="text1" type="text" />
                </form>
		</td>
		<td class="style1"><input name="Button1" type="submit" value="Inserisci"/>
                	<?/*Query per l'inserimento dei dati*/
			$insert = "INSERT INTO Italfrutta (NomeCliente)
		        	VALUES     ('$text1')";
			if (isset($Inserisci)) 
                            $result = mysql_query($insert);  //esecuzione query
                         if($result)
		             echo("<br>Inserimento riuscito"); 
                                else
                             echo("<br>Inserimento fallito"); 
      mysql_close($db);

?>
                </td>
	</tr>
</table>

</body>



</html>







