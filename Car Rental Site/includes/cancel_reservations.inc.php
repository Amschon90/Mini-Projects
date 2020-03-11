<?php
mysqli_query($link, "SET AUTOCOMMIT = 0");
$delete_reservation = "DELETE rental_billing_address.*, rental_reservations.* from rental_billing_address, rental_reservations WHERE rental_reservations.rental_billing_address_id = rental_billing_address.rental_billing_address_id AND rental_reservations_id = $rental_reservations_id";
$exec_delete_reservation = @mysqli_query($link, $delete_reservation);
if(!$exec_delete_reservation){
	rollback('Delete failed because '.mysqli_error($link));
}else{
	mysqli_query($link, "COMMIT");
	redirect('Your reservation has been cancelled', 'view_current_reservations.php', 1);
}
?>