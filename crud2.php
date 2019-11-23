<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CRUD2 Page</title>
  </head>
  <body>
	  
<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );
		
	print_r($_POST);
	  
$conn = include('pdo_connect.php'); 
	  
if(!$conn) //verify database connection
{
	die('cannot display quotes due to server error');
} //end of connection 

// 	Main content display  
if($conn){


echo '<main>
	<script>
	var currentRow,id;

	$(document).on("click",".deletedata",function() {
		id = $(this).attr("data-id"); // Get the clicked id for deletion 
		currentRow = $(this).closest("tr"); // Get a reference to the row that has the button we clicked
		$.ajax({
			type:"post",
			url:location.pathname, // sending the request to the same page we are on right now
			data:{"action":"deleteEntry","id":id},
			success:function(response){
				if (response == "ok") {
					// Hide the row nicely and remove it from the DOM once the animation is finished.

					currentRow.slideUp(500,function(){
						currentRow.remove();


					})
				} else {
					// throw an error modally to let the user know there was an error
				}

		$(document).ajaxStop(function(){
		window.location.reload();
	});
			}
		})
	})
	


	$(document).on("click",".updatedata",function() {
	
	  id = $(this).attr("data-id"); // Get the clicked id for update 
	  currentRow = $(this).closest("tr"); // Get a reference to the row that has the button we clicked
	  $.ajax({
	  
	    		
			type:"post",
			url:location.pathname, // sending the request to the same page we are on right now
			data:{"action":"updateEntry","id":id, "title":title, "entry":entry},
			success:function(response){
			  if (response == "ok"){
					  // Add response in Modal body
					  $(".modal-body").html(response);

					  // Display Modal
					  $("#myModal").modal("show"); 
			  
			  
			  }  else {
					// throw an error modally to let the user know there was an error
					console.log(data.body)
				}

		$(document).ajaxStop(function(){
		window.location.reload();
	});
			
			
			
			
		  }
			
		})
	
	
	
	
	})
	
		


	</script>
	
<div id="content_wrapper">
	<div class="container">
		<section>
			<table class="table table-hover">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Title </th>
					<th scope="col">Description</th>
					<th scope="col">Delete</th>
					<th scope="col">Update</th>

				</tr>';

		

echo "outside delete isset";

if(isset($_POST["delete"])) {
	echo 'inside delete isset';
    $id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    if ($id > 0) {
        $query = "DELETE FROM entries WHERE id = :id LIMIT 1";
        $result=$dbh->prepare($query);
		$result->bindParam(":id", $id);
		$id = $_POST["id"];
		$result->execute();
		echo $result->rowCount() . " " . "Row(s) deleted <br>";	
        echo "ok";
    } else {
        echo "err";
    }

}
}
echo "outside update isset";


$query = $dbh->query("SELECT * FROM entries ORDER BY date_entered DESC");
if (!$conn){echo'no connection';}

while ($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr>
		<td class="id">'.$row['id'].'</td>
		<td class="title">'.$row['title'].'</td>
		<td class="entry">'.$row['entry'].'</td>	
		<td class= ""><form action="" method="POST"><input type="hidden" name="id" data-id="'.$row['id'].'" value= "'.$row['id'].'"><input type="submit" class="deletedata btn btn-sm btn-danger" value="Delete" name="delete" onclick="return confirm(\'Are you sure you want to delete row: ' . $row["id"] . '?\')"></form></td>
		<td class= ""><form action="" method="POST" name="edit"><input type="hidden" name="id" data-id="'.$row['id'].'" value= "'.$row['id'].'"><input type="button" class="updatedata btn btn-sm btn-success"  name="edit" value="Update" data-toggle="modal" data-target="#myModal"onclick="return confirm(\'Are you sure you want to delete row: ' . $row["id"] . '?\')"></form></td>
		';
	}//end of query

	
//$dbh=NULL;



			

echo '
</tr>
</table>
</section>
</div>
</div>
</main>';

	  
$query = $dbh->query("SELECT * FROM entries ORDER BY date_entered DESC");
var_dump($query);
if (!$conn){echo'no connection';}

	  
//Modal Entry Update Form 
echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make your update here!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form action="crud2.php" method="post">
	<p>Entry Title: <input type="text" name="title" size="40" maxsize="100" value="' . htmlentities($row['title']) . '"></p>
	<p>Entry Text: <textarea name="entry" cols="40" rows="5">' . htmlentities($row['entry']) . '</textarea></p>

	<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		
		<input type="submit" name="update" class="btn btn-primary" value="Post This Entry!">
        
     </div>

</form>
      </div>
	  
      
    </div>
  </div>
</div>';
echo "outside delete isset";


echo "<br>outside update isset";
 if (isset($_POST['edit']) && is_numeric($_POST['id'])) { // Handle the form.

	// Validate and secure the form data:
	$problem = FALSE;
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		$id = $_POST['id'];
		$title = trim(strip_tags($_POST['title']));
		$entry = trim(strip_tags($_POST['entry']));
		
	} 
	 
	 else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}
	
if (!$problem) {
	//echo 'inside no problem';
	// modal form 'update' id button 
if(isset($_POST["edit"])) {
	echo 'inside modal update isset';
    $id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    if ($id > 0) {
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

}
} // end of if no problem
 } // end of handle the form
	 else { // No ID set.
	print '<p style="color: red;">This page has been accessed in error.</p>';
} 

?>
	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

