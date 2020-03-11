<?php
session_start();
$title = 'logout';
require('./includes/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');

if(isset($_SESSION['rental_customers_id']) && isset ($_SESSION['full_name'])){
	//setcookie('rental_customers_id', '', time()+3600, '/', '', 0, 1);
	//setcookie('full_name', '', time()+3600, '/', '', 0, 1);
	unset($_SESSION['rental_customers_id']);
	unset($_SESSION['full_name']);
	
	$_SESSION = array();
	
	session_destroy();
	setcookie('PHPSESSID', '', time()-5, '/', '', 0, 0);
	redirect('Logout successful.', 'login.php', 2);
}else{
	redirect('You are already logged out', 'login.php', 1);
}
?>