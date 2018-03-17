<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Inserisci Nuovo Cliente</title>
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
</head>

<body>

<table style="width: 25%">
	<tr>
		<td style="width: 324px; height: 123px;"><img src="Risorse/ItalfruttaL2.jpg" /></td>
		<td class="style1" style="height: 123px" colspan="2"><span class="TestoTitoli">ItalFrutta <br/>tabella 
		lavorazioni</span></td>
	</tr>

	<tr class="TestoTitoli">
		<td colspan="3" class="style1">Inserisci Nuova Lavorazione<br/><br/></td>
	</tr>
	<tr>
		<td class="style3">Lavorazione</td>
		<td class="style1">
		<form action="functionINSERT.php" method="post">
			<input name="DatoForm" type="text">
                        <input name="id" type="hidden" value='Lavorazione'>
		</td>
		<td class="style1"><input name="Button1" type="Submit" value="Inserisci" /></form></td>
	</tr>
</table>

</body>    

</html>