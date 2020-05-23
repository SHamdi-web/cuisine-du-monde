<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cuisine du monde</title>

	<link rel="stylesheet" type="text/css" href="css_admin.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
	



</head>

<body>


<h1> <center> <img  class="image" src="cuisine.png" alt="..."> </center></h1>

	<div class="container admin">
		<div class="row">
			<h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter</a></h1>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Description</th>
							<th>Prix</th>
							<th>Cat&eacute;gorie</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<?php
						header('Content-type: text/html; charset=iso-8859-1');
						require 'database.php';

					
						$db = Database::connect();
						
						
						$statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category 
						                        FROM items LEFT JOIN categories ON items.category = categories.id
						                        ORDER BY items.id DESC');
						
						while($item = $statement->fetch())
						{
							echo '<tr>';
							echo '<td>' . $item['name'] . '</td>';
							echo '<td>' . $item['description'] .'</td>';
							echo '<td>' . $item['price'] .'</td>';
							echo '<td>' . $item['category'] .'</td>';
			
							echo '<td width=300>';
							echo '<a class="btn btn-default" href="view.php?id=' .$item['id'] .'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
							echo ' ';
							echo '<a class="btn btn-primary" href="update.php?id=' .$item['id']. '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
							echo ' '; 
							echo '<a class="btn btn-danger" href="delete.php?id='.$item['id']. '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';

							echo '</td>';
						    echo '</tr>';

						}
						
						Database::disconnect();

						?>

					</tbody>
				</table>

	
	</div>
		</div>


</body>
</html>


