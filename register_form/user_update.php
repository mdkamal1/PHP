<?php 
session_start();
require_once("dbconnect.php");
	if (isset($_SESSION['user_id'])) {

		include_once "user_header.php";
		$uid=$_SESSION['user_id'];

		$user_lang=mysql_query("select * from register_lang_tbl where id = $uid");	
		while ($lang_fetch=mysql_fetch_assoc($user_lang)) 
		{
			$lang[]=$lang_fetch['lang'];
		}

		$user_skill=mysql_query("select * from register_skill_tbl where id = $uid");	
		while ($skills_fetch=mysql_fetch_assoc($user_skill)) 
		{
			$skills[]=$skills_fetch['skills'];
		}



		extract($_POST);
		if (isset($update)) {
			$date_of_birth=$day."-".$month."-".$year;
			$update_query="update register_tbl set uname='$uname',fname='$fname',lname='$lname',dob='$date_of_birth',email='$email',contact='$contact',country='$country'  where id=$uid ";
			$update_sel=mysql_query($update_query) or die(mysql_error());

			$del_lang="delete from register_lang_tbl where id=$uid ";
			$del_lang_run=mysql_query($del_lang) or die(mysql_error());
			


			foreach ($lan as $value) 
				{
					$add_lang="insert into register_lang_tbl (lang,id) values ('$value','$uid')	";
					$add_lang_run=mysql_query($add_lang) or die(mysql_error());	
				}

			$del_skill="delete from register_skill_tbl where id=$uid ";
			$del_skill_run=mysql_query($del_skill) or die(mysql_error());
			
			foreach ($skill as $value) 
				{
					$add_skill="insert into register_skill_tbl (skills,id) values ('$value','$uid')	";
					$add_skill_run=mysql_query($add_skill) or die(mysql_error());	
				}		
					// header("location:register.php?updated");			
					// header("location:user_update.php");
		} 	

		$select_query="select * from register_tbl where id = $uid";
		$select_res=mysql_query($select_query) or die(mysql_error()); 				
		$row=mysql_fetch_assoc($select_res);
		// $lang = explode(",", $row['language']);
		
			?>

<form action="" method="post">
	<table>
		<tr>
			<td>UserName</td>
			<td>
				<input type="text" name="uname" value="<?php echo $row['uname']; ?>">
			</td>
		</tr>
		<tr>
			<td>First Name</td>
			<td>
				<input type="text" name="fname" value="<?php echo $row['fname']; ?>">
			</td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td>
				<input type="text" name="lname" value="<?php echo $row['lname']; ?>">
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
				<input type="email" name="email" value="<?php echo $row['email']; ?>">
			</td>
		</tr>
		<tr>
			<td>Contact No</td>
			<td>
				<input type="text" name="contact" value="<?php echo $row['contact']; ?>">
			</td>
		</tr>

				<!-- <tr>
					<td>Gender</td>
					<td>
						<input type="radio" name="gender" value="male">Male
						<input type="radio" name="gender" value="female">Female
						<input type="radio" name="gender" value="other">Other
					</td>
				</tr> -->

		<tr>
			<td>Country</td>
			<td>
				<select name="country">
					<option value="" >Select Country</option>
						<?php 
						$qry="select * from add_country";
						$res=mysql_query($qry) or die(mysql_error());
							while ($row1=mysql_fetch_assoc($res)) 
							{
								?>
								<option <?php if ($row['country']==$row1['country']) {
									echo "selected";
								} ?>>
									<?php echo $row1['country']; ?>
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
				// $uid=$row1['id'];
					
					// print_r($lang);
					// echo $uid;

					$lang_select=mysql_query("select * from add_language");	
					while ($lan_fetch=mysql_fetch_assoc($lang_select)) 
					{
						// print_r($lang_fetch);
						?>
							<input type="checkbox" name="lan[]" value="<?php echo $option_lang=$lan_fetch['language']; ?>" <?php if (in_array($option_lang,$lang)) 
							{
							echo "checked";
							} ?>><?php echo $option_lang; ?>		
						<?php
					}
				
				?>
			</td>
						<!-- <td>
							<input type="text" name="language" placeholder="other">
						</td> -->
		</tr>

		<tr>
			<td>Skill</td>
			<td>
				<?php  
					

					$skill_select=mysql_query("select * from add_skills");	
					while ($skill_fetch=mysql_fetch_assoc($skill_select)) 
					{
						?>
							<input type="checkbox" name="skill[]" value="<?php echo $option_skill=$skill_fetch['skills']; ?>" <?php if (in_array($option_skill,$skills)) 
							{
							echo "checked";
							} ?>><?php echo $option_skill; ?>		
						<?php
					}
				?>
			</td>
						
		</tr>
		
		<tr></tr>
		<tr></tr>
		<tr>
			<td colspan="3" align="center"><input type="submit" value="UPDATE" name="update"></td>	
		</tr>
	</table>
</form>

	<?php 
}
else
{
	header("location:register.php");
}

?>