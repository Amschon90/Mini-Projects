<?php
session_start();
require('./includes/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');
if(isset($_SESSION['rental_customers_id']) && isset ($_SESSION['full_name'])){
	$rental_customers_id = $_SESSION['rental_customers_id'];

include('./includes/header.inc.php');

require('./includes/view_reservations.inc.php');

include('./includes/footer.inc.php');
}else{
	redirect('You are not logged in.', 'login.php', 2);
}
?>