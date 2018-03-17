<?php
function dammi_maxStra ($dtaAnno, $giornA) { // restituisce il successivo valore della sequenza dei trasporti giornalieri ATTENZIONE LO PRENDE DALLA TB DELLE RIGHE
    $pdo2 = connetti();
    $sql = "SELECT MAX(sgID) AS ultimoSGID FROM tra_riga WHERE sgAnno = {$dtaAnno} AND sgDoy = {$giornA}";
    $query = $pdo2->prepare($sql);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammi_maxStra</b><br>\n"; print_r($list); echo "</pre>"; }
    if ($list[0]['ultimoSGID']) {
        $valore = $list[0]['ultimoSGID'] + 1;
        return $valore;        
    } else {
        return 1;
    }
}
function TraSodlOperativa ($dtaparam) { // questo fa il select dei trasporti non associati
    if (0) echo "!!!_".$GLOBALS['_SESSION']['Username']."_!!!";
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM odl_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND tColore = 'B' AND Assoc = 00000000000000000000 ORDER BY OraPartenza";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']);
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgODL']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM odl_riga WHERE idTestataODL = '{$riga['idTestataODL']}' AND Cancellazione = '000'";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idRigaOdL'];
        ?> 
        <tr class="t<?=$riga['tColore']?>">
        <form method="POST" name="nuova_riga_TRA" id="fnrsodl<?=$rN?>">
            <input type="hidden" name="percorso" value="newrowTRA">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            <!-- ASTR -->
            <td class="<?=$rigar['rCvett']?>">   
                <input type="hidden"   name="astr[]" id="astr<?=$rN?>_hid" value="">
                <input type="text"     name="astr[]" id="astr<?=$rN?>_txt" class="btW" autocomplete="off" onkeyup="autocomplet('astr<?=$rN?>')">
                <div id="astr<?=$rN?>_list"></div> 
            </td>
            <!-- CLIE -->
            <td id="op">
                <? $nclie = dammiCliente($riga['CodCliente']); ?>
                <p id="ope"><?=$nclie?></p>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <input type="hidden" name="percorsoupd" value="RIG">
            <td class="tbgray" colspan="2"></td>
            <? } ?>
            <!-- STIV -->
            <td id="op" class="<?=$rigar['rCsti']?>"><?php $numstive = str_replace(",", ".", $rigar['Stive']); ?><!--<input type="text" name="stive" id="txtst" class="btW" size="4" value="<?=$numstive?>">--><p id="ope"><?=$numstive?></p></td>
            <!-- T.PA -->
            <td id="op" class="<?=$rigar['rCtpa']?>">   
                <? $ntpa = dammiPallet($rigar['CodPallet']); ?>
                <p id="ope"><?=$ntpa?></p>
            </td>
            <!-- PROD --> 
            <td class="<?=$rigar['rCpro']?>">  
                <? $nprod = dammiProdotto($rigar['CodNP']); ?>
                <p id="ope"><?=$nprod?></p>
            </td>
            <!-- IMBA -->
            <td id="op" class="<?=$rigar['rCimb']?>">
                <? $nimba = dammiImballo($rigar['CodImb']); ?>
                <p id="ope"><?=$nimba?></p>
            </td>
            <!-- MISU -->
            <td id="op" class="<?=$rigar['rCmis']?>"><p id="ope"><?=$rigar['Misura']?></p></td>
            <!-- COLL -->
            <td id="op" class="<?=$rigar['rCcol']?>"><p id="ope"><?=$rigar['Colli']?></p></td>
            <!-- OPAR -->
            <? if ($gaygi != "si") { ?>
            <td id="op" class="<?=$riga['tColore']?>">
                <p id="ope"><?=$riga['OraPartenza']?></p>                
                <script> selezionami('<?=$posizcheck?>','orapartenza<?=$rN?>'); </script>
            </td>
            <? } else { ?>
                <td class="tbgray"></td>
            <? } ?>             
        </tr>
        <? 
        }
        ?>
            <tr class="tbgray"><!-- class="t<?//=$riga['tColore']?>" -->
                <td colspan="2" class="tbgray"></td>
                <td id="op" colspan="9" align="right" class="<?=$rigar['rColore']?>">
                    <small>Odl: <?=$an?>.<?=$dedlan?>.</small><?=$numar?><input type="hidden" name="nsodl" value="<?=$numar?>"><!--<input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">-->
                    <button name="btASSO" class="btY">ASSOCIA</button>
                </td>
                <td colspan="1" class="tbgray"></td>
            </tr>
            <input type="hidden" name="rColore" value="<?=$rigar['rColore']?>">
            <input type="hidden" name="idTestataODL" value="<?=$riga['idTestataODL']?>">
        </form>
        <tr class="tbgray"><td colspan="13" class="vuota"></td></tr><? 
    }
}
function TraSelect ($dtaparam) { //
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM tra_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null ORDER BY OraPartenza";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']); // cerca la chiave del menù a tendina orari partenza per riposizionarsi su quello quando visualizza
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgTRA']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM tra_riga WHERE idTra = '{$riga['idTra']}' AND Cancellazione Is Null ORDER BY crono";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idTraRiga'];
            //$rN = ltrim($rigar['idTraRiga'], '0'); // toglie gli zerofill
        ?>
        <tr class="t<?=$riga['tColore']?>">
        <form method="POST" name="nuova_riga" id="fnrs<?=$rN?>" action="#<?=$riga['idTra']?>" autocomplete="off">
            <input type="hidden" name="percorso" value="updateTRA">
            <input type="hidden" name="idriga" value="<?=$rigar['idTraRiga']?>">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            <!-- TRAS -->
            <td><? // class="divtoBlink" onmouseover="javascript:lampeggiami('#RBlink','tRR',1200)" ?>
                <? if (BETA) : ?>
                    <!-- Variabili ambiente --><pre class="Beta3"> conta righe $i:<br><?=$i?></pre>
                    <!-- TRA --><pre class="Beta3">idTra:<br><?=$riga['idTra']?></pre>
                    <!-- Tra riga --><pre class="Beta3">idTraRiga:<br><?=$rigar['idTraRiga']?></pre>
                <? endif; ?>
                    <a id="<?=$riga['idTra']?>"></a><small><?=$an?>.<?=$dedlan?>.</small><br><b><?=$numar?></b>
            </td>
            <!-- OPAR -->
            <td class="<?=$riga['tColore']?>">
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
            <!-- VETT -->
            <td class="<?=$rigar['rCvett']?>">   
                <input type="hidden"   name="vett[]" id="vett<?=$rN?>_hid" value="<?=$riga['CodVett']?>"><? $nvett = dammiVettore($riga['CodVett']); ?>
                <input type="text"     name="vett[]" id="vett<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nvett?>" onkeyup="autocomplet('vett<?=$rN?>')">
                <div id="vett<?=$rN?>_list"></div> 
            </td>
            <!-- PORT -->
            <td class="<?=$rigar['rCport']?>"><input type="text" name="portata" id="txtst" class="btW" size="6" value="<?=$riga['portata']?>"></td>
            <!-- AUTI -->
            <td class="<?=$rigar['rCauti']?>">   
                <input type="hidden" name="auti[]" id="auti<?=$rN?>_hid" value="<?=$riga['CodAut']?>"><? $nauti = dammiAutista($riga['CodAut']); ?>
                <input type="text"   name="auti[]" id="auti<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nauti['Cognome']?>" onkeyup="autocomplet('auti<?=$rN?>')">
                <input type="text"   name="auti[]" id="auti<?=$rN?>_nom" class="btZ" autocomplete="off" value="<?=$nauti['Nome']?>" disabled><br>
                t1(<input type="text"   name="auti[]" id="auti<?=$rN?>_te1" class="btZ" autocomplete="off" size="13" value="<?=$nauti['Telefono1']?>" disabled>)<br>
                t2(<input type="text"   name="auti[]" id="auti<?=$rN?>_te2" class="btZ" autocomplete="off" size="13" value="<?=$nauti['Telefono2']?>" disabled>)
                <div id="auti<?=$rN?>_list"></div> 
            </td>
            <!-- NOTE --> 
            <td>  
                <textarea name="note[]" id="note<?=$rN?>_txt" class="btW" autocomplete="off"><?=$riga['Note']?></textarea>  
            </td>
            <!-- ARRI --> 
            <td <?=($riga['Arrivato'] ? "class=\"class2blink\"" : "")?>>
                <input type="checkbox" name="arrivato[]" value="1" <? if ($riga['Arrivato']) echo "checked"; ?>/>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <input type="hidden" name="percorsoupd" value="RIG">
            <td colspan="8">&nbsp;</td>
            <? } ?>
        </form>
        <form method="POST" name="spostariga" id="spstr<?=$rN?>" action="#<?=$riga['idTra']?>" autocomplete="off"> <!-- SPOSTA LA RIGA IN ALTRO ORDINE -->
            <input type="hidden" name="percorso" value="spostariga">
            <input type="hidden" name="idTra" value="<?=$riga['idTra']?>">
            <input type="hidden" name="an" value="<?=$an?>">
            <input type="hidden" name="dedlan" value="<?=$dedlan?>">
            <input type="hidden" name="numar" value="<?=$numar?>">
        </form>
        <form method="POST" action="#<?=$riga['idTra']?>" autocomplete="off">
            <input type="hidden" name="percorso" value="updateSTATUS">
            <td colspan="10" class="t<?=$rigar['rColore']?>"><!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!--<?=$rigar['idTraRiga']?>-->
                Crono <input type="text" name="crono" id="crono<?=$rN?>_nom" class="btZ" autocomplete="off" value="<?=$rigar['crono']?>">
                <button type="submit" name="btCRONO" class="btGY">CRONO</button>
                <button type="submit" name="btDISAS" class="btR">DISASSOCIA</button><br>
                    <table class="tWo" style="width:100%">
                    <tr>
                        <!--<th>Seq.</th>-->
                        <!--<th>Crono</th>-->
                        <th>Cliente</th>
                        <!--<th>S</th>-->
                        <!--<th>Pez.</th>-->
                        <!--<th>Lavorazione</th>-->
                        <!--<th>Commenti</th>-->
                        <th>Stive</th>
                        <th>T.Pallet</th>
                        <th>Prod.</th>
                        <th>Imballo</th>        
                        <th>Misura</th>
                        <th>Colli</th>
                        <th>Ora Part.</th>
                        <!--<th>OP</th>-->
                    </tr>
                <?
                rigTraAssoc($dtaparam,$riga['idTra'],$rigar['idTestataODL']);
                ?>
                    </table>
            </td>
            <tr><!-- class="t<?=$riga['tColore']?>" -->
                <td class="t<?=$riga['tColore']?>">
                    <? if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C" <? echo (dammi_rigaTra_bol($riga['idTra']) ? "" : 'disabled'); ?>>C</button><? } ?>
                </td>
                <td colspan="6" class="t<?=$riga['tColore']?>">
                    <? if ($gaygi != "si") { ?>
                    <button name="btCONF" class="bt<? if ($riga['tColore'] == 'B' || $riga['tColore'] == 'Black') { $comodo = "TOGLI"; $cmd2 = ""; ?>W<?} else { $comodo = ""; $cmd2 = "disabled"; ?>B<?}?>" value="<? if ($riga['tColore'] == 'B') {?>W<?} else {?>B<?}?>"><?=$comodo?> CONFERMA </button>
                        <button type="submit" name="bt" class="btG" value="A" form="fnrs<?=$rN?>">AGGIORNA</button> <button name="btPARTITO" class="btBlack" <?=$cmd2?>>PARTITO!</button>
                        <? } ?> 
                </td>
                <td colspan="10" align="right" class="t<?=$riga['tColore']?>">
                    <small>Trasporto# <?=$an?>.<?=$dedlan?>.<?=$numar?> r# <?=$rigar['idTraRiga']?></small>
                    <input type="hidden" name="nsodl" value="<?=$numar?>">
                    <!--<input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">-->
                    <!-- <button name="btRESET" class="btW">RESET</button>&nbsp;-->
                    <button name="btCARI" class="btLilla" <?=$cmd2?>>CARI</button>
                </td>
                <!--<td colspan="2" class="t<?=$riga['tColore']?>"></td>-->
            </tr>
            <input type="hidden" name="rColore" value="<?=$rigar['rColore']?>">
            <input type="hidden" name="idTra" value="<?=$riga['idTra']?>">
            <input type="hidden" name="idTraRiga" value="<?=$rigar['idTraRiga']?>">
            <input type="hidden" name="idTestataODL" value="<?=$rigar['idTestataODL']?>">
        </form>
        </tr>
        <? 
        }
        ?><tr><td colspan="17" class="tBl">xxx</td></tr><?
    }
}
function insert_newTra ($parametri) { //INSERISCE TESTATA Trasporti
    $pdo2 = connetti();
    $sodlval = str_pad(dammi_maxStra($GLOBALS['anno'], $GLOBALS['giornan']), 3, "0", STR_PAD_LEFT);
    $idsgODL = $GLOBALS['anno'].".".str_pad($GLOBALS['giornan'], 3, "0", STR_PAD_LEFT).".".str_pad($sodlval, 3, "0", STR_PAD_LEFT);
    
    $sql_testata = "INSERT INTO tra_testata SET idsgTRA = \"{$idsgODL}\", data = \"{$GLOBALS['data']}\", tColore = \"W\"";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newTra: "; print_r($sql_testata); echo "</pre>\n"; }
    $queryt = $pdo2->prepare($sql_testata);
    $queryt->execute();
    $LASTidTestataODL = $pdo2->lastInsertId();
    
    $sql_riga = "INSERT INTO tra_riga SET idTra = {$LASTidTestataODL}, sgAnno = {$GLOBALS['anno']}, sgDoy = {$GLOBALS['giornan']}, sgID = {$sodlval}"; //, rColore = \"W\"
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newTra_riga: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
function dammi_rigaTra ($idTra) { // restituisce l'ultimo valore di riga 
    $pdo2 = connetti();
    $sql = "SELECT idTraRiga FROM tra_riga WHERE idTra = {$idTra} AND idTestataODL = 0";
    $query = $pdo2->prepare($sql);
    $query->execute();
    $flag = $query->rowCount();
    $list = $query->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammi_rigaTra</b><br>\n"; print_r($list); echo "<br>flag: {$flag}</pre>"; }
    if ($flag) {
        return array("UPDATE", "WHERE idTraRiga = {$list[0]['idTraRiga']}");        
    } else {
        return array("INSERT", "");
    }
}
function insert_Trarow ($idTra,$idsgTRA,$idTestataODL){
    $pdo2 = connetti();
    list($an, $dedlan, $numar) = preg_split("/\./", $idsgTRA);
    $operando = dammi_rigaTra($idTra);
    $sql_riga = "{$operando[0]} tra_riga SET idTra = {$idTra}, sgAnno = {$an}, sgDoy = {$dedlan}, sgID = {$numar}, idTestataODL = {$idTestataODL}, crono = 0, controller = \"{$GLOBALS['utente']}:{$operando[0]}\", dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sql_riga .= $operando[1];
    if(BETA2) { echo "<pre class=\"Beta2\">insert_Trarow: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
    
    $sql_riga = "UPDATE odl_testata SET Assoc = {$idTra}, controller = \"{$GLOBALS['utente']}:TRASSOC\", dataLastMod = \"{$GLOBALS['datatempo']}\" WHERE idTestataODL = {$idTestataODL}";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_Trarow update odl_testata: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();  
    
    $sql_riga = "UPDATE tra_testata SET tColore = 'tR' WHERE idTra = {$idTestataODL}";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_Trarow update tra_testata: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute(); 
}
function update_tra ($dammiPOST) { // dedicata al Sommo
    // estraggo
    //lampeggia($dammiPOST);
    $pdoriga = connetti();
    $stive = str_replace(",", ".", $dammiPOST['stive']);
    $sql_riga = "UPDATE tra_riga SET "
 /* . "ciccio = \"{$dammiPOST['prod'][0]}\", "
    . "CodLav = \"{$dammiPOST['lavo'][0]}\", "
    . "CodPez = \"{$dammiPOST['pezz'][0]}\", "
    . "CodImb = \"{$dammiPOST['imba'][0]}\", "
    . "CodPallet = \"{$dammiPOST['tpal'][0]}\", "
    . "Colli = \"{$dammiPOST['colli']}\", "
    . "Stive = \"{$stive}\", "
    . "Commenti = \"{$dammiPOST['testo'][0]}\", "
    . "Misura = \"{$dammiPOST['misura']}\", "
    . "rColore = \"class2blink\", "   
    . "rCpro = \"R\", "
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
    . "WHERE idTraRiga = \"{$dammiPOST['idriga']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sql_riga); echo "</pre>\n"; }
    $quriga = $pdoriga->prepare($sql_riga);
    $quriga->execute();
    if ($_POST['percorsoupd']=='TES+RIG') {
        $sql_testa = "SELECT idTra FROM tra_riga WHERE idTraRiga = \"{$dammiPOST['idriga']}\" LIMIT 1";
        $qstesta = $pdoriga->prepare($sql_testa);
        $qstesta->execute();
        $risultato = $qstesta->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\"><b>update tra_riga SELECT:</b><br>"; print_r($risultato); echo "</pre>\n"; }
        $sqltesta = "UPDATE tra_testata SET "
                . "CodVett = \"{$dammiPOST['vett'][0]}\", "
                . "CodAut = \"{$dammiPOST['auti'][0]}\", "
                . "stive = \"{$dammiPOST['stive']}\", "
                . "portata = \"{$dammiPOST['portata']}\", "
                . "Note = \"{$dammiPOST['note'][0]}\", "
                . "OraPartenza = \"{$dammiPOST['OraP']}\", "
                . "Arrivato = \"{$dammiPOST['arrivato'][0]}\" "
                . "WHERE idTra = \"{$risultato[0]['idTra']}\"";
        if(BETA2) { echo "<pre class=\"Beta2\"><b>Query update testata:</b><br>"; print_r($sqltesta); echo "</pre>\n"; }
        $qutesta = $pdoriga->prepare($sqltesta);
        $qutesta->execute();
    }
}
function update_colore_testata_tra ($dammiPOST) { // modifica il colore della testata in base alla pressione dei giusti bottoni
    $pdo = connetti();
    $sql = "UPDATE tra_testata SET "
    . "tColore = \"{$dammiPOST['btCONF']}\" "
    . "WHERE idTra = \"{$dammiPOST['idTra']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_testata: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo->prepare($sql);
    $que->execute();
}
function rigTraAssoc ($dtaparam, $idTra, $idTestataODL) { // questo fa il select dei trasporti non associati
    if (0) echo "!!!_".$GLOBALS['_SESSION']['Username']."_!!!";
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM odl_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND tColore = 'B' AND Assoc = {$idTra} AND idTestataODL = {$idTestataODL}";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']);
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgODL']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM odl_riga WHERE idTestataODL = '{$riga['idTestataODL']}' AND Cancellazione = '000'";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idRigaOdL'];
        ?> 
        <tr class="t<?=$riga['tColore']?>">
            <? if ($i++ < 1) { ?>
            <!-- CLIE -->
            <td id="op">
                <? $nclie = dammiCliente($riga['CodCliente']); ?>
                <p id="ope"><?=$nclie?></p>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <td class="tbgray" colspan="1"></td>
            <? } ?>
            <!-- STIV -->
            <td id="op" class="<?=$rigar['rCsti']?>"><?php $numstive = str_replace(",", ".", $rigar['Stive']); ?><!--<input type="text" name="stive" id="txtst" class="btW" size="4" value="<?=$numstive?>">--><p id="ope"><?=$numstive?></p></td>
            <!-- T.PA -->
            <td id="op" class="<?=$rigar['rCtpa']?>">   
                <? $ntpa = dammiPallet($rigar['CodPallet']); ?>
                <p id="ope"><?=$ntpa?></p>
            </td>
            <!-- PROD --> 
            <td class="<?=$rigar['rCpro']?>">  
                <? $nprod = dammiProdotto($rigar['CodNP']); ?>
                <p id="ope"><?=$nprod?></p>
            </td>
            <!-- IMBA -->
            <td id="op" class="<?=$rigar['rCimb']?>">
                <? $nimba = dammiImballo($rigar['CodImb']); ?>
                <p id="ope"><?=$nimba?></p>
            </td>
            <!-- MISU -->
            <td id="op" class="<?=$rigar['rCmis']?>"><p id="ope"><?=$rigar['Misura']?></p></td>
            <!-- COLL -->
            <td id="op" class="<?=$rigar['rCcol']?>"><p id="ope"><?=$rigar['Colli']?></p></td>
            <!-- OPAR -->
            <? if ($gaygi != "si") { ?>
            <td id="op" class="<?=$riga['tColore']?>">
                <p id="ope"><?=$riga['OraPartenza']?></p>                
            </td>
            <? } else { ?>
                <td class="tbgray"></td>
            <? } ?>             
        </tr>
        <? 
        }
        ?>
        <tr class="tbgray"><td colspan="13" class="vuota"></td></tr><? 
    }
}
function update_rigTRA_crono ($scroto){ // aggiorna il crono delle righe dei TRA
    $pdo2 = connetti();
    $sql_riga = "UPDATE tra_riga SET crono = {$scroto['crono']}, controller = \"{$GLOBALS['utente']}:CRONO\", dataLastMod = \"{$GLOBALS['datatempo']}\" WHERE idTraRiga = {$scroto['idTraRiga']}";
    if(BETA2) { echo "<pre class=\"Beta2\">update_rigTRA_crono: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
function update_rigTRA_deassocia ($scroto){ // deassocia un ODL dal TRA assegnato e lo rende disponibile per una riassegnazione
    $pdo2 = connetti();
    $sql_riga = "UPDATE tra_riga SET Cancellazione = 1, controller = \"{$GLOBALS['utente']}:CANC\", dataLastMod = \"{$GLOBALS['datatempo']}\" WHERE idTraRiga = {$scroto['idTraRiga']}";
    if(BETA2) { echo "<pre class=\"Beta2\">update_rigTRA_deassocia: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
    
    $sql_riga = "UPDATE odl_testata SET Assoc = 0, controller = \"{$GLOBALS['utente']}:TRADEASSOC\", dataLastMod = \"{$GLOBALS['datatempo']}\" WHERE idTestataODL = {$scroto['idTestataODL']}";
    if(BETA2) { echo "<pre class=\"Beta2\">update_rigTRA_deassocia update odl_testata: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
    
    $pdo2 = connetti();
    $sql = "SELECT idTraRiga FROM tra_riga WHERE idTra = {$scroto['idTra']} AND idTestataODL = {$scroto['idTestataODL']} AND Cancellazione is Null";
    $query = $pdo2->prepare($sql);
    $query->execute();
    $flag = $query->rowCount();
    $list = $query->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: update_rigTRA_deassocia/dammi_rigaTra</b><br>\n"; print_r($list); echo "<br>flag: {$flag}</pre>"; }
    if ($flag) {       
    } else {
        $sql_riga = "INSERT INTO tra_riga SET idTra = {$scroto['idTra']}, sgAnno = {$GLOBALS['anno']}, sgDoy = {$GLOBALS['giornan']}, sgID = {$scroto['nsodl']}"; //, rColore = \"W\"
        if(BETA2) { echo "<pre class=\"Beta2\">update_rigTRA_deassocia/insert_newTra_riga: "; print_r($sql_riga); echo "</pre>\n"; }
        $queryr = $pdo2->prepare($sql_riga);
        $queryr->execute();
    }
}
function dammi_rigaTra_bol ($idTra) { // restituisce il numero di righe per un dato trasporto 
    $pdo2 = connetti();
    $sql = "SELECT idTraRiga FROM tra_riga WHERE idTra = {$idTra} AND idTestataODL = 0";
    $query = $pdo2->prepare($sql);
    $query->execute();
    $flag = $query->rowCount();
    $list = $query->fetchAll(PDO::FETCH_ASSOC); 
    if(BETA3) { echo "<pre class=\"Beta3\"><b>funzione: dammi_rigaTra</b><br>\n"; print_r($list); echo "<br>flag: {$flag}</pre>"; }
    return $flag;
}
function delete_Tra ($parametri) { //CANCELLA Trasporto Testata e ultima riga
    $pdo2 = connetti();
    $sql_riga = "UPDATE tra_riga SET Cancellazione = 1, controller = \"{$GLOBALS['utente']}:CANC\", dataLastMod = \"{$GLOBALS['datatempo']}\" WHERE idTraRiga = {$parametri['idTraRiga']}";
    if(BETA2) { echo "<pre class=\"Beta2\">delete_Tra (riga): "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
    
    $sql_riga = "UPDATE tra_testata SET Cancellazione = 1, controller = \"{$GLOBALS['utente']}:CANC\", dataLastMod = \"{$GLOBALS['datatempo']}\" WHERE idTra = {$parametri['idTra']}";
    if(BETA2) { echo "<pre class=\"Beta2\">delete_Tra (testata): "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
function update_colore_tra_totale ($dammiPOST, $colore) { // aggiorna il campo colore principale della riga
    $pdo3 = connetti();
    $sql = "UPDATE tra_riga SET "
    . "rColore = \"{$colore}\" "
    . "WHERE idTra = {$dammiPOST['idTra']}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_riga: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo3->prepare($sql);
    $que->execute();

    $sql = "UPDATE tra_testata SET "
    . "tColore = \"{$colore}\" "
    . "WHERE idTra = {$dammiPOST['idTra']}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_testata: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo3->prepare($sql);
    $que->execute();
}
function update_colore_trariga ($dammiPOST, $colore) { // aggiorna il campo colore principale della riga
    $pdo3 = connetti();
    $sql = "UPDATE tra_riga SET "
    . "rColore = \"{$colore}\" "
    . "WHERE idTraRiga = {$dammiPOST['idTraRiga']}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_riga: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo3->prepare($sql);
    $que->execute();
}
function update_colore_trarighe ($dammiPOST, $colore) { // aggiorna il campo colore principale della riga
    $pdo3 = connetti();
    $sql = "UPDATE tra_riga SET "
    . "rColore = \"{$colore}\" "
    . "WHERE idTra = {$dammiPOST['idTra']}";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_colore_righe: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo3->prepare($sql);
    $que->execute();
}
function TraSelectOperativa ($dtaparam) { //
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM tra_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND (tColore = 'B' OR tColore = 'Black') ORDER BY OraPartenza";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']); // cerca la chiave del menù a tendina orari partenza per riposizionarsi su quello quando visualizza
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgTRA']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM tra_riga WHERE idTra = '{$riga['idTra']}' AND Cancellazione Is Null ORDER BY crono";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idTraRiga'];
            //$rN = ltrim($rigar['idTraRiga'], '0'); // toglie gli zerofill
        ?>
        <tr class="t<?=$riga['tColore']?>">
        <form method="POST" name="nuova_riga" id="fnrs<?=$rN?>" action="#<?=$riga['idTra']?>" autocomplete="off">
            <input type="hidden" name="percorso" value="updateTRA">
            <input type="hidden" name="idriga" value="<?=$rigar['idTraRiga']?>">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            
        <!--<td colspan="8">
            <table style="width:100%"><tr>-->
                        <? // class="divtoBlink" onmouseover="javascript:lampeggiami('#RBlink','tRR',1200)" ?>
            <!-- TRAS -->
            <td id="op">
            <? if (BETA) : ?>
                <!-- Variabili ambiente --><pre class="Beta3"> conta righe $i:<br><?=$i?></pre>
                <!-- TRA --><pre class="Beta3">idTra:<br><?=$riga['idTra']?></pre>
                <!-- Tra riga --><pre class="Beta3">idTraRiga:<br><?=$rigar['idTraRiga']?></pre>
            <? endif; ?>
            <a id="<?=$riga['idTra']?>"></a><center><!--<small><?=$an?>.<?=$dedlan?>.</small>-->Trasporto<br><h1><?=$numar?></h1></center>
            </td>
            <!-- OPAR -->
            <td id="op">
            <? if ($gaygi != "si") { ?><center>Partenza<br> 
                <h1><?=$riga['OraPartenza']?></h1></center>
            <? } else { ?>
                &nbsp;
            <? } ?> 
            </td>
            <!-- VETT -->
            <td id="op" class="<?=$rigar['rCvett']?>">   
            <? $nvett = dammiVettore($riga['CodVett']); ?><center>Vettore<br>
                <h1><?=$nvett?></h1></center>
            </td>
            <!-- PORT -->
            <td id="op" class="<?=$rigar['rCport']?>"><center>Portata:<br><h1><?=$riga['portata']?></h1></center></td>
            <!-- AUTI -->
            <td id="op" class="<?=$rigar['rCauti']?>">
                <center>Autista<br>
                    <h2><? $nauti = dammiAutista($riga['CodAut']); ?><?=$nauti['Cognome']?> <?=$nauti['Nome']?><br>
                    t1: <?=$nauti['Telefono1']?> t2: <?=$nauti['Telefono2']?></h2>
                </center>
            </td>
            <!-- NOTE --> 
            <td id="op" colspan="2">  
                <center>Note<br><h1><?=$riga['Note']?></h1></center>
            </td>
            <td id="op" class="t<?=$riga['tColore']?>">
                    <? if ($gaygi != "si") { ?>
                    <!--<button name="btCONF" class="bt<? if ($riga['tColore'] == 'B' || $riga['tColore'] == 'Black') { $comodo = "TOGLI"; $cmd2 = ""; ?>W<?} else { $comodo = ""; $cmd2 = "disabled"; ?>B<?}?>" value="<? if ($riga['tColore'] == 'B') {?>W<?} else {?>B<?}?>"><?=$comodo?> CONFERMA </button>-->
                        <!--<button type="submit" name="bt" class="btG" value="A" form="fnrs<?=$rN?>">AGGIORNA</button>-->
                        <center> 
                            <button name="btARRIVAT" class="btR" value="<?=$riga['Arrivato']?>" <?=$cmd2?>>ARRIVATO</button><br>
                            <button name="btPARTITO" class="btBlack" <?=$cmd2?>>PARTITO!</button>
                        </center>
                        <? } ?> 
            </td>
            <!-- ARRI -->
            <td <?=($riga['Arrivato'] ? "class=\"class2blink\"" : "")?>>
                <center><?=($riga['tColore']=="Black" ? "Partito" : ($riga['Arrivato'] ? "Arrivato" : "Non Arrivato<br>In Attesa"))?></center>
            </td>
            <!--</tr></table>
        </td>--></tr>
        <!--<tr>
            <? 
                } else { 
                $gaygi = "si";?>
            <input type="hidden" name="percorsoupd" value="RIG">
            <!--<td colspan="8">&nbsp;</td>-->
            <? } ?>
<!--        </form>
<!--        <form method="POST" name="spostariga" id="spstr<?=$rN?>" action="#<?=$riga['idTra']?>" autocomplete="off"> <!-- SPOSTA LA RIGA IN ALTRO ORDINE -->
<!--            <input type="hidden" name="percorso" value="spostariga">
<!--            <input type="hidden" name="idTra" value="<?=$riga['idTra']?>">
<!--            <input type="hidden" name="an" value="<?=$an?>">
<!--            <input type="hidden" name="dedlan" value="<?=$dedlan?>">
<!--            <input type="hidden" name="numar" value="<?=$numar?>">
<!--        </form>
<!--        <form method="POST" action="#<?=$riga['idTra']?>" autocomplete="off">
<!--            <input type="hidden" name="percorso" value="updateSTATUS">
<!--            <td colspan="1" class="t<?=$rigar['rColore']?>"><!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--                <!--<?=$rigar['idTraRiga']?>-->
<!--                Crono <input type="text" name="crono" id="crono<?=$rN?>_nom" class="btZ" autocomplete="off" value="<?=$rigar['crono']?>">
                <button type="submit" name="btCRONO" class="btGY">CRONO</button>
                <button type="submit" name="btDISAS" class="btR">DISASSOCIA</button><br>

                    
            </td></tr>-->
                    <tr>
    <th class="t<?=$riga['tColore']?>">Crono</th>
    <!--<th>N.Ordine</th>-->
    <!--<th>F.P.</th>-->
    <th class="t<?=$riga['tColore']?>">Cliente</th>
    <th class="t<?=$riga['tColore']?>">Stive</th>
    <th class="t<?=$riga['tColore']?>">T.Pallet</th>
    <!-- <th>S</th> -->
    <th class="t<?=$riga['tColore']?>">Prod.</th>
    <th class="t<?=$riga['tColore']?>">Imballo</th>
    <th class="t<?=$riga['tColore']?>">Misura</th>
    <th class="t<?=$riga['tColore']?>">Colli</th>
    <!--<th>Lavorazione</th>
    <th>Commenti</th>
    <th>Ora Part.</th>
    <th>OP</th>-->
                    </tr><tr>                <?
                    rigTraAssocOperativa($dtaparam,$riga['idTra'],$rigar['idTestataODL'],$rigar['crono'],$rigar['rColore']);
                ?></tr>
            <tr><!-- class="t<?=$riga['tColore']?>" -->
                <td class="t<?=$rigar['rColore']?>">
                    <!--<? if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C" <? echo (dammi_rigaTra_bol($riga['idTra']) ? "" : 'disabled'); ?>>C</button><? } ?>-->
                </td>

                <td colspan="7" align="right" class="t<?=$rigar['rColore']?>">
                    <small>Trasporto# <?=$an?>.<?=$dedlan?>.<?=$numar?> r# <?=$rigar['idTraRiga']?></small>
                    <input type="hidden" name="nsodl" value="<?=$numar?>">
                    <!--<input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">-->
                    <!-- <button name="btRESET" class="btW">RESET</button>&nbsp;-->
                    <button name="btCARI" class="btLilla" <?=$cmd2?>>CARI</button>
                </td>
                <!--<td colspan="2" class="t<?=$riga['tColore']?>"></td>-->
            </tr>
            <input type="hidden" name="rColore" value="<?=$rigar['rColore']?>">
            <input type="hidden" name="idTra" value="<?=$riga['idTra']?>">
            <input type="hidden" name="idTraRiga" value="<?=$rigar['idTraRiga']?>">
            <input type="hidden" name="idTestataODL" value="<?=$rigar['idTestataODL']?>">
        </form>
        </tr>
        <? 
        }
        ?><tr><td colspan="8" class="tW">.</td></tr><?
    }
}
function rigTraAssocOperativa ($dtaparam, $idTra, $idTestataODL,$crono,$colore) { // questo fa il select dei trasporti non associati
    if (0) echo "!!!_".$GLOBALS['_SESSION']['Username']."_!!!";
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM odl_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND tColore = 'B' AND Assoc = {$idTra} AND idTestataODL = {$idTestataODL}";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']);
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgODL']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM odl_riga WHERE idTestataODL = '{$riga['idTestataODL']}' AND Cancellazione = '000'";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idRigaOdL'];
        ?> 
        <tr class="t<?=$riga['tColore']?>">
            <td class="t<?=$colore?>"><center><h1><?=$crono?></h1></center></td>
            <? if ($i++ < 1) { ?>
            <!-- CLIE -->
            <td id="op">
                <? $nclie = dammiCliente($riga['CodCliente']); ?>
                <p id="ope"><?=$nclie?></p>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <td class="tbgray" colspan="1"></td>
            <? } ?>
            <!-- STIV -->
            <td id="op" class="<?=$rigar['rCsti']?>"><?php $numstive = str_replace(",", ".", $rigar['Stive']); ?><!--<input type="text" name="stive" id="txtst" class="btW" size="4" value="<?=$numstive?>">--><p id="ope"><?=$numstive?></p></td>
            <!-- T.PA -->
            <td id="op" class="<?=$rigar['rCtpa']?>">   
                <? $ntpa = dammiPallet($rigar['CodPallet']); ?>
                <p id="ope"><?=$ntpa?></p>
            </td>
            <!-- PROD -->
            <td id="op" class="<?=$rigar['rCpro']?>">  
                <? $nprod = dammiProdotto($rigar['CodNP']); ?>
                <p id="ope"><?=$nprod?></p>
            </td>
            <!-- IMBA -->
            <td id="op" class="<?=$rigar['rCimb']?>">
                <? $nimba = dammiImballo($rigar['CodImb']); ?>
                <p id="ope"><?=$nimba?></p>
            </td>
            <!-- MISU -->
            <td id="op" class="<?=$rigar['rCmis']?>"><p id="ope"><?=$rigar['Misura']?></p></td>
            <!-- COLL -->
            <td id="op" class="<?=$rigar['rCcol']?>"><p id="ope"><?=$rigar['Colli']?></p></td>
        </tr>
        <? 
        }
        ?>
        <tr class="tbgray"><td colspan="13" class="vuota"></td></tr><? 
    }
}
function update_arrivato_testata_tra ($dammiPOST,$val) { // modifica il colore della testata in base alla pressione dei giusti bottoni
    $pdo = connetti();
    $sql = "UPDATE tra_testata SET "
    . "Arrivato = \"{$val}\" "
    . "WHERE idTra = \"{$dammiPOST['idTra']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\"><b> update_arrivato_testata_tra: </b><br>"; print_r($sql); echo "</pre>\n"; }
    $que = $pdo->prepare($sql);
    $que->execute();
}
function TraSelectOperativa2 ($dtaparam) { //
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM tra_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND (tColore = 'B' OR tColore = 'Black') ORDER BY OraPartenza";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']); // cerca la chiave del menù a tendina orari partenza per riposizionarsi su quello quando visualizza
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgTRA']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM tra_riga WHERE idTra = '{$riga['idTra']}' AND Cancellazione Is Null ORDER BY crono";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idTraRiga'];
            //$rN = ltrim($rigar['idTraRiga'], '0'); // toglie gli zerofill
        ?>
        <tr class="t<?=$riga['tColore']?>">
        <form method="POST" name="nuova_riga" id="fnrs<?=$rN?>" action="#<?=$riga['idTra']?>" autocomplete="off">
            <input type="hidden" name="percorso" value="updateTRA">
            <input type="hidden" name="idriga" value="<?=$rigar['idTraRiga']?>">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            
        <!--<td colspan="8">
            <table style="width:100%"><tr>-->
                        <? // class="divtoBlink" onmouseover="javascript:lampeggiami('#RBlink','tRR',1200)" ?>
            <!-- TRAS -->
            <td id="op">
            <? if (BETA) : ?>
                <!-- Variabili ambiente --><pre class="Beta3"> conta righe $i:<br><?=$i?></pre>
                <!-- TRA --><pre class="Beta3">idTra:<br><?=$riga['idTra']?></pre>
                <!-- Tra riga --><pre class="Beta3">idTraRiga:<br><?=$rigar['idTraRiga']?></pre>
            <? endif; ?>
            <a id="<?=$riga['idTra']?>"></a><center><!--<small><?=$an?>.<?=$dedlan?>.</small>-->Trasporto<br><?=$numar?></center>
            </td>
            <!-- OPAR -->
            <td id="op">
            <? if ($gaygi != "si") { ?><center>Partenza<br> 
                <?=$riga['OraPartenza']?></center>
            <? } else { ?>
                &nbsp;
            <? } ?> 
            </td>
            <!-- VETT -->
            <td id="op" class="<?=$rigar['rCvett']?>">   
            <? $nvett = dammiVettore($riga['CodVett']); ?><center>Vettore<br>
                <?=$nvett?></center>
            </td>
            <!-- PORT -->
            <td id="op" class="<?=$rigar['rCport']?>"><center>Portata:<br><?=$riga['portata']?></center></td>
            <!-- AUTI -->
            <td id="op" class="<?=$rigar['rCauti']?>">
                <center>Autista<br>
                    <? $nauti = dammiAutista($riga['CodAut']); ?><?=$nauti['Cognome']?> <?=$nauti['Nome']?><br>
                    t1: <?=$nauti['Telefono1']?> t2: <?=$nauti['Telefono2']?>
                </center>
            </td>
            <!-- NOTE --> 
            <td id="op" colspan="2">  
                <center>Note<br><?=$riga['Note']?></center>
            </td>
            <td id="op" class="t<?=$riga['tColore']?>">
                <? if ($gaygi != "si") { ?>
                <!--<button name="btCONF" class="bt<? if ($riga['tColore'] == 'B' || $riga['tColore'] == 'Black') { $comodo = "TOGLI"; $cmd2 = ""; ?>W<?} else { $comodo = ""; $cmd2 = "disabled"; ?>B<?}?>" value="<? if ($riga['tColore'] == 'B') {?>W<?} else {?>B<?}?>"><?=$comodo?> CONFERMA </button>-->
                <!--<button type="submit" name="bt" class="btG" value="A" form="fnrs<?=$rN?>">AGGIORNA</button>-->
                <center> 
                    <button name="btARRIVAT" class="btR" value="<?=$riga['Arrivato']?>" <?=$cmd2?>>ARRIVATO</button><br>
                    <button name="btPARTITO" class="btBlack" <?=$cmd2?>>PARTITO!</button>
                </center>
                <? } ?> 
            </td>
            <!-- ARRI -->
            <td <?=($riga['Arrivato'] ? "class=\"class2blink\"" : "")?>>
                <center><?=($riga['tColore']=="Black" ? "Partito" : ($riga['Arrivato'] ? "Arrivato" : "Non Arrivato<br>In Attesa"))?></center>
            </td>
        </tr>
        <? } ?>
            <tr>
                <th class="t<?=$riga['tColore']?>">Crono</th>
                <!--<th>N.Ordine</th>-->
                <!--<th>F.P.</th>-->
                <th class="t<?=$riga['tColore']?>">Cliente</th>
                <th class="t<?=$riga['tColore']?>">Stive</th>
                <th class="t<?=$riga['tColore']?>">T.Pallet</th>
                <!-- <th>S</th> -->
                <th class="t<?=$riga['tColore']?>">Prod.</th>
                <th class="t<?=$riga['tColore']?>">Imballo</th>
                <th class="t<?=$riga['tColore']?>">Misura</th>
                <th class="t<?=$riga['tColore']?>">Colli</th>
                <!--<th>Lavorazione</th>
                <th>Commenti</th>
                <th>Ora Part.</th>
                <th>OP</th>-->
            </tr>
               <?
                    rigTraAssocOperativa2($dtaparam,$riga['idTra'],$rigar['idTestataODL'],$rigar['crono'],$rigar['rColore']);
                ?>
            <tr class="t<?=$rigar['rColore']?>">
                <td class="t<?=$rigar['rColore']?>">
                    <!--<? if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C" <? echo (dammi_rigaTra_bol($riga['idTra']) ? "" : 'disabled'); ?>>C</button><? } ?>-->
                </td>
                <td colspan="7" align="right" class="t<?=$rigar['rColore']?>">
                    <small>Trasporto# <?=$numar?> riga# <?=$rigar['idTraRiga']?></small>
                    <input type="hidden" name="nsodl" value="<?=$numar?>">
                    <!--<input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">-->
                    <!-- <button name="btRESET" class="btW">RESET</button>&nbsp;-->
                    <button name="btCARI" class="btLilla" <?=$cmd2?>>CARI</button>
                </td>
                <!--<td colspan="2" class="t<?=$riga['tColore']?>"></td>-->
            </tr>
            <input type="hidden" name="rColore" value="<?=$rigar['rColore']?>">
            <input type="hidden" name="idTra" value="<?=$riga['idTra']?>">
            <input type="hidden" name="idTraRiga" value="<?=$rigar['idTraRiga']?>">
            <input type="hidden" name="idTestataODL" value="<?=$rigar['idTestataODL']?>">
        </form>
        </tr>
        <? 
        }
        ?><tr><td colspan="8" class="tW">.</td></tr><?
    }
}
function rigTraAssocOperativa2($dtaparam, $idTra, $idTestataODL,$crono,$colore) { // questo fa il select dei trasporti non associati
    if (0) echo "!!!_".$GLOBALS['_SESSION']['Username']."_!!!";
    $pdotra = connetti();
    $pdotrar = connetti();
    $sqltra = "SELECT * FROM odl_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND tColore = 'B' AND Assoc = {$idTra} AND idTestataODL = {$idTestataODL}";
    if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltra); echo "</pre>\n"; }
    $query = $pdotra->prepare($sqltra);
    $query->execute();
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($list); echo "</pre>\n"; }
    foreach ($list as $riga) { ///////////////////////////////////////////////////////////////////////////////////////// records TESTATA: $riga 
        $i = 0; $gaygi = "no";
        $posizcheck = array_search($riga['OraPartenza'],$GLOBALS['arOP']);
        if (BETA3) { echo "<pre class='Beta3'>OraP {$riga['OraPartenza']} PosizCheck: {$posizcheck}"; echo "</pre>"; }
        list($an, $dedlan, $numar) = preg_split("/\./", $riga['idsgODL']); // splitta datario da testata.idsgODL seq giornaliera degli OdL
        $sqltrar = "SELECT * FROM odl_riga WHERE idTestataODL = '{$riga['idTestataODL']}' AND Cancellazione = '000'";
        if(BETA2) { echo "<pre class=\"Beta2\">"; print_r($sqltrar); echo "</pre>\n"; }
        $queryr = $pdotrar->prepare($sqltrar);
        $queryr->execute();
        $listr = $queryr->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\">"; print_r($listr); echo "</pre>\n"; }
        foreach ($listr as $rigar) { ///////////////////////////////////////////////////////////////////////////////////////// records RIGHE: $rigar
            $rN = $rigar['idRigaOdL'];
        ?> 
        <tr class="t<?=($colore == "Black" ? "Black" : $riga['tColore'])?>">
            <td class="t<?=$colore?>"><center><?=$crono?></center></td>
            <? if ($i++ < 1) { ?>
            <!-- CLIE -->
            <td id="op">
                <? $nclie = dammiCliente($riga['CodCliente']); ?>
                <p id="opex"><center><?=$nclie?></center></p>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <td class="tbgray" colspan="1"></td>
            <? } ?>
            <!-- STIV -->
            <td id="op" class="<?=($colore == "Black" ? "Black" : $rigar['rCsti'])?>"><?php $numstive = str_replace(",", ".", $rigar['Stive']); ?><!--<input type="text" name="stive" id="txtst" class="btW" size="4" value="<?=$numstive?>">--><p id="opex"><center><?=$numstive?></center></p></td>
            <!-- T.PA -->
            <td id="op" class="<?=($colore == "Black" ? "Black" : $rigar['rCtpa'])?>">   
                <? $ntpa = dammiPallet($rigar['CodPallet']); ?>
                <p id="opex"><center><?=$ntpa?></center></p>
            </td>
            <!-- PROD -->
            <td id="op" class="<?=($colore == "Black" ? "Black" : $rigar['rCpro'])?>">  
                <? $nprod = dammiProdotto($rigar['CodNP']); ?>
                <p id="opex"><center><?=$nprod?></center></p>
            </td>
            <!-- IMBA -->
            <td id="op" class="<?=($colore == "Black" ? "Black" : $rigar['rCimb'])?>">
                <? $nimba = dammiImballo($rigar['CodImb']); ?>
                <p id="opex"><center><?=$nimba?></center></p>
            </td>
            <!-- MISU -->
            <td id="op" class="<?=($colore == "Black" ? "Black" : $rigar['rCmis'])?>"><p id="opex"><center><?=$rigar['Misura']?></center></p></td>
            <!-- COLL -->
            <td id="op" class="<?=($colore == "Black" ? "Black" : $rigar['rCcol'])?>"><p id="opex"><center><?=$rigar['Colli']?></center></p></td>
        </tr>
        <? 
        }
        ?>
        <!--<tr class="tbgray"><td colspan="13" class="vuota"></td>--></tr><? 
    }
}
?>  