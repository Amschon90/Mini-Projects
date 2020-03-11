<form action='<? echo $_SERVER['PHP_SELF']; ?>' method='POST' name='reservation_form' id='reservation_form'>
	<fieldset><legend>Driver Information</legend>
	<?php create_form_field('Drivers License Number: ', 'text', 'drivers_license', 'drivers_license', ['maxlength'=>'20', 'size'=>'20', 'tabindex'=>'1', 'title'=>'Drivers License', 'required'=>'required', 'pattern'=>'[A-Za-z0-9]{2,10}', 'placeholder'=>''], $errors_array);
	?>
	
	<fieldset><legend>Billing Address</legend>
	<?php 
	$select_address = "SELECT address_1, address_2, city, zip from rental_customers WHERE rental_customers_id = $rental_customers_id";
	$exec_select_address = @mysqli_query($link, $select_address);
	if(!exec_select_address){
		rollback('The following error occured: '.mysqli_error($link));
	}else{
		$one_record = mysqli_fetch_assoc($exec_select_address);
		$address_1 = $one_record['address_1'];
		$address_2 = $one_record['address_2'];
		$city = $one_record['city'];
		$zip = $one_record['zip'];
	}
	
	create_form_field('Address 1:', 'text', 'address_1', 'address_1', ['maxlength'=>'100', 'size'=>'50', 'tabindex'=>'6', 'title'=>'Home Address', 'required'=>'required', 'pattern'=>'[A-Za-z0-9_\.\#\' \-:=]{2,100}', 'placeholder'=>'100 Market Street'], $errors_array);
	create_form_field('Address 2:', 'text', 'address_2', 'address_2', ['maxlength'=>'100', 'size'=>'50', 'tabindex'=>'7', 'title'=>'Home Address', 'pattern'=>'[A-Za-z0-9_\.\#\' \-:=]{0,100}', 'placeholder'=>'Suite #9'], $errors_array);
	create_form_field('City:', 'text', 'city', 'city', ['maxlength'=>'50', 'size'=>'20', 'tabindex'=>'8', 'title'=>'City', 'pattern'=>'[A-Za-z]{2,50}', 'placeholder'=>'Youngstown'], $errors_array);
	create_form_field('Zip:', 'text', 'zip', 'zip', ['maxlength'=>'5', 'size'=>'5', 'tabindex'=>'10', 'title'=>'Zip Code', 'placeholder'=>'44555'], $errors_array);
	
	?>
	</fieldset>
	</fieldset>
	
	
	<fieldset><legend>Rental Information</legend>
	<?php create_form_field('Days Needed: ', 'text', 'rental_days', 'rental_days', ['maxlength'=>'3', 'size'=>'3', 'tabindex'=>'2', 'title'=>'Rental Days', 'required'=>'required', 'pattern'=>'[0-9]{1-3}', 'placeholder'=>''], $errors_array);

	$select_rental = "SELECT rentals_id, description, daily_rate from rentals, rental_styles where rentals.rental_styles_id = rental_styles.rental_styles_id";
			$exec_select_rental = @mysqli_query($link, $select_rental);
			if(!$exec_select_rental){
				exit("The following error occurred: ".mysqli_error($link));
				mysqli_close($link);
			}else{
				$multi_array = array();
				while($one_record = mysqli_fetch_assoc($exec_select_rental)){
					$multi_array[] = $one_record;
				}
				create_drop_down_from_query('Rental Type: ', 'rentals_id', 'rentals_id', $multi_array, ['title'=>'Rental Type'], $errors_array);
			}
		create_form_field('Pick Up Date: ', 'date', 'reservation_date', 'reservation_date', ['tabindex'=>'3', 'title'=>'Reservation Date', 'required'=>'required', 'pattern'=>'[0-9]{8}', 'placeholder'=>'YYYYMMDD'], $errors_array);
		
		$select_location = "SELECT rental_pickup_locations_id, location from rental_pickup_locations";
			$exec_select_location = @mysqli_query($link, $select_location);
			if(!$exec_select_location){
				exit("The following error occurred: ".mysqli_error($link));
				mysqli_close($link);
			}else{
				$multi_array = array();
				while($one_record = mysqli_fetch_assoc($exec_select_location)){
					$multi_array[] = $one_record;
				}
				create_drop_down_from_query('Pick Up Location: ', 'rental_pickup_locations_id', 'rental_pickup_locations_id', $multi_array, ['title'=>'Location'], $errors_array);
			}
		
		?>	
	</fieldset>
	
	<fieldset>
	<p>
		<input type='hidden' value='form_submitted' name='form_submitted' id='form_submitted' />
		<input type='submit' value='Submit' />
		
		<input type='reset' value='Reset' />
	</p>
	</fieldset>
	
	</form>