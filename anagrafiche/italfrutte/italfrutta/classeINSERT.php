<?php

/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","")or die("Connessione non riuscita: ".mysql_error());
   echo ("Connesso con successo");
mysql_select_db("Italfrutta", $db) or die("Errore nella selezione del database"); 
 

/*Query per l'inserimento dei dati*/
$DatoForm = $_POST['DatoForm'];
echo ($DatoForm);


switch ($_POST['id']){
    
/*Caso Inserimento Cliente*/    
    case "Cliente":
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM cliente WHERE NomeCliente='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO cliente (NomeCliente) VALUES ('$DatoForm')";

            if (isset($Inserisci)) //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);  	
                 if($query)
       	     	     echo("<br>Inserimento riuscito"); 
                 else
                     echo("<br>Inserimento fallito"); 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");

/*Caso Inserimento Imballo*/        
     case "Imballo":
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM imballo WHERE TipoImballo='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO imballo (TipoImballo) VALUES ('$DatoForm')";
 
            if (isset($Inserisci)) //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);  	
                 if($query)
       	     	     echo("<br>Inserimento riuscito"); 
                 else
                     echo("<br>Inserimento fallito"); 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         
/*Caso Inserimento Pezzatura*/         
     case "Pezzatura":
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM pezzatura WHERE TipoPez='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO pezzatura (TipoPez) VALUES ('$DatoForm')";
 
            if (isset($Inserisci)) //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);  	
                 if($query)
       	     	     echo("<br>Inserimento riuscito"); 
                 else
                     echo("<br>Inserimento fallito"); 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");

/*Caso Inserimento Pallet*/         

     case "Pallet":
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM pallet WHERE TipoPallet='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO pallet (TipoPallet) VALUES ('$DatoForm')";
 
            if (isset($Inserisci)) //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);  	
                 if($query)
       	     	     echo("<br>Inserimento riuscito"); 
                 else
                     echo("<br>Inserimento fallito"); 
                 
        }
            
        
/*Caso Inserimento Lavorazione*/         

     case "Lavorazione":
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM pallet WHERE TipoPallet='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO lavorazione (TipoLav) VALUES ('$DatoForm')";
 
            if (isset($Inserisci)) //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);  	
                 if($query)
       	     	     echo("<br>Inserimento riuscito"); 
                 else
                     echo("<br>Inserimento fallito"); 
                 
        }
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");         

}


$close=mysql_close($db);
/*manca controllo di chiusura*/


?>
