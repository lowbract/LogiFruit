<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE vettore SET NomeVettore=\"{$_POST['modifica']}\" WHERE CodVett={$_POST['CodVett']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM vettore WHERE CodVett={$_POST['CodVett']} LIMIT 1";
    $sql = "UPDATE vettore SET del = 1 WHERE CodVett={$_POST['CodVett']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM vettore ORDER BY NomeVettore ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbFluttuante1>';
echo '<tr>'; echo "<th colspan=2>Vettore</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodVett']}'><form method=POST><input type=hidden name=CodVett value='{$rs['CodVett']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodVett']}' value='{$rs['NomeVettore']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodVett']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodVett']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodVett value='{$rs['CodVett']}'>"
            . "<button type=button name='btcancella' value='{$rs['CodVett']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodVett']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodVett']}'></form></td>";
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
