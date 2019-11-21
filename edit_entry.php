<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit a Blog Entry</title>
</head>
<body>
<h1>Edit an Entry</h1>
<?php // Script 12.8 - edit_entry.php
// Connect and select:
include('pdo_connect.php');	


if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the entry in a form:

	// Define the query.
	$query = $dbh->query("SELECT title, entry FROM entries WHERE id={$_GET['id']}");
	if($row = $query->fetch(PDO::FETCH_ASSOC))  { // Run the query.
	


	// Make the form:
	print '<form action="edit_entry.php" method="post">
	<p>Entry Title: <input type="text" name="title" size="40" maxsize="100" value="' . htmlentities($row['title']) . '"></p>
	<p>Entry Text: <textarea name="entry" cols="40" rows="5">' . htmlentities($row['entry']) . '</textarea></p>
	<input type="hidden" name="id" value="' . $_GET['id'] . '">
	<input type="submit" name="submit" value="Update this Entry!">
	</form>';

	} else { // Couldn't get the information.
		print '<p style="color: red;">Webd166 no information found</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.

	// Validate and secure the form data:
	$problem = FALSE;
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		$id = $_POST['id'];
		$title = trim(strip_tags($_POST['title']));
		$entry = trim(strip_tags($_POST['entry']));
		
	} else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}
	
	if (!$problem) {
		//echo 'inside no problem';

		

		$update = $dbh->prepare("UPDATE entries SET title='$title', entry='$entry' WHERE id={$_POST['id']}");
		echo 'past dbh prepare';
		$update->bindParam(':title', $title);
		$update->bindParam(':entry', $entry);
		$update->bindParam(':id', $id);

		var_dump($update);

		// Report on the result:
		if ($update->execute()) {
			print '<p>The blog entry has been updated.</p>';
			echo 'inside update execute';
		} else {
			print '<p style="color: red;">WEBD166 Edit Update Failed</p>';
		}

	} // No problem!

} else { // No ID set.
	print '<p style="color: red;">This page has been accessed in error.</p>';
} // End of main IF.
	echo '<pre>';
	print_r($dbh->ERRORINFO());
	echo '</pre>';

 $dbh = NULL; // Close the connection.

?>
</body>
</html>