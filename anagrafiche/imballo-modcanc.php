<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE imballo SET TipoImballo=\"{$_POST['modifica']}\" WHERE CodImb={$_POST['CodImb']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM imballo WHERE CodImb={$_POST['CodImb']} LIMIT 1";
    $sql = "UPDATE imballo SET del = 1 WHERE CodImb={$_POST['CodImb']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM imballo WHERE del = 0 ORDER BY TipoImballo ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbFluttuante1>';
echo '<tr>'; echo "<th colspan=2>Imballi</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodImb']}'><form method=POST><input type=hidden name=CodImb value='{$rs['CodImb']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodImb']}' value='{$rs['TipoImballo']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodImb']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodImb']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodImb value='{$rs['CodImb']}'>"
            . "<button type=button name='btcancella' value='{$rs['CodImb']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodImb']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodImb']}'></form></td>";
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
