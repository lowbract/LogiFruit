 <?php
$link=mysql_pconnect("localhost","user","password");
mysql_select_db("db",$link);
$result = mysql_query("select date_format(birth_date,'%Y') as birth_year from members where member_id=1");

$row=mysql_fetch_array($result); // fetch first row
$year=$row["birth_year"]; // retrieve 4-digit year of birth

// display combo: current year -> -100
$current_year=date("Y");
echo '<select name="cbo_year">';
for ($i = $current_year; $i >= ($current_year-100); $i--) {
echo '<option '.($year == $i ? ' selected ' : '').' value="'.$i.'" >'.$i.'</option>';
}
echo '</select>';
?> 

<?php echo "<option value='$id'> $name </option>";?>

<td width="6025" rowspan="3" align="left">
<p class="style1">
Target:
<select name="select">
<?
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$name=mysql_result($result,$i,"name");
$phone=mysql_result($result,$i,"phone");
$email=mysql_result($result,$i,"email");
?>
<? echo "<option value='$id'>$name</option>";?>
<?php }?>
</select>

You do the same thing for the other loop. Or assign this:
$new_variable = "<option value='$id'>$name</option>";
to a variable and just echo in the other select box. 


 <?php
$link=mysql_pconnect("localhost","user","password");
mysql_select_db("db",$link);
$result = mysql_query("select date_format(birth_date,'%Y') as birth_year from members where member_id=1");

$row=mysql_fetch_array($result); // fetch first row
$year=$row["birth_year"]; // retrieve 4-digit year of birth

// display combo: current year -> -100
$current_year=date("Y");
echo '<select name="cbo_year">';
for ($i = $current_year; $i >= ($current_year-100); $i--) {
echo '<option '.($year == $i ? ' selected ' : '').' value="'.$i.'" >'.$i.'</option>';
}
echo '</select>';
?> 


$sql = "SELECT sigla,nome FROM provincie ORDER BY nome";
$result = mysql_query($sql);             
echo"<select name='provincia_nascita'>";
while($row = mysql_fetch_array($result))
{
    print("<option value='".$row['sigla']."'");
    print(">".$row['nome']."</option>");
}
echo '</select>


while($lista = mysql_fetch_array(mysql_query("SELECT sigla,nome FROM provincie ORDER BY nome")))
{
echo '<option value="'.$lista['sigla'].'"'.(($lista['sigla'] == $sceltaprecedente) ? ' selected="selected"' : '').'>'.$lista['nome'].'</option>';


<form action="" method="post" enctype="multipart/form-data">

  <strong>Your Name: </strong><br>
     <input type="text" name="myname" value="" />
  <br /><br/>    

  <strong>Which class type you want:</strong><br>
    <select name="selection">
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
    </select>

  <strong>Do you agree?</strong><br>
    <input type="radio" name="agree" value="Yes"> or 
    <input type="radio" name="agree" value="No">


  <input type="submit" name="submit" value="Submit">

</form>  



<?php

$sql = "SELECT users.user_id, users.name FROM users";
                $result = mysql_query($sql, $connection)
                or die ("Couldn't perform query $sql <br />".mysql_error());
                $row = mysql_fetch_array($result);?>

 <label>Designated Person:</label> <select name="name" id="name">

        <option value="<?php echo $row['user_id']?>" SELECTED><?php echo $row['name']?> - Current</option>

         <?php    
              while($row = mysql_fetch_array($result))
        { ?>                        <option value="<?php echo $row['user_id']; if (isset($_POST['user_id']));?>">
            <?php echo $row['fullname']?></option>
        <?php } ?>


<label for="name">Designated Person:</label>
    <select name="name" id="name">

 <?php    
      while($row = mysql_fetch_array($result))
{ ?>                        
    <option value="<?php echo $row['user_id'] ?>" 
        <?php if ($curname == $row['name']) echo ' SELECTED'; ?>>
            <?php echo $row['fullname']?></option>
<?php } ?>

    $row = mysql_fetch_object($sqlCliente); 
       //echo "<br>";
       //echo "echo ->";
       //echo $row->CodCliente;