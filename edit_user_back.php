<?php
include('inc/pdo.php');
include('inc/function.php');
$pagename="users";

$roles=array(
  'admin' => 'admin',
  'user' => 'user'
);

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $sql="SELECT * FROM user WHERE id = $id";
  $query=$pdo->prepare($sql);
  $query->execute();
  $user=$query->fetch();

  if (!empty($user)) {
    if (!empty($_POST['submitted']))
    {
      $roles = trim(strip_tags($_POST['role']));

      // Modifier un post dans la BDD
      $sql = "UPDATE user SET updated_at = NOW(), role = :role WHERE id = $id";
      $query = $pdo -> prepare($sql);
      $query -> bindValue(':role', $roles, PDO::PARAM_STR);
    }
    else {
      die ('efaqf');
    }
  }
  else {
    die('404');
  }
}
else {
  die('404');
}
include('inc/header_back.php');
?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-warning text-center">
        <h4>Modification d'un user :</h4>
      </div>
      <form class="" method="post">
        <div class="form-group">
          <label for="pseudo" class="bmd-label-floating">Login :</label>
          <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php if(!empty($user['pseudo'])){echo $user['pseudo'];} ?>" disabled>
        </div>
        <div class="form-group">
          <label for="password" class="bmd-label-floating">Password :</label>
          <input type="text" class="form-control" id="password" name="password" value="<?php if(!empty($user['password'])){echo $user['password'];} ?>" disabled>
        </div>
        <div class="form-group">
          <label for="token" class="bmd-label-floating">Token :</label>
          <input type="text" class="form-control" id="token" name="token" value="<?php if(!empty($user['token'])){echo $user['token'];} ?>" disabled>
        </div>
        <div class="form-group">
          <label for="role" class="bmd-label-floating">Rôle :</label>
          <select class="form-control" id="role" name="role">
            <?php foreach($roles as $role => $value) { ?>
              <option value="<?php echo $key; ?>"<?php if(!empty($_POST['role'])) { if($_POST['role'] == $role) { echo ' selected="selected"'; } } ?>><?php echo $value; ?></option>
              <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="mail" class="bmd-label-floating">E-mail :</label>
          <input type="email" class="form-control" id="mail" name="mail" value="<?php if(!empty($user['email'])){echo $user['email'];} ?>" disabled>
        </div>
        <div class="form-group">
          <label for="created_at" class="bmd-label-floating">Créée le :</label>
          <input type="text" class="form-control" id="created_at" name="created_at" value="<?php if(!empty($user['created_at'])){echo $user['created_at'];} ?>" disabled>
        </div>

        <div class="form-group text-center">
          <input type="submit" class="btn btn-primary" name="submitted" value="Envoyer">
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('inc/footer.php'); ?>
