<?php
include_once 'costanti.php';
include 'connessione.php';
/*connessione al databse Italfrutta
$db = mysql_connect("localhost","root","")or die("Connessione non riuscita: ".mysql_error());
   echo ("Connesso con successo");
mysql_select_db("Italfrutta", $db) or die("Errore nella selezione del database"); 
 */

/*Query per l'inserimento dei dati*/
$DatoForm = addslashes($_POST['DatoForm']);
$letturaid = $_POST['id'];

echo ("<br> $DatoForm");
echo ("<br>Hidden da form: $letturaid");
echo "<br> Lettura ID: ".$letturaid."<br>";

switch ($letturaid){
/*Caso Inserimento Cliente*/    
    case 'Cliente':
        //echo("<br> sono entrata in Cliente<br>");
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM cliente WHERE NomeCliente='$DatoForm'"; 
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Cliente.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO cliente SET NomeCliente = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciCliente.php");
        break;
/*Caso Inserimento Nome Prodotto*/    
    case 'Prodotto':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM nomeprod WHERE NomeProd='$DatoForm'"; 
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO nomeprod SET NomeProd = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciSP.php");
        break; 
/*Caso Inserimento Imballo*/        
    case 'Imballo':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM imballo WHERE TipoImballo='$DatoForm'"; 
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO imballo SET TipoImballo = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciImballo.php");
        break;
/*Caso Inserimento Pezzatura*/         
    case 'Pezzatura':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM pezzatura WHERE TipoPez='$DatoForm'"; 
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO pezzatura SET TipoPez = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciPezzatura.php");
        break;
/*Caso Inserimento Pallet*/         
    case 'Pallet':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM pallet WHERE TipoPallet='$DatoForm'"; 
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO pallet SET TipoPallet = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciPallet.php");
        break;
/*Caso Inserimento Lavorazione*/         
    case 'Lavorazione':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM lavorazione WHERE TipoLav='$DatoForm'";
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO lavorazione SET TipoLav = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciLavorazione.php");
        break;
/*Caso Inserimento Lavorazione*/         
    case 'Vettore':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM vettore WHERE NomeVettore='$DatoForm'";
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO vettore SET NomeVettore = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciVettore.php");
        break;
/*Caso Inserimento Lavorazione*/         
    case 'Vettore':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM vettore WHERE NomeVettore='$DatoForm'";
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO vettore SET NomeVettore = '$DatoForm'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(1);header("location:InserisciVettore.php");
        break;
        /*Caso Inserimento Lavorazione*/         
    case 'Autista':
        /*Controllo che il record inserito non sia presente*/
        $controllo="SELECT * FROM autista WHERE Nome = 'xxxx'";
        $ricerca = mysql_query($controllo, $db) OR die(mysql_error());
        $numerorighe=mysql_num_rows($ricerca);
        //echo("<br>risultato della select in numero di righe".$numerorighe);
        /*Se il $numeroriche è = FALSE o a 0 posso inserire il nuovo record*/
        echo "<br>Prodotto.numerorighe: ".$numerorighe . "<br>";
        if ($numerorighe == FALSE OR $numerorighe == 0) {
            /*Query per l'inserimento dei dati*/
            $inser = "INSERT INTO autista SET Nome = '{$_POST['Nome']}', Cognome = '{$_POST['Cognome']}', Telefono1 = '{$_POST['Tel1']}', Telefono2 = '{$_POST['Tel2']}'";
            echo $inser."<br>";
             $query = mysql_query($inser) OR die(mysql_error());  	
             if($query) { 
                 echo("<br>Inserimento riuscito");
             } else {
                 echo("<br>Inserimento fallito ");
             }
        }
        /*altrimenti stampo a video un messaggio*/               
        else echo ("<br>Dato già presente in anagrafica");
        sleep(3);header("location:InserisciAutista.php");
        break;
}
$close=mysql_close($db);
/*manca controllo di chiusura*/
?>
