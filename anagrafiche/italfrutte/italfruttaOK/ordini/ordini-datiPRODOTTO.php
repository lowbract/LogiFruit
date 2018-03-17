<h1>(2) ordini-datiPRODOTTO.php</h1>
<?php
include("connessione.php");  
if (isset($_POST['ordine']) || isset($_POST['Inserimento'])){
    if (isset($_POST['NumOrdine'])) $NumOrdine=$_POST['NumOrdine'];
    if (isset($_POST['Cliente'])) $Cliente=$_POST['Cliente'];
    if (isset($_POST['FP'])) $FP=$_POST['FP'];
    if (isset($_POST['OraP'])) $OraP=$_POST['OraP'];
    //echo $CodCliente;
    //$rigacliente =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC);
    //print_r ($rigacliente['CodCliente']);
}
?>
<form method="POST" action="ordini.php">
    <input type="hidden" name="percorso" value="datiPRODOTTO">
<table border='1' color='BLACK' "width: 100%">
<tr class="TestoPiccolo">
    <td>
        N.Ordine
    </td>    
     <td>
        Ora Partenza
    </td>
    <td>
        F.P.
    </td>    
    <td>
        Cliente
    </td> 
    <td>
        Prodotto
    </td> 
    <td>
        Pez.
    </td>
     <td>
        Lavor.
    </td> 
    <td>
        Commenti</td>    
    <td>
        T.Pallet
    </td> 
    <td>
        Imballo
    </td> 
    <td>
        Colli</td>
     <td>
        Stive</td> 
</tr>
<tr>
<!cella per la SELECT del nome ORDINE------------------>    
<td>
    <? echo $NumOrdine; 
    echo "<input type='hidden' name='NumOrdine' value='$NumOrdine'>\n";
    ?>
</td>
<!cella per la SELECT del nome ORA PARTENZA------------>   
<td>    
    <? echo $OraP; 
    echo "<input name=OraP type=hidden value=$OraP>\n";
    ?>
</td>
<!cella per la SELECT del nome FRANCO PARTENZA---------->
<td>     
   <?echo $FP;
   echo "<input name=FP type=hidden value=$FP>";?>    
 </td>
<!cella per la SELECT del nome CLIENTE------------------>
<td> 
    <? 
    $sqlCliente = mysql_query("SELECT NomeCliente FROM cliente WHERE CodCliente=$Cliente");
    $NomeCliente =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC);
    echo $NomeCliente['NomeCliente'];
    echo "<input name='Cliente' type='hidden' value=$Cliente>";
    ?>   
</td>
<!cella per la SELECT del nome PRODOTTO----------------->
<td>      
<?$sqlSP = mysql_query("SELECT CodNP,NomeProd FROM nomeprod ORDER BY NomeProd");?>
    <select name="Prodotto" style="width: 150px">
    <option value=""></option>
    <? while ($rigaSP =  mysql_fetch_array($sqlSP,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaSP['CodNP']."\">".$rigaSP['NomeProd']."</option>";
    }?>
    </select>     
</td>
<!cella per la SELECT del nome PEZZATURA----------------->
<td>    
    <?$sqlPezzatura = mysql_query("SELECT CodPez,TipoPez FROM pezzatura ORDER BY TipoPez");?>
    <select name="Pezzatura" style="width: 75px">
        <option value=""></option>
    <? while ($rigaPez =  mysql_fetch_array($sqlPezzatura,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaPez['CodPez']."\">".$rigaPez['TipoPez']."</option>";
    }?>
    </select>
</td>
<!cella per la SELECT del nome LAVORAZIONE---------------->
<td>
<?$sqlLavorazione = mysql_query("SELECT CodLav,TipoLav FROM lavorazione ORDER BY TipoLav");?>
   <select name="Lavorazione" style="width: 75px">
    <option value=""></option>   
    <? while ($rigaLav =  mysql_fetch_array($sqlLavorazione,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaLav['CodLav']."\">".$rigaLav['TipoLav']."</option>";
    }?>
   </select>
 </td>
 <!cella per la SELECT del nome COMMENTI---------------->
<td>      
    <input name="Commento" type="text"> 
</td>
<!cella per la SELECT del nome PALLET------------------->
<td>
<?$sqlPallet = mysql_query("SELECT CodPallet,TipoPallet FROM pallet ORDER BY TipoPallet");?>
   <select name="Pallet" style="width: 75px">
    <option value=""></option>   
    <? while ($rigaPallet =  mysql_fetch_array($sqlPallet,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaPallet['CodPallet']."\">".$rigaPallet['TipoPallet']."</option>";
    }?>
   </select>
 </td>
 <!cella per la SELECT del nome IMBALLO------------------->
 <td>
  <?$sqlImballo = mysql_query("SELECT CodImb,TipoImballo FROM imballo ORDER BY TipoImballo");?>
   <select name="Imballo" style="width: 100px">
   <option value=""></option>   
    <? while ($rigaImballo =  mysql_fetch_array($sqlImballo,MYSQL_ASSOC)){
    echo "<option value=\"".$rigaImballo['CodImb']."\">".$rigaImballo['TipoImballo']."</option>";
    }?>
   </select>   
 </td>
 
 <!cella per la SELECT del nome COLLI------------------->
 <td>
   <input name="Colli" type="text" style="width: 50px">
 </td>
 <!cella per la SELECT del nome STIVE------------------->
 <td>
   <input name="Stive" type="text" style="width: 50px">   
 </td>
 </tr>
</table>
</br>     
<input name="Inserimento" type="Submit" value="Inserisci" />    
</form> 

  
 