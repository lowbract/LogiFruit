<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Ital-Frutta sac - Login</title>
<style type="text/css">
.style4 {
	border: 1px solid #000000;
	font-family: Calibri;
		font-size: large;
		font-weight: bold;
		font-style: italic;
		text-align: center;
}
.style5 {
	border: 1px solid #000000;
}
.style6 {
	text-align: center;
	border-collapse: collapse;
	border: 1px solid #000000;
}
</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin: 30px 0 0 0">

<table align="center" cellpadding="2" style="width: 44%; height: 227px" class="style5">
	<tr>
		<td colspan="3" class="style6" valign="top">
		<img alt="" height="121" src="Risorse/ItalfruttaL2.jpg" width="300" /></td>
	</tr>
	<tr class="Testo">
		<td colspan="3" class="style6">Login ItalFrutta</td>
	</tr>
	<tr>                
		<td class="style4" style="height: 50%">Nome Utente</td>
		<td class="style6" rowspan="2" valign="top"><br/>
       		<form method="post" name="NomeUtente" action="auth-user.php" style="height: 100%">
				<input name="Username" type="text" /><br/><br/>
           	 	<input name="Password" type="password" /><br/><br/>
            	<td class="style5" rowspan="2" valign="middle" align="center">
            	<? echo 
            		"<input name='ButtonIndex' type='Submit' value='Autentica' />" ;?>
            	</td>
        	</form>
        </td>
	</tr>
	<tr class="Testo">
		<td class="style6" style="height: 50%">Password</td>
	</tr>
	
</table>

</body>

</html>
