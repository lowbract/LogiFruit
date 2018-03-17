<?php
/* 
 *  Percorso serve ad indicare la posizione dell'operatore nella gerarchia dei menu ed a fornire la possibilità di tornare
 * almeno alla home.
 */
?>
<a href="ordini.php" accesskey="z"></a><a href="trasportoindex.php" accesskey="x"></a>
<table border="0" width="100%">
    <tr>
        <td>
            <pre><a target="_top" href="Menu.php">Home</a> > <a target="_top" href="<?=COLLEGAMENTO?>"><?=POSIZIONE?></a></pre>
        </td>
        <td width="1%"><a target="_top" href="exit.php">logout</a></td>
    </tr>
</table>