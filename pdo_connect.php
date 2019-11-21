



<?php
//$servername = "localhost";
//$dbname = "webd166_04";
$username = 'root';
$password = '';

try {
	
	
	$user = 'root';
	$pass = ''; 

	$dbh = new PDO('mysql:host=localhost;dbname=webd166_04', $user, $pass);

	//echo 'database connected';
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

