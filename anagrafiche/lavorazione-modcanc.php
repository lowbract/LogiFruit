<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE lavorazione SET TipoLav=\"{$_POST['modifica']}\" WHERE CodLav={$_POST['CodLav']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM lavorazione WHERE CodLav={$_POST['CodLav']} LIMIT 1";
    $sql = "UPDATE lavorazione SET del = 1 WHERE CodLav={$_POST['CodLav']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM lavorazione ORDER BY TipoLav ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbFluttuante1>';
echo '<tr>'; echo "<th colspan=2>Lavorazione</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodLav']}'><form method=POST><input type=hidden name=CodLav value='{$rs['CodLav']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodLav']}' value='{$rs['TipoLav']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodLav']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodLav']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodLav value='{$rs['CodLav']}'>"
            . "<button type=button name='btcancella' value='{$rs['CodLav']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodLav']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodLav']}'></form></td>";
    echo "</tr>\n";
}
echo '</table>';
if (BETA3) {
    echo '<pre class=Beta2>';
    foreach ($list as $rs) {
        print_r($rs);
        foreach ($rs as $campo) {
            //print_r($campo);
        }
    }
    echo '</pre>';
}
?>
