<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>ItalFrutta - LogiPear - Menù principale</title>
<base target="_self">
<style type="text/css">
.style1 {
	text-align: center;
}
.TestoTitoli {
	font-family: Calibri;
	font-size: x-large;
	font-style: italic;
	font-weight: bold;
	font-variant: small-caps;
}
.Testo {
	font-family: Calibri;
	font-size: large;
	font-weight: bold;
	font-style: italic;
}
.style2 {
	border-collapse: collapse;
	border: 1px solid #000000;
}
.Menu {
	font-family: Calibri;
        /* text-align: center; */
}</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>
<body style="margin: 1px">
<table style="width: 100%" class="style2">
	<tr>
		<td style="width: 324px"><img alt="logo italfrutta" src="./Risorse/ItalfruttaL2.jpg" /></td>
                <td class="style1"><span class="TestoTitoliGrande"><img width="200" alt="logo italfrutta" src="./Risorse/logipear_logo.png" />Menu</span></td>
	</tr>
	<tr>
            <td colspan="2" class="FondoImmagine">
                <ul id=”nomeID” class="Menu">
                    <li>Gestione Ordini
                        <ul>
                        <li><a href="ordini.php" accesskey="z">[z] Creazione e Gestione Ordine</a></li>
                        <li><a href="trasportoindex.php" accesskey="x">[x] Associazione Trasporto ad Ordine</a></li>
                        <li><a href="cancellazione.php">Cancellazione Prodotto da Ordine</a></li>
                        <li><a href="ricercaxdata.php">Ricerca per DATA</a></li>
                        <li><a href="modificaprodotto.php">Modifica Prodotto</a></li>
                        </ul>
                    </li> </br>
                    <li><a href="lavorazione.php">Visualizzazione STATO ORDINI</a> </li> 
                    <br></br>
                    <li><a href="trasportoconbottone.php">Visualizzazione STATO TRASPORTO</a> </il> 
                    <li>Anagrafica<ul>
                    <li><a href="InserisciCliente.php">Cliente</a></li>
                    <li><a href="InserisciSP.php">Prodotto</a></li>
                    <li><a href="InserisciLavorazione.php">Lavorazione</a></li>
                    <li><a href="InserisciPezzatura.php">Pezzatura</a></li>
                    <li><a href="InserisciImballo.php">Imballo</a></li>
                    <li><a href="InserisciPallet.php">Pallet</a></li>
                    <li><a href="InserisciVettore.php">Vettore</a></li>
                    <li><a href="InserisciAutista.php">Autista</a></li>
                    </ul></li>
                </ul>
            </td>
	</tr>		
    </table>
</body>
</html>
