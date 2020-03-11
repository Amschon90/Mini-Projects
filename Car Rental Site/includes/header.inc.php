<!doctype html>
<html>
<head>
	<title><?php if(isset($title)){ echo $title;}else{ echo 'Submitted! Thank you!'; } ?></title>
	<meta charset='utf-8'>
	<style>
		.mainsection{
			width: 100%;
			margin: 0 auto;
			background: red;
			padding: 10px;
		}
		
		nav.topnavbar{
			width: 100%;
			margin: 0 auto;
			margin-bottom: 1em;
			padding: 5px 0px;
		}

		nav.topnavbar ul {
			list-style: none;
		}

		nav.topnavbar:after {
			content: "";
			display: block;
			clear: both;
		}
		
		nav.topnavbar>ul>li {
			float: left;
			position: relative;
		}

		nav.topnavbar ul li a{
			background: red;
			color: black;
			text-decoration: none;
			padding: 5px 10px;
			white-space: nowrap;
		}

		nav.topnavbar ul li:hover>a{
			color: red;
			background: black;
		}	
	</style>
</head>
<body>
<section class='mainsection'>
	<nav class='topnavbar'>
		<ul class='leftmainul'>
			<li>
				<?php
				if(isset($_SESSION['rental_customers_id']) && isset ($_SESSION['full_name'])){
					echo "Welcome {$_SESSION['full_name']} <a href='logout.php'>Logout</a>";
				}else{
					echo "<a href='login.php'>Login</a>";
				}
				?>
			</li>
			<li><a href='carrental.php'>Create Account</a></li>
			<li><a href='account_info.php'>Account Information</a></li>
			<li><a href='reservation.php'>Create a Reservation</a></li>
			<li><a href='view_current_reservations.php'>View Upcoming Reservations</a></li>
			<li><a href='view_reservations.php'>View Past Rental History</a></li>
		</ul>
	</nav>
</section>
