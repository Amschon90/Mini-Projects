<?php
session_start();
$title = 'Registration';
require('./includes/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');
if(isset($_SESSION['rental_customers_id']) && isset ($_SESSION['full_name'])){
	redirect('You are already logged in.', 'view_reservations.php', 2);
}else{	
if(!empty($_POST['form_submitted'])){
	require('./includes/car_rental_handle.inc.php');
}
include('./includes/header.inc.php');
require('./includes/car_rental_form.inc.php');

include('./includes/footer.inc.php');
}
?>