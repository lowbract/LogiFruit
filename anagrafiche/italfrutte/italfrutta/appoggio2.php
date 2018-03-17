if ($ricerca == 0) 
	{/*Query per l'inserimento dei dati*/
	$inser = "INSERT INTO cliente (NomeCliente)
	       	       VALUES ('$nome')";
   	echo("<br>risultato della insert" . $inser); 

	if (isset($Inserisci)) echo("<br>Sono qui!");
            $query = mysql_query($inser);  	
            echo("<br>esecuzione query"); //esecuzione query
            if($query)
       	     	echo("<br>Inserimento riuscito"); 
            else
                echo("<br>Inserimento fallito"); }
 else echo ("<br>Cliente già presente in anagrafica");