<a href="trasportoindex.php"><button type=”button” name="index">Associare un nuovo Trasporto</button></a>
<? 
include("connessione.php"); 
include_once("funzioni.php");
$sqlSTq = "
    SELECT ordine.CodOrd,ordine.Codice, ordine.OraPartenza, ordine.data, 
        vettore.NomeVettore, autista.Nome, autista.Cognome, autista.Telefono1, 
        trasporto.CodTrasp,trasporto.Portata, trasporto.Note, trasporto.Arrivato, 
        trasporto.Cronologia, trasporto.Colore
        FROM ordine, vettore, autista, trasporto
           WHERE trasporto.CodOrd=ordine.CodOrd
               AND vettore.CodVett=trasporto.CodVett
               AND autista.CodAut=trasporto.CodAut
               AND ordine.Assoc > 0
               AND ordine.data BETWEEN '$ieri' AND '$data'
           ORDER BY ordine.OraPartenza,ordine.Codice DESC";
if (BETA) echo "<tr><td><pre>$sqlSTq\n</pre></td></tr>\n";
$sqlST = mysql_query($sqlSTq);   
?>
<table cellspacing="1" class="TabelleOrdiniTrasporto" width="100%">
    <tr bgcolor="lightgray" class="TestoPiccolo">
        <td>h P.</td><td>Vettore</td><td>Portata</td><td>Autista</td><td>Tel.</td><td>Note</td><td>Arrivato</td><td>CodOrd</td><td>Codice</td>
        <td>Cronologia</td><td>Tot Stive</td><td>Riepilogo Ordine</td>
    </tr>
<?
while ($rigaST=mysql_fetch_array($sqlST,MYSQL_ASSOC)){ ?>                                 
    <tr>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['OraPartenza']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['NomeVettore']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Portata']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Nome']; echo $rigaST['Cognome']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Telefono1']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Note']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Arrivato']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['CodOrd']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Codice']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo $rigaST['Cronologia']; ?></td>
        <td class="<?=$rigaST['Colore']?>"><?echo sommastive($rigaST['CodOrd']); ?></td>
        <td class="TabelleOrdiniTrasporto"> 
        <table class="TabelleOrdiniTrasporto" cellspacing="1" width="100%">
        <? 
        $CodOrd_Trasp=$rigaST['CodOrd'];
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
            <tr class="<?=$rigaSP['Colore']?>">
               <td width="30%" class="TabelleOrdiniTrasporto"><?echo $rigaSP['NomeCliente']; ?></td>
               <td width="6%" class="TabelleOrdiniTrasporto"><?echo $rigaSP['Stive']; ?></td>
               <td width="6%" class="TabelleOrdiniTrasporto"><?echo str_replace (",", ".", $rigaSP['Stive']); ?></td>
               <td width="6%" class="TabelleOrdiniTrasporto"><?echo $rigaSP['Misura']; ?></td>
               <td width="16%" class="TabelleOrdiniTrasporto"><?echo $rigaSP['NomeProd']; ?></td>
               <td width="20%" class="TabelleOrdiniTrasporto"><?echo $rigaSP['TipoImballo']; ?></td>
               <td width="16%" class="TabelleOrdiniTrasporto"><?echo $rigaSP['Colli']; ?></td>
            </tr>    
             <?}?>  
        </table>
        </td>
    </tr>                         
    <?}?>
</table>