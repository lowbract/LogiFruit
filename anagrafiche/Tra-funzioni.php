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
function insert_newTra ($parametri) { //INSERISCE TESTATA Trasporti
    $pdo2 = connetti();
    $sodlval = str_pad(dammi_maxStra($GLOBALS['anno'], $GLOBALS['giornan']), 3, "0", STR_PAD_LEFT);
    $idsgODL = $GLOBALS['anno'].".".str_pad($GLOBALS['giornan'], 3, "0", STR_PAD_LEFT).".".str_pad($sodlval, 3, "0", STR_PAD_LEFT);
    
    $sql_testata = "INSERT INTO tra_testata SET idsgTRA = \"{$idsgODL}\", data = \"{$GLOBALS['data']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newTra: "; print_r($sql_testata); echo "</pre>\n"; }
    $queryt = $pdo2->prepare($sql_testata);
    $queryt->execute();
    $LASTidTestataODL = $pdo2->lastInsertId();
    
    /*$sql_riga = "INSERT INTO odl_riga SET idTestataODL = {$LASTidTestataODL}, sgAnno = {$GLOBALS['anno']}, sgDoy = {$GLOBALS['giornan']}, sgID = {$sodlval}";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newrSodl: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();*/
}
function TraSodlOperativa ($dtaparam) {
    if (0) echo "!!!_".$GLOBALS['_SESSION']['Username']."_!!!";
    $pdossodl = connetti();
    $pdossodlr = connetti();
    $sqlssodl = "SELECT * FROM odl_testata WHERE data = '{$dtaparam}' AND Cancellazione Is Null AND tColore = 'B' ORDER BY OraPartenza";
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
        <form method="POST" name="nuova_riga_SODL" id="fnrsodl<?=$rN?>">
            <input type="hidden" name="percorso" value="updateSODL">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            <!-- NORD -->
            <td id="op"><p id="ope"><?=$riga['nOrd']?></p></td>
            <!-- CRON -->
            <td id="op"><p id="ope">crono</p></td>
            <!-- CLIE -->
            <td id="op">
                <? $nclie = dammiCliente($riga['CodCliente']); ?>
                <p id="ope"><?=$nclie?></p>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <input type="hidden" name="percorsoupd" value="RIG">
            <td class="tblibera" colspan="3"></td>
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
                <td class="tblibera"></td>
            <? } ?>             

            <input type="hidden" name="idTestataODL" value="<?=$riga['idTestataODL']?>">
        </form>
        <form method="POST" name="spostariga" id="spstr<?=$rN?>"> <!-- SPOSTA LA RIGA IN ALTRO ORDINE -->
            <input type="hidden" name="percorso" value="spostariga">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
            <input type="hidden" name="an" value="<?=$an?>">
            <input type="hidden" name="dedlan" value="<?=$dedlan?>">
            <input type="hidden" name="numar" value="<?=$numar?>">
        </form>
        <form method="POST">
            <input type="hidden" name="percorso" value="updateSTATUS">
            <!--<td><!-- OP.. --><!--
                <? if ($gaygi != "si") { // Qui differenzio i bottoni per la riga di testa e la riga delle righe OdL ?>
                <button type="submit" name="btadd" class="btG" value="AOdL">+</button>
                <? } else { ?>
                    <button type="submit" name="btdel" class="btO" value="SOdL">-</button>
                <? } ?> 
                <!--<button type="submit" name="btMODI" class="btY" value="M">M</button>-->
                <!--<? // if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C">C</button><? // } ?>
                --><!--</td>-->
            <tr class="vuota"><!-- class="t<?//=$riga['tColore']?>" -->
                <td colspan="3" class="vuota"></td>
                <td id="op" colspan="9" align="right" class="<?=$rigar['rColore']?>">
                    <small>Odl: <?=$an?>.<?=$dedlan?>.</small><?=$numar?><input type="hidden" name="nsodl" value="<?=$numar?>"><!--<input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">-->
                    <button name="btCARI" class="btLilla" <?=$cmd2?>>CARI</button>
                </td>
                <td colspan="1" class="tblibera"></td>
            </tr>
            <input type="hidden" name="rColore" value="<?=$rigar['rColore']?>">
            <input type="hidden" name="idTestataODL" value="<?=$riga['idTestataODL']?>">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
        </form>
        </tr>
        <? 
        }
        ?><tr class="tblibera"><td colspan="13" class="vuota"></td></tr><? 
    }
}