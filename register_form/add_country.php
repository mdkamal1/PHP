<!-- database name ==>learning -->
<!-- table name ==>add_country -->


<?php 

session_start();

if (isset($_SESSION['adminname'])) {

	echo $_SESSION['adminname'];
	echo "<br>";
	?>
		<button><a href="admin.php">Admin Page</a></button>
		<button><a href="add_language.php">Add Language</a></button>
		<button><a href="add_skills.php">Add Language</a></button>
		<button><a href="logout.php">Log Out</a></button>
		<br><br>
	<?php

	include_once "modified_strings.php";

	// connecting and selecting the database
	mysql_connect("localhost","root","");
	mysql_select_db("learning");

		

	extract($_POST);
		if (isset($add)) 
		{
			if (!empty($country)) 
			{
						
				$select="select * from add_country where country='".$country."'";
				$query1=mysql_query($select) or die(mysql_error());
				$count=mysql_num_rows($query1);
				if ($count>0) 
				{
					echo "<b>WARNING : </b> COUNTRY NAME IS ALREADY PRESENT";
					echo "<br>";
					echo "TRY ANOTHER COUNTRY NAME";
					echo "<br><br><br>";
				}
				else
				{
					$insert="insert into add_country(country) values('".modify($country)."')";	
					$query2=mysql_query($insert) or die(mysql_error());
					if ($query2) 
					{
						// echo "<b>DATA IS INSERTED</b>";
						
							// header("location:add_country.php");
						/*echo "<br>";
						echo "<b>ENTER NEW COUNTRY NAME<b>";
						echo "<br><br><br>";*/
				  	}
				}
			}
		
			else
			{
				echo "invalid country name";
			}
	  	}

		
	$select2="select * from add_country";
	$query3=mysql_query($select2) or die(mysql_error());

	echo "<b>ALREDAY AVAILABLE COUNTRY IN DATABASE</b>";
	echo "<br>";
	$i=1;
	while ($row=mysql_fetch_assoc($query3)) 
	{

		echo $i.".  ".$row['country'];
		echo "<br>";
		$i++;
	}

	?>
	<br><br>

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
							<label for="country">Country Name :: </label>
						</td>
						<td>
							<input type="text" name="country" autofocus id="country">
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

<?php 
}
else
{
	header("location:register.php");
}
?>