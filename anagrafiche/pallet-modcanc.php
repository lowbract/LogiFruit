<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE pallet SET TipoPallet=\"{$_POST['modifica']}\" WHERE CodPallet={$_POST['CodPallet']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM pallet WHERE CodPallet={$_POST['CodPallet']} LIMIT 1";
    $sql = "UPDATE pallet SET del = 1 WHERE CodPallet={$_POST['CodPallet']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM pallet ORDER BY TipoPallet ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbFluttuante1>';
echo '<tr>'; echo "<th colspan=2>Pallet</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodPallet']}'><form method=POST><input type=hidden name=CodPallet value='{$rs['CodPallet']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodPallet']}' value='{$rs['TipoPallet']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodPallet']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodPallet']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodPallet value='{$rs['CodPallet']}'>"
            . "<button type=button name='btcancella' value='{$rs['CodPallet']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodPallet']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodPallet']}'></form></td>";
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
