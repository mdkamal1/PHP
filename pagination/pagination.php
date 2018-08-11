<?php  
$con = mysqli_connect("localhost","root","","learning") or die("error in connection");
$result = mysqli_query($con,"select * from tbl_1 ");
if(mysqli_num_rows($result)==0)
{
	echo "not result is found";
}else
{
	$total_res=mysqli_num_rows($result);
	$record_per_page=3;
	$no_of_pages=ceil($total_res/$record_per_page);
	/*if (isset($_GET['page'])) {
	$c_p=$_GET['page'];
	}else{
		$c_p=1;
	}*/

	// TUNNEL OPERATOR {same as if()}
	$current_page = (isset($_GET['page'])) ? $_GET['page'] : 1 ; // variable = condition ? true : false :

	$index=($current_page-1)*($record_per_page);
	$pag_result = mysqli_query($con,"select * from tbl_1 limit $index,$record_per_page");
		?>
			<table border="2" align="center" style="line-height: 25px; margin-top: 30px;">
				<tr>
					<th>S.No</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Nation</th>
					<th>State</th>
				</tr>
		<?php
	$n=1;	
	while ($record=mysqli_fetch_assoc($pag_result)) 
	{
		?>
			<tr>
				<!-- <td><?php //echo $n; $n++; ?></td> -->
				<td><?php echo $record['id']; ?></td>
				<td><?php echo $record['fname'];?></td>
				<td><?php echo $record['lname'];?></td>
				<td><?php echo $record['gender'];?></td>
				<td><?php echo $record['contact'];?></td>
				<td><?php echo $record['email'];?></td>
				<td><?php echo $record['nation'];?></td>
				<td><?php echo $record['state'];?></td>
			</tr>
		<?php	
	}
	?></table>
	<br>
	<div align="right" style="margin-right: 260px;">
		<!-- <?php echo $current_page;?> -->
		<button style="text-align: center" <?php if ($current_page==1) { echo "hidden";}?>>
			<a href="pagination.php?page=<?php echo $current_page-1; ?>">pre</a>
		</button>
		<?php
	for ($i=1; $i <= $no_of_pages ; $i++) 
	{ 
		?>
		<button style="text-align: center"><a href="pagination.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></button>
		<?php
	}
		?>
		<button style="text-align: center" <?php if ($current_page==$no_of_pages) { echo "hidden";}?>>
			<a href="pagination.php?page=<?php echo $current_page+1; ?>">next</a>
		</button>
	</div>
	<br>
	<div align="right" style="margin-right: 260px;">
		<input type="text" name="jump_page" placeholder="enter page no">
		<input type="submit" name="jump" value="jump">

	</div>
		<?php
}

print_r(mysqli_error($con));

?>