<?php
$pagename="dashboard";
include 'inc/pdo.php';
include 'inc/function.php';
// pre($_SESSION);
if(isAdmin()){
include 'inc/header_back.php';
 ?>

<?php
include 'inc/footer_back.php';
}
else {
  die('403');
}
 ?>
