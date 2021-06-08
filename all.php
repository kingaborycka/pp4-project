<?php

    $html = fopen("templates/all.html","r");
    $str = "";
    while (!feof($html)) {
        $str .= fgets($html);
      }

    require_once "../../db_connection.php";
    $pdo = new PDO($db_pg, $user, $password);
    $s = "SELECT recipe_id, name, photo FROM recipes ORDER BY name asc";
    $r = $pdo->prepare($s);
    $r->execute();

    print($str);

    if (!$r) {
        echo "query did not execute";
    } else {   
        foreach ($r as $photo) {
            //wywołanie funkcji recentRecipes(), która wczytuje zdjęcia ostatnich przepisów
            echo '<script type="text/javascript">populateRecipes('.$photo[0].',"'.$photo[1].'","'.$photo[2].'");</script>';
        }
    }
    

?>