<?php include('inc/pdo.php'); ?>
<?php include('inc/function.php'); ?>

<?php
$error=array();
//Vérification que l'on reçoit quelque chose dans l'URL
//debug($movies);
if(!empty($_GET['slug'])) {
  $slug = $_GET['slug'];
  //vérification BDD
    //Vérification si le slug existe
  $sql="SELECT * FROM movies_full WHERE slug= :slug";
  $query=$pdo->prepare($sql);
  $query->bindValue(':slug',$slug,PDO::PARAM_STR);
  $query->execute();
  $movie= $query->fetch();
  // Vérification si slug dans l'URL est existant dans la BDD
  if($movie['slug'] == $slug){
    // SI $movie['slug']== same url
  }
  else {
    die('Mauvais slug');
  }
}
else {
  die('404');
}
/******************************************************************************/
if (!empty($_POST['submitted'])) {
  $movieid = trim(strip_tags($_POST['movie_id']));
  $userid = $_SESSION['user']['id'];
  $sql = "INSERT INTO `liste_movie`(`user_id`, `movie_id`, `created_at`) VALUES (:userid, :movieid, NOW())";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':userid',$userid,PDO::PARAM_INT);
  $query -> bindValue(':movieid',$movieid,PDO::PARAM_INT);
  $query -> execute();
}
$sql = "SELECT * FROM liste_movie WHERE movie_id = :movie_id";
$query = $pdo -> prepare($sql);
$query->bindValue(':movie_id',$movie['id'],PDO::PARAM_STR);
$query -> execute();
$movie_id= $query -> fetch();

echo 'utilisateur actuel :' . $_SESSION['user']['id'];
echo $movie_id['user_id'];


?>
<?php include('inc/header.php'); ?>

<div class="film">
    <h1><?php echo $movie['title']; ?></h1>
    <?php imageMovie($movie); ?>
    <p class="year">Date de sortie: <?php echo $movie['year'];?></p>
    <p class="time">Durée: <?php echo convertToHoursMins($movie['runtime'],'%02d heures %02d minutes'); ?></p>
    <p class="directors">De: <?php echo $movie['directors']; ?></p>
    <p class="cast">Avec: <?php echo $movie['cast']; ?> </p>
    <p class="genre">Genre: <?php echo $movie['genres']; ?> </p>
    <p class="mpaa">Classification age: <?php echo $movie['mpaa'];?></p>
    <p class="popularity">Popularité: <?php echo $movie['popularity'];?></p>
    <p class="rating">Rating: <?php echo $movie['rating'];?></p>
    <div class="star-ratings-sprite"><span style="width: <?php echo $movie['rating'];?>%" class="star-ratings-sprite-rating"></span></div>

</div>

<!--Si connecté, affiche un bouton d'ajout à sa liste -->
<?php if (isLogged()) {
  if ( $_SESSION['user']['id'] == $movie_id['user_id'] && $movie_id['movie_id'] != $movie['id'] ) { ?>
        <form method="post">
          <input type="submit" name="submitted" value="Ajouter à ma liste">
          <input type="text" name="movie_id" value="<?php echo $movie['id']; ?>">
        </form>
      <?php } elseif ( $_SESSION['user']['id'] == $movie_id['user_id'] && $movie_id['movie_id'] == $movie['id'] ) {
        echo 'Déjà entré';
      }
      if ( $_SESSION['user']['id'] != $movie_id['user_id'] && $movie_id['movie_id'] == $movie['id'] ) {?>
        <form method="post">
          <input type="submit" name="submitted" value="Ajouter à ma liste">
          <input type="text" name="movie_id" value="<?php echo $movie['id']; ?>">
        </form>
      <?php }
      if ( $_SESSION['user']['id'] != $movie_id['user_id'] && $movie_id['movie_id'] != $movie['id'] ) {?>
        <form method="post">
          <input type="submit" name="submitted" value="Ajouter à ma liste">
          <input type="text" name="movie_id" value="<?php echo $movie['id']; ?>">
        </form><?php
      }
  } ?>

<?php include('inc/footer.php'); ?>
