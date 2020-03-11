<?php
$update_account_info = "SELECT first_name, last_name, phone, address_1, address_2, city, zip
FROM rental_customers WHERE rental_customers_id = $rental_customers_id";
$exec_update_account_info = @mysqli_query($link, $update_account_info);

if(!$exec_update_account_info){
	rollback('Customers account info could not be retrieved because: '.mysqli_error($link));
}elseif(mysqli_num_rows($exec_update_account_info)==1){
	$one_record = mysqli_fetch_assoc($exec_update_account_info);
	$first_name = $one_record['first_name'];
	$last_name = $one_record['last_name'];
	$phone = $one_record['phone'];
	$address_1 = $one_record['address_1'];
	$address_2 = $one_record['address_2'];
	$city = $one_record['city'];
	$zip = $one_record['zip'];
	mysqli_free_result($exec_update_account_info);
}else{
	redirect('Unknown error', 'account_info.php', 2);
}

?>