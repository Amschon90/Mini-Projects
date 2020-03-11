<?php

$select_reservations = "select rental_reservations_id, CONCAT (first_name,' ', last_name) as 'Drivers Name', reservation_date, location, style, description, (daily_rate * rental_days) as 'Subtotal'
from rental_reservations
join rental_customers on rental_reservations.rental_customers_id = rental_customers.rental_customers_id
join rental_pickup_locations on rental_reservations.rental_pickup_locations_id = rental_pickup_locations.rental_pickup_locations_id
join rentals on rental_reservations.rentals_id = rentals.rentals_id
join rental_styles on rentals.rental_styles_id = rental_styles.rental_styles_id
where rental_reservations.rental_customers_id = $rental_customers_id
AND reservation_date > NOW()";

$exec_select_reservations = @mysqli_query($link, $select_reservations);
if(!$exec_select_reservations){
	rollback('Reservations could not be found because '.mysqli_error($link));
}elseif(mysqli_num_rows($exec_select_reservations) > 0){
	echo "<table class='reservation_table' border='1'>
		<tr class='header'>
			<th>Drivers Name</th>
			<th>Reservation Date</th>
			<th>Pickup Location</th>
			<th>Vehicle Class</th>
			<th>Vehicle Description</th>
			<th>Subtotal</th>
			<th>Cancel</th>
		</tr>";
	while($one_record = mysqli_fetch_assoc($exec_select_reservations)){
		echo "<tr>
			<td>{$one_record['Drivers Name']}</td>
			<td>{$one_record['reservation_date']}</td>
			<td>{$one_record['location']}</td>
			<td>{$one_record['style']}</td>
			<td>{$one_record['description']}</td>
			<td>{$one_record['Subtotal']}</td>
			<td><a href='".$_SERVER['PHP_SELF']."?rental_reservations_id=".$one_record['rental_reservations_id']."'>Cancel</td>
		</tr>";
	}	
	echo "<tr><td colspan='6'>Number of Reservations:</td><td>".mysqli_num_rows($exec_select_reservations)."</td></tr></table>";
	mysqli_free_result($exec_select_reservations);
	
}else{
	echo "No reservations found";
}

?>