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

if(!empty($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$email = htmlspecialchars(add_slashes($_POST['email']));
}else{
	$errors_array['email'] = "Please enter a valid email!";
}

if(!empty($_POST['phone'])){
	$phone = htmlspecialchars(add_slashes($_POST['phone']));
}else{
	$errors_array['phone'] = "Please enter a valid phone!";
}

if(!empty($_POST['password'])){
	$password = htmlspecialchars($_POST['password']);
}else{
	$errors_array['password'] = "Please enter a valid password!";
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
	$insert_into_rental_customers = "insert into rental_customers(first_name, last_name, email, phone, password, address_1, address_2, city, zip) VALUES
('$first_name', '$last_name', '$email', '$phone', '$password', '$address_1', '$address_2', '$city', '$zip')";
	$exec_insert_into_rental_customers = @mysqli_query($link, $insert_into_rental_customers);
	if(!$exec_insert_into_rental_customers){
		rollback("The following error occured when inserting into rental_customers: ".mysqli_error($link));
	}else{
		
		mysqli_query($link, 'COMMIT');
		redirect('You are successfully registered.', 'login.php', 2);
	}
}
?>