<?php
function pre($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
function imageMovie($movie){
  ?><img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?php echo $movie['title']; ?>">
<?php }
function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
  function br()
  {
    echo '<br />';
  }
  function debug($array)
  {
    echo '<pre>';
      print_r($array);
    echo '</pre>';
  }
  function labelText($name, $title)
  {
    echo '<label for="'.$name.'">'.$title.'</label>';
    br();
    echo '<input type="text" name="'.$name.'" value="';
    if(!empty($_POST[$name])){
      echo $_POST[$name];
    }
    echo '">';
  }
  function afficherErreur($error, $name)
  {
    echo '<span class="error">';
      if (!empty($error[$name])) {
          echo $error[$name];
       }
    echo '</span>';
  }
  function labelTextArea($name, $title, $rows, $cols)
  {
    echo '<label for="'.$name.'">'.$title.'</label>';
    br();
    echo '<textarea name="'.$name.'" rows="'.$rows.'" cols="'.$cols.'"></textarea>';
  }
  function inputButton($value)
  {
    echo '<input type="submit" name="submitted" value="'.$value.'">';
  }
  function validationTexte($error, $data, $min, $max, $key, $empty = true){
  if (!empty($data)){
      if(strlen($data) < $min ) {
        $error[$key] = 'trop court.';
      } elseif(strlen($key) > $max) {
        $error[$key] = 'trop long.';
      }
  } else {
    if ($empty) {
      $error[$key] = 'Veuillez renseignez ce champ';
    }
  }
    return $error;
  }
  function generateRandomString($length) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  function validationpseudo($error,$pseudo,$min,$max,$empty = true){
  global $pdo;
  if (!empty($pseudo)) {
    if(strlen($pseudo)<$min){
      $error['pseudo']= 'minimum '.$min .' caractères';
    }
    elseif (strlen($pseudo)>$max) {
      $error['pseudo']= 'maximum '.$max.' caractères';
    }
    else{
      //Verification si idverif existe déjà
        //Selection de $idverif de $table de la $bdd
        $sql="SELECT pseudo FROM user WHERE pseudo = :pseudo";
        $query=$pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->execute();
        $resultat = $query->fetch();
        if(!empty($resultat)){
          $error['pseudo']='Pseudo déjà utilisé';
        }
    }
  }
  else{
    if($pseudo){
      $error['pseudo']='veuillez renseigner ce champ';
    }
  }
    return $error;
}
  function validationemail($error,$mail,$empty=true){
  global $pdo;
  if(!empty($mail)){
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $sql="SELECT email FROM user WHERE email = :email";
        $query=$pdo->prepare($sql);
        $query->bindValue(':email',$mail,PDO::PARAM_STR);
        $query->execute();
        $resultatmail = $query->fetch();
        if(!empty($resultatmail)){
          $error['mail']='Mail déjà utilisé';
        }
    } else {
      $error['mail'] = ' mail invalide';
    }
  }
  else {
    $error['mail'] = 'Erreur : mail vide';
  }
  return $error;
  }
  function validationpassword($error,$password1,$password2,$min,$max,$empty = true){
    global $pdo;
    if (!empty($password1)) {
      if($password1 != $password2){
        $error['password'] = 'Erreur: Veuillez saisir le même mot de passe';
      }
      elseif(strlen($password1)<$min){
        $error['password']= 'minimum '.$min .' caractères';
      }
      elseif (strlen($password1)>$max) {
        $error['password']= 'maximum '.$max.' caractères';
      }
      else{
        //Verification si idverif existe déjà
          //Selection de $idverif de $table de la $bdd
          $sql="SELECT password FROM user WHERE password = :password";
          $query=$pdo->prepare($sql);
          $query->bindValue(':password',$password1,PDO::PARAM_STR);
          $query->execute();
          $resultatpassword = $query->fetch();
          if(!empty($resultatpassword)){
            $error['password']='Pseudo déjà utilisé';
          }
      }
    }
    else {
      $error['password'] = 'Erreur : password vide';
    }
    return $error;
  }
  function isAdmin()
  {
    if (isLogged()) {
      if ($_SESSION['user']['role'] == 'admin') {
        return TRUE;
      }
    }
    return FALSE;
  }
  function isLogged()
  {
    if (!empty($_SESSION['user']['id']) && !empty($_SESSION['user']['pseudo']) && !empty($_SESSION['user']['email']) && !empty($_SESSION['user']['role']) && !empty($_SERVER['REMOTE_ADDR'])) {
      if (is_numeric($_SESSION['user']['id'])) {
        if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
          return TRUE;
        }
      }
    }
    return FALSE;
  }
/////////////////////////////////////////DASHBOARD\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function afficherelement($element,$pagename){
  echo '<li ';
  if($element[0] == $pagename ){
    echo 'class= "nav-item active">';
  }
  else{
    echo 'class= "nav-item">';
  }
  echo '<a class= "nav-link" href='.$element[1].'>';
  echo '<i class="material-icons">' .$element[2]. '</i>';
  echo '<p>' . $element[3] . '</p>';
  echo '</a>';
  echo '</li>';
}


function AfficherinfoUser($user){
  echo '<tr>';
    echo '<td>' . $user['id'] . '</td>';
    echo '<td>' . $user['pseudo'] . '</td>';
    echo '<td>' . $user['password'] . '</td>';
    echo '<td>' . $user['role'] . '</td>';
    echo '<td>' . $user['token'] . '</td>';
    echo '<td>' . $user['created_at'] . '</td>';
    echo '<td>' . $user['updated_at'] . '</td>';
    echo '<td>
            <a href="add_user_back.php?id=' . $user['id'] . '" class="btn btn-success btn-round btn-sm" role="button"> <i class="material-icons">add</i></a>
          </td>';
    echo '<td>
            <a href="edit_user_back.php?id=' . $user['id'] . '" class="btn btn-warning btn-round btn-sm" role="button"> <i class="material-icons">edit</i></a>
          </td>';
    echo '<td>
            <a href="delete_user_back.php?id=' . $user['id'] . '" class="btn btn-danger btn-round btn-sm" role="button"> <i class="material-icons">delete_forever</i></a>
          </td>';
  echo '</tr>';
}

function Affichertableauuser($users,$title,$description){
  echo '<div class="col-md-12">';
    echo '<div class="card">';
      echo '<div class="card-header card-header-success" >';
        echo '<h4 class="card-title ">' . $title . '</h4>';
        echo '<p class="card-category">' . $description . '</p>';
      echo '</div>';
      echo '<div class="card-body">';
        echo '<div class="table-responsive">';
          echo '<table class="table">';
            echo '<thead class=" text-success">';
              echo '<th> ID </th>';
              echo '<th> Pseudo </th>';
              echo '<th> Password </th>';
              echo '<th> Rôle </th>';
              echo '<th> Token </th>';
              echo '<th> Date de création </th>';
              echo '<th> Date de modification </th>';
              echo '<th> Action </th>';
            echo '</thead>';
            echo '<tbody>';
              foreach ($users as $user) {
                AfficherinfoUser($user);
              }
            echo '</tbody>';
          echo '</table>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
}

function AffichertableauMovie($movies,$title,$description){
  echo '<div class="col-md-12">';
    echo '<div class="card">';
      echo '<div class="card-header card-header-success" >';
        echo '<h4 class="card-title ">' . $title . '</h4>';
        echo '<p class="card-category">' . $description . '</p>';
      echo '</div>';
      echo '<div class="card-body">';
        echo '<div class="table-responsive">';
          echo '<table class="table">';
            echo '<thead class=" text-success">';
              echo '<th> ID </th>';
              echo '<th> Slug </th>';
              echo '<th> Titre </th>';
              echo '<th> Année </th>';
              echo '<th> Genre </th>';
              echo '<th> Synopsis </th>';
              echo '<th> Réalisateur </th>';
              echo '<th> Casting </th>';
              echo '<th> Script </th>';
              echo '<th> Temps </th>';
              echo '<th> Classification </th>';
              echo '<th> Rating </th>';
              echo '<th> Popularity </th>';
              echo '<th> Date de création </th>';
              echo '<th> Date de modification </th>';
              echo '<th> Drapeau poster </th>';
              echo '<th> Action </th>';
            echo '</thead>';
            echo '<tbody>';
              foreach ($movies as $movie) {
                AfficherinfoMovie($movie);
              }
            echo '</tbody>';
          echo '</table>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
}

function AfficherinfoMovie($movie){
  echo '<tr>';
    echo '<td>' . $movie['id'] . '</td>';
    echo '<td>' . $movie['slug'] . '</td>';
    echo '<td>' . $movie['title'] . '</td>';
    echo '<td>' . $movie['year'] . '</td>';
    echo '<td>' . $movie['genres'] . '</td>';
    echo '<td>' . $movie['plot'] . '</td>';
    echo '<td>' . $movie['directors'] . '</td>';
    echo '<td>' . $movie['cast'] . '</td>';
    echo '<td>' . $movie['writers'] . '</td>';
    echo '<td>' . $movie['runtime'] . '</td>';
    echo '<td>' . $movie['mpaa'] . '</td>';
    echo '<td>' . $movie['rating'] . '</td>';
    echo '<td>' . $movie['popularity'] . '</td>';
    echo '<td>' . $movie['created'] . '</td>';
    echo '<td>' . $movie['modified'] . '</td>';
    echo '<td>' . $movie['poster_flag'] . '</td>';
    echo '<td>
            <a href="add_movie_back.php?id=' . $movie['id'] . '" class="btn btn-success btn-round btn-sm" role="button"> <i class="material-icons">add</i></a>
          </td>';
    echo '<td>
            <a href="edit_movie_back.php?id=' . $movie['id'] . '" class="btn btn-warning btn-round btn-sm" role="button"> <i class="material-icons">edit</i></a>
          </td>';
    echo '<td>
            <a href="" class="btn btn-danger btn-round btn-sm" role="button" data-toggle="modal" data-target="#exampleModal"> <i class="material-icons">delete_forever</i></a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer un film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer le film ' . $movie['title'] . '?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <a href="delete_movie_back.php?id=' . $movie['id'] . '" class="btn btn-danger" role="button">SUPPRIMER</a>
                  </div>
                </div>
              </div>
            </div>
          </td>';
  echo '</tr>';

}

function modalDelete()
{?>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
