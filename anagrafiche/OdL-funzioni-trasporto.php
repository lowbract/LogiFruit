<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table>
<tr>
    <td>
        Vettore<br><input type="hidden"   name="tras[]" id="tras<?=$rN?>_hid" value="<?=$riga['CodCliente']?>"><? $idtrasp = "vuoto"; ?>
        <input type="text"     name="tras[]" id="tras<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$idtrasp?>" onkeyup="autocomplet('tras<?=$rN?>')">
        <div id="tras<?=$rN?>_list"></div>  
    </td>
    <td><!-- F.P. -->Franco Part.<br><input type="checkbox" name="fpt" id="fp_check" class="btW" <? if ($riga['FP']=='on') { echo "checked=\"checked\""; }?>></td>
    <td>
        Autista<br><input type="hidden"   name="tras[]" id="tras<?=$rN?>_hid" value="<?=$riga['CodCliente']?>"><? $idtrasp = "vuoto"; ?>
        <input type="text"     name="tras[]" id="tras<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$idtrasp?>" onkeyup="autocomplet('tras<?=$rN?>')">
        <div id="tras<?=$rN?>_list"></div>  
    </td>   
    <td>
        Portata<br><input type="hidden"   name="tras[]" id="tras<?=$rN?>_hid" value="<?=$riga['CodCliente']?>"><? $idtrasp = "vuoto"; ?>
        <input type="text"     name="tras[]" id="tras<?=$rN?>_txt" class="btW" autocomplete="off" value="<?=$idtrasp?>" onkeyup="autocomplet('tras<?=$rN?>')">
        <div id="tras<?=$rN?>_list"></div>  
    </td>  
    <td><!-- Arri -->Arrivato<br><input type="checkbox" name="arri" id="fp_check" class="btW" <? if ($riga['FP']=='on') { echo "checked=\"checked\""; }?>></td>
    <td class="<?=$rigar['rCcom']?>"><!-- COMM -->Note<br><textarea cols="10" rows="2" name="note" id="txtst" class="btW"><?=$rigar['Note']?></textarea></td>
</tr>
</table>