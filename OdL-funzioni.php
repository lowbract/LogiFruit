<?php
/*
 * &$anno passa puntatore variabile globale 
 *  */
function dammi_maxSodl ($dtaAnno, $giornA) { // restituisce il successivo valore della sequenza degli OdL ATTENZIONE LO PRENDE DALLA TB DELLE RIGHE
    $pdo2 = connetti();
    $sql = "SELECT MAX(sgID) AS ultimoSGID FROM odl_riga WHERE sgAnno = {$dtaAnno} AND sgDoy = {$giornA}";
    $query = $pdo2->prepare($sql);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammi_maxSodl</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['ultimoSGID']) {
        $valore = $list[0]['ultimoSGID'] + 1;
        return $valore;        
    } else {
        return 1;
    }
}
function insert_newSodl ($parametri) { //INSERISCE TESTATA OdL e 1° Riga
    $pdo2 = connetti();
    $sodlval = str_pad(dammi_maxSodl($GLOBALS['anno'], $GLOBALS['giornan']), 3, "0", STR_PAD_LEFT);
    $idsgODL = $GLOBALS['anno'].".".str_pad($GLOBALS['giornan'], 3, "0", STR_PAD_LEFT).".".str_pad($sodlval, 3, "0", STR_PAD_LEFT);
    
    $sql_testata = "INSERT INTO odl_testata SET idsgODL = \"{$idsgODL}\", data = \"{$GLOBALS['data']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newSodl: "; print_r($sql_testata); echo "</pre>\n"; }
    $queryt = $pdo2->prepare($sql_testata);
    $queryt->execute();
    $LASTidTestataODL = $pdo2->lastInsertId();
    
    $sql_riga = "INSERT INTO odl_riga SET idTestataODL = {$LASTidTestataODL}, sgAnno = {$GLOBALS['anno']}, sgDoy = {$GLOBALS['giornan']}, sgID = {$sodlval}";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newrSodl: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
function insert_newrSodl ($parametri) { //INSERISCE TESTATA OdL e 1° Riga
    $pdo2 = connetti();
    $sql_riga = "INSERT INTO odl_riga SET idTestataODL = {$_POST['idTestataODL']}, sgAnno = {$GLOBALS['anno']}, sgDoy = {$GLOBALS['giornan']}, sgID = {$parametri['nsodl']}, "
        . "controller = \"{$GLOBALS['utente']}:INSE\", dataCrea = \"{$GLOBALS['datatempo']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newrSodl: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
function insert_thisSodl ($Fnsodl, $Fnord, $Ffp, $Fidclie, $Fidprod, $Fidpez, $Fidlavo, $Fidtpa, $Fidimba, $Fcommento, $Fnumcolli, $Fnumstive, $Fmisura, $Forapartenza) { //INSERISCE TESTATA OdL e sua Riga
    $pdo2 = connetti();
    $idsgODL = $GLOBALS['anno'].".".str_pad($GLOBALS['giornan'], 3, "0", STR_PAD_LEFT).".".str_pad($Fnsodl, 3, "0", STR_PAD_LEFT);
    $sql_testata = "INSERT INTO odl_testata SET"
            . " idsgODL = \"{$idsgODL}\","
            . " nOrd = \"{$Fnord}\","
            . " FP = \"{$Ffp}\","
            . " CodCliente = \"{$Fidclie}\","
            . " OraPartenza = \"{$Forapartenza}\", "
            . " data = \"{$GLOBALS['data']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sql_testata); echo "</pre>\n"; }
    $queryt = $pdo2->prepare($sql_testata);
    $queryt->execute();
    $LASTidTestataODL = $pdo2->lastInsertId();
    $Fnumstive = str_replace(",", ".", $Fnumstive);
    $sql_riga = "INSERT INTO odl_riga SET idTestataODL = {$LASTidTestataODL}, "
    . "sgAnno = {$GLOBALS['anno']}, "
    . "sgDoy = {$GLOBALS['giornan']}, "
    . "sgID = {$Fnsodl}, "
    . "CodNP = \"{$Fidprod}\", "
    . "CodLav = \"{$Fidlavo}\", "
    . "CodPez = \"{$Fidpez}\", "
    . "CodImb = \"{$Fidimba}\", "
    . "CodPallet = \"{$Fidtpa}\", "
    . "Colli = \"{$Fnumcolli}\", "
    . "Stive = \"{$Fnumstive}\", "
    . "Commenti = \"{$Fcommento}\", "
    . "Misura = \"{$Fmisura}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
function select_Sodl ($dtaparam) {
    $pdossodl = connetti();
    $pdossodlr = connetti();
    $sqlssodl = "SELECT * FROM odl_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null ORDER BY OraPartenza";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqlssodl); echo "</pre>\n"; }
    $query = $pdossodl->prepare($sqlssodl);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']);
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgODL']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqlssodlr = "SELECT * FROM odl_riga WHERE idTestataODL = '{$riga['idTestataODL']}' AND Cancellazione = '000'";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqlssodlr); echo "</pre>\n"; }
        $queryr = $pdossodlr->prepare($sqlssodlr);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idRigaOdL'];
        ?>
        <tr class="t<?=$riga['tColore']?>">
        <form method="POST" name="nuova_riga_SODL" id="fnrsodl<?=$rN?>" action="#<?=$riga['idTestataODL']?>" autocomplete="off">
            <input type="hidden" name="percorso" value="updateSODL">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            <td><? // class="divtoBlink" onmouseover="javascript:lampeggiami('#RBlink','tRR',1200)" ?>
                <? if (BETA) : ?>
                    <!-- Variabili ambiente --><pre class="Beta3"> conta righe $i:<br><?=$i?></pre>
                    <!-- SODL --><pre class="Beta3">idTestataODL:<br><?=$riga['idTestataODL']?></pre>
                    <!-- SODL riga --><pre class="Beta3">idRigaOdL:<br><?=$rigar['idRigaOdL']?></pre>
                <? endif; ?>
                    <a id="<?=$riga['idTestataODL']?>"></a><?=$numar?></td>
            <td><!-- NORD -->   <input type="text" name="nord" id="nord_txt" class="btW" size="6" value="<?=$riga['nOrd']?>"></td>
            <!--<td><!-- F.P. --><!--   <input type="checkbox" name="fp" id="fp_check" class="btW" <? if ($riga['FP']=='on') { echo "checked=\"checked\""; }?>></td>-->
            <td><!-- CLIE -->  
                <input type="hidden"   name="clie[]" id="clie<?=$rN?>_hid" value="<?=$riga['CodCliente']?>"><? $nclie = dammiCliente($riga['CodCliente']); ?>
                <input type="text"     name="clie[]" id="clie<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nclie?>" onkeyup="autocomplet('clie<?=$rN?>')">
                <div id="clie<?=$rN?>_list"></div>  
            </td>
            <? } else { 
                $gaygi = "si";?>
            <input type="hidden" name="percorsoupd" value="RIG">
            <td colspan="3">&nbsp;</td>
            <? } ?>
            <td class="tBl"><!-- S... -->   <? if ($gaygi != "si") { ?><input type="checkbox" name="S[]" id="scheck" class="btW" value="<?=$riga['idTestataODL']?>" form="copia_odl"><? } else { ?>&nbsp;<? } ?> </td>
            <td class="<?=$rigar['rCpro']?>"><!-- PROD -->   
                <input type="hidden"   name="prod[]" id="prod<?=$rN?>_hid" value="<?=$rigar['CodNP']?>"><? $nprod = dammiProdotto($rigar['CodNP']); ?>
                <input type="text"     name="prod[]" id="prod<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nprod?>" onkeyup="autocomplet('prod<?=$rN?>')">
                <div id="prod<?=$rN?>_list"></div> 
            </td>
            <td class="<?=$rigar['rCpez']?>"><!-- PEZ. --> 
                <input type="hidden"   name="pezz[]" id="pezz<?=$rN?>_hid" value="<?=$rigar['CodPez']?>"><? $npez = dammiPezzatura($rigar['CodPez']); ?>
                <input type="text"     name="pezz[]" id="pezz<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$npez?>" onkeyup="autocomplet('pezz<?=$rN?>')" size="4">
                <div id="pezz<?=$rN?>_list"></div> 
            </td>
            <td class="<?=$rigar['rClav']?>"><!-- LAVO -->  
                <input type="hidden"   name="lavo[]" id="lavo<?=$rN?>_hid" value="<?=$rigar['CodLav']?>"><? $nlav = dammiLavorazione($rigar['CodLav']); ?>
                <input type="text"     name="lavo[]" id="lavo<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nlav?>" onkeyup="autocomplet('lavo<?=$rN?>')" size="8">
                <div id="lavo<?=$rN?>_list"></div> 
            </td>
            <td class="<?=$rigar['rCcom']?>"><!-- COMM --><textarea cols="6" rows="2" name="testo[]" id="txtst" class="btW"><?=$rigar['Commenti']?></textarea></td>
            <td class="<?=$rigar['rCtpa']?>"><!-- T.PA -->   
                <input type="hidden"   name="tpal[]" id="tpal<?=$rN?>_hid" value="<?=$rigar['CodPallet']?>"><? $ntpa = dammiPallet($rigar['CodPallet']); ?>
                <input type="text"     name="tpal[]" id="tpal<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$ntpa?>" onkeyup="autocomplet('tpal<?=$rN?>')" size="7">
                <div id="tpal<?=$rN?>_list"></div> 
            </td>
            <td class="<?=$rigar['rCimb']?>"><!-- IMBA -->
                <input type="hidden"   name="imba[]" id="imba<?=$rN?>_hid" value="<?=$rigar['CodImb']?>"><? $nimba = dammiImballo($rigar['CodImb']); ?>
                <input type="text"     name="imba[]" id="imba<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nimba?>" onkeyup="autocomplet('imba<?=$rN?>')" size="8">
                <div id="imba<?=$rN?>_list"></div> 
            </td>
            <td class="<?=$rigar['rCcol']?>"><!-- COLL --><input type="text" name="colli" id="txtst" class="btW" size="6" value="<?=$rigar['Colli']?>"></td>
            <td class="<?=$rigar['rCsti']?>"><!-- STIV --><?php $numstive = str_replace(",", ".", $rigar['Stive']); ?><input type="text" name="stive" id="txtst" class="btW" size="4" value="<?=$numstive?>"></td>
            <td class="<?=$rigar['rCmis']?>"><!-- MISU --><input type="text" name="misura" id="txtst" class="btW" size="6" value="<?=$rigar['Misura']?>"></td>
            <td class="<?=$riga['tColore']?>"><!-- OPAR -->
                <? if ($gaygi != "si") { ?>
                <select name="OraP" id="orapartenza<?=$rN?>" onmouseout="allertami('orapartenza<?=$rN?>')">
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
                <? } else { ?>
                &nbsp;
                <? } ?> 
                <script> selezionami('<?=$posizcheck?>','orapartenza<?=$rN?>'); </script>
            </td>
            <input type="hidden" name="idTestataODL" value="<?=$riga['idTestataODL']?>">
        </form>
        <form method="POST" name="spostariga" id="spstr<?=$rN?>" action="#<?=$riga['idTestataODL']?>" autocomplete="off"> <!-- SPOSTA LA RIGA IN ALTRO ORDINE -->
            <input type="hidden" name="percorso" value="spostariga">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
            <input type="hidden" name="an" value="<?=$an?>">
            <input type="hidden" name="dedlan" value="<?=$dedlan?>">
            <input type="hidden" name="numar" value="<?=$numar?>">
        </form>
        <form method="POST" action="#<?=$riga['idTestataODL']?>" autocomplete="off">
            <input type="hidden" name="percorso" value="updateSTATUS">
            <td><!-- OP.. --> 
                <? if ($gaygi != "si") { // Qui differenzio i bottoni per la riga di testa e la riga delle righe OdL ?>
                <button type="submit" name="btadd" class="btG" value="AOdL">+</button>
                <? } else { ?>
                    <button type="submit" name="btdel" class="btO" value="SOdL">-</button>
                <? } ?> 
                <!--<button type="submit" name="btMODI" class="btY" value="M">M</button>-->
                <!--<? if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C">C</button><? } ?> -->
            <tr><!-- class="t<?=$riga['tColore']?>" -->
                <td class="t<?=$riga['tColore']?>"><? if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C">C</button><? } ?></td>
                <td colspan="3" class="t<?=$riga['tColore']?>"><? if ($gaygi != "si") { ?><button name="btCONF" class="bt<? if ($riga['tColore'] == 'B') { $comodo = "TOGLI"; $cmd2 = ""; ?>W<?} else { $comodo = ""; $cmd2 = "disabled"; ?>B<?}?>" value="<? if ($riga['tColore'] == 'B') {?>W<?} else {?>B<?}?>"><?=$comodo?> CONFERMA </button><? } ?></td>
                <td colspan="10" align="right" class="<?=$rigar['rColore']?>">
                    <small>Odl: <?=$an?>.<?=$dedlan?>.</small><input type="hidden" name="nsodl" value="<?=$numar?>"><input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">
                    <button type="submit" name="bt" class="btG" value="A" form="fnrsodl<?=$rN?>">AGGIORNA</button><button name="btRESET" class="btW">RESET</button>&nbsp;<button name="btPVIS" class="btY" <?=$cmd2?>>PVIS</button><button name="btPLIN" class="btO" <?=$cmd2?>>PLIN</button><button name="btASPE" class="btGY" <?=$cmd2?>>ASPE</button><button name="btCARI" class="btLilla" <?=$cmd2?>>CARI</button></td>
                </td>
                <td colspan="2" class="t<?=$riga['tColore']?>"></td>
            </tr>
            <input type="hidden" name="rColore" value="<?=$rigar['rColore']?>">
            <input type="hidden" name="idTestataODL" value="<?=$riga['idTestataODL']?>">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
        </form>
        </tr>
        <? 
        }
        if (TRASPORTO) { ?>
        <tr><td colspan="15">TRASPORTO<br>(in sviluppo non usare per ora)
            
        </td>
        </tr>
        <? } ?>
        <tr class="tBl"><td colspan="16">&nbsp;</td></tr>
        <tr class="tBl"><td colspan="16">&nbsp;</td></tr>
            <? 
    }
}
function update_odl ($dammiPOST) {
    // estraggo
    lampeggia($dammiPOST);
    $pdoriga = connetti();
    $stive = str_replace(",", ".", $dammiPOST['stive']);
    $sql_riga = "UPDATE odl_riga SET "
    . "CodNP = \"{$dammiPOST['prod'][0]}\", "
    . "CodLav = \"{$dammiPOST['lavo'][0]}\", "
    . "CodPez = \"{$dammiPOST['pezz'][0]}\", "
    . "CodImb = \"{$dammiPOST['imba'][0]}\", "
    . "CodPallet = \"{$dammiPOST['tpal'][0]}\", "
    . "Colli = \"{$dammiPOST['colli']}\", "
    . "Stive = \"{$stive}\", "
    . "Commenti = \"{$dammiPOST['testo'][0]}\", "
    . "Misura = \"{$dammiPOST['misura']}\", "
    . "rColore = \"tR\", "    // sbrilluccichio . "rColore = \"class2blink\", "   altrimenti . "rColore = \"tR\", "
 /* . "rCpro = \"R\", "
    . "rCpez = \"R\", "
    . "rClav = \"R\", "
    . "rCcom = \"R\", "
    . "rCtpa = \"R\", "
    . "rCimb = \"R\", "
    . "rCcol = \"R\", "
    . "rCsti = \"R\", "
    . "rCmis = \"R\" "
*/
    . "controller = \"{$GLOBALS['utente']}:UPDA\", "
    . "dataLastMod = \"{$GLOBALS['datatempo']}\" "
    . "WHERE idRigaOdL = \"{$dammiPOST['idrigaodl']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sql_riga); echo "</pre>\n"; }
    $quriga = $pdoriga->prepare($sql_riga);
    $quriga->execute();
    if ($_POST['percorsoupd']=='TES+RIG') {
        $sql_testa = "SELECT idTestataODL FROM odl_riga WHERE idRigaOdL = \"{$dammiPOST['idrigaodl']}\" LIMIT 1";
        $qstesta = $pdoriga->prepare($sql_testa);
        $qstesta->execute();
        $risultato = $qstesta->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\"><b>update_odl SELECT:</b><br>"; print_r($risultato); echo "</pre>\n"; }
        $sqltesta = "UPDATE odl_testata SET "
                . "nOrd = \"{$dammiPOST['nord']}\", "
                . "FP = \"{$dammiPOST['fp']}\", "
                . "OraPartenza = \"{$dammiPOST['OraP']}\", "
                . "CodCliente = \"{$dammiPOST['clie'][0]}\" "
                . "WHERE idTestataODL = \"{$risultato[0]['idTestataODL']}\"";
        if(BETA2) { echo "<pre class=\"Beta2\"><b>Query update testata:</b><br>"; print_r($sqltesta); echo "</pre>\n"; }
        $qutesta = $pdoriga->prepare($sqltesta);
        $qutesta->execute();
    }
}
function update_colore_riga ($dammiPOST) { // aggiorna il campo colore principale della riga
    $pdo = connetti();
    $sql = "UPDATE odl_riga SET "
    . "tColore = \"{$dammiPOST['rColore']}\", "
    . "WHERE idTestataODL = \"{$dammiPOST['idTestataODL']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_testata: </b><br>"; print_r($sql_riga); echo "</pre>\n"; }
    $que = $pdo->prepare($sql);
    $que->execute();
}
function update_colore_testata ($dammiPOST) { // modifica il colore della testata in base alla pressione dei giusti bottoni
    $pdo = connetti();
    $sql = "UPDATE odl_testata SET "
    . "tColore = \"{$dammiPOST['btCONF']}\" "
    . "WHERE idTestataODL = \"{$dammiPOST['idTestataODL']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_testata: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo->prepare($sql);
    $que->execute();
}
function select_riga ($param) {
    $pdoriga = connetti();
    $sqlselectriga = "SELECT * FROM odl_riga WHERE idRigaOdL = \"{$param['idrigaodl']}\" LIMIT 1";
    $qsriga = $pdoriga->prepare($sqlselectriga);
    $qsriga->execute();
    $rsriga = $qsriga->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\"><b>select_riga:</b><br>"; print_r($rsriga); echo "</pre>\n"; }
}
function lampeggia($par){ // funzione che controlla il lampeggio dei campi modificati
    $pdo = connetti();
    $sql = "SELECT * FROM odl_riga WHERE idRigaOdL = '{$par['idrigaodl']}' LIMIT 1";
    if(BETA2) { echo "<pre class=\"Beta2\">function lampeggia: "; print_r($sql); echo "</pre>\n"; }
    $que = $pdo->prepare($sql);
    $que->execute();
    $liz = $que->fetchAll(PDO::FETCH_ASSOC);
    $lis = $liz[0]; // denidio l'array
    if(BETA3) { echo "<pre class=\"Beta3\">function lampeggia: "; print_r($lis); echo "</pre>\n"; }
    $sqlu = "UPDATE odl_riga SET ";
    $sqlu .= ($lis['CodNP'] != $par['prod'][0]) ? " rCpro = \"tR\", " : ""; 
    $sqlu .= ($lis['CodLav'] != $par['lavo'][0]) ? " rClav = \"tR\", " : "";
    $sqlu .= ($lis['Colli'] != $par['colli']) ? " rCcol = \"tR\", " : "";
    $sqlu .= ($lis['Stive'] != $par['stive']) ? " rCsti = \"tR\", " : "";
    $sqlu .= ($lis['Commenti'] != $par['testo'][0]) ? " rCcom = \"tR\", " : "";
    if (BETA) {echo "<pre class=\"Beta\">function lampeggia variabili: {$lis['Commenti']} != {$par['testo'][0]} ? </pre>\n";}
    $sqlu .= ($lis['CodPez'] != $par['pezz'][0]) ? " rCpez = \"tR\", " : "";
    $sqlu .= ($lis['CodImb'] != $par['imba'][0]) ? " rCimb = \"tR\", " : "";
    $sqlu .= ($lis['CodPallet'] != $par['tpal'][0]) ? " rCtpa = \"tR\", " : "";
    $sqlu .= ($lis['Misura'] != $par['misura']) ? " rCmis = \"tR\", " : "";
    /* LAMPEGGIA
    $sqlu .= ($lis['CodNP'] != $par['prod'][0]) ? " rCpro = \"class2blink\", " : ""; 
    $sqlu .= ($lis['CodLav'] != $par['lavo'][0]) ? " rClav = \"class2blink\", " : "";
    $sqlu .= ($lis['Colli'] != $par['colli']) ? " rCcol = \"class2blink\", " : "";
    $sqlu .= ($lis['Stive'] != $par['stive']) ? " rCsti = \"class2blink\", " : "";
    $sqlu .= ($lis['Commenti'] != $par['testo'][0]) ? " rCcom = \"class2blink\", " : "";
    if (BETA) {echo "<pre class=\"Beta\">function lampeggia variabili: {$lis['Commenti']} != {$par['testo'][0]} ? </pre>\n";}
    $sqlu .= ($lis['CodPez'] != $par['pezz'][0]) ? " rCpez = \"class2blink\", " : "";
    $sqlu .= ($lis['CodImb'] != $par['imba'][0]) ? " rCimb = \"class2blink\", " : "";
    $sqlu .= ($lis['CodPallet'] != $par['tpal'][0]) ? " rCtpa = \"class2blink\", " : "";
    $sqlu .= ($lis['Misura'] != $par['misura']) ? " rCmis = \"class2blink\", " : "";
     */
    $sqlu .= "controller = \"{$GLOBALS['utente']}:MODI\", ";
    $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sqlu .= "WHERE idRigaOdL = \"{$par['idrigaodl']}\"";
    if(BETA3) { echo "<pre class=\"Beta3\">function lampeggia: "; print_r($sqlu); echo "</pre>\n"; }
    $queu = $pdo->prepare($sqlu);
    $queu->execute();
}
function reset_lampeggia($par) { // restituisce la classe di colore per la riga richiesta e il campo specifico
    $pdo = connetti();
    $sqlu = "UPDATE odl_riga SET ";
    if (isset($par['btPVIS'])) { 
        $col = "tY";
        $flag = "PVIS";
        $sqlu .= " rColore = \"{$col}\", ";
    } elseif (isset($par['btPLIN'])) { 
        $col = "tO";
        $flag = "PLIN";
        $sqlu .= " rColore = \"{$col}\", ";
    } elseif (isset($par['btASPE'])) { 
        $col = "tG";
        $flag = "ASPE";
        $sqlu .= " rColore = \"{$col}\", ";
    } elseif (isset($par['btCARI'])) { 
        $col = "tLilla";
        $flag = "CARI";
        $sqlu .= " rColore = \"{$col}\", ";
    } elseif (isset($par['btRESET'])) { 
        $col = $par['rColore']; 
    } else { $col = "tWo"; }
    $sqlu .= " rCpro = \"{$col}\", ";
    $sqlu .= " rClav = \"{$col}\", ";
    $sqlu .= " rCcol = \"{$col}\", ";
    $sqlu .= " rCsti = \"{$col}\", ";
    $sqlu .= " rCcom = \"{$col}\", ";
    $sqlu .= " rCpez = \"{$col}\", ";
    $sqlu .= " rCimb = \"{$col}\", ";
    $sqlu .= " rCtpa = \"{$col}\", ";
    $sqlu .= " rCmis = \"{$col}\", ";
    $sqlu .= "controller = \"{$GLOBALS['utente']}:{$flag}\", ";
    $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sqlu .= "WHERE idRigaOdL = \"{$par['idrigaodl']}\"";
    if(BETA3) { echo "<pre class=\"Beta3\">function reset_lampeggia: "; print_r($sqlu); echo "</pre>\n"; }
    $queu = $pdo->prepare($sqlu);
    $queu->execute();
}
function reset_colore($par) { // RESETTA COLORI RIGA
    $pdo = connetti();
    $sqlu = "UPDATE odl_riga SET ";
    $col = "tW";
    $flag = "RESE";
    $sqlu .= " rColore = \"{$col}\", ";
    $sqlu .= " rCpro = \"{$col}\", ";
    $sqlu .= " rClav = \"{$col}\", ";
    $sqlu .= " rCcol = \"{$col}\", ";
    $sqlu .= " rCsti = \"{$col}\", ";
    $sqlu .= " rCcom = \"{$col}\", ";
    $sqlu .= " rCpez = \"{$col}\", ";
    $sqlu .= " rCimb = \"{$col}\", ";
    $sqlu .= " rCtpa = \"{$col}\", ";
    $sqlu .= " rCmis = \"{$col}\", ";
    $sqlu .= "controller = \"{$GLOBALS['utente']}:{$flag}\", ";
    $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sqlu .= "WHERE idRigaOdL = \"{$par['idrigaodl']}\"";
    if(BETA3) { echo "<pre class=\"Beta3\">function reset_lampeggia: "; print_r($sqlu); echo "</pre>\n"; }
    $queu = $pdo->prepare($sqlu);
    $queu->execute();
}
function delete_rSodl($par) { // cancella riga con UPDATE Cancellazione a 1
    $pdo = connetti();
    $sqlu = "UPDATE odl_riga SET ";
    $flag = "CANC";
    $sqlu .= "Cancellazione = \"001\", ";
    $sqlu .= "controller = \"{$GLOBALS['utente']}:{$flag}\", ";
    $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sqlu .= "WHERE idRigaOdL = \"{$par['idrigaodl']}\"";
    if(BETA3) { echo "<pre class=\"Beta3\">function delete_rSodl: "; print_r($sqlu); echo "</pre>\n"; }
    $queu = $pdo->prepare($sqlu);
    $queu->execute();
}
function delete_Sodl($par) { // cancella testata con UPDATE Cancellazione a 1
    $pdo = connetti();
    $sqlu = "UPDATE odl_testata SET ";
    $flag = "CANC";
    $sqlu .= "Cancellazione = \"001\", ";
    $sqlu .= "controller = \"{$GLOBALS['utente']}:{$flag}\", ";
    $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sqlu .= "WHERE idTestataODL = \"{$par['idTestataODL']}\"";
    if(BETA3) { echo "<pre class=\"Beta3\">function delete_Sodl (TESTATA): "; print_r($sqlu); echo "</pre>\n"; }
    $queu = $pdo->prepare($sqlu);
    $queu->execute();
}
function sposta_rodl($par) { // sposta una riga da una testata all'altra
    $pdo = connetti();
    $idsodl = "{$par['an']}.{$par['dedlan']}.{$par['nsodl']}";
    $sqT = "SELECT idTestataODL FROM odl_testata WHERE idsgODL = '{$idsodl}' AND Cancellazione Is Null";
    if(BETA2) { echo "<pre class=\"Beta2\"> sposta_rodl: "; print_r($sqT); echo "</pre>\n"; }
    $que= $pdo->prepare($sqT);
    $que->execute();
    $res = $que->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\"> sposta_rodl: "; print_r($res); echo "</pre>\n"; }
    if (isset($res[0]['idTestataODL'])) {
        $testata = $res[0]['idTestataODL'];
        $sqlu = "UPDATE odl_riga SET ";
        $flag = "SPOR";
        $sqlu .= "idTestataODL = \"{$testata}\", ";
        $sqlu .= "controller = \"{$GLOBALS['utente']}:{$flag}\", ";
        $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
        $sqlu .= "WHERE idRigaOdL = \"{$par['idrigaodl']}\"";
        if(BETA3) { echo "<pre class=\"Beta3\">function sposta_rodl: "; print_r($sqlu); echo "</pre>\n"; }
        $queu = $pdo->prepare($sqlu);
        $queu->execute();
    }
}
function rowcheck4value ($rid, $rfi) { // TABELLA RIGHE: restituisce il valore del campo richiesto
    $pSR = connetti();
    $sSR = "SELECT {$rfi} FROM odl_riga WHERE idRigaOdL = {$rid}";
    if(BETA2) { echo "<pre class=\"Beta2\"> rowcheck4value: sSR "; print_r($sSR); echo "</pre>\n"; }
    $qSR= $pSR->prepare($sSR);
    $qSR->execute();
    $rSR = $qSR->fetchAll(PDO::FETCH_COLUMN);
    if(BETA3) { echo "<pre class=\"Beta3\"> rowcheck4value: rSR "; print_r($rSR); echo "</pre>\n"; }
    return $rSR[0];
}