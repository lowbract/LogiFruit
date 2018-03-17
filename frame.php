<?php
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
session_cache_expire(1);
$cache_expire = session_cache_expire();
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 23 May 2000 01:00:00 GMT"); // Date in the past
if ($_SESSION['funzione']=='VP') {
    $fsrc = "OdL-operativa.php";
} else {
    $fsrc = "NON SEI ABILITATO ALLA FUNZIONE";
}
?>
<frameset rows="50,*" frameborder="0">
  <frame src="frame-testa.php">
  <frame src="<?=$fsrc?>">
</frameset>