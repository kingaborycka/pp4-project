<?php

    $html = fopen("templates/start.html","r");
    $str = "";
    while (!feof($html)) {
        $str .= fgets($html);
      }

    require_once "../../db_connection.php";
    $pdo = new PDO($db_pg, $user, $password);
    $s = "SELECT name, photo FROM recipes ORDER BY date desc LIMIT 9";
    $r = $pdo->prepare($s);
    $r->execute();

    print($str);

    if (!$r) {
        echo "query did not execute";
    } else {   
        $i=0; //licznik rekordów potrzebny do identyfikacji div class="recepie"
        foreach ($r as $photo) {
            //wywołanie funkcji recentRecipes(), która wczytuje zdjęcia ostatnich przepisów
            echo "name: ".$photo[0]." photo: ".$photo[1];
            echo '<script type="text/javascript">recentRecipes('.$i.',"'.$photo[0].'","'.$photo[1].'");</script>';
            $i += 1;
        }
    }
    

?>