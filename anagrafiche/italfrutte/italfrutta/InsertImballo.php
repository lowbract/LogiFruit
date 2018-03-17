<?php
//connessione al DB
$db = mysql_connect("localhost","root","")or die("Connessione non riuscita: " . mysql_error());
   echo ("Connesso con successo");
mysql_select_db("Italfrutta", $db) or die("Errore nella selezione del database"); 

	

/*Query per l'inserimento dei dati*/
$nome = $_GET['Imballo'];
//    echo $nome;

/*Query per l'inserimento dei dati*/
	$inser = "INSERT INTO imballo (TipoImballo)
	       	VALUES     ('$nome')";
   	echo("<br>creazione della variabile inser"); 

	if (isset($Inserisci)) echo("<br>Sono qui!");
            $ok = mysql_query($inser);  	echo("<br>esecuzione query"); //esecuzione query
            if($ok)
       	     	echo("<br>Inserimento riuscito"); 
            else
                echo("<br>Inserimento fallito"); 
 
	

$close=mysql_close($db);
/*manca controllo di chiusura*/
?>



