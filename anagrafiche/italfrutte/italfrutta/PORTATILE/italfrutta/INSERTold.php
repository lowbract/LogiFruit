<?php

/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","epass1+")or die("Connessione non riuscita: ".mysql_error());
   echo ("Connesso con successo");
mysql_select_db("Italfrutta", $db) or die("Errore nella selezione del database"); 
 

/*Query per l'inserimento dei dati*/
$DatoForm = $_POST['DatoForm'];

echo ("<br> $DatoForm");
$letturaid = $_POST['id'];

echo ("<br>Hidden da form: $letturaid");

switch ($letturaid){
    
/*Caso Inserimento Cliente*/    
    case 'Cliente':
        echo("<br> sono entrata in Cliente");
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

            if (isset($_POST['Button1'])) { 
                echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Inserimento riuscito"); 
                 else
                 echo("<br>Inserimento fallito"); } 
               
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;

/*Caso Inserimento Imballo*/        
     case 'Imballo':
           echo("<br> sono entrata in Imballo");
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
 
            if (isset($_POST['Button1'])) { 
                echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Inserimento riuscito"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;
         
/*Caso Inserimento Pezzatura*/         
     case 'Pezzatura':
           echo("<br> sono entrata in Pezzatura");
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
 
            if (isset($_POST['Button1'])) { 
                echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Inserimento riuscito"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;
         
/*Caso Inserimento Pallet*/         

     case 'Pallet':
           echo("<br> sono entrata in Pallet");
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
 
            if (isset($_POST['Button1'])) { 
                echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Inserimento riuscito"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
         /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;  
        
/*Caso Inserimento Lavorazione*/         

     case 'Lavorazione':
           echo("<br> sono entrata in Lavorazione");
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM lavorazione WHERE TipoLav='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO lavorazione (TipoLav) VALUES ('$DatoForm')";
            
    
            if (isset($_POST['Button1'])) { 
                echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Inserimento riuscito"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");         
         break;
}


$close=mysql_close($db);
/*manca controllo di chiusura*/


?>