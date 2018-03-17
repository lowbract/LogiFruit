<?
//possibile problema con FP
include("connessione.php");
    //echo "Entro nella modifica";
    if (isset($_POST['CodOrd_FromSelect'])) $CodOrd_FromSelect1=$_POST['CodOrd_FromSelect'];
    if (isset($_POST['CodProd_FromSelect'])) $CodProd_FromSelect1=$_POST['CodProd_FromSelect']; 
    if (isset($_POST['Ordine'])) $CodOrdine=$_POST['Ordine']; 
    if (isset($_POST['FP'])) $FP=$_POST['FP']; 
    if (isset($_POST['Cliente'])) $CodCliente=$_POST['Cliente']; 
    if (isset($_POST['Prodotto'])) $Prodotto=$_POST['Prodotto']; 
    if (isset($_POST['Pezzatura'])) $Pezzatura=$_POST['Pezzatura']; 
    if (isset($_POST['Lavorazione'])) $Lavorazione= $_POST['Lavorazione']; 
    if (isset($_POST['Commento'])) $Commento=$_POST['Commento'];
    if (isset($_POST['Pallet'])) $Pallet=$_POST['Pallet']; 
    if (isset($_POST['Imballo'])) $Imballo=$_POST['Imballo']; 
    if (isset($_POST['Colli'])) $Colli=$_POST['Colli']; 
    if (isset($_POST['Stive'])) $Stive=$_POST['Stive']; 
    if (isset($_POST['OraP'])) $OraP=$_POST['OraP'];  
    $FondoRiga='FondoRosso';
    
    /*echo "codOrdfromSelect" . $CodOrd_FromSelect1; echo "<br>";
    echo "codProdFromselect" .$CodProd_FromSelect1; echo "<br>";
    echo "CodOrd" . $CodOrdine;echo "<br>";
    echo "FP" . $FP;echo "<br>";
    echo "CodCliente" . $CodCliente;echo "<br>";
    echo "Prodotto" . $Prodotto;echo "<br>";
    echo "pezz: " . $Pezzatura;echo "<br>";
    echo "Lav" .$Lavorazione;  echo "<br>";
    echo "Commento" .$Commento; echo "<br>";
    echo "pallet" . $Pallet; echo "<br>";
    echo "imballo" . $Imballo;echo "<br>";
    echo "Colli" . $Colli;   echo "<br>";
    echo "Stive" . $Stive; echo "<br>";
    echo "OraP" . $OraP;  echo "<br>";*/
  
   
    
    echo "<br> <br>";
    $data= date("Y-m-d");
    
    //Select per verificare se l'id è gia presente all'interno della tabella ordini
    //AGGIUNGI IN CONDIZIONE DATA,ORAP, CONTROLLO COLORE E ANNULLATO ---> WHERE data='$data',
    
    $sqlricercaidesistente= "SELECT * FROM ordine 
                                 WHERE OraPartenza='$OraP' 
                                   AND CodOrd=$CodOrd_FromSelect1 
                                   AND CodCliente=$CodCliente 
                                   AND Codice=$CodOrdine";
    //echo $sqlricercaidesistente;
    
    $querycontrollo=mysql_query($sqlricercaidesistente);
    $controllo=  mysql_fetch_array($querycontrollo);
    
    //echo "controllo" . $controllo['Codice'];
    
    if ($controllo) {
         //echo "sono nell if<br>";
         $sqlUPDATEPRODSTRING="UPDATE prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$CodOrd_FromSelect1, Colore='$FondoRiga' WHERE CodProd=$CodProd_FromSelect1";
         //echo $sqlUPDATEPRODSTRING;
         $sqlUpdateProd =mysql_query($sqlUPDATEPRODSTRING);
           }        
          else {
              
  //INSERT nuovo ordine
              //echo "sono nell'else<br>";
              $insertOrd="INSERT ordine SET Codice=$CodOrdine, FP='$FP', data='$data', OraPartenza='$OraP', CodCliente=$CodCliente";
              //echo $insertOrd; echo "<br>";
              $queryOrd = mysql_query($insertOrd);
              //echo "risultato query insert ORD: " . $queryOrd; echo "<br>";
              
  //SELECT del codice del nuovo ordine
              $selectidord = "SELECT CodOrd from ordine WHERE Codice=$CodOrdine AND FP='$FP'  AND data='$data' AND OraPartenza='$OraP' AND CodCliente=$CodCliente";
              //echo $queryidord; echo "<br>";
              $queryidOrd = mysql_query($selectqueryidord); 
              $OrdRiga=  mysql_fetch_array($queryidOrd);
              $idOrd= $OrdRiga['CodOrd'];
              
  //UPDATE prodotto con CodOrd nuovo appena inserito           
              //echo "risultato query select" . $idOrd; echo "<br>";             
              $insertProdotto = "UPDATE prodotto SET CodNP=$Prodotto, Colli=$Colli, Stive=$Stive, Commenti='$Commento', CodLav=$Lavorazione, CodPez=$Pezzatura, CodImb=$Imballo, CodPallet=$Pallet, CodOrd=$idOrd, Colore='$FondoRiga' WHERE CodProd=$CodProd_FromSelect1";
              //echo $insertProdotto; echo "<br>";
              $queryProd = mysql_query($insertProdotto); 
              //echo "Risultato query insert prodotto".$queryProd; echo "<br>";
            }

?>
