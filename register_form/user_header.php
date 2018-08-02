<style>
	h2{
		border: 2px solid red;
		width: 150px;
		text-align: center;
		border-radius: 20px;
		background-color: grey;
		height: auto;
		font-size: 30px;
		padding: 0;
	}
	h2 a{
		text-decoration: none;
		color: darkorange;
	}
	
	ul li{
		list-style-type: disc;
		width: 150px;
		margin-left:  -10px;
		line-height: 25px;
	}
	ul li a{
		text-decoration: none;
		color: black;
	}
</style>
<h2><a href="login.php?user_main_page" name="profile">Profile</a></h2>
<ul>
	<li><a href="user_profile.php?user_profile_detail" name="user_profile">User_profile</a></li>
	<li><a href="user_update.php?user_update" name="user_update">Update_profile</a></li>
	<li><a href="#" name="delete">Delete_Profile</a></li>
	<li><a href="user_change_password.php?change_password" name="password">Change_Password</a></li>
	<li><a href="logout.php"name="logout">Logout</a></li>
</ul>