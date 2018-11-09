<?php
$pagename="statistique";
include 'inc/pdo.php';
include 'inc/function.php';
isLogged();
// pre($_SESSION);
if(isAdmin()){

}
else {
  die('403');
}

include ('inc/header_back.php');
 ?>

<?php
include 'inc/footer_back.php';
