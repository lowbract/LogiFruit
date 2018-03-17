<?php
$pdo = connetti();

if (isset($_POST['modifica'])) {
    $sql = "UPDATE autista SET Nome=\"{$_POST['nome']}\", Cognome=\"{$_POST['cognome']}\", Telefono1=\"{$_POST['telefono1']}\", Telefono2=\"{$_POST['telefono2']}\" WHERE CodAut={$_POST['CodAut']}";
    if (BETA2) { echo '<pre class=Beta2>'; echo $sql; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

if (isset($_POST['btcancsure'])) {
    //$sql = "DELETE FROM autista WHERE CodAut={$_POST['CodAut']} LIMIT 1";
    $sql = "UPDATE autista SET del = 1 WHERE CodAut={$_POST['CodAut']} LIMIT 1";
    if (BETA2) { echo 'test<pre class=Beta2>'; echo $query; echo '</pre>'; }
    $query = $pdo->prepare($sql);
    $query->execute();
}

$sql = "SELECT * FROM autista WHERE del = 0 ORDER BY Nome ASC";
$query = $pdo->prepare($sql);
$query->execute();
    //$list = $query->fetch(PDO::FETCH_ASSOC);
$list = $query->fetchAll(PDO::FETCH_ASSOC);
echo '<table id=tbFluttuante1>';
echo '<tr>'; echo "<th colspan=2>Autisti</th>"; echo '</tr>';
foreach ($list as $rs) {
    //print_r($rs);
    echo "<tr>\n";
    echo "<td id='{$rs['CodAut']}'><form method=POST><input type=hidden name=CodAut value='{$rs['CodAut']}'>"
        . "<input type=text name='nome' class='tx' id='txNome{$rs['CodAut']}' value='{$rs['Nome']}'>"
        . "<input type=text name='cognome' class='tx' id='txCognome{$rs['CodAut']}' value='{$rs['Cognome']}'>"
        . "<input type=text name='telefono1' class='tx' id='txTelefono1{$rs['CodAut']}' value='{$rs['Telefono1']}'>"
        . "<input type=text name='telefono2' class='tx' id='txTelefono2{$rs['CodAut']}' value='{$rs['Telefono2']}'>"
        . "<input type=submit name='modifica' class='btG' id='btconferma{$rs['CodAut']}' value='SICURO?'>"
        . "<button type=button name='btmodifica' value='{$rs['CodAut']}' class=btY onclick=\"attiva_modifica('{$rs['CodAut']}')\">M</button></form></td><td>"
        . "<form method=POST><input type=hidden name=CodAut value='{$rs['CodAut']}'>"
        . "<button type=button name='btcancella' value='{$rs['CodAut']}' class=btR onclick=\"attiva_delete('#btc{$rs['CodAut']}')\">C</button>"
        . "<input type=submit name='btcancsure' value='SICURO?' class=btRR id='btc{$rs['CodAut']}'></form></td>";
    echo "</tr>\n";
}
echo '</table>';
if (BETA3) {//beta3
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
