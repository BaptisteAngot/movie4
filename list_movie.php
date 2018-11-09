<?php
$pagename="list_movie";
include 'inc/pdo.php';
include 'inc/function.php';

$sql="SELECT * FROM movies_full ORDER BY id ASC LIMIT 0,10  ";
$query=$pdo->prepare($sql);
$query->execute();
$movies=$query->fetchAll();

 ?>

 <?php include('inc/header_back.php'); ?>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <?php AffichertableauMovie($movies,"Liste users", "Un tableau de tous les utilisateurs enregistrés") ?>
      <?php modalDelete(); ?>
      </div>
    </div>
  </div>
<!--End Content -->

  <?php include('inc/footer_back.php'); ?>
