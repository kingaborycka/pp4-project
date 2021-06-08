
<?php

    require_once "../../db_connection.php";
    $pdo = new PDO($db_pg, $user, $password);
    
    $s1 = "SELECT nick FROM users";
    $r1 = $pdo->prepare($s1);
    $r1->execute();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!$r1) {
            //echo "Nie udało się pobrać nicków ";
        } else {   
            $nick = $_POST["nick"];
            $email = $_POST["email"];    
            $nicks_array = array();

            foreach ($r1 as $n) {
                $nicks_array[] = $n[0];
            }
            
            if (in_array($nick, $nicks_array)) {
                // echo "Użytkownik ".$nick." istnieje w bazie";
            }else{
                $s2 = "INSERT INTO users VALUES ('$nick','$email')";
                $r2 = $pdo->prepare($s2);
                $r2->execute();
                if (!$r2) {
                    //echo "Nie udało się dodać ".$nick;
                }else{
                    //echo "Dodano ".$nick;
                }
            }

            //PRZEPIS

            $description = trim($_POST["description"]);
            $name = $_POST["name"];
            $portions = $_POST["portions"];
            // $photo =
            

            $s3 = "INSERT INTO \"recipes\"(\"nick\", \"description\", \"name\", \"portions\") VALUES ('$nick','$description', '$name', '$portions') RETURNING recipe_id";
            $r3 = $pdo->prepare($s3);
            $r3->execute();

            //Pobieranie id dodanego właśnie przepisu
            $result = $r3->fetch(PDO::FETCH_ASSOC);
            $recipe_id = $result["recipe_id"];

            // Dodanie pliku

            $file = $_FILES['file-upload'];
            $upload_dir = getcwd()."/"."photos/";
            $file_path = $upload_dir . $recipe_id.".jpg";

            if($file['error']==0){

                echo $file_path;
                move_uploaded_file($file['tmp_name'], $file_path);
            }
            
            

            //KATEGORIE
            // echo '<script>getCategories();</script>';
            
            $categories = $_POST['category'];  
            $cat="";  
            foreach($categories as $cat1){  
                $cat .= "(".$recipe_id.", '".$cat1."'),";
            }  

            $s4 = "INSERT INTO \"recipes_categories\"(\"recipe_id\", \"category\") VALUES ".substr($cat, 0, -1);
            $r4 = $pdo->prepare($s4);
            $r4->execute();

            //SKŁADNIKI

            //print_r($_POST);
            //echo "\nInge";
            $ing="";
            $ing_vol="";

            $s7 = "SELECT ingredient FROM ingredients";
            $r7 = $pdo->prepare($s7);
            $r7->execute();
        
            if(!$r7){
                //echo "Nie udało się pobrać składników ";
            } else {   
                $ing_array = array();
            
                foreach ($r7 as $ingredient) {
                    $ing_array[] = $ingredient[0];
                }
                
                //echo '<pre>';print_r($ing_array); '</pre>';

                foreach($_POST as $key => $value){
                    if(substr( $key, 0,  10) === "ingredient"){
                        if (!in_array($value, $ing_array)) {
                            $ing .= "('".$value."'),";
                        }
                        $ing_vol .= "(".$recipe_id.",'".$value."',";

                    }else if(substr( $key, 0,  6) === "volume"){
                        $ing_vol .= "'".$value."',";
                    }else if(substr( $key, 0,  5) === "units"){
                        $ing_vol .= "'".$value."'),";
                    }
                }
                
            
                $s5 = "INSERT INTO \"ingredients\" VALUES ".substr($ing, 0, -1);
                $r5 = $pdo->prepare($s5);
                $r5->execute(); 
                
                $s6 = "INSERT INTO \"ingredients_volumes\"(\"recipe_id\",\"ingredient\", \"volume\", \"unit\") VALUES ".substr($ing_vol, 0, -1);
                $r6 = $pdo->prepare($s6);
                $r6->execute();
                
                echo '<script type="text/javascript">window.location = "http://v-ie.uek.krakow.pl/~s214804/pp4-project/index.php"</script>';
            }
        }
    }
?>

