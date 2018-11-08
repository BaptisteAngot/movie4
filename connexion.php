<?php
include 'inc/pdo.php';
include 'inc/function.php';

$error = array();
if (!empty($_POST['submitted']))
{
  $login_mail = trim(strip_tags($_POST['login_mail']));
  $password = trim(strip_tags($_POST['password']));

  $sql = "SELECT * FROM user WHERE pseudo = :login_mail OR email = :login_mail";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':login_mail',$login_mail);
  $query -> execute();
  $user = $query -> fetch();
  if (!empty($user)) {
    if (!password_verify($password, $user['password'])) {
      $error['password'] = 'Mot de passe incorrect';
    }

  }
  else {
    $error['login_mail'] = 'Identifiant incorrect';
  }


  if(count($error) == 0)
  {
    $_SESSION['user'] = array(
      // Clé unique pour eviter les problèmes de connexion
      'id' => $user['id'],
      'pseudo' => $user['pseudo'],
      'email' => $user['email'],
      'role' => $user['role'],
      'ip' => $_SERVER['REMOTE_ADDR']
    );
    header('Location: index.php');
  }
 }

 // lien vers une page mdp oublié

include 'inc/header.php';
 ?>

 <form method="post">
    <label for="login_mail">Login ou e-mail :</label>
    <input type="text" name="login_mail" value="">
    <?php
    afficherErreur($error, 'login_mail');
    br(); ?>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" value="">
    <?php
    afficherErreur($error, 'password');
    br(); ?>
    <a href="password_forget.php">Mot de passe oublié?</a>
    <input type="submit" name="submitted" value="Envoyer">
 </form>

 <?php
include 'inc/footer.php';
