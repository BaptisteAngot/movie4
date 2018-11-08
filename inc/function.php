<?php

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
