<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE pezzatura SET TipoPez=\"{$_POST['modifica']}\" WHERE CodPez={$_POST['CodPez']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM pezzatura WHERE CodPez={$_POST['CodPez']} LIMIT 1";
    $sql = "UPDATE pezzatura SET del = 1 WHERE CodPez={$_POST['CodPez']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM pezzatura ORDER BY TipoPez ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbFluttuante1>';
echo '<tr>'; echo "<th colspan=2>Pezzatura</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodPez']}'><form method=POST><input type=hidden name=CodPez value='{$rs['CodPez']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodPez']}' value='{$rs['TipoPez']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodPez']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodPez']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodPez value='{$rs['CodPez']}'>"
            . "<button type=button name='btcancella' value='{$rs['CodPez']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodPez']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodPez']}'></form></td>";
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
