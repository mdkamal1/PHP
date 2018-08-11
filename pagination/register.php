<?php 

	extract($_POST);
// $fn=trim($fname);
// strip_tags($fname);
// addslashes($fname);

	if (isset($password)) {

		if (!empty($fname) && !empty($lname) && !empty($gender) && !empty($contact) && !empty($email)
			&& !empty($nation) && !empty($state) && !empty($password)) {
			
	$fname=strip_tags($fname);
	$lname=strip_tags($lname);
	$contact=strip_tags($contact);
	$email=strip_tags($email);
	
	$fname=trim($fname);
	$lname=trim($lname);
	$contact=trim($contact);
	$email=trim($email);

	$fname=addslashes($fname);
	$lname=addslashes($lname);
	$contact=addslashes($contact);
	$email=addslashes($email);

	$con=mysql_connect("localhost","root","");

	if ($con) {

		$database=mysql_select_db("learning");

		if ($database) {
			
			$query="insert into tbl_1(fname,lname,gender,contact,email,nation,state,password) values('$fname','$lname','$gender','$contact','$email','$nation','$state','$password')";

			$res=mysql_query($query);

			if ($res) {
					echo $fname;
					echo "<br>";
					echo "your form is submitted";
					echo "<br>";
					echo "Thank You";
				}	
		}


	}
	else
	{
		echo "not connected to database";
	}





 }
 else{
 	echo "complete the form";
 }
echo "<br><br><br><br><br><br>";
}

 
 ?>

 <html>
 	<head>
 		<title>
 			new form
 		</title>
 	</head>
 	<body>
 		<form action="" method="post">
 			<table>
 				<tr>
 					<td>First Name</td>
 					<td>
 						<input type="text" name="fname" id="fname">
 					</td>
 				</tr>

 				<tr>
 					<td>Last Name</td>
 					<td>
 						<input type="text" name="lname" id="lname">
 					</td>
 				</tr>

 				<tr>
 					<td>gender</td>
 					<td>
 						<input type="radio" name="gender" value="male">Male
 						<input type="radio" name="gender" value="female">Female
 						<input type="radio" name="gender" value="other">Other						 						
 					</td>
 				</tr>

 				<tr>
 					<td>Contact No</td>
 					<td>
 						<input type="text" name="contact" maxlength="10">
 					</td>
 				</tr>

 				<tr>
 					<td>Email</td>
 					<td>
 						<input type="email" name="email">
 					</td>
 				</tr>

 				<tr>
 					<td>Nationality</td>
 					<td>
 						<input type="radio" name="nation" value="india">India
 						<input type="radio" name="nation" value="nri">Nri
 					</td>
 				</tr>
						
					<tr>
						<td>Select the state</td>
						<td>
							
							<select name="state">
							
									<?php
								$state=array('Andra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand','Karnataka','Kerala','Madya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Punjab','Rajasthan','Sikkim','Tamil Nadu','Tripura','Uttaranchal','Uttar Pradesh','Andaman and Nicobar Islands','Chandigarh','Dadar and Nagar Haveli','Daman and Diu','Delhi','Lakshadeep','Pondicherry');
			
								  foreach ($state as $val) {
									echo "<option value='$val'>";
									echo  $val."</option>";
									

								}?>	
  									
								
							</select>

							</select>
						</td>
					</tr>
						
 				<tr>
 					<td>Password</td>
 					<td>
 						<input type="password" name="password">
 					</td>
 				</tr>

 				<tr>
 					<td>
 						<input type="submit" name="submit" value="Submit">
 					</td>
 				</tr>
 			</table>

 		</form>

 	</body>
 </html>