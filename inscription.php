<?php
include 'inc/pdo.php';
include 'inc/function.php';

$error = array();
if (!empty($_POST['submitted']))
{

  // Vérification pseudo
  $pseudo = trim(strip_tags($_POST['pseudo']));
  if (!empty($pseudo)){
    // Requête SQL des pseudos
    $sql = "SELECT pseudo FROM user WHERE pseudo = :pseudo";
    $query = $pdo -> prepare($sql);
    $query -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $query -> execute();
    $resultatPseudo = $query->fetch();

      if(strlen($pseudo) < 3 ) {
        $error['pseudo'] = 'trop court.';
      }
      elseif(strlen($pseudo) > 50) {
        $error['pseudo'] = 'trop long.';
      }
      elseif (!empty($resultatPseudo)) {
        $error['pseudo'] = 'Déjà pris.';
      }
  } else {
      $error['pseudo'] = 'Veuillez renseignez ce champ';
  }


  $mail = trim(strip_tags($_POST['mail']));
  if (!empty($mail)){
    // Requête SQL des pseudos
    $sql = "SELECT email FROM user WHERE email = :mail";
    $query = $pdo -> prepare($sql);
    $query -> bindValue(':mail', $mail, PDO::PARAM_STR);
    $query -> execute();
    $resultatMail = $query->fetch();

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error['mail'] = 'E-mail invalide';
    }
    elseif (!empty($resultatMail)) {
      $error['mail'] = 'Déjà pris.';
    }
  }
  else {
      $error['mail'] = 'Veuillez renseignez ce champ';
  }



  $mdp = trim(strip_tags($_POST['mdp']));
  $mdp2 = trim(strip_tags($_POST['mdp2']));
  if ((!empty($mdp)) && (!empty($mdp2))) {
      if(strlen($mdp) < 3 ) {
        $error['mdp'] = 'trop court.';
      }
      elseif(strlen($mdp) > 50) {
        $error['mdp'] = 'trop long.';
      }
      elseif ($mdp != $mdp2) {
        $error['mdp'] = 'Veuillez renseigné le même mdp.';
      }
  } else {
      $error['mdp'] = 'Veuillez renseignez ce champ';
  }

  if (count($error) == 0) {
    // Inscrire un post dans la BDD
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
    $token = generateRandomString(50);
    $sql = "INSERT INTO user(pseudo, email, password, created_at, token) VALUES (:pseudo, :email, :password, NOW(), :token)";
    $query = $pdo -> prepare($sql);
    $query -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $query -> bindValue(':email', $mail, PDO::PARAM_STR);
    $query -> bindValue(':password', $hash, PDO::PARAM_STR);
    $query -> bindValue(':token', $token, PDO::PARAM_STR);
    $query -> execute();

    // redirection
    header('Location: index.php');
  }
  debug($error);
}

include 'inc/header.php';
 ?>

<form action="" method="post">
  <label for="pseudo">Pseudo :</label>
  <input type="text" name="pseudo" value="">
  <?php
  afficherErreur($error, 'pseudo');
  br(); ?>
  <label for="mail">E-mail :</label>
  <input type="text" name="mail" value="">
  <?php
  afficherErreur($error, 'mail');
  br(); ?>
  <label for="mdp">Mot de passe :</label>
  <input type="password" name="mdp" value="">
  <?php
  afficherErreur($error, 'mdp');
  br(); ?>
  <label for="mdp2">Vérifiez votre mot de passe :</label>
  <input type="password" name="mdp2" value="">
  <?php
  afficherErreur($error, 'mdp');
  br(); ?>
  <input type="submit" name="submitted" value="Envoyer">
</form>


<?php
include 'inc/footer.php';
