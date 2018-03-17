<?php
function copia_odl($par) { // copia gli ODL da un giorno precedente all'attuale
    $pST = connetti(); // connessione select testata
    $pIT = connetti();
    $pSR = connetti();
    $pIR = connetti();
    foreach ($par['S'] as $testata) {
        $sST = "SELECT * FROM odl_testata WHERE idTestataODL = '{$testata}'";
        if(BETA2) { echo "<pre class=\"Beta2\"> copia_odl: sST "; print_r($sST); echo "</pre>\n"; }
        $qST= $pST->prepare($sST);
        $qST->execute();
        $rST = $qST->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\"> copia_odl: rST "; print_r($rST); echo "</pre>\n"; }
        $tor = $rST[0];
        $idsgODL = $GLOBALS['anno'].".".str_pad($GLOBALS['giornan'], 3, "0", STR_PAD_LEFT).".".str_pad(dammi_maxSodl($GLOBALS['anno'], $GLOBALS['giornan']), 3, "0", STR_PAD_LEFT);
        $sIT = "INSERT INTO odl_testata SET"
            . " idsgODL = \"{$idsgODL}\","
            . " nOrd = \"{$tor['nOrd']}\","
            . " FP = \"{$tor['FP']}\","
            . " CodCliente = \"{$tor['CodCliente']}\","
            . " OraPartenza = \"{$tor['OraPartenza']}\", "
            . " data = \"{$GLOBALS['data']}\"";
        if(BETA2) { echo "<pre class=\"Beta2\"> copia_odl: sIT "; print_r($sIT); echo "</pre>\n"; }
        $qIT= $pIT->prepare($sIT);
        $qIT->execute();
        $liT = $pIT->lastInsertId(); $col = 'tWo'; $flag = "COPY";
        $sSR = "SELECT * FROM odl_riga WHERE idTestataODL = '{$testata}'";
        if(BETA2) { echo "<pre class=\"Beta2\"> copia_odl: sSR "; print_r($sSR); echo "</pre>\n"; }
        $qSR= $pSR->prepare($sSR);
        $qSR->execute();
        $rSR = $qSR->fetchAll(PDO::FETCH_ASSOC);
        if(BETA3) { echo "<pre class=\"Beta3\"> copia_odl: rSR "; print_r($rSR); echo "</pre>\n"; }
        foreach ($rSR as $riga) {
            $idsgODL = str_pad(dammi_maxSodl($GLOBALS['anno'], $GLOBALS['giornan']), 3, "0", STR_PAD_LEFT);
            $sIT = "INSERT INTO odl_riga SET " 
            . "sgAnno = '{$GLOBALS['anno']}', "
            . "sgDoy = '{$GLOBALS['giornan']}', "
            . "sgID = '{$idsgODL}', "
            . "CodNP = \"{$riga['CodNP']}\", "
            . "Colli = \"{$riga['Colli']}\", "
            . "Stive = \"{$riga['Stive']}\", "
            . "CodLav = \"{$riga['CodLav']}\", "
            . "CodPez = \"{$riga['CodPez']}\", "
            . "CodImb = \"{$riga['CodImb']}\", "
            . "CodPallet = \"{$riga['CodPallet']}\", "
            . "Commenti = \"{$riga['Commenti']}\", "
            . "Misura = \"{$$riga['Misura']}\", "
            . "rColore = \"{$col}\", "
            . "rCpro = \"{$col}\", "
            . "rClav = \"{$col}\", "
            . "rCcol = \"{$col}\", "
            . "rCsti = \"{$col}\", "
            . "rCcom = \"{$col}\", "
            . "rCpez = \"{$col}\", "
            . "rCimb = \"{$col}\", "
            . "rCtpa = \"{$col}\", "
            . "rCmis = \"{$col}\", "
            . "controller = \"{$GLOBALS['utente']}:{$flag}\", "
            . "dataLastMod = \"{$GLOBALS['datatempo']}\", "
            . "idTestataODL = \"{$liT}\", "
            . "dataCrea = \"{$GLOBALS['data']}\"";
            if(BETA2) { echo "<pre class=\"Beta2\"> copia_odl: sIT "; print_r($sIT); echo "</pre>\n"; }
            $qIT= $pIT->prepare($sIT);
            $qIT->execute();
        }
    }
}