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
<div class="content">
  <div class="container-fluid">
    <div class="row">
      toto
    </div>
  </div>
</div>
<?php
include 'inc/footer_back.php';
