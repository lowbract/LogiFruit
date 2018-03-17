<?php
/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","")or die("Connessione non riuscita: ".mysql_error());
   echo ("Connesso con successo");
mysql_select_db("Italfrutta", $db) or die("Errore nella selezione del database"); 
 

/*Query per l'inserimento dei dati*/
$nome = $_GET['Cliente'];
echo ($nome);

/*Controllo che il record inserito non sia presente*/
$controllo="SELECT * FROM cliente WHERE NomeCliente='$nome'"; 

$ricerca = mysql_query($controllo, $db) OR die(mysql_error());

$numerorighe=mysql_num_rows($ricerca);

//echo("<br>risultato della select in numero di righe".$numerorighe);

/*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
if ($numerorighe == FALSE OR $numerorighe == 0) 
	{/*Query per l'inserimento dei dati*/
	$inser = "INSERT INTO cliente (NomeCliente)
	       	       VALUES ('$nome')";
   	echo("<br>risultato della insert" . $inser); 

	if (isset($Inserisci)) //echo("<br>Sono qui!");
            $query = mysql_query($inser);  	
            echo("<br>esecuzione query"); //esecuzione query
            if($query)
       	     	echo("<br>Inserimento riuscito"); 
            else
                echo("<br>Inserimento fallito"); }
                
 /*altrimenti stampo a video un messaggio*/               
 else echo ("<br>Dato già presente in anagrafica");


$close=mysql_close($db);
/*manca controllo di chiusura*/
php?>





              
 
