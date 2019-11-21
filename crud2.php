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
		<td class= ""><button type="button" class="btn btn-sm btn-success" value="Update" data-toggle="modal" data-target="#exampleModal">Update</button></td>
		';
	}//end of query

	
//$dbh=NULL;

}

			

echo '
</tr>
</table>
</section>
</div>
</div>
</main>';
	  


	  
//Modal Entry Update Form 
echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make your update here!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form action="edit_entry.php" method="post">
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
?>
	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

