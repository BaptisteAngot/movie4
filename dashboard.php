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
$sql = "SELECT COUNT(id) FROM user";
$query = $pdo -> prepare($sql);
$query -> execute();
$nbid=$query->fetch();
$nbusers=$nbid['COUNT(id)'];

$sql = "SELECT COUNT(id) FROM movies_full";
$query = $pdo -> prepare($sql);
$query -> execute();
$nbfilmsbdd=$query->fetch();

$sql= "SELECT COUNT(role) FROM user WHERE role='admin'";
$query = $pdo -> prepare($sql);
$query -> execute();
$nbidadmin=$query->fetch();
$nbadmin=$nbidadmin['COUNT(role)'];

$sql= "SELECT COUNT(role) FROM user WHERE role='user'";
$query = $pdo -> prepare($sql);
$query -> execute();
$nbiduser=$query->fetch();
$nbuser=$nbiduser['COUNT(role)'];

$sql= "SELECT created_at FROM user ORDER BY created_at ASC";
$query = $pdo -> prepare($sql);
$query -> execute();
$lastuser=$query->fetch();

$sql= "SELECT created FROM movies_full ORDER BY created ASC";
$query = $pdo -> prepare($sql);
$query -> execute();
$lastmovie=$query->fetch();

include ('inc/header_back.php');
 ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-chart card-header-warning text-center">
            <div class="ct-chart"><i class="material-icons">accessibility_new</i>Utilisateurs</div>
          </div>
          <div class="card-body">
            <h4 class="card-title ">Nombre d'utilisateurs en temps réel</h4>
            <p class="card-category"><span class="text-success"><i class="material-icons text-warning">account_circle</i></span><?php echo $nbusers; ?> Utilisateurs inscrit.</p>
            <p class="card-category"><span class="text-success"><i class="material-icons text-danger">gavel</i></span><?php echo $nbadmin; ?> Admin.</p>
            <p class="card-category"><span class="text-success"><i class="material-icons text-sucess">face</i></span><?php echo $nbuser; ?> Utilisateur(s).</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> dernière utilisateur créée le <span class="text-success"><?php echo $lastuser['created_at']; ?></span>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-chart card-header-success text-center">
          <div class="ct-chart"><i class="material-icons">movie_filter</i>Films</div>
        </div>
        <div class="card-body">
          <h4 class="card-title ">Nombre de films en temps réel</h4>
          <p class="card-category"><span class="text-success"><i class="material-icons text-warning">movie_filter</i></span><?php echo $nbfilmsbdd['COUNT(id)']; ?> films en base de données.</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> Dernier film ajouté le <span class="text-success"><?php echo $lastmovie['created']; ?></span>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-chart card-header-info text-center">
        <div class="ct-chart"><i class="material-icons">movie</i>A voir</div>
      </div>
      <div class="card-body">
        <h4 class="card-title ">30 film le plus ajoutés à la liste des films à voir</h4>
        <p class="card-category"><span class="text-success"><i class="material-icons text-warning">movie_filter</i></span><?php echo $nbfilmsbdd['COUNT(id)']; ?> films en base de données.</p>
      </div>
      <div class="card-footer">
        <div class="stats">
          <p class="card-category"><span class="text-success"><i class="material-icons text-warning">movie_filter</i></span><?php echo $nbfilmsbdd['COUNT(id)']; ?> films en base de données.</p>
        </div>
      </div>
    </div>
</div>
  </div>
</div>
<?php
include 'inc/footer_back.php';
