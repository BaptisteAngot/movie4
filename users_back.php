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
       <div class="col-md-12">
         <div class="card">
           <div class="card-header card-header-primary">
             <h4 class="card-title ">Table User</h4>
             <p class="card-category">Le tableau de tous les utilisateurs enregistrés</p>
           </div>
           <div class="card-body">
             <div class="table-responsive">
               <table class="table">
                 <thead class=" text-primary">
                   <th> ID </th>
                   <th> Login </th>
                   <th> Password </th>
                   <th> Status </th>
                   <th> Token </th>
                   <th> Date de création </th>
                   <th> Edit </th>
                 </thead>
                 <tbody>
                   <?php foreach ($users as $user) {
                     Afficherinfo($user);
                   } ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
      </div>
    </div>
  </div>
<!--End Content -->
