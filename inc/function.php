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
