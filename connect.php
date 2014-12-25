<?php
mysql_connect("localhost","username","password");
mysql_query('CREATE DATABASE IF NOT EXISTS test');
mysql_select_db("test");
mysql_query("CREATE  TABLE IF NOT EXISTS users(username TEXT, password TEXT, id INT, email TEXT, date_reg TEXT, last_lgoin TEXT, ip TEXT)");
?>
