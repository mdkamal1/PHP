<!-- database name ==>learning -->
<!-- table name ==>add_country -->

<?php 

function modify($modify){
 $modified=ucwords(strtolower(strip_tags(addslashes(trim($modify)))));
 return $modified;
}

// connecting and selecting the database
mysql_connect("localhost","root","");
mysql_select_db("learning");

$select2="select * from add_country";
$query3=mysql_query($select2) or die(mysql_error());

	echo "<b>ALREDAY AVAILABLE COUNTRY IN DATABASE</b>";
	echo "<br>";
while ($row=mysql_fetch_assoc($query3)) {
	
	echo $row['country'];
	echo "<br>";
}
echo "<br>";
echo "REFERSH TO ADD RECENTLY ADDED COUNTRY NAME";
echo "<br><br>";
extract($_POST);
	if (isset($add)) {
		if (!empty($country)) {
					
					$select="select * from add_country where country='".modify($country)."'";
					$query1=mysql_query($select) or die(mysql_error());
					$count=mysql_num_rows($query1);
					if ($count>0) {
						echo "<b>WARNING : </b> COUNTRY NAME IS ALREADY PRESENT";
						echo "<br>";
						echo "TRY ANOTHER COUNTRY NAME";
						echo "<br><br><br>";
					}
					else{
						$insert="insert into add_country(country) values('".modify($country)."')";	
						$query2=mysql_query($insert) or die(mysql_error());
						if ($query2) {
							echo "<b>DATA IS INSERTED</b>";
							echo "<br>";
							echo "<b>ENTER NEW COUNTRY NAME<b>";
							echo "<br><br><br>";
					  	}
					}
				  }
			
	else{
		echo "invalid country name";
	}
  }
?>


<html>
	<head>
		<title>
			
		</title>
	</head>
	<body>   
		<form action="" method="post">
			<table>
				<tr>
					<td>
						Country Name :: 
					</td>
					<td>
						<input type="text" name="country" autofocus>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<input type="submit" name="add" value="ADD">
					</td>
				</tr>
			</table>
		</form>

	</body>
</html>