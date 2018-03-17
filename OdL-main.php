<?php 
$pdo = connetti();
include_once "OdL-funzioni.php";
$flagcercagiorno = 0; // imposta il bottone su aggiorna o su copia in base a se stai cercando o se stai lavorando sul giorno.
if (isset($_POST['bt']) && $_POST['bt'] == 'N') { // primo insert nuovo S-OdL
    insert_newSodl($_POST['testo']);
}
if (isset($_POST['percorso']) && $_POST['percorso'] == 'insertORDINE') { // stabilisce i percorsi alternativi
    $nsodl = $_POST['nsodl'];
    $nord = $_POST['nord'];
    $fp = $_POST['fp'];
    $idclie = $_POST['clie'][0];
    $idprod = $_POST['prod'][0];
    $idpez  = $_POST['pez'][0];
    $idlavo = $_POST['lavo'][0];
    $idtpa = $_POST['tpa'][0];
    $idimba = $_POST['imba'][0];
    $commento = $_POST['testo'][0];
    $numcolli = $_POST['colli'];
    $numstive = $_POST['stive'];
    $misura = $_POST['misura'];
    $orapartenza = $_POST['OraP'];
    insert_thissodl($nsodl, $nord, $fp, $idclie, $idprod, $idpez, $idlavo, $idtpa, $idimba, $commento, $numcolli, $numstive, $misura, $orapartenza);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btCONF'])) {
    update_colore_testata($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && (isset($_POST['btPVIS']) || isset($_POST['btPLIN']) || isset($_POST['btASPE']) || isset($_POST['btCARI']))) {
    reset_lampeggia($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btRESET'])) {
    reset_colore($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && $_POST['btadd'] == 'AOdL') {
    insert_newrSodl($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && $_POST['btdel'] == 'SOdL') {
    delete_rSodl($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && $_POST['btCANC'] == 'C') {
    delete_Sodl($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSODL') {
    update_odl($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'spostariga') {
    sposta_rodl($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'copiaodl') {
    include_once 'OdL-funzioni-2.php';
    copia_odl($_POST);
}
if (isset($_POST['cercagiorno']) && $_POST['cercagiorno']=='Y') {
    $cercanno = date('Y', strtotime($_POST['data']));
    $cercgiornanno = date('z', strtotime($_POST['data']));
    $cercgiornanno = str_pad($cercgiornanno, 3, "0", STR_PAD_LEFT);
    if (BETA) { echo "<pre class='Beta2'>"; echo $cercanno.".".$cercgiornanno; echo "</pre>"; }
    $sodlval = dammi_maxSodl($cercanno, $cercgiornanno);
    $dataform = $_POST['data'];
    $flagcercagiorno = 1;
} else {
    $sodlval = str_pad(dammi_maxSodl($anno, $giornan), 3, "0", STR_PAD_LEFT);
    $dataform = $data;
}
if (BETA) { echo "<pre>"; print_r($arOP); echo "</pre>"; }
?>
<table class="style1" style="width:100%">
    <tr>
        <!--<th></th>-->
        <td class="menu">
            <form method="POST"><input type="hidden" name="cercagiorno" value="Y">
                (<?=$datario?>) Data: <input type="date" name="data" value="<?=$dataform?>" class="super">&nbsp;<input type="submit" name="cerca" value="cerca">
            </form>
        </td>
        <td class="menu">
            <form method="POST"><input type="hidden" name="testo[]" value="<?=$sodlval?>" class="super">
                <button type="submit" name="bt" value="N">Nuovo Ordine di Lavorazione</button> <!--  -->
            </form>
        </td>
    </tr>
</table>
<table class="style1" style="width:100%">
<tr>
    <th>Seq.</th>
    <th>N.Ordine</th>
    <!--<th>F.P.</th>-->
    <th>Cliente</th>
    <th>S</th>
    <th>Prod.</th>
    <th>Pez.</th>
    <th>Lavorazione</th>
    <th>Commenti</th>
    <th>T.Pallet</th>
    <th>Imballo</th>
    <th>Colli</th>
    <th>Stive</th>
    <th>Misura</th>
    <th>Ora Part.</th>
    <th>OP</th>
</tr>
<?php
if ($sodlval > 1) {
    select_Sodl($dataform);
}
function nuovoordine () { //non viene + usata dopo l'introduzione di insert_newSodl
?>
<tr>
    <form method="POST" name="nuovo_record_SODL"> <!-- QUI INIZIA LA FORM -->
    <input type="hidden" name="percorso" value="insertORDINE">
    <td><!-- SODL -->
        <input type="text"     name="nsodl" id="txtst" class="btW" size="3" value="<?=$sodlval?>"></td>
    <td><!-- NORD -->   <input type="text" name="nord" id="nord_txt" class="btW" size="6"></td>
    <td><!-- F.P. -->   <input type="checkbox" name="fp" id="fp_check" class="btW"></td>
    <td><!-- CLIE -->  
        <input type="hidden"   name="clie[]" id="clie_hid">
        <input type="text"     name="clie[]" id="clie_txt" class="btW" autocomplete="off" onkeyup="autocomplet('clie')">
        <div id="clie_list"></div>  
    </td>
    <td><!-- PROD -->   
        <input type="hidden"   name="prod[]" id="prod_hid">
        <input type="text"     name="prod[]" id="prod_txt" class="btW" autocomplete="off" onkeyup="autocomplet('prod')">
        <div id="prod_list"></div> 
    </td>
    <td><!-- PEZ. --> 
        <input type="hidden"   name="pez[]" id="pezz_hid">
        <input type="text"     name="pez[]" id="pezz_txt" class="btW" autocomplete="off" onkeyup="autocomplet('pezz')" size="4">
        <div id="pezz_list"></div> 
    </td>
    <td><!-- LAVO -->  
        <input type="hidden"   name="lavo[]" id="lavo_hid">
        <input type="text"     name="lavo[]" id="lavo_txt" class="btW" autocomplete="off" onkeyup="autocomplet('lavo')" size="8">
        <div id="lavo_list"></div> 
    </td>
    <td><!-- COMM -->   <input type="text" name="testo[]" id="txtst" class="btW" size="10"></td>
    <td><!-- T.PA -->   
        <input type="hidden"   name="tpa[]" id="tpal_hid">
        <input type="text"     name="tpa[]" id="tpal_txt" class="btW" autocomplete="off" onkeyup="autocomplet('tpal')" size="7">
        <div id="tpal_list"></div> 
    </td>
    <td><!-- IMBA -->
        <input type="hidden"   name="imba[]" id="imba_hid">
        <input type="text"     name="imba[]" id="imba_txt" class="btW" autocomplete="off" onkeyup="autocomplet('imba')" size="8">
        <div id="imba_list"></div> 
    </td>
    <td><!-- COLL -->   <input type="text" name="colli" id="txtst" class="btW" size="4"></td>
    <td><!-- STIV -->   <input type="text" name="stive" id="txtst" class="btW" size="4"></td>
    <td><!-- MISU -->   <input type="text" name="misura" id="txtst" class="btW" size="6"></td>
    <td><!-- OPAR -->   
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
    <td><!-- S... -->   <input type="checkbox" name="testo[]" id="s_check" class="btW"></td>
    <td><!-- OP.. -->   <button type="submit" name="bt" class="btG" value="A">INS</button><!--<button type="submit" name="btR" class="btY" value="C">M</button>&nbsp;<button type="submit" name="btR" class="btR" value="C">C</button> 
        <br><button name="bt">PVIS</button><button name="bt">PLIN</button><button name="bt">ASPE</button><button name="bt">CARI</button>--></td>
</form>
</tr>
<?
}
?>
</table>
<? if (isset($_POST['cercagiorno'])) { ?>
<form method="POST" name="copia_odl" id="copia_odl">
    <input type="hidden" name="percorso" value="copiaodl">
    <center><button type="submit" name="copiaodl" class="btGY" value="A">COPIA ODL</button></center>
</form>
<?
}
?>