<?php
header('Content-type: text/html; charset=iso-8859-1');
    require 'database.php';
    
    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

    if(!empty($_POST))
    {
        $name               = checkInput($_POST['name']);
        $description        = checkInput($_POST['description']);
        $price              = checkInput($_POST['price']);
        $category           = checkInput($_POST['category']);
        $image              = checkInput($_FILES['image']['name']);
        $imagePath          = basename($image);
        $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($name))
        {
            $nameError = "Ce champ ne peut pas �tre vide";
            $isSuccess = false;
        }
        if(empty($description))
        {
            $descriptionError = "Ce champ ne peut pas �tre vide";
            $isSuccess = false;
        }
        if(empty($price))
        {
            $priceError = "Ce champ ne peut pas �tre vide";
            $isSuccess = false;
        }
        if(empty($category))
        {
            $categoryError = "Ce champ ne peut pas �tre vide";
            $isSuccess = false;
        }
        if(empty($image))
        {
            $imageError = "Ce champ ne peut pas �tre vide";
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
            if($imageExtension !="jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
            {
                $imageError = "Les fichiers autoris�s sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath))
            {
                $imageError = "Le fichier existe d�j�";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000)
            {
                $imageError = "Le fichier ne doit pas d�passer les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }
        
        if($isSuccess && $isUploadSuccess)
        {
            $db = Database::connect();
/*?>            $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) VALUES(?, ?, ?, ?, ?)");
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: admin.php");<?php */
        }
        
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
	<link rel="stylesheet" type="text/css" href="css_insert.css">
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


    
    <body>
        <h1> <center> <img  class="image" src="cuisine.png" alt="..."> </center></h1>
        <div class="container admin">
            <div class="row">              
                <h1><strong>Ajouter un item</strong></h1>
                <br>
                <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom: </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description: </label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix: (en&euro;)</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                        <span class="help-inline"><?php echo $priceError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Cat&eacute;gorie:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                                $db = Database::connect();
                                foreach($db->query('SELECT * FROM categories') as $row)
                                {
                                   echo '<option value="' .$row['id'] . '">' . $row['name'] . '</option>';
                                }
                                Database::disconnect();
                            ?>                                                    
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">S&eacute;lectionner une image:</label>
                        <input type="file" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                
                <br>
                <div class="form-actions">
                
                  <div class="btn-success popup btn" onclick="myFunction()"> <span class="glyphicon glyphicon-pencil"></span> Ajouter
  				<span class="popuptext" id="myPopup">Cette fonctionalit� est d�sactiv�e!</span>
			</div> 
            
                  
                    <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
                    </form>
                                                      
            </div>
        
        </div>
    
    </body>
    
</html>









