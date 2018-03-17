<?php
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
session_cache_expire(1);
$cache_expire = session_cache_expire();
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 23 May 2000 01:00:00 GMT"); // Date in the past

session_destroy();
$yep = <<<EOF
        <META HTTP-EQUIV=Refresh CONTENT='1;URL=index.php'> 
EOF;
echo $yep;

