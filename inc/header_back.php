<?php
  include('inc/pdo.php');
  include('inc/function.php');

 ?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard Movie
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
  <header>
    <div class="wrapper ">
      <div class="sidebar" data-color="azure" data-background-color="white">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
          <a class="simple-text logo-normal">
            Dashboard Movie
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <?php
            $tableau_element_liste = array(
              array('dashboard','./dashboard.php','dashboard','Dashboard'),
              // array('list_user_movie','./table.php','content_paste','Movie List'),
              array('users','./users_back.php','person','Users list')
            );
             foreach ($tableau_element_liste as $element) {
               afficherelement($element, $pagename );
               }
             ?>
            <!-- your sidebar here -->
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="#pablo">Dashboard</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
              <ul class="nav justify-content-end">
                <li class="nav-item">
                  <a class="nav-link active" href="index.php">Acceuil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <!-- your content here -->
          </div>
        </div>
    </div>

  </header>
