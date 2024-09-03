<?php 

	$server = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'ws_concoursprof';

	$db=mysqli_connect($server,$username,$password,$dbname);



// Check connection
if(!$db) {
		die("Connection Failed ");
    exit;
	} 