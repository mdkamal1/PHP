<?php 
session_start();
session_destroy();

// unset($_SESSION);

 header("location:register.php?successfully_logged_out");

?>