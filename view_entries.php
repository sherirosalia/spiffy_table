<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View My Blog</title>
</head>
<body>
<h1>My Blog</h1>
<?php // Script 12.6 - view_entries.php
/* This script retrieves blog entries from the database. */

include('pdo_connect.php');	

// Define the query:
$query = $dbh->query('SELECT * FROM entries ORDER BY date_entered DESC');

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		print "<p><h3>{$row['title']}</h3>
		{$row['entry']}<br>
		<a href=\"edit_entry.php?id={$row['id']}\">Edit</a>
		<a href=\"delete_entry.php?id={$row['id']}\">Delete</a>
		</p><hr>\n";
	}

	echo '<pre>';
	print_r($dbh->ERRORINFO());
	echo '</pre>';
	
	$dbh = NULL; // Close the connection.
?>
</body>
</html>