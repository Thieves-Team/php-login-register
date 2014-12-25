<?php
date_default_timezone_set("Europe/Bucharest");
include("inc/connect.php");
if(isset($_POST['login'])) { 
	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		$user = $_POST['username'];
		$pass = md5(md5($_POST['password']));
		$ip = $_SERVER['REMOTE_ADDR'];
		$date = date("d.m.Y H:i:s");
		$query_login = mysql_query("SELECT * FROM `users` WHERE `username` = '$user'");
		while($row = mysql_fetch_array($query_login)) {
			$db_user = $row['username'];
			$db_pass = $row['password'];
		}
		if(isset($db_user) && $pass == $db_pass) {
			mysql_query("UPDATE `test`.`users` SET `last_login` = '$date', `ip` = '$ip' WHERE `username` = '$user'");				
			echo "You have succesfully logged";
		}else{
			echo "Username or password is incorrect";
		}
	}else{
		echo "All fields are required";
	}
}  
?>
<form action="" method="post">
Username : <input type="text" name="username" /> <br /><br />
Password : <input type="password" name="password" /> <br /><br />
<input type="submit" name="login" value="Login"/>
</form>
<a href="index.php"> Back </a>
