<!DOCTYPE html>
<!-- Indique la langue du site -->
<html lang="fr">

  <head>
<!-- Tête HTML de base -->
    <meta charset="utf-8">
    <meta name="description" content="movie4">
    <meta name="keyword" content="PHP,movie4,exercice,">
    <meta name="author" content="L'équipe">
    <meta name="robots" content="all|(no)follow|(no)index|none">
    <link rel="stylesheet" href="asset/css/style.css">
<!-- Titre du site -->
    <title>Movie 4</title>

  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="index.php">Acceuil</a></li>
          <?php if (isLogged()) { ?>
            <li><a href="deconnexion.php">Déconnexion</a></li>
            <?php if (isAdmin()) { ?>
              <li><a href="dashboard.php">Admin</a></li>
            <?php } ?>
          <?php } else { ?>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
          <?php } ?>
        </ul>
      </nav>
    </header>
    <!-- Début class wrap -->
    <div class="wrap">
