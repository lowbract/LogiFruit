<html>
    <body>
<title>Modifica Ordine</title>
<style type="text/css">
.style1 {
	text-align: center;
}
.style3 {
	font-family: Calibri;
	font-size: x-large;
	font-style: italic;
	font-weight: bold;
	font-variant: small-caps;
	text-align: center;
}
</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
<table style="width: 25%">
	<tr>
		<td style="width: 324px; height: 123px;"><img src="Risorse/ItalfruttaL2.jpg" /></td>
		<td class="style1" style="height: 123px" colspan="2"><span class="TestoTitoli">ItalFrutta <br/>Modifica Ordine</span></td>
	</tr>


</table>



<?
include("connessione.php");

if (isset($_POST['Modifica'])) include("prodottoissetmodifica.php");         

if (isset($_GET['idProdotto'])) include("prodottoRIvisual.php");

include ("prodottovisualtabella.php"); 
?>

        
</body>
</html>
