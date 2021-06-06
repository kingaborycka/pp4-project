<?php
    function getUnits() {
        require_once "../../db_connection.php";
            $pdo = new PDO($db_pg, $user, $password);
            $s2 = "SELECT unit FROM units";
            $r2 = $pdo->prepare($s2);
            $r2->execute();

        if (!$r2) {
                echo "query did not execute";
            } else {   
                foreach ($r2 as $unit) {
                    echo '<script type="text/javascript">showUnit("'.$unit[0].'");</script>';
                }
            }
    }
?>