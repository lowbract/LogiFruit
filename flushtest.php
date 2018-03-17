<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

*This will show each line at a time with a pause of 2 seconds.
*(Tested under IEx and Firefox)

if (ob_get_level() == 0) ob_start();

for ($i = 0; $i<10; $i++){

        echo "<br> Line to show.";
        echo str_pad('',4096)."\n";   

        ob_flush();
        flush();
        sleep(2);
}

echo "Done.";

ob_end_flush();

?>