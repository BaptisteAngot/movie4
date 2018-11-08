<?php
include 'inc/pdo.php';
include 'inc/function.php';

$error = array();
if (!empty($_POST['submitted']))
{
  $mail = trim(strip_tags($_POST['mail']));
  if (!empty($mail)){
    // Requête SQL des pseudos
    $sql = "SELECT email, token FROM user WHERE email = :mail";
    $query = $pdo -> prepare($sql);
    $query -> bindValue(':mail',$mail);
    $query -> execute();
    $user = $query->fetch();
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error['mail'] = 'E-mail invalide';
    }
    else {
      if (!empty($user)) {
        $body = '<p>Cliquez <a href="new_password.php?email='.urlencode($user['email']).'&token='.urlencode($user['token']).'">ICI<?php"></a></p>';
        echo $body;
      }
      else {
        $error['mail'] = 'Pas de pseudo à cette adresse';
      }
    }
    }

}
// Cette page s'affiche lors de la connexion ( à travers un lien)
// 1 - Formulaire avec mail
// 2 - Rechercher dans la bdd un email correspondant et récupération du token
// 3 - Envoyez un mail avec un lien avec un mail ainsi que le token dans l'url à l'utilisateur
// 4 - Lorsque l'utilisateur clique sur le lien, il serait redirigé vers un nouvelle page pour modifier son mdp

include 'inc/header.php';
 ?>

<form class=""  method="post">
  <label for="mail">Adresse mail :</label>
  <input type="email" name="mail" value="<?php if (!empty($_POST['email'])) {
    echo $_POST['email'];
  } ?>">
  <?php
  afficherErreur($error, 'mail');
  br(); ?>
  <input type="submit" name="submitted" value="Envoyer">

</form>

<?php
include 'inc/footer.php';
