<?php

    $html = fopen("templates/recipe.html","r");
    $str = "";
  

    while (!feof($html)) {
        $str .= fgets($html);
      }
      
      if(isset($_GET['pk']))
      {
        $id = $_GET['pk'];
        $name = "";
        $description = "";
        $nick = "";
        $portions = 0;
        $categories_array = array();
        $ingredients_array = array();
        
        require_once "../../db_connection.php";
        $pdo = new PDO($db_pg, $user, $password);
        
        $s1 = "SELECT * FROM recipes WHERE recipe_id='$id'";
        $r1 = $pdo->prepare($s1);
        $r1->execute();

        foreach ($r1 as $row) {
        
          $name = $row['name'];
          $description = $row['description'];
          $nick = $row['nick'];
          $portions = $row['portions'];
 
        // echo '<pre>';print_r($row);'</pre>';
        }

        $s2 = "SELECT category from recipes_categories where recipe_id='$id'";
        $r2 = $pdo->prepare($s2);
        $r2->execute();
        
        $s3 = "SELECT ingredient,volume,unit from ingredients_volumes where recipe_id='$id'";
        $r3 = $pdo->prepare($s3);
        $r3->execute();

        print($str);

        foreach ($r2 as $row) {
          $categories_array[] = $row[0];
        }

        foreach ($r3 as $row) {
          $ingredients_array[] = array($row[0],$row[1],$row[2]);
        }

        echo '<script type="text/javascript">representRecipe("'.$name.'","'.$description.'","'.$portions.'","'.$nick.'");</script>';
        foreach ($categories_array as $cat) {
          echo '<script type="text/javascript">renderCategory("'.$cat.'");</script>';
        }
        foreach ($ingredients_array as $ing) {
          echo '<script type="text/javascript">renderIngredient("'.$ing[0].'",'.$ing[1].',"'.$ing[2].'");</script>';
        }
      }


?>