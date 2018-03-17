<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? 
session_start();
include 'costanti.php';
include 'connessione.php'; 
?>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Inserisci Nuovo Cliente</title>
<style type="text/css">
.style1 {
	text-align: center;
}
</style>
<link href="Style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery/jquery-2.1.3.js"></script>
<script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
<script>
function attiva_modifica(codicecampo){
    //window.alert(codicecampo);
    $(".btG").hide();
    $("#btconferma" + codicecampo).show();
    $(".tx").prop('disabled', true);
    $("#txNome" + codicecampo).prop('disabled', false);
    $("#txCognome" + codicecampo).prop('disabled', false);
    $("#txTelefono1" + codicecampo).prop('disabled', false);
    $("#txTelefono2" + codicecampo).prop('disabled', false);
}
function attiva_delete(codicecampo){
  //window.alert(codicecampo);
  $(".btRR").hide(); $(".btG").hide();
  $(codicecampo).show();
}
$(function() {
  $( "#tbFluttuante1" ).draggable();
  $(".tx").prop('disabled', true);
  $(".btRR").hide();
  $(".btG").hide();
});
</script>
</head>

<body>
<?
define ("POSIZIONE","Anagrafica - Autista");
define ("COLLEGAMENTO","InserisciAutista.php");
include_once 'percorso.php';
?>
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
        <td class="TestoTitoli" colspan="2">
        <form action="functionINSERT.php" method="post">
        <table style="width: 100%">
            <tr><td>Nome:</td><td><input name="Nome" type="text" /></td></tr>
            <tr><td>Cognome: </td><td><input name="Cognome" type="text" /></td></tr>
            <tr><td>Cellulare1:</td><td><input name="Tel1" type="text" /></td></tr>            
            <tr><td>Cellulare2:</td><td><input name="Tel2" type="text" /></td></tr>
            <input name="id" type="hidden" value='Autista' />
            <tr><td class="style1" colspan="2"><input name="Button1" type="Submit" value="Inserisci" /></td></tr>
        </table>          
        </form>
        </td>
    </tr>
</table>
<? include './anagrafiche/autista-modcanc.php'; ?>
</body>    
</html>