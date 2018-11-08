<?php include('inc/pdo.php'); ?>
<?php include('inc/function.php'); ?>

<?php

  $movieid = $film['id'];
if(!empty($_POST('submitted'))){
  $sql = "INSERT INTO `liste_movie`(`user_id`, `movie_id`, `note`, `created_at`, `modified_at`) VALUES (:userid, :movieid, NULL, NOW(), NULL)";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':userid',$userid,PDO::PARAM_INT);
  $query -> bindValue(':movieid',$movieid,PDO::PARAM_INT);
  $query -> execute();
  $movie= $query->fetch();
}
// header('Location: detail.php');
?>
<?php include('inc/header.php'); ?>

<?php include('inc/footer.php'); ?>
