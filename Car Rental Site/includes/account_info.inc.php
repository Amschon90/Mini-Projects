<?php

$select_account_info = "select rental_customers_id, CONCAT (first_name,' ', last_name) as 'Full Name', email, phone, CONCAT_WS (' ',address_1, address_2, city, zip) as address
from rental_customers where rental_customers_id = $rental_customers_id";

$exec_select_account_info = @mysqli_query($link, $select_account_info);
if(!$exec_select_account_info){
	rollback('Customer account info could not be retrieved because '.mysqli_error($link));
}elseif(mysqli_num_rows($exec_select_account_info) > 0){
	echo "<table class='account_info_table' border='1'>
		<tr class='header'>
			<th>Full Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Address</th>
		</tr>";
	while($one_record = mysqli_fetch_assoc($exec_select_account_info)){
		echo "<tr>
	<td><a href='account_update.php?rental_customers_id=".$one_record['rental_customers_id']."'>{$one_record['Full Name']}</a></td>
			<td>{$one_record['email']}</td>
			<td>{$one_record['phone']}</td>
			<td>{$one_record['address']}</td>
		</tr>";
	}	
	echo "<tr><td colspan='3'>Number of Customers:</td><td>".mysqli_num_rows($exec_select_account_info)."</td></tr></table>";
	mysqli_free_result($exec_select_account_info);
	
}else{
	echo "No customer data found";
}

?>