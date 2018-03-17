<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function newTra ($parametri) { //INSERISCE TESTATA OdL e 1° Riga
    $pdo2 = connetti();
    $sodlval = str_pad(dammi_maxSodl($GLOBALS['anno'], $GLOBALS['giornan']), 3, "0", STR_PAD_LEFT);
    $idsgODL = $GLOBALS['anno'].".".str_pad($GLOBALS['giornan'], 3, "0", STR_PAD_LEFT).".".str_pad($sodlval, 3, "0", STR_PAD_LEFT);
    
    $sql_testata = "INSERT INTO odl_testata SET idsgODL = \"{$idsgODL}\", data = \"{$GLOBALS['data']}\"";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newrSodl: "; print_r($sql_testata); echo "</pre>\n"; }
    $queryt = $pdo2->prepare($sql_testata);
    $queryt->execute();
    $LASTidTestataODL = $pdo2->lastInsertId();
    
    $sql_riga = "INSERT INTO odl_riga SET idTestataODL = {$LASTidTestataODL}, sgAnno = {$GLOBALS['anno']}, sgDoy = {$GLOBALS['giornan']}, sgID = {$sodlval}";
    if(BETA2) { echo "<pre class=\"Beta2\">insert_newrSodl: "; print_r($sql_riga); echo "</pre>\n"; }
    $queryr = $pdo2->prepare($sql_riga);
    $queryr->execute();
}
?>
<tr>
    <td>
    </td>
<form>
    <td><!-- VETTORE -->  
        <input type="hidden"   name="vett[]" id="vett_hid">
        <input type="text"     name="vett[]" id="vett_txt" class="btW" autocomplete="off" onkeyup="autocomplet('vett')">
        <div id="vett_list"></div>  
    </td>
</form>
