<?php

    $html = fopen("templates/form.html","r");
    $str = "";
    while (!feof($html)) {
        $str .= fgets($html);
      }

    require_once "../../db_connection.php";
    $pdo = new PDO($db_pg, $user, $password);
    $s1 = "SELECT category FROM categories";
    $r1 = $pdo->prepare($s1);
    $r1->execute();

    $s2 = "SELECT unit FROM units";
    $r2 = $pdo->prepare($s2);
    $r2->execute();

    print($str);

    if (!$r1) {
        echo "query did not execute";
    } else {   
        foreach ($r1 as $category) {
            echo '<script type="text/javascript">showCategory("'.$category[0].'");</script>';
        }
    }

    if (!$r2) {
        echo "query did not execute";
    } else {   
        foreach ($r2 as $unit) {
            echo '<script type="text/javascript">showUnit("'.$unit[0].'");</script>';
        }
    }
?>