<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CRUD Page</title>
  </head>
  <body>

<form method="post">
<table class="table table-hover">
	<tr>
		<th scope="col">ID</th>
		<th scope="col">Title </th>
		<th scope="col">Description</th>
		<th scope="col">Delete</th>
		


<?php 	
	 error_reporting(E_ALL);
	
	

	$conn = include('pdo_connect.php');
		if(!$conn)
		{
			die('cannot display quotes due to server error');
		} //end of connection if
	  

	$query = $dbh->query('SELECT * FROM entries ORDER BY date_entered DESC');
	

	while ($row = $query->fetch(PDO::FETCH_ASSOC))

		{
		
		echo '<tr><td>' . $row["id"] . '</td>
			<td>' . $row["title"] . '</td><td>' . $row["entry"] . '</td><td><form action="" method="POST"><input type="hidden" name="id" value= ".$row["id"]" ><input type="submit" class="btn btn-sm btn-danger" value="Delete" name="Delete" onclick="return confirm(\'Are you sure you want to delete' . $row["id"] . '?\')"></form></td>';
		

		} //end of query
		print_r($_POST);
		
		if(isset($_POST['Delete']))
	{
		$sql = "DELETE FROM entries WHERE id = :id";
		$result=$dbh->prepare($sql);
		$result->bindParam(':id', $id);
		$id = $_POST['id'];
		$result->execute();
		echo $result->rowCount() . ' ' . 'Row(s) deleted <br>';	
		unset($result);
	
	
	}
		
 
	  ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){

            $.ajax({
                type: 'POST',
                url: 'crud.php',
                success: function(data) {
                    alert(data);
                    $("p").text(data);

                }
            });
   });
});
</script>


<?php 
  echo "You win";
 ?>


		
	</tr>
</table>
</form>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

