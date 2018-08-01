<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("learning"); 

extract($_POST);

if (isset($submit)) {
	
	$res=mysql_query("insert into remember_me(name,contact,email,password) values('$name','$contact','$email','$password')") or die(mysql_error()) ;
	if ($res) 
	{
	 	?>
	 	<script>alert("registered successfully");</script>
	 	<?php	
	}
}

?>

<form action="" method="post">	
	<label for="name">NAME : </label>
	<input type="text" name="name" id="name">
<br><br>
	<label for="contact">CONTACT : </label>
	<input type="text" name="contact" id="contact">
<br><br>
	<label for="email">EMAIL : </label>
	<input type="email" name="email" id="email">
<br><br>
	<label for="password">PASSWORD : </label>
	<input type="password" name="password" id="password">
<br><br>	
	<input type="submit" value="Submit" name="submit">
</form>


<?php  

	if (isset($login)) {
		$res_set=mysql_query("select * from remember_me where email='$email' and password='$password'");

		$user = mysql_fetch_assoc($res_set);

		if ($res_set) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['user_name'] = $user['name'];
			$_SESSION['user_email'] = $user['email'];
			// print_r($_SESSION);
			// header("location:home.php"); 
			// print_r($_SESSION);
			
			if (isset($remember)) {
				$time=3600;
				setcookie('email',$email,time()+$time);
				setcookie('password',$password,time()+$time);
				// print_r($_COOKIE);
				echo "COOKIE IS SET for REMEMBER ME FOR ".$time."sec";
			}

		}
		?>
			<script>alert("login successfully");</script>
		<?php
	}
?>

<form action="" style="float: right;" method="post">
	<label for="email">EMAIL : </label>
	<input type="email" name="email" id="email" value="<?php if(!empty($_COOKIE['email'])) echo $_COOKIE['email']; ?>" >
<br><br>
	<label for="password">PASSWORD : </label>
	<input type="password" name="password" id="password" value="<?php if(!empty($_COOKIE['password'])) echo $_COOKIE['password']; ?>" >
<br><br>	
	<input type="checkbox" value="remember" name="remember">Remember Me
<br><br>
	<input type="submit" value="Login" name="login">
</form>
