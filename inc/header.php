<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Register</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="index.php">Acceuil</a></li>
          <?php if (isLogged()) { ?>
            <li><a href="deconnexion.php">Déconnexion</a></li>
          <?php } else { ?>
            <?php if (isAdmin()) { ?>
              <li><a href="dashboard.php">Admin</a></li>
            <?php } ?>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
          <?php } ?>
        </ul>
      </nav>
    </header>
