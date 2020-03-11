<?php
DEFINE('HOST', 'localhost');
DEFINE('USER', 'amschon');
DEFINE('PASS', 'dtr61322');
DEFINE('DB', 'car_rental_project');

$link = @mysqli_connect(HOST, USER, PASS, DB) or die('The following error occured: '.mysqli_connect_error());

mysqli_set_charset($link, 'utf8');

?>