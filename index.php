
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cuisine du monde</title>

<link rel="stylesheet" type="text/css" href="css_style.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>


</head>


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