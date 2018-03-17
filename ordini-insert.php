<pre>
<b>ORDINE:</b>
se non esiste lo crea/se esiste lo rintraccia e consente di aggiungere i nuovi prodotti
</pre>
<?php
include("connessione.php");  
//$sql = mysql_query("SELECT NomeCliente FROM cliente ORDER BY NomeCliente");
//if ($sql) echo "ok";
// <table style="width: 100%" class="BordoTabella2">
?>
<table style="width:100%">
<form method="POST" action="ordini.php"> <!-- QUI INIZIA LA FORM -->
    <input type="hidden" name="percorso" value="insertORDINE">
    <tr class="TestoPiccolo">    
        <td>
            Inserire N. Ordine: 
        </td>
        <td>
            Inserire Franco Partenza: 
        </td>
        <td>
            Inserire Cliente: 
        </td>
        <td>
            Inserire Ora di Partenza: 
        </td>
    <tr>
    <tr> 
        <td>
            <input name="NumOrdine" type="text" size="7" maxlength="7" autocomplete="off">
        </td>
        <td>
            <!--<input type="checkbox" name="FP" value="X">Sì-->
            <input type="radio" name="FP" value="X">Sì <input type="radio" name="FP" value="">No
            <!--<input name="FP" type="text" style="width: 30px">-->
        </td>
        <td>
            <? 
            $sqlCliente = mysql_query("SELECT CodCliente,NomeCliente FROM cliente ORDER BY NomeCliente");
            ?>
            <select name="Cliente" style="width: 150px">
            <option value=""></option>
            <? 
            while ($rigaCliente =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC)){
                echo "<option value=\"".$rigaCliente['CodCliente']."\">".$rigaCliente['NomeCliente']."</option>";
            }
            ?>
            </select>
        </td>
<!-- <br>Selezionare Cliente:   
     <?//$sqlCliente = mysql_query("SELECT NomeCliente FROM cliente ORDER BY NomeCliente");?>
     <select name="Cliente">
     <?//while ($riga =  mysql_fetch_array($sqlCliente,MYSQL_ASSOC)){
         //echo "<option value=\"".$riga['NomeCliente']."\">".$riga['NomeCliente']."</option>";}
     ?>
     </select>
-->
   <!cella per la SELECT del nome ORA PARTENZA------------------->
   <td>
                    
        <select name="OraP">
           <option value="">scegli</option>
           <option value="00:00">00:00</option>
           <option value="00:30">00:30</option>
           <option value="01:00">01:00</option>
           <option value="01:30">01:30</option>
           <option value="02:00">02:00</option>
           <option value="02:30">02:30</option>
           <option value="03:00">03:00</option>
           <option value="03:30">03:30</option>
           <option value="04:00">04:00</option>
           <option value="04:30">04:30</option>
           <option value="05:00">05:00</option>
           <option value="05:30">05:30</option>
           <option value="06:00">06:00</option>
           <option value="06:30">06:30</option>
           <option value="07:00">07:00</option>
           <option value="07:30">07:30</option>
           <option value="08:00">08:00</option>
           <option value="08:30">08:30</option>
           <option value="09:00">09:00</option>
           <option value="09:30">09:30</option>
           <option value="10:00">10:00</option>
           <option value="10:30">10:30</option>
           <option value="11:00">11:00</option>
           <option value="11:30">11:30</option>
           <option value="12:00">12:00</option>
           <option value="12:30">12:30</option>
           <option value="13:00">13:00</option>
           <option value="13:30">13:30</option>
           <option value="14:00">14:00</option>
           <option value="14:30">14:30</option>
           <option value="15:00">15:00</option>
           <option value="15:30">15:30</option>
           <option value="16:00">16:00</option>
           <option value="16:30">16:30</option>
           <option value="17:00">17:00</option>
           <option value="17:30">17:30</option>
           <option value="18:00">18:00</option>
           <option value="18:30">18:30</option>
           <option value="19:00">19:00</option>
           <option value="19:30">19:30</option>
           <option value="20:00">20:00</option>
           <option value="20:30">20:30</option>
           <option value="21:00">21:00</option>
           <option value="21:30">21:30</option>
           <option value="22:00">22:00</option>
           <option value="22:30">22:30</option>
           <option value="23:00">23:00</option>
           <option value="23:30">23:30</option>
           <option value="24:00">24:00</option>
           <option value="24:30">24:30</option>
        </select>        
      </td>
      <td align="center">
          <input name="ordine" type="Submit" value="Inserisci" />
      </td>
    </tr>
</table> 
</form>

