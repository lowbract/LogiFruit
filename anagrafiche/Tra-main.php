<?php
/* 
 * Trasporto scheda principale
 */
?>
<table style="width:100%">
<tr>
    <th>N#Trasp.</th>
    <th>Ora Part.</th>
    <th>Vettore</th>
    <th>Portata</th>
    <th>Autista</th>
    <th>Note</th>
    <th>Tel.</th>
    <th>Arrivato</th>
    <th colspan="10">Stato Lavorazione Ordine</th>
    <!--<th>N.Ordine</th>
    <th>Crono</th>
    <th>Cliente</th>
    <th>Stive</th>
    <th>Misura</th>
    <th>Prodotto</th>
    <th>Imballo</th>-->
</tr>


<tr>    
    <td colspan="8"> </td>
    <td colspan="7">
    <table class="tblibera" style="width:100%">
    <tr>
        <!--<th>Seq.</th>-->
        <th>N.Ordine</th>
        <th>Crono</th>
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
        $sodlval = str_pad(dammi_maxSodl($anno, $giornan), 3, "0", STR_PAD_LEFT);
        $dataform = $data;
        if ($sodlval > 1) {
            TraSodlOperativa($dataform);
        }
    ?>  
    </td>
    </table>
</table>