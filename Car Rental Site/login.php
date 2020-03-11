<?php
session_start();
$title = 'login';
require('./includes/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');
if(isset($_SESSION['rental_customers_id']) && isset ($_SESSION['full_name'])){
	redirect('You are already logged in.', 'view_reservations.php', 2);
}else{
	
if(isset($_POST['submitted'])){
	if(!empty($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$email = htmlspecialchars(add_slashes($_POST['email']));
	}else{
		$errors_array['email'] = "Please enter a valid email!";
	}
	if(!empty($_POST['password'])){
		$password = htmlspecialchars($_POST['password']);
	}else{
		$errors_array['password'] = "Please enter a valid password!";
	}
	
	if(count($errors_array) == 0){
		$sel_customer = "SELECT rental_customers_id, password, concat(first_name,' ', last_name) as full_name from rental_customers where email = '$email'";
		$exec_sel_customer = @mysqli_query($link, $sel_customer);
		if(!exec_sel_customer){
			rollback('An error occured'.mysqli_error($link));
		}elseif(mysqli_num_rows($exec_sel_customer) > 1){
			rollback('There are multiple customers with one email. Please call customer support.');
	}else{
		$one_record = mysqli_fetch_assoc($exec_sel_customer);
		$cus_password = $one_record['password'];
		if($cus_password == $password){
			//setcookie('rental_customers_id', $one_record['rental_customers_id'], time()+3600, '/', '', 0, 1);
			//setcookie('full_name', $one_record['full_name'], time()+3600, '/', '', 0, 1);
			$_SESSION['rental_customers_id'] = $one_record['rental_customers_id'];
			$_SESSION['full_name'] = $one_record['full_name'];
			redirect('Welcome!', 'view_reservations.php', 2);
			
		}else{
			redirect('There was an error', 'login.php', 2);
		}
	}
	}

}else{
	echo "<form action='{$_SERVER['PHP_SELF']}'	method='POST' name='login_form' id='login_form'>";
	
	create_form_field('Email:', 'email', 'email', 'email', ['maxlength'=>'40', 'size'=>'20', 'tabindex'=>'3', 'title'=>'Type in Your email Here', 'required'=>'required', 'placeholder'=>'email@you.com']);
	create_form_field('Password:', 'password', 'password', 'password', ['maxlength'=>'15', 'size'=>'10', 'tabindex'=>'5', 'title'=>'Type in Your Password', 'required'=>'required', 'placeholder'=>'xxxxxxxx']);
	
	echo "<input type='hidden' value='form_submitted' name='submitted' id='form_submitted' />
		<input type='submit' value='Submit' />
		
		<input type='reset' value='Reset' />
	</form>
	<a href='carrental.php'>Register</a>";
}
}


?>