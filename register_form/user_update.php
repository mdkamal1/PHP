<?php 
session_start();
require_once("dbconnect.php");
	if (isset($_SESSION['user_id'])) {

		include_once "user_header.php";
		$uid=$_SESSION['user_id'];

		
		// print_r($lang_array);

		extract($_POST);
		if (isset($update)) 
		{
			$date_of_birth=$day."-".$month."-".$year;
			$update_query="update register_tbl set uname='$uname',fname='$fname',lname='$lname',dob='$date_of_birth',email='$email',contact='$contact',country='$country'  where id=$uid ";
			$update_sel=mysql_query($update_query) or die(mysql_error());


				#update language
			$del_lang="delete from register_lang_tbl where id=$uid ";
			$del_lang_run=mysql_query($del_lang) or die(mysql_error());
			
			foreach ($lan as $value) 
				{
					$add_lang="insert into register_lang_tbl (lang,id) values ('$value','$uid')	";
					$add_lang_run=mysql_query($add_lang) or die(mysql_error());	
				}


				#update skill
			$del_skill="delete from register_skill_tbl where id=$uid ";
			$del_skill_run=mysql_query($del_skill) or die(mysql_error());
			
			foreach ($skill as $value) 
				{
					$add_skill="insert into register_skill_tbl (skills,id) values ('$value','$uid')	";
					$add_skill_run=mysql_query($add_skill) or die(mysql_error());	
				}		
		} 	

		$select_query="select * from register_tbl where id = $uid";
		$select_res=mysql_query($select_query) or die(mysql_error()); 				
		$row=mysql_fetch_assoc($select_res);
		$user_date=explode("-",$row['dob']);
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
						
						for($i=1; $i <= 31;$i++) 
						{
							?>
							<option <?php if ($user_date[0]==$i) {
								echo "selected";
							} ?>>
								<?php echo $i; ?>
							</option>
								<?php
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
								<option <?php if ($user_date[1]==$value) {
								echo "selected";
							} ?>> 
									<?php echo $value; ?> 
								</option>
									<?php
							}
								?>
				</select>
				<select name="year">
					<option>Year</option>
						<?php
							
							for ($x=2018;$x>=1910;$x--) 
							{
								?>
								<option <?php if ($user_date[2]==$x) {
								echo "selected";
							} ?>><?php echo "$x"; ?></option>
								<?php
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

					$user_lang=mysql_query("select * from register_lang_tbl where id = $uid");	
					if(mysql_num_rows($user_lang)==0)
					{
						$lang_array=array("");
					}
					else
					{
						while ($lang_fetch=mysql_fetch_assoc($user_lang)) 
						{
							$lang_array[]=$lang_fetch['lang'];
						}
					}
					$lang_select=mysql_query("select * from add_language");	
					while ($lan_fetch=mysql_fetch_assoc($lang_select)) 
					{
						?>
							<input type="checkbox" name="lan[]" value="<?php echo $option_lang=$lan_fetch['language']; ?>" <?php if (in_array($option_lang,$lang_array)) 
							{
							echo "checked";
							} ?>><?php echo $option_lang; ?>		
						<?php
					}
				?>
			</td>
		</tr>

		<tr>
			<td>Skill</td>
			<td>
				<?php  
					
					$user_skill=mysql_query("select * from register_skill_tbl where id = $uid");
					if(mysql_num_rows($user_skill)==0)
					{
						$skill_array=array("");
					}
					else
					{	
						while ($skills_fetch=mysql_fetch_assoc($user_skill)) 
						{
							$skill_array[]=$skills_fetch['skills'];
						}	
					}

					$skill_select=mysql_query("select * from add_skills");	
					while ($skill_fetch=mysql_fetch_assoc($skill_select)) 
					{
						?>
							<input type="checkbox" name="skill[]" value="<?php echo $option_skill=$skill_fetch['skills']; ?>" <?php if (in_array($option_skill,$skill_array)) 
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