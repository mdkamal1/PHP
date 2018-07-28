<?php 


function modifyvar($modify){
	$modified=ucfirst(strtolower(strip_tags(addslashes(trim($modify)))));
	return $modified;
}



	extract($_POST);

if (isset($admin)) {
		
		if ($admin_password=='admin123') {
			session_start();
			$_SESSION['adminname']='Admin Page';
			header("location:admin.php?admin_logged_in");
		}else{
			?>
			<script>alert("NOT AN ADMINISTRATOR");</script>
			<?php
		}
	}	

	if (isset($login)) {
		if (!empty($email) && !empty($password)) {
			require "dbconnect.php";
			$sel_qry="select * from register_tbl where email='$email' and password='$password'";
			$sel_res=mysql_query($sel_qry) or die(mysql_error());
			$sel_count=mysql_num_rows($sel_res);
			$row=mysql_fetch_assoc($sel_res);
			if ($sel_count==1) {

				session_start();
					$_SESSION['name'] = $row['uname'];
					$_SESSION['user_id'] = $row['id'];
					// print_r ($_SESSION);
				header("location:login.php?user_logged_in");
			}else{
				?><script>alert("EMAIL OR PASSWORD NOT FOUND")</script><?php
			}
		}else{
			?><script>alert("BLANK INPUT")</script><?php
		}
	}


	if (isset($submit)) 
	{
			
		if (!empty($uname) && !empty($fname) && !empty($lname) &&!empty($day) &&!empty($month) &&!empty($year) && !empty($email) && !empty($contact) && !empty($gender)  && !empty($password) && !empty($country)) 
			{
					// for multiple option from checkbox
		$lan=$_POST['languag'];
		$language=implode(",", $lan);

				require("dbconnect.php");

				$validate_query="select email,password from register_tbl where email='".modifyvar($email)."' or contact='".modifyvar($contact)."'";
				$validate_res=mysql_query($validate_query) or die(mysql_error());
				$count=mysql_num_rows($validate_res);
				if ($count>0) {
					echo "Email or Contact number is already registered";
				}
				else{

					$date_of_birth=$day."-".$month."-".$year;

				$insert_query="insert into register_tbl(uname,fname,lname,dob,email,contact,gender,country,language,password) values('".modifyvar($uname)."','".modifyvar($fname)."','".modifyvar($lname)."','$date_of_birth','".modifyvar($email)."','$contact','$gender','$country','$language','$password')";
				$insert_res=mysql_query($insert_query) or die(mysql_error());
				if ($insert_res) {
					echo "Registration is complete";
				}
			}
		}
			

			else {
				echo "fill the form correctly";
			}	
	}
	
 ?>

	<div style="float: left">	
		<form action="register.php" method="post">
			<table>

				<tr>
					<td>UserName</td>
					<td>
						<input type="text" name="uname">
					</td>
				</tr>

				<tr>
					<td>First Name</td>
					<td>
						<input type="text" name="fname">
					</td>
				</tr>

				<tr>
					<td>Last Name</td>
					<td>
						<input type="text" name="lname">
					</td>
				</tr>

				<tr>
					<td>Date of Birth </td>
					<td>
						<select name="day">
							<option value=>Day</option>
							<?php 
							$i=1;
								while ( $i <= 31) {
									?>
									<option>
										<?php echo $i; ?>
									</option>
									<?php
									$i++; 
								}
							 ?>
						</select>
						<select name="month">
							<option>Month</option>
							<?php 
								$month=array('January','February','March','April','May','June','July','August','September','October','November','December');
								foreach ($month as $value) {
									?>
										<option> 
											<?php echo $value; ?> 
										</option>
									<?php
								}
							 ?>
						</select>
						<select name="year">
							<option>Year</option>
								<?php 
									$x=2018;
									while ($x>=1910) {
										?>
										<option><?php echo "$x"; ?></option>
										<?php
										$x--;
									}
								 ?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Email</td>
					<td>
						<input type="email" name="email">
					</td>
				</tr>

				<tr>
					<td>Contact No</td>
					<td>
						<input type="text" name="contact">
					</td>
				</tr>

				<tr>
					<td>Gender</td>
					<td>
						<input type="radio" name="gender" value="male">Male
						<input type="radio" name="gender" value="female">Female
						<input type="radio" name="gender" value="other">Other
					</td>
				</tr>

				<tr>
					<td>Country</td>
					<td>
						<select name="country">
							<option value="">Select Country</option>
							<?php 
								require("dbconnect.php");
								$qry="select * from add_country";
								$res=mysql_query($qry) or die(mysql_error());
								while ($row=mysql_fetch_assoc($res)) {
								?>
								<option>
									<?php echo $row['country']; ?>
								</option>
								<?php  	
								}
							 ?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Language</td>
					<td>
						<input type="checkbox" name="languag[]" value="english">English
						<input type="checkbox" name="languag[]" value="hindi">Hindi
						<input type="checkbox" name="languag[]" value="urdu">Urdu
					</td>
						<!-- <td>
							<input type="text" name="language" placeholder="other">
						</td> -->
				</tr>

				<tr>
					<td>Password</td>
					<td>
						<input type="password" name="password">
					</td>
				</tr>

				<tr></tr>
				<tr></tr>
				
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="submit" value="SUBMIT">
					</td>
				</tr>
			</table>

		</form>
	</div>

<div style="float: right">

<form method="post">
	<input type="password" name="admin_password" placeholder="admin only">
	<input type="submit" name="admin" value="ADMIN PANNEL">
</form>

<br><br>

<form action="" method="post" style="margin-right: 20px;">
	<strong><u>USER LOGIN</u></strong><br><br>
	EMAIL : <input type="text" name="email" value=""><br><br>
	PASSWORD : <input type="password" name="password"><br><br>
	<input type="submit" name="login" value="Login">
</form>

</div>		