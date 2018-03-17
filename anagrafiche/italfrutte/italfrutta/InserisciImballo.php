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
</head>

<body>

<table style="width: 25%">
	<tr>
		<td colspan="3" class="style1">Inserisci Nuovo Cliente</td>
	</tr>
	<tr>
		<td class="style1">Cliente</td>
		<td class="style1">
		<form action="functionINSERT.php" method="post">
			<input name="DatoForm" type="text">
                        <input name="id" type="hidden" value='Imballo'>
		</td>
		<td class="style1"><input name="Button1" type="Submit" value="Inserisci" /></form></td>
	</tr>
</table>

</body>    

</html>
