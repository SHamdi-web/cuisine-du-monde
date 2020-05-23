<?php
header('Content-type: text/html; charset=iso-8859-1');
    require  'database.php';

        if(!empty($_GET['id']))

        {

            $id = checkInput($_GET['id']);

        }

    $db = Database::connect();

    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');

    $statement->execute(array($id));

    $item = $statement->fetch();

    Database::disconnect();





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

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
	

<style>

body{
	background: url(back.jpg);
}
.site {
	font-family: 'Hotwood One SC', sans serif;
}

.text-logo {
	font-family: 'Hotwood One SC', sans serif;
	color:#5cb85c;
	text-shadow: 2px 2px #ffd301;
	font-size: 30px;
	padding: 40px 0px;
	text-align: center;
}

.h1
{
text-align: center;	
}

.image
{
width: 400px;
height: 170px;	
margin-bottom: 50px;
left: 50%;
}

.text-logo .glyphicon{
	color: #5cb85c;
	text-shadow:  0px 0px #ffd301;
}

.admin{
	background: #fff;
	padding: 50px;
	border-radius: 10px;
}

.thumbnail img{
	background: #ffd301;
}

.price{
	background: #5cb85c;
	box-shadow: 0 1px rgba(0,0,0,0.2);
	-moz-box-shadow:0 1px rgba(0,0,0,0.2);
	-webkit-box-shadow:0 1px rgba(0,0,0,0.2);
	color: #fff;
	text-shadow: 2px 2px #333;
	position: absolute;
	right: 6px;
	top: 20px;
	padding: 5px 10px;
	font-size: 20px; 
	border-radius: 3px;
}

.price:before{
	border: 4px solid transparent;
	border-bottom:4px solid #4a934a;
	border-left: 4px solid #4a934a;
	content: "";
	position: absolute;
	right: 1px;
	top: -8px;
}

.caption > p
{
font-size: 20px;
text-align:center;
}
.caption > h4
{
	text-align:center;
    color: #e7480f;
    font-size: 25px;
}

</style>
    </head>

    <body>

       <h1> <center> <img  class="image" src="cuisine.png" alt="..."> </center></h1>

        <div class="container admin">

            <div class="row">

                <div class="col-sm-6">

                    <h1><strong>Voir un Item</strong></h1>

                    <br>

                    <form>

                        <div class="form-group">

                            <label>Nom:</label><?php echo ' ' . $item['name']; ?> <br>

                            <label>Description:</label><?php echo ' ' . $item['description']; ?> <br>

                            <label>Prix:</label><?php echo ' ' .$item['price']; ?> <br>

                            <label>Categories:</label><?php echo ' ' . $item['category']; ?> <br>

                            <label>Image:</label><?php echo ' ' . $item['image']; ?> <br>

                        </div>

                    </form>

                    <div class="form-actions"><a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>

                    </div>

               

                </div>

                <div class="col-sm-6 site">

                    <div class="thumbnail">

                            <img src="<?php echo $item['image'];?>" alt="...">

                            <div class="price"><?php echo $item['price']. " €"; ?></div>

                            <div class="caption">

                                <h4><?php echo $item['name']; ?></h4>

                                <p><?php echo $item['description']; ?></p>

                                

                            </div>

                        </div>

                </div>

            </div>

        </div>

    </body>

</html>