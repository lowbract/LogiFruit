<?php
/* 
 * Trasporto scheda principale
 */
if (isset($_POST['percorso']) && $_POST['percorso'] == 'newrowTRA') { // stabilisce i percorsi alternativi
    // cerca riga 1 per testata se idTestataODL = 0 update altrimenti insert nuova riga
    $idTra = $_POST['astr'][0];
    $idsgTRA = $_POST['astr'][1];
    $nsodl = $_POST['nsodl'];
    $idTestataODL = $_POST['idTestataODL'];
    insert_trarow($idTra,$idsgTRA,$idTestataODL);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btCONF'])) {
    update_colore_testata_tra($_POST); update_colore_trarighe($_POST,"B");
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateRowTra' ) {
    update_colore_testata_tra($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btCRONO'])) {
    update_rigTRA_crono($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btDISAS'])) {
    update_rigTRA_deassocia($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btPARTITO'])) {
    update_colore_tra_totale($_POST,"Black");
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btCARI'])) {
    update_colore_trariga($_POST,($_POST['rColore']=="Lilla" ? "" : "Lilla"));
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['bt'])) { 
    update_rigTRA_crono($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && (isset($_POST['btPVIS']) || isset($_POST['btPLIN']) || isset($_POST['btASPE']) || isset($_POST['btCARI']))) {
    /*reset_lampeggia($_POST);*/
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && isset($_POST['btRESET'])) {
    /*reset_colore($_POST);*/
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && $_POST['btadd'] == 'AOdL') {
    /*insert_newrSodl($_POST);*/
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && $_POST['btdel'] == 'SOdL') {
    /*delete_rSodl($_POST);*/
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateSTATUS' && $_POST['btCANC'] == 'C') {
    delete_Tra($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'updateTRA') {
    update_tra($_POST);
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'spostariga') {
    /*sposta_rodl($_POST);*/
} elseif (isset($_POST['percorso']) && $_POST['percorso'] == 'copiaodl') {
    /*include_once 'OdL-funzioni-2.php';
    copia_odl($_POST);*/
}
?>
<table style="width:100%" class="style1">
<tr>
    <th>N#Trasp.</th>
    <th>Ora Part.</th>
    <th>Vettore</th>
    <th>Portata</th>
    <th>Autista</th>
    <th>Note</th>
    <th>Arrivato</th>
    <th colspan="10">Stato Lavorazione Ordine</th><!--
    <th>Cliente</th>
    <th>Stive</th>
    <th>T.Pallet</th>
    <th>Prod.</th>
    <th>Imballo</th>        
    <th>Misura</th>
    <th>Colli</th>
    <th>Ora Part.</th>-->
</tr>
<tr>
    <?php
    $straval = str_pad(dammi_maxStra($anno, $giornan), 3, "0", STR_PAD_LEFT);
    if ($straval > 1) {
        TraSelect($dataform); // 2016.06.11 devi prevedere riga di verifica anche per testata trasporti con funzione relativa $sodlval = str_pad(dammi_maxSodl($anno, $giornan), 3, "0", STR_PAD_LEFT);
    }
    ?>
</tr>
<tr><td colspan="15"></td></tr>
<tr>
    <td colspan="15" class="FondoArancio">Lavorazioni non associate</td>
</tr>

<tr>    
    <td colspan="8"> </td>
    <td colspan="7">
    <table class="tbgray" style="width:100%">
    <tr>
        <!--<th>Seq.</th>-->
        <th>Associa Trasporto</th>
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
        $sodlval = str_pad(dammi_maxSodl($anno, $giornan), 3, "0", STR_PAD_LEFT);
        $dataform = $data;
        if ($sodlval > 1) {
            TraSodlOperativa($dataform);
        }
    ?>  
    </td>
    </table>
</table>