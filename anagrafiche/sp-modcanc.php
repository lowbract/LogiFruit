<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE nomeprod SET NomeProd=\"{$_POST['modifica']}\" WHERE CodNP={$_POST['CodNP']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM nomeprod WHERE CodNP={$_POST['CodNP']} LIMIT 1";
    $sql = "UPDATE nomeprod SET del = 1 WHERE CodNP={$_POST['CodNP']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM nomeprod ORDER BY NomeProd ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbNomeprod>';
echo '<tr>'; echo "<th colspan=2>Prodotti</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodNP']}'><form method=POST><input type=hidden name=CodNP value='{$rs['CodNP']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodNP']}' value='{$rs['NomeProd']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodNP']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodNP']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodNP value='{$rs['CodNP']}'>"
            . "<button type=button name='btcancella' value='{$rs['CodNP']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodNP']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodNP']}'></form></td>";
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
