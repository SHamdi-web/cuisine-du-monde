<?php
header('Content-type: text/html; charset=iso-8859-1');
    require 'database.php';
	
 	if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();

         /*?>$statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
		header("Location: admin.php");<?php */
		Database::disconnect();
		
	}
	
	function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	?>
    
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cuisine du monde</title>
	<link rel="stylesheet" type="text/css" href="css_delete.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>


<script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>


</head>

<body>


<h1> <center> <img  class="image" src="cuisine.png" alt="..."> </center></h1>
        <div class="container admin">
            <div class="row">
            
            <h1> <strong> Supprimer un item </h1> </strong> <br>
            <form class="form" role="form" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-warning"> Etes vous sur de vouloir supprimer ? </p>
            <div class="form-actions">
             <div class="btn-warning popup btn" onclick="myFunction()"> Oui
  				<span class="popuptext" id="myPopup">Cette fonctionalité est désactivée!</span>
			</div> 
            <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour</a>
            </div>
          



            </form>
            </div>
            
</div>


</body>
</html>