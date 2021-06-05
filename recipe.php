<?php

    $html = fopen("templates/recipe.html","r");
    $str = "";
    while (!feof($html)) {
        $str .= fgets($html);
      }

    print($str);
?>