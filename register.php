<?php
date_default_timezone_set("Europe/Bucharest");
include("inc/connect.php");
if(isset($_POST['register'])) { 
	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_pass']) && !empty($_POST['email'])) {
		if($_POST['password'] == $_POST['confirm_pass']) {
			if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
				$user = $_POST['username'];
				$pass = md5(md5($_POST['password']));
				$confirm_pass = $_POST['confirm_pass'];
				$email = $_POST['email'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date("d.m.Y H:i:s");
				$query_rep_user = mysql_query("SELECT * FROM `users` WHERE `username` = '$user'");
				$query_rep_email = mysql_query("SELECT * FROM `users` WHERE `email` = '$email'");
				while($row = mysql_fetch_array($query_rep_user)) {
					$db_user = $row['username'];
				}
				while($row = mysql_fetch_array($query_rep_email)) {
					$db_email = $row['email'];
				}
				if(isset($db_user)) { 
					echo "Username already exists<br />"; 
				}elseif(isset($db_email)) { 
					echo "E-mail already exists<br />"; 
				}else{
					mysql_query("INSERT INTO `test`.`users` (`username`, `password`, `date_reg`, `last_login`, `ip`, `email`) VALUES ('$user', '$pass', '$date', '$date', '$ip','$email')");
					echo "You have registered succsesfully";
				}
			}else{
				echo "E-mail is incorrect";
			}
		}else{
			echo "Passwords do not match";
		}
	}else{
		echo "All fields are required";
	}
}  
?>
<form action="" method="post">
Username : <input type="text" name="username" /> <br /><br />
Password : <input type="password" name="password" /> <br /><br />
Confirm  : <input type="password" name="confirm_pass" /> <br /><br />
E-mail :<input type="text" name="email" /> <br /><br />
<input type="submit" name="register" value="Register"/>
</form>
<a href="index.php"> Back </a>
