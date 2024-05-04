<?php
session_start();
$admin = false;
$role = $_SESSION['utilisateur']['ID_role'];
if($role == 1){
  $admin = true;
}
?>

<nav class="navbar  navbar-expand-lg  bg-primary sticky-top" data-bs-theme="dark" style="z-index:1;">
  <div class="container-fluid justify-content-center">
    <a class="navbar-brand" href="#">RStageENSAA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
          if($admin){
            ?>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="admin.php">Dashboard</a>
              </li>
            <?php
          }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="rapport.php">Rapports</a>
        </li>
        <?php
          if($admin){
            ?>
              <li class="nav-item">
                <a class="nav-link" href="utilisateur.php">Utilisateurs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="filiere.php">Filières</a>
              </li>
            <?php
          }
          ?>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
      </ul>
      <!--<form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>-->
    </div>
  </div>
</nav>

