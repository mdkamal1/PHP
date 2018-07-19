<!-- database name ==>learning -->
<!-- table name ==>add_country -->

<?php 

function modify($modify){
 $modified=ucwords(strtolower(strip_tags(addslashes(trim($modify)))));
 return $modified;
}

extract($_POST);
	if (isset($add)) {
		if (!empty($country)) {
			$con=mysql_connect("localhost","root","");
			if ($con) {
				$db=mysql_select_db("learning");
				if ($db) {
					
					$select="select * from add_country where country='".modify($country)."'";
					$query1=mysql_query($select) or die(mysql_error());
					$count=mysql_num_rows($query1);
					if ($count>0) {
						echo "COUNTRY NAME IS ALREDAY PRESENT";
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
				}
			
			else{
				echo "error in connecting database";
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