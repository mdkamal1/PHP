<?php 
session_start();
if (isset($_SESSION['user_id'])) {

include_once "user_header.php";
require_once "dbconnect.php";

$uid=$_SESSION['user_id'];
 $select_query="select * from register_tbl where id = $uid";
  $select_res=mysql_query($select_query) or die(mysql_error());
 				
 	$row=mysql_fetch_assoc($select_res);

extract($_POST);
if (isset($update)) {
$lan=$_POST['languag'];
$language=implode(",", $lan);

$date_of_birth=$day."-".$month."-".$year;

 $update_query="update register_tbl set uname='$uname',fname='$fname',lname='$lname',language='$language',dob='$date_of_birth',email='$email',contact='$contact',language='$language'  where id=$uid ";
 $update_sel=mysql_query($update_query) or die(mysql_error());
 header("location:register.php?updated");
} 	
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
								require("dbconnect.php");
								$qry="select * from add_country";
								$res=mysql_query($qry) or die(mysql_error());
								while ($row1=mysql_fetch_assoc($res)) {
								?>
								<option>
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
						<input type="checkbox" name="languag[]" value="english" >English
						<input type="checkbox" name="languag[]" value="hindi">Hindi
						<input type="checkbox" name="languag[]" value="urdu">Urdu
					</td>
						<!-- <td>
							<input type="text" name="language" placeholder="other">
						</td> -->
				</tr>
						<tr></tr><tr></tr>
				<tr>
					<td colspan="3" align="center"><input type="submit" value="UPDATE" name="update"></td>
					
				</tr>
	</table>
</form>

<?php 
}else{
	header("location:register.php");
}

?>