<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cuisine du monde</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>


</head>

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

.nav {
	margin-bottom: 40px;
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

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
    background: #e7480f ;
}

.nav>li>a:focus, .nav>li>a:hover {
    color: #e7480f;
    background-color: #eee;
}
.nav>li>a{
    color: #C33;
    font-size: 18px;
    text-shadow: 1px 1px #333;
    font-family: 'Holtwood One SC';
}

.btn-order
{
width: 100%;
padding:10px;
font-size:16px;
color:#fff;
background-color:#e7480f;
text-decoration:none;
text-shadow: 2px 2px #333;	
}

.btn-order:hover, .btn-order:focus
{
color: #fff;
background-color: #c13c0d;	
}



</style>
<body>

 <div class="container site">
        <h1> <center> <img  class="image" src="cuisine.png" alt="..."> <br />
        
        <a href="admin.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-log-in"></span> Se connecter en tant qu'administrateur</a> </center></h1>
    
 
        <?php
		
		header('Content-type: text/html; charset=iso-8859-1');
        require 'database.php';
         
        echo '<nav>
            <ul class="nav nav-pills" >';
        $db = Database::connect();
          $statement = $db->query('SELECT * FROM categories');
          $categories = $statement->fetchAll();
          foreach($categories as $category)
          {
               if($category['id'] == '1')
                    echo '<li role="presentation" class="active"> <a href="#'. $category['id'].'" data-toggle="tab">'.$category['name'].'</a></li>';
                else
                   echo '<li role="presentation" ><a href="#'. $category['id']. '" data-toggle="tab">'.$category['name'].'</a></li>';
            }
			 echo '</ul> </nav>';
         
          
          echo '<div class="tab-content">';
          
          foreach($categories as $category)
          {
              if($category['id'] == '1')
                  echo '<div class="tab-pane active" id="' . $category['id'] . '">';
              else
                  echo '<div class="tab-pane" id="' . $category['id'] . '">';
              
              echo '<div class="row">';
              
              $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
              $statement->execute(array($category['id']));
          
            while($item = $statement->fetch())
             {
                  echo '<div class="col-sm-6 col-md-4">
                            <div class="thumbnail ">
                                <img src=" '.$item['image'] . '" alt="...">
                                <div class="price"> '. $item['price'].' €</div>
                                <div class="caption">
                                    <h4>' . $item['name'] . '</h4>
                                    <p> ' . $item['description'] . '</p>
                                    <a href="#" class="btn btn-order" role="button">Commander</a>
                                </div>
                            </div>
                        </div>';
              }
              
              echo      '</div>
                        
                    </div>';
              
          } 
          Database::disconnect();
          
          echo '</div>';
        ?>




</div>


</body>
</html>