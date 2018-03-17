<?php
function sodl_operativa ($dtaparam) {
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
            $rN = $rigar['idRigaOdL']; ?>
        <tr class="t<?=$riga['tColore']?>">
        <form method="POST" name="nuova_riga_SODL" id="fnrsodl<?=$rN?>">
            <input type="hidden" name="percorso" value="updateSODL">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
            <? if ($i++ < 1) { ?>
            <input type="hidden" name="percorsoupd" value="TES+RIG">
            <!-- <td> -->
                <? // if (BETA) : ?>
                    <!-- Variabili ambiente --  <pre class="Beta3"> conta righe $i:<br><?//=$i?></pre> -->
                    <!-- SODL --                <pre class="Beta3">idTestataODL:<br><?//=$riga['idTestataODL']?></pre> -->
                    <!-- SODL riga --           <pre class="Beta3">idRigaOdL:<br><?//=$rigar['idRigaOdL']?></pre> -->
                <? // endif; ?>
                <!--<?=$numar?></td>-->
            <td id="op"><!-- NORD --><!--<input type="text" name="nord" id="nord_txt" class="btW" size="7" value="<?//=$riga['nOrd']?>">--><?=$riga['nOrd']?></td>
            <!--<td id="op">--><!-- F.P. --><!--<input type="checkbox" name="fp" id="ope" class="btW" disabled="disabled" <?// if ($riga['FP']=='on') { echo "checked=\"checked\""; }?>>--><!--<? if ($riga['FP']=='on') { echo "<p id=\"ope\">SI</p>"; }?>--><!--</td>-->
            <td id="op"><!-- CLIE -->
                <!--<input type="hidden"   name="clie[]" id="clie<?=$rN?>_hid" value="<?=$riga['CodCliente']?>"><? $nclie = dammiCliente($riga['CodCliente']); ?>
                <input type="text"     name="clie[]" id="clie<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nclie?>" onkeyup="autocomplet('clie<?=$rN?>')">
                <div id="clie<?=$rN?>_list"></div>-->
                <p id="ope"><?=$nclie?></p>
            </td>
            <? } else { 
                $gaygi = "si";?>
            <input type="hidden" name="percorsoupd" value="RIG">
            <td class="tblibera" colspan="2"></td>
            <? } ?>
            <!--<td class="tBl"><!-- S... --   <? //if ($gaygi != "si") { ?><input type="checkbox" name="S[]" id="scheck" class="btW" value="<?//=$riga['idTestataODL']?>" form="copia_odl"><?// } else { ?>&nbsp;<?// } ?> </td>-->
            <td id="op" class="<?=$rigar['rCpro']?>"><!-- PROD -->   
                <!--<input type="hidden"   name="prod[]" id="prod<?=$rN?>_hid" value="<?=$rigar['CodNP']?>"><? $nprod = dammiProdotto($rigar['CodNP']); ?>
                <input type="text"     name="prod[]" id="prod<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nprod?>" onkeyup="autocomplet('prod<?=$rN?>')">
                <div id="prod<?=$rN?>_list"></div>-->
                <a id="<?=$rigar['idRigaOdL']?>"></a>
                <p id="ope"><?=$nprod?></p>
            </td>
            <td id="op" class="<?=$rigar['rCpez']?>"><!-- PEZ. --> 
                <!--<input type="hidden"   name="pezz[]" id="pezz<?=$rN?>_hid" value="<?=$rigar['CodPez']?>"><? $npez = dammiPezzatura($rigar['CodPez']); ?>
                <input type="text"     name="pezz[]" id="pezz<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$npez?>" onkeyup="autocomplet('pezz<?=$rN?>')" size="5">
                <div id="pezz<?=$rN?>_list"></div>-->
                <p id="ope"><?=$npez?></p>
            </td>
            <td id="op" class="<?=$rigar['rClav']?>"><!-- LAVO -->  
                <!--<input type="hidden"   name="lavo[]" id="lavo<?=$rN?>_hid" value="<?=$rigar['CodLav']?>"><? $nlav = dammiLavorazione($rigar['CodLav']); ?>
                <input type="text"     name="lavo[]" id="lavo<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nlav?>" onkeyup="autocomplet('lavo<?=$rN?>')">
                <div id="lavo<?=$rN?>_list"></div>-->
                <p id="ope"><?=$nlav?></p>
            </td>
            <td id="op" class="<?=$rigar['rCcom']?>"><!-- COMM --><!--<textarea cols="6" rows="2" name="testo[]" id="txtst" class="btW"><?=$rigar['Commenti']?></textarea>--><p id="ope"><?=$rigar['Commenti']?></p></td>
            <td id="op" class="<?=$rigar['rCtpa']?>"><!-- T.PA -->   
                <!--<input type="hidden"   name="tpal[]" id="tpal<?=$rN?>_hid" value="<?=$rigar['CodPallet']?>"><? $ntpa = dammiPallet($rigar['CodPallet']); ?>
                <input type="text"     name="tpal[]" id="tpal<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$ntpa?>" onkeyup="autocomplet('tpal<?=$rN?>')" size="8">
                <div id="tpal<?=$rN?>_list"></div>-->
                <p id="ope"><?=$ntpa?></p>
            </td>
            <td id="op" class="<?=$rigar['rCimb']?>"><!-- IMBA -->
                <!--<input type="hidden"   name="imba[]" id="imba<?=$rN?>_hid" value="<?=$rigar['CodImb']?>"><? $nimba = dammiImballo($rigar['CodImb']); ?>
                <input type="text"     name="imba[]" id="imba<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$nimba?>" onkeyup="autocomplet('imba<?=$rN?>')">
                <div id="imba<?=$rN?>_list"></div> -->
                <p id="ope"><?=$nimba?></p>
            </td>
            <td id="op" class="<?=$rigar['rCcol']?>"><!-- COLL --><!--<input type="text" name="colli" id="txtst" class="btW" size="7" value="<?=$rigar['Colli']?>">--><p id="ope"><?=$rigar['Colli']?></p></td>
            <td id="op" class="<?=$rigar['rCsti']?>"><!-- STIV --><?php $numstive = str_replace(",", ".", $rigar['Stive']); ?><!--<input type="text" name="stive" id="txtst" class="btW" size="4" value="<?=$numstive?>">--><p id="ope"><?=$numstive?></p></td>
            <td id="op" class="<?=$rigar['rCmis']?>"><!-- MISU --><!--<input type="text" name="misura" id="txtst" class="btW" size="8" value="<?=$rigar['Misura']?>">--><p id="ope"><?=$rigar['Misura']?></p></td>
            <? if ($gaygi != "si") { ?>
            <td id="op" class="<?=$riga['tColore']?>"><!-- OPAR -->
                <p id="ope"><?=$riga['OraPartenza']?></p>
                <? } else { ?>
            <td class="tblibera"></td>
                <? } ?> 
                <script> selezionami('<?=$posizcheck?>','orapartenza<?=$rN?>'); </script>
            </td>
            <input type="hidden" name="idTestataODL" value="<?=$riga['idTestataODL']?>">
        </form>
        <form method="POST" name="spostariga" id="spstr<?=$rN?>"> <!-- SPOSTA LA RIGA IN ALTRO ORDINE -->
            <input type="hidden" name="percorso" value="spostariga">
            <input type="hidden" name="idrigaodl" value="<?=$rigar['idRigaOdL']?>">
            <input type="hidden" name="an" value="<?=$an?>">
            <input type="hidden" name="dedlan" value="<?=$dedlan?>">
            <input type="hidden" name="numar" value="<?=$numar?>">
        </form>
        <form method="POST" action="#<?=$rigar['idRigaOdL']?>">
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
            <tr><!-- class="t<?//=$riga['tColore']?>" -->
                <!--<td class="t<?//=$riga['tColore']?>"><?// if ($gaygi != "si") { ?><button type="submit" name="btCANC" class="btR" value="C">C</button><?// } ?></td>-->
                <td colspan="2" ><!--class="t<?=$riga['tColore']?>"<?// if ($gaygi != "si") { ?><button name="btCONF" class="bt<?// if ($riga['tColore'] == 'B') { $comodo = "TOGLI"; $cmd2 = ""; ?>W<?//} else { $comodo = ""; $cmd2 = "disabled"; ?>B<?//}?>" value="<?// if ($riga['tColore'] == 'B') {?>W<?//} else {?>B<?//}?>"><?//=$comodo?> CONFERMA </button><?// } ?>--></td>
                <td id="op" colspan="9" align="right" class="<?=$rigar['rColore']?>">
                    <small>Odl: <?=$an?>.<?=$dedlan?>.</small><?=$numar?><input type="hidden" name="nsodl" value="<?=$numar?>"><!--<input type="text" name="nsodl" id="txtst" class="btW" size="3" value="<?=$numar?>" form="spstr<?=$rN?>">-->
                    <!--<button type="submit" name="bt" class="btG" value="A" form="fnrsodl<?=$rN?>">AGGIORNA</button><button name="btRESET" class="btW">RESET</button>&nbsp;--><button name="btPVIS" class="btY" <?=$cmd2?>>PVIS</button><button name="btPLIN" class="btO" <?=$cmd2?>>PLIN</button><button name="btASPE" class="btGY" <?=$cmd2?>>ASPE</button><button name="btCARI" class="btLilla" <?=$cmd2?>>CARI</button></td>
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
        ?><tr class="tblibera"><td colspan="13"></td></tr><? 
    }
}
function reset_lampeggia_plus($par) { // restituisce la classe di colore per la riga richiesta e il campo specifico verifica lampeggio attuale
    $pdo = connetti();
    $sqlu = "UPDATE odl_riga SET "; 
    $col = "tR";
    $flag = "PVIL";
    if (rowcheck4value($par['idrigaodl'],"rColore")=='class2blink') { $sqlu .= " rColore = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCpro")=='class2blink') { $sqlu .= " rCpro = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rClav")=='class2blink') { $sqlu .= " rClav = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCcol")=='class2blink') { $sqlu .= " rCcol = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCsti")=='class2blink') { $sqlu .= " rCsti = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCcom")=='class2blink') { $sqlu .= " rCcom = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCpez")=='class2blink') { $sqlu .= " rCpez = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCimb")=='class2blink') { $sqlu .= " rCimb = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCtpa")=='class2blink') { $sqlu .= " rCtpa = \"{$col}\", "; }
    if (rowcheck4value($par['idrigaodl'],"rCmis")=='class2blink') { $sqlu .= " rCmis = \"{$col}\", "; }
    $sqlu .= "controller = \"{$GLOBALS['utente']}:{$flag}\", ";
    $sqlu .= "dataLastMod = \"{$GLOBALS['datatempo']}\" ";
    $sqlu .= "WHERE idRigaOdL = \"{$par['idrigaodl']}\"";
    if(BETA3) { echo "<pre class=\"Beta3\">function reset_lampeggia_plus: "; print_r($sqlu); echo "</pre>\n"; }
    $queu = $pdo->prepare($sqlu);
    $queu->execute();
}