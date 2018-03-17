<?php
session_start();
$con = mysql_connect("localhost", "root", "epass1+");
mysql_select_db("italfrutta", $con) or die(mysql_error());

if (isset($_POST['ButtonIndex'])) {
    $userName = $_POST[Username];
    $passWord = $_POST[Password];
    mysql_select_db('italfrutta');
    $query = "select * from utente where NomeUtente='" . $userName . "'and     Password='" . $passWord . "'";
    $result = mysql_query($query, $con);
    if (!$result) {
        die('Nome utente o password errati! ' . mysql_error());
    }
    $rows = mysql_num_rows($result);
    if ($rows == 1) {
        $_SESSION['Username'];
        $_SESSION['Password'];
        header("location: Menu.php");
       
    }
    }
?>