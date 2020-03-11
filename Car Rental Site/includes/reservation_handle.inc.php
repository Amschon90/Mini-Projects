<?php

$errors_array = array();

if(!empty($_POST['drivers_license'])&&is_string($_POST['drivers_license'])){
	$drivers_license = htmlspecialchars(add_slashes($_POST['drivers_license']));
}else{
	$errors_array['drivers_license'] = "Please enter a valid drivers license number!";
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

if(!empty($_POST['rental_days'])&&is_string($_POST['rental_days'])){
	$rental_days = htmlspecialchars(add_slashes($_POST['rental_days']));
}else{
	$errors_array['rental_days'] = "Please enter a valid number of days!";
}

if(isset($_POST['rentals_id'])){
	$rentals_id = $_POST['rentals_id'];
}else{
	$errors_array['rentals_id'] = "Please pick a car!";
}

if(!empty($_POST['reservation_date'])){
	$reservation_date = htmlspecialchars(add_slashes($_POST['reservation_date']));
}else{
	$errors_array['reservation_date'] = "Please enter a valid reservation date!";
}

if(isset($_POST['rental_pickup_locations_id'])){
	$rental_pickup_locations_id = $_POST['rental_pickup_locations_id'];
}else{
	$errors_array['rental_pickup_locations_id'] = "Please pick a location!";
}

if(count($errors_array) == 0){
	mysqli_query($link, 'AUTOCOMMIT = 0');
	$insert_billing_address = "INSERT INTO rental_billing_address (address_1, address_2, city, zip) VALUES ('$address_1', '$address_2', '$city', '$zip')"; 
	$exec_insert_billing_address = @mysqli_query($link, $insert_billing_address);
	if(!$exec_insert_billing_address){
		rollback("The following error occured when inserting into rental_billing_address: ".mysqli_error($link));
	}else{
		$rental_billing_address_id = mysqli_insert_id($link);
		$insert_reservation = "INSERT INTO rental_reservations (rental_customers_id, rentals_id, rental_pickup_locations_id, rental_billing_address_id, drivers_license, rental_days, reservation_date) VALUES
		($rental_customers_id, $rentals_id, $rental_pickup_locations_id, $rental_billing_address_id, $drivers_license, $rental_days, $reservation_date)";
		$exec_insert_reservation = @mysqli_query($link, $insert_reservation);
		if(!exec_insert_reservation){
			rollback("The following error occured when inserting into rental_reservations: ".mysqli_error($link));
	}else{
		mysqli_query($link, 'COMMIT');
		redirect('Thanks, your reservation was submitted.', 'view_current_reservations.php', 2);
	}
	}		
}
?>