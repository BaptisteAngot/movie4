<?php
      include 'inc/pdo.php';
      include 'inc/function.php';

      $sql = "SELECT *   FROM `movies_full` ORDER BY RAND() LIMIT 0,5";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      $movie = $query -> fetchall();
      include 'inc/header.php';
      foreach ($movie as $film) {
        // echo $film['id']; ?>
        <div class="posters">
        <a href="detail.php?slug=<?php echo $film['slug'] ;?>"><img src="posters/<?php echo $film['id']; ?>.jpg" alt="posters"></a>
        </div>
        <?php
        echo '</br>';
      }
      ?> <button type="button" name="button"> <a href="refresh.php">+ de films !</a> </button>

    <?php include 'inc/footer.php';?>
