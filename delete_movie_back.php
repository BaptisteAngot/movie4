<?php
$pagename="list_movie";
include('inc/pdo.php');
include('inc/function.php');

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
}
else {
  die('404');
}

include('inc/header_back.php');
?>

<?php include('inc/footer.php'); ?>
