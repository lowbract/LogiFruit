<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Inserisci Nuovo Cliente</title>
<style type="text/css">
.style1 {
	text-align: center;
}
</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table style="width: 25%">
	<tr>
		<td style="width: 324px; height: 123px;"><img src="Risorse/ItalfruttaL2.jpg" /></td>
		<td class="style1" style="height: 123px"><span class="TestoTitoli">ItalFrutta <br/>tabella 
		autista</span></td>
	</tr>

	<tr class="TestoTitoli">
		<td colspan="2" class="style1">Inserisci Nuovo autista<br/><br/></td>
	</tr>
	
	<tr>
		<td class="TestoPiccolo">
		<form action="functionINSERT.php" method="post">
                    <br/>Nome: 
                    <td><input name="Nome" type="text" /><tr>
			<td class="TestoPiccolo">
                    <br/>Cognome: 
                    <td><input name="Cognome" type="text" />
                    </td></tr>
                    <tr><td class="TestoPiccolo">
                    <br/>Cellulare1: </td><td><input name="Tel1" type="text" /></td></tr>
                    <tr><td class="TestoPiccolo">
                    <br/>Cellulare2: </td><td><input name="Tel2" type="text" /></td></tr>       
                    <br/><input name="id" type="hidden" value='Autista' />
		</td>
		<td class="style1" colspan="2"><input name="Button1" type="Submit" value="Inserisci" /></form></td></tr></table>

</body>    

</html>