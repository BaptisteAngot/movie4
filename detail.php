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
</div>

// Si connecté, affiche un bouton d'ajout à sa liste
<?php if (isLogged()){?>
  <a href="addlist.php">Ajouter à la liste</a>
<?php } ?>

<?php include('inc/footer.php'); ?>
