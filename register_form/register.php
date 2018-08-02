<?php 

session_start();  // starting all the session on the page
require_once "dbconnect.php";
include_once "modified_strings.php";
extract($_POST);  // extracting the variables from the form


// FOR ADMIN LOGIN PAGE
	if (isset($admin)) 
		{
			if ($admin_password=='admin123') 
			{
				$_SESSION['adminname']='Admin Page';
				header("location:admin.php?admin_logged_in");
			}
			else
			{
				?>
					<script>alert("NOT AN ADMINISTRATOR");</script>
				<?php
			}
		}	


// FOR USER LOGIN PAGE
		if (isset($login)) 
			{
				if (!empty($email) && !empty($password)) 
				{	
					$sel_qry="select * from register_tbl where email='$email' and password='$password'";
					$sel_res=mysql_query($sel_qry) or die(mysql_error());
					$sel_count=mysql_num_rows($sel_res);
					$row=mysql_fetch_assoc($sel_res);
						if ($sel_count==1) 
						{
							session_start();
							$_SESSION['name'] = $row['uname'];
							$_SESSION['user_id'] = $row['id'];
							$_SESSION['last_login'] = date("Y-m-d H:i:s A");
						// print_r ($_SESSION);

							if (isset($remember)) 
							{
								$time=120;
								setcookie('email',$email,time()+$time);
								setcookie('password',$password,time()+$time);
								// print_r($_COOKIE);
								echo "COOKIE IS SET for REMEMBER ME FOR ".$time."sec";
							}

							header("location:login.php?user_logged_in");
						}
						else
						{
							?>
								<script>alert("EMAIL OR PASSWORD NOT FOUND")</script>
							<?php
						}
				}
					else
					{
						?>
							<script>alert("BLANK INPUT")</script>	
						<?php
					}
			}


// FOR REGISTERATION PAGE
	if (isset($submit)) 
	{
		if (!empty($uname) && !empty($fname) && !empty($lname) &&!empty($day) &&!empty($month) &&!empty($year) && !empty($email) && !empty($contact) && !empty($gender)  && !empty($password) && !empty($country)) 
			{
					// for multiple option from checkbox
				// $lan=$_POST['language'];
				$lang=implode(",", $language);
				$skills=implode(",", $skill);

				//validation query	
				$validate_query="select email,password from register_tbl where email='$email' or contact='$contact'";
				$validate_res=mysql_query($validate_query) or die(mysql_error());
				$count=mysql_num_rows($validate_res);
					if ($count>0) 
					{
						?>
							<script>alert("EMAIL OR CONTACT NO IS ALREADY REGISTERED");</script>
						<?php
					}
					else
					{
						//insert query
						$date=date("Y-m-d");
						$date_of_birth=$day."-".$month."-".$year;
						$insert_query="insert into register_tbl(uname,fname,lname,dob,email,contact,gender,country,language,skills,password,registered_on,status) values('".modifystr($uname)."','".modifystr($fname)."','".modifystr($lname)."','$date_of_birth','".modifystr($email)."','$contact','$gender','$country','$lang','$skills','$password','$date','active')";
						$insert_res=mysql_query($insert_query) or die(mysql_error());

						$userid=mysql_insert_id();
						
						foreach ($skill as $value) 
						{
							$skill_ins="insert into register_skill_tbl(skills,id) values('$value','$userid')";
							$skill_res=mysql_query($skill_ins) or die(mysql_error());
						}

						foreach ($language as $value1) 
						{
							$lang_ins="insert into register_lang_tbl(lang,id) values('$value1','$userid')";
							$lang_res=mysql_query($lang_ins) or die(mysql_error());
						}


							if ($insert_res) 
							{
								if ($skill_res) 
								{
									if ($lang_res) 
									{
								?>
									<script>alert("REGISTRATION COMPLETED SUCCESSFULLY");</script>
								<?php
									}
								}	
							}
					}
			}
			else 
			{
				echo "fill the form correctly";
			}	
	}
	
 ?>


<!-- REGISTER HTML TABLE -->
	<div style="float: left">
	<h2><u>REGISTRATION TABLE</u></h2>	
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
								while ( $i <= 31) 
								{
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
								foreach ($month as $value)
								{
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
									while ($x>=1910) 
									{
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
								$country_qry="select * from add_country";
								$country_res=mysql_query($country_qry) or die(mysql_error());
								while ($country_row=mysql_fetch_assoc($country_res)) 
								{
								?>
									<option>
										<?php echo $country_row['country']; ?>
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
						<?php 
								$language_qry="select * from add_language";
								$language_res=mysql_query($language_qry) or die(mysql_error());
								while ($language_row=mysql_fetch_assoc($language_res)) 
								{
								?>
									<input type="checkbox" name="language[]" value="<?php echo $language_row['language']; ?>"><?php echo $language_row['language'] ?>										
								<?php  	
								}
							?>



						<!-- <input type="checkbox" name="languag[]" value="english">English
						<input type="checkbox" name="languag[]" value="hindi">Hindi
						<input type="checkbox" name="languag[]" value="urdu">Urdu -->
					</td>
						<!-- <td>
							<input type="text" name="language" placeholder="other">
						</td> -->
				</tr>
				<tr>
				<td>Skills</td>
					<td>
						<?php 
								$skill_qry="select * from add_skills";
								$skill_res=mysql_query($skill_qry) or die(mysql_error());
								while ($skill_row=mysql_fetch_assoc($skill_res)) 
								{
								?>
									<input type="checkbox" name="skill[]" value="<?php echo $skill_row['skills']; ?>"><?php echo $skill_row['skills'] ?>										
								<?php  	
								}
							?>
					</td>
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


<!--ADMIN HTML TABLE  -->
	<form method="post">
		<input type="password" name="admin_password" placeholder="admin only">
		<input type="submit" name="admin" value="ADMIN PANNEL">
	</form>

<br><br>


<!-- SIGNIN HTML TABLE -->
	<form action="" method="post" style="margin-right: 20px;">
		<strong><u>USER LOGIN</u></strong><br><br>
		EMAIL : <input type="text" name="email" value="<?php if(!empty($_COOKIE['email'])) echo $_COOKIE['email']; ?>"><br><br>
		PASSWORD : <input type="password" name="password" value="<?php if(!empty($_COOKIE['password'])) echo $_COOKIE['password']; ?>" ><br><br>
		<input type="checkbox" value="remember" name="remember">Remember Me<br><br>
			<input type="submit" name="login" value="Login">
	</form>

</div>		

<?php  

?>