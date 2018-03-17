<?php
session_start();
include_once 'connessione.php';
//$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
//mysql_select_db(DB_NAME, $con) or die(mysql_error());

if (isset($_POST['ButtonIndex'])) {
    $userName = $_POST[Username];
    $passWord = $_POST[Password];
    //mysql_select_db('italfrutta');
    //$query = "select * from utente where NomeUtente='" . $userName . "'and     Password='" . $passWord . "'";
    $query = "SELECT * FROM utente WHERE user='" . $userName . "' AND password='" . $passWord . "'";
    echo $query."<br>";
    $result = mysql_query($query, $db);
    if (!$result) {
        die('Nome utente o password errati! ' . mysql_error());
    }
    $rows = mysql_num_rows($result);
    if ($rows == 1) {
        $gino = mysql_fetch_assoc($result);
        $_SESSION['Username']=$userName;
        $_SESSION['funzione']=$gino['funzione'];
        header("location: Menu.php");
       
    }
    }
?>