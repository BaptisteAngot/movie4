<?php

include('inc/pdo.php'); ?>

<?php

if (!empty($_POST)) {
  echo '<pre>'.print_r($_POST,true).'</pre>';
}
 ?>
 <form method="post">
     <input type="checkbox" name="tableau[]" value=" <?php

                    $sql = "SELECT title FROM movies_full WHERE genres = 'Drama'";
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $genres = $query -> fetchAll();

                    $tableau = array();
                    foreach ($genres as $genre) {
                      $g = $genre['title'];
                      $explode = explode(',',$g);
                      foreach ($explode as $ex) {
                        $ex = trim($ex);
                        if (!in_array($ex,$tableau)) {
                          if (!empty($ex)) {
                            $tableau[] = $ex;
                          }
                        }
                      }
                    }

                    print_r ($genres);

    ?> ">Drama<br>
     <input type="checkbox" name="tableau[]" value="Hey!">CB2<br>
     <input type="checkbox" name="tableau[]" value="Coucou!">CB3<br>
     <input type="checkbox" name="tableau[]" value="tableau4">CB4<br>
     <input type="checkbox" name="tableau[]" value="tableau5">CB5<br>
  
     <input type="submit" value="envoyer">
 </form>







<!-- echo print_r($tableau[0]);
