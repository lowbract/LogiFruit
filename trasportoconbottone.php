<?
/*problema sul passaggio del id del codice trasporto per poi cambiare colore utilizzando i bottoni.
 *Nel'IF del bottone non entra mai...
 *Ho provato a mettere l'if sia dentro che fuori il while ma non cambia molto
 */
?>    
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Associazione Trasporto-Ordine</title>
    <link href="Style.css" rel="stylesheet" type="text/css" />
</head>    
<body>
<table style="width: 100%" class="style2">
	<tr>
            <td class="style1"><span class="TestoTitoli">ItalFrutta - Tabella Trasporti
            in Lavorazione</span></td>
	</tr>
</table>
<table cellspacing="1" class="TabelleOrdini" width="100%">
<? 
include("connessione.php");  
if (isset($_POST['bottone'])) {
    $colore= $_POST['bottone'];
    $postidriga=$_POST['IDRiga'];
    echo "<br>sono nel IF del bottone<br>";
    $sqlColore = "UPDATE trasporto SET Colore='$colore' WHERE CodTrasp=$postidriga";
    if (BETA2) echo $sqlColore;
    mysql_query($sqlColore);
}

$sqlST = mysql_query("SELECT ordine.CodOrd,ordine.Codice, ordine.OraPartenza, 
        vettore.NomeVettore, autista.Nome, autista.Cognome, autista.Telefono1, 
        trasporto.CodTrasp,trasporto.Portata, trasporto.Note, trasporto.Arrivato, 
        trasporto.Cronologia, trasporto.Colore, trasporto.CodTrasp
        FROM ordine, vettore, autista, trasporto
           WHERE trasporto.CodOrd=ordine.CodOrd
               AND vettore.CodVett=trasporto.CodVett
               AND autista.CodAut=trasporto.CodAut
               AND ordine.Assoc > 0
           ORDER BY ordine.OraPartenza,ordine.Codice DESC");      

while ($rigaST=mysql_fetch_array($sqlST,MYSQL_ASSOC)){                             
              //$IDTrasp=$rigaST['CodTrasp'];
              //$CodOrd_Trasp=$rigaST['CodOrd'];
    $CodTrasp=$rigaST['CodTrasp'];
    $CodOrd_Trasp=$rigaST['CodOrd'];
?>        
        <tr class="TabelleOrdiniTrasporto">
              <td>   
                <table cellspacing="1" class="TabelleOrdini">
                    <form method="POST">
                    <input name="IDRiga" type="hidden" value='<?=$CodTrasp?>'>
                    <tr class="TabelleOrdiniTrasporto">
                        <td>
                             <button type=”button” name="bottone" value='FondoBlu'>
                             <img alt="Presa in Carico" height="26" src="Rosso-Blu.jpg" width="50" />
                             </button>  
                         </td>
                     </tr>  
                     <tr>
                         <td>                                          
                             <button type=”button” name="bottone" value='FondoVerde'>
                             <img alt="Completato" height="26" src="VerdeT.jpg" width="50" />
                             </button>  
                        </td>
                     </tr> 
                    </form>
                 </table>
                </td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['OraPartenza']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['NomeVettore']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Portata']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Nome']; echo "&nbsp;".$rigaST['Cognome']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Telefono1']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Note']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Arrivato']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['CodOrd']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Codice']; ?></td>
                <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Cronologia']; ?></td> 
                <td class="<?=$rigaST['Colore']?>"> 
               <table cellspacing="1" class="TabelleOrdini" width="100%" align="top">
               <tr>
<? 
             //$CodOrd_Trasp=$rigaST['CodOrd'];
             $sqlSP= mysql_query("SELECT ordine.Codice, cliente.NomeCliente, 
                    nomeprod.NomeProd, prodotto.Colli, prodotto.Stive, prodotto.Misura,
                    imballo.TipoImballo, prodotto.CodProd, prodotto.Colore  
                    FROM ordine,cliente,nomeprod,prodotto,imballo
                        WHERE ordine.CodCliente=cliente.codCliente
                            AND ordine.CodOrd= $CodOrd_Trasp
                            AND prodotto.CodOrd=ordine.CodOrd
                            AND prodotto.CodNP=nomeprod.CodNP
                            AND prodotto.CodImb=imballo.CodImb    
                            AND prodotto.Cancellazione < 001
                            AND ordine.Assoc > 0
                    ORDER BY ordine.OraPartenza,ordine.Codice DESC"); 
            while($rigaSP=mysql_fetch_array($sqlSP,MYSQL_ASSOC)){
?>    
             <tr class="TabelleOrdiniTrasporto" width="100%">
                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['NomeCliente']; ?></td>
                <td class="<?=$rigaSP['Colore']?>"><?echo "Somma POI";?></td>
                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Stive'];?></td>
                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Misura'];?></td>
                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['NomeProd'];?></td>
                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['TipoImballo'];?></td>
                <td class="<?=$rigaSP['Colore']?>"><?echo $rigaSP['Colli'];?></td>
             </tr>    
<? } ?>  
           </table>
        </td>
    </tr>
<? } ?>
</table>
</body>
</html>
