<?php 
$con = mysqli_connect("localhost","root","","learning");
extract($_POST);
if(isset($submit))
{
	$lang = implode(",",$language);
	mysqli_query($con,"Insert into check_tb(uname, language) values ('$uname','$lang')");

	if(mysqli_affected_rows($con)==1)	
	{
		echo mysqli_affected_rows($con)." rows added";
	}	
	else
	{
		echo "Unable to add record";
	}
}
?>
	<style>
		table tr td,th{
			padding: 5px;
		}
	</style>
<form action="" method="POST">
Username: <input type="text" name="uname">
<input type="checkbox" name="language[]" value="english" id="english"><label for="english">English</label>
<input type="checkbox" name="language[]" value="hindi" id="hindi"><label for="hindi">Hindi</label>
<input type="checkbox" name="language[]" value="spanish" id="spanish"><label for="spanish">Spanish</label>
<input type="checkbox" name="language[]" value="french" id="french"><label for="french">French</label>
<input type="submit" value="submit" name="submit">
</form>

<table border="1px" style="border-collapse: collapse; text-align:center; padding: 5px;">
	<?php  
	if(isset($_POST['delete']))#delete query
	{
		extract($_POST);
		$ids = implode(",",$ids);
		mysqli_query($con,"DELETE FROM check_tb WHERE id IN ($ids)");
		echo mysqli_affected_rows($con)." row deleted.";
	}
	if(isset($_POST['status']))#change Status
	{
		$ids = implode(",",$_POST['ids']);
		$result = mysqli_query($con,"SELECT id,status FROM check_tb WHERE id IN ($ids)");
		while($user = mysqli_fetch_assoc($result))
		{
			$id = $user['id'];
			if($user['status']=='Inactive')
			{
				mysqli_query($con,"UPDATE check_tb SET `status` = 'Active' WHERE id=$id");		
			}
			elseif($user['status']=='Active')
			{
				mysqli_query($con,"UPDATE check_tb SET `status` = 'Inactive' WHERE id=$id");
			}
		}
		echo mysqli_num_rows($result). " status changed";
	}	
	if(isset($_POST['update'])) #Update Query
	{

	}
	?>
	<form action="" method="POST">
		<thead>
			<th>Select</th>
			<th>ID</th>
			<th>Uname</th>
			<th>Status</th>
			<th>Languages</th>
		</thead>
<?php 
	$result = mysqli_query($con,"Select * from check_tb");
	while($row=mysqli_fetch_assoc($result))
	{
	?>
		<tr>
			<td><input type="checkbox" name="ids[]" value="<?php echo $row['id']?>"></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['uname']; ?></td>
			<td><?php echo $row['status']; ?></td>
			<td><?php echo $row['language']; ?></td>
		</tr>
		
	<?php
	}
?>
		<tr>
			<td colspan="3"><button type="submit" name="delete">Delete</button></td>
			<td colspan="2"><button type="submit" name="status">Make Inactive or Active</button></td>
		</tr>
</form>
</table>