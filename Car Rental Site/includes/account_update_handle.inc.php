<?php

$errors_array = array();

if(!empty($_POST['first_name'])&&is_string($_POST['first_name'])){
	$first_name = htmlspecialchars(add_slashes($_POST['first_name']));
}else{
	$errors_array['first_name'] = "Please enter a valid first name!";
}

if(!empty($_POST['last_name'])&&is_string($_POST['last_name'])){
	$last_name = htmlspecialchars(add_slashes($_POST['last_name']));
}else{
	$errors_array['last_name'] = "Please enter a valid last name!";
}

if(!empty($_POST['phone'])){
	$phone = htmlspecialchars(add_slashes($_POST['phone']));
}else{
	$errors_array['phone'] = "Please enter a valid phone!";
}

if(!empty($_POST['address_1'])){
	$address_1 = htmlspecialchars(add_slashes($_POST['address_1']));
}else{
	$errors_array['address_1'] = "Please enter a valid home address!";
}

if(!empty($_POST['address_2'])){
	$address_2 = htmlspecialchars(add_slashes($_POST['address_2']));
}else{
	$address_2 = null;
}

if(!empty($_POST['city'])){
	$city = htmlspecialchars(add_slashes($_POST['city']));
}else{
	$errors_array['city'] = "Please enter a valid City!";
}

if(!empty($_POST['zip'])){
	$zip = htmlspecialchars(add_slashes($_POST['zip']));
}else{
	$errors_array['zip'] = "Please enter a valid zip!";
}

if(count($errors_array) == 0){
	mysqli_query($link, 'AUTOCOMMIT = 0');
	$update_rental_customers = "update rental_customers
	set
	first_name = '$first_name',
	last_name = '$last_name',
	phone = '$phone',
	address_1 = '$address_1',
	address_2 = '$address_2',
	city = '$city',
	zip = '$zip'
	where rental_customers_id = $rental_customers_id";
	$exec_update_rental_customers = @mysqli_query($link, $update_rental_customers);
	if(mysqli_affected_rows($link)==0){
		mysqli_query('COMMIT');
		redirect('No account updated', 'account_info.php', 2);
	}elseif(mysqli_affected_rows($link)==1){
		mysqli_query($link, 'COMMIT');
		redirect('Account updated. You are being redirected now.', 'account_info.php', 2);
	}else{
		rollback('The following error occured'.mysqli_error($link));
	}
}else{
	require('./includes/account_update.inc.php');
}

?>