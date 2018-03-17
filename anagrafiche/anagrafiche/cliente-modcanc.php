<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE cliente SET NomeCliente=\"{$_POST['modifica']}\" WHERE CodCliente={$_POST['CodCliente']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM cliente WHERE CodCliente={$_POST['CodCliente']} LIMIT 1";
    $sql = "UPDATE cliente SET del = 1 WHERE CodCliente={$_POST['CodCliente']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM cliente WHERE del = 0 ORDER BY NomeCliente ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbClienti>';
echo '<tr>'; echo "<th colspan=2>Cliente</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodCliente']}'><form method=POST><input type=hidden name=CodCliente value='{$rs['CodCliente']}'><input type=text name='modifica' class='tx' id='tx{$rs['CodCliente']}' value='{$rs['NomeCliente']}'>"
            . "<button type=button name='btmodifica' value='{$rs['CodCliente']}' class=btY onclick=\"attiva_modifica('#tx{$rs['CodCliente']}')\">M</button></form></td><td>"
            . "<form method=POST><input type=hidden name=CodCliente value='{$rs['CodCliente']}'>"
            . "<button type=button name='btcancella' value={$rs['CodCliente']} class=btR onclick=\"attiva_delete('#btc{$rs['CodCliente']}')\">C</button>"
            . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodCliente']}'></form></td>";
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
