<?php

/*<html>
<head>


</head>
<body>

function aprifinestra()
{
window.open('ConfInserimento.php','miaFinestra','width=dimensione,height=dimensione, toolbar=no, location=no,status=no,menubar=no,scrollbars=no,resizable=no');
}

</body>*/

//Gestione controllo db
//Gestione mancanza di un cognome 
//Commentare gli echo sparsi


/*connessione al databse Italfrutta*/
$db = mysql_connect("localhost","root","epass1+")or die("Connessione non riuscita: ".mysql_error());
  // echo ("Connesso con successo");
mysql_select_db("db-italfrutta", $db) or die("Errore nella selezione del database"); 
 

/*Dati inviati tramite $_POST-----------------------------------------------------*/
$DatoForm = $_POST['DatoForm'];

//echo ("<br> $DatoForm");
$letturaid = $_POST['id'];

//echo ("<br>Hidden da form: $letturaid");

//Variabili passate per l'autista
$NomeAut = $_POST['Nome'];
$CognomeAut = $_POST['Cognome'];
$Tel1 = $_POST['Tel1'];
$Tel2 = $_POST['Tel2'];
/*----------------------------------------------------------------------------------*/



switch ($letturaid){
    
/*Caso Inserimento Cliente----------------------------------------------------------*/    
    case 'Cliente':
        //echo("<br> sono entrata in Cliente");
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
                //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 //echo ("<br>Risultato query= ".$query);
                 if($query)
                     
                  // echo "<a href='#' onclick='aprifinestra()'>Link</a>";
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                   echo("<br>Inserimento fallito"); } 
               
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;

/*Caso Inserimento Imballo---------------------------------------------------------*/        
     case 'Imballo':
           //echo("<br> sono entrata in Imballo");
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
                //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 //echo ("<br>Risultato query= ".$query);
                 if($query) 
                     
                  


                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;
         
/*Caso Inserimento Pezzatura-----------------------------------------------------*/         
     
      case 'Pezzatura':
       //   echo("<br> sono entrata in Pezzatura");
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
             //   echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
               //  echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
                
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;
         
/*Caso Inserimento Pallet-------------------------------------------------------*/         

     case 'Pallet':
         //  echo("<br> sono entrata in Pallet");
        
         
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
                //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                //echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
         /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");
         break;  

         
        
/*Caso Inserimento Prodotto*--------------------------------------------------*/         

     case 'Prodotto':
          // echo("<br> sono entrata in Lavorazione");
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM nomeprod WHERE CodNP='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO nomeprod (NomeProd) VALUES ('$DatoForm')";
            
    
            if (isset($_POST['Button1'])) { 
               // echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                // echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");         
         break;


        
/*Caso Inserimento Lavorazione*--------------------------------------------------*/         

     case 'Lavorazione':
          // echo("<br> sono entrata in Lavorazione");
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
               // echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                // echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");         
         break;


/*Caso Inserimento Vettore*--------------------------------------------------*/         

     case 'Vettore':
           //echo("<br> sono entrata in Vettore");
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM vettore WHERE NomeVettore='$DatoForm'"; 

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO vettore (NomeVettore) VALUES ('$DatoForm')";
            
    
            if (isset($_POST['Button1'])) { 
               // echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                // echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Dato Inserimento Correttamente"); 
                 else
                 echo("<br>Inserimento fallito"); } 
                 
        }
        /*altrimenti stampo a video un messaggio*/               
         else echo ("<br>Dato già presente in anagrafica");         
         break;
         
         
         
         
/*Caso Inserimento Autista--------------------------------------------------------*/    
    case 'Autista':
        //echo("<br> sono entrata in Autista");
        /*Controllo che il record inserito non sia presente*/
        
/*-----controllo se il Cognome non è stato inserito--------------------------------*/        
        if ($CognomeAut == NULL) {
            echo "<br> Non è stato inserito un Cognome";
        break; }
        
/*---------------------------------------------------------------------------------*/        
        
        
        $controllo="SELECT * FROM autista WHERE Nome='$NomeAut' AND Cognome='$CognomeAut'"; 
        

        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());

        $numerorighe=mysql_num_rows($ricerca);

        //echo("<br>risultato della select in numero di righe".$numerorighe);

        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        if ($numerorighe == FALSE OR $numerorighe == 0) 
        {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO autista (Nome,Cognome,Telefono1,Telefono2) VALUES ('$NomeAut','$CognomeAut','$Tel1','$Tel2')";

            if (isset($_POST['Button1'])) { 
                //echo("<br>isset su inserisci ok!");
                 $query = mysql_query($inser);
                 //echo ("<br>Risultato query= ".$query);
                 if($query) 
                   echo("<br>Dato Inserimento Correttamente"); 
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
</html> 