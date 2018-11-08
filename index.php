<?php
      include 'inc/pdo.php';
      include 'inc/function.php';

      $sql = "SELECT *   FROM `movies_full` ORDER BY RAND() LIMIT 0,5";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $movie = $query -> fetchall();

      foreach ($movie as $film) {
        // echo $film['id']; ?>
        <div class="posters">
        <a href="detail.php"><img src="posters/<?php echo $film['id']; ?>.jpg" alt="posters"></a>
        </div>
        <?php
        echo '</br>';
      }
        include 'inc/header.php'; ?>

      <button type="button" name="button"> <a href="index.php">+ de films !</a></button>
