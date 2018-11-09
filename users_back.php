<?php
$pagename="users";
include 'inc/pdo.php';
include 'inc/function.php';

$sql="SELECT * FROM user";
$query=$pdo->prepare($sql);
$query->execute();
$users=$query->fetchAll();

 ?>

 <?php include('inc/header_back.php'); ?>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <?php Affichertableauuser($users,"Liste users", "Un tableau de tous les utilisateurs enregistrés") ?>;
      </div>
    </div>
  </div>
<!--End Content -->
